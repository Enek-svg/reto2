<?php
// Cerebro de la web: presupuesto, compatibilidad, cuellos de botella, recomendaciones.

const ETIQUETAS = [
    'cpu' => 'Procesador', 'gpu' => 'Tarjeta gráfica', 'placa' => 'Placa base', 'ram' => 'Memoria RAM',
    'fuente' => 'Fuente de alimentación', 'disco' => 'Almacenamiento', 'caja' => 'Caja', 'refrigeracion' => 'Refrigeración',
];

// Guía para principiantes: qué hace cada pieza
const GUIAS = [
    'cpu' => 'El procesador es el "cerebro": ejecuta todas las órdenes. Más potencia = programas y juegos más fluidos.',
    'gpu' => 'La gráfica genera las imágenes. Es lo más importante para jugar o editar vídeo.',
    'placa' => 'La placa base conecta todas las piezas entre sí. Define qué RAM y qué procesador puedes usar.',
    'ram' => 'La RAM es la memoria de trabajo: cuántas cosas puedes tener abiertas a la vez sin que vaya lento.',
    'fuente' => 'La fuente da electricidad a todo el equipo. Si se queda corta, el PC puede apagarse o dañarse.',
    'disco' => 'Guarda tus archivos y programas. Un SSD arranca y abre todo mucho más rápido que un HDD.',
    'caja' => 'Protege las piezas y permite que circule el aire para que no se calienten.',
    'refrigeracion' => 'Mantiene el procesador fresco. Si se calienta demasiado, baja su rendimiento y dura menos.',
];

const PERFILES = [
    1 => 'ofimática, navegar y ver vídeos',
    2 => 'estudiar, multitarea y juegos ligeros en 1080p',
    3 => 'jugar en 1080p con buenos ajustes',
    4 => 'jugar en 1440p y crear contenido',
    5 => 'juegos 4K, edición de vídeo y trabajo profesional',
];

/** Convierte los índices elegidos en el formulario en componentes (valida que existan). */
function obtenerConfiguracion(array $catalogo, array $post): array {
    $config = [];
    foreach ($catalogo as $cat => $lista) {
        $i = filter_var($post[$cat] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => count($lista) - 1]]);
        $config[$cat] = $lista[$i === false ? 0 : $i];
    }
    return $config;
}

function precioTotal(array $config): float {
    return round(array_sum(array_column($config, 'precio')), 2);
}

function consumoEstimado(array $config): int {
    return $config['cpu']['tdp'] + $config['gpu']['tdp'] + 100; // +100W resto de piezas
}

/** Enlace a PcComponentes: URL directa si existe; si no, búsqueda del modelo; null si no aplica. */
function enlaceTienda(array $p): ?string {
    if (!empty($p['url'])) return $p['url'];
    if (!empty($p['busqueda'])) return 'https://www.pccomponentes.com/buscar/?query=' . rawurlencode($p['busqueda']);
    return null;
}

/**
 * Devuelve una lista de alertas: [nivel, titulo, texto]  (nivel: error | aviso | ok)
 * 'error' = no funciona / no encaja.  'aviso' = funciona pero no es buena idea.
 */
function analizar(array $c, float $presupuesto = 0): array {
    $a = [];
    $err = function (string $t, string $x) use (&$a) { $a[] = ['error', $t, $x]; };
    $avi = function (string $t, string $x) use (&$a) { $a[] = ['aviso', $t, $x]; };

    $cpu = $c['cpu']; $gpu = $c['gpu']; $pl = $c['placa']; $ram = $c['ram'];
    $psu = $c['fuente']; $dk = $c['disco']; $cj = $c['caja']; $rf = $c['refrigeracion'];

    // ===== COMPATIBILIDAD FÍSICA / ELÉCTRICA (errores) =====

    // 1. Socket CPU <-> placa
    if ($cpu['socket'] !== $pl['socket']) {
        $err('Socket incompatible', "El procesador usa {$cpu['socket']} y la placa {$pl['socket']}. No encajan físicamente.");
    }
    // 2. Tipo de RAM <-> placa
    if ($ram['ddr'] !== $pl['ddr']) {
        $err('Memoria incompatible', "La placa usa {$pl['ddr']} y la RAM es {$ram['ddr']}.");
    }
    // 3. Capacidad y módulos de RAM
    if ($ram['capacidad'] > $pl['ram_max']) {
        $err('Demasiada RAM para la placa', "La placa admite como máximo {$pl['ram_max']}GB y has elegido {$ram['capacidad']}GB.");
    }
    if ($ram['modulos'] > $pl['ram_slots']) {
        $err('Faltan ranuras de RAM', "El kit tiene {$ram['modulos']} módulos y la placa solo {$pl['ram_slots']} ranuras.");
    }
    // 4. Formato de placa <-> caja
    if (!in_array($pl['formato'], $cj['formatos'], true)) {
        $err('La placa no cabe en la caja', "La placa es {$pl['formato']} y la caja solo admite " . implode('/', $cj['formatos']) . '.');
    }
    // 5. Sin gráfica dedicada => la CPU necesita gráficos integrados
    if ($gpu['tdp'] === 0 && !$cpu['igpu']) {
        $err('No habrá imagen', "Has elegido no poner gráfica dedicada, pero {$cpu['nombre']} no tiene gráficos integrados.");
    }
    // 6. Longitud de la gráfica <-> caja
    if ($gpu['longitud'] > $cj['gpu_max']) {
        $err('La gráfica no cabe en la caja', "La gráfica mide {$gpu['longitud']}mm y la caja admite hasta {$cj['gpu_max']}mm.");
    }
    // 7. Potencia mínima recomendada por el fabricante de la gráfica
    if ($psu['vatios'] < $gpu['psu_min']) {
        $err('Fuente por debajo del mínimo de la gráfica', "Esta gráfica pide al menos {$gpu['psu_min']}W y la fuente es de {$psu['vatios']}W.");
    }
    // 8. Consumo total con margen de seguridad
    $consumo = consumoEstimado($c);
    if ($psu['vatios'] < $consumo * 1.2) {
        $err('Fuente insuficiente', "Consumo estimado: {$consumo}W. Se recomienda una fuente de al menos " . ceil($consumo * 1.2) . "W y has elegido {$psu['vatios']}W.");
    }
    // 9. Disipador: socket
    if (!in_array($cpu['socket'], $rf['sockets'], true)) {
        $err('Disipador incompatible', "El disipador no tiene anclaje para {$cpu['socket']}.");
    }
    // 10. Disipador de serie: solo si la CPU lo incluye
    if ($rf['stock'] && !$cpu['cooler_incluido']) {
        $err('Este procesador no incluye disipador', "{$cpu['nombre']} se vende sin disipador. Elige uno de torre o líquido.");
    }
    // 11. Capacidad de refrigeración (TDP)
    if ($cpu['tdp'] > $rf['tdp_max']) {
        $err('Refrigeración insuficiente', "El procesador genera hasta {$cpu['tdp']}W y el disipador solo disipa {$rf['tdp_max']}W.");
    }
    // 12. Altura del disipador de aire <-> caja
    if ($rf['altura'] > $cj['cooler_max']) {
        $err('El disipador no cabe en la caja', "El disipador mide {$rf['altura']}mm y la caja admite {$cj['cooler_max']}mm.");
    }
    // 13. Radiador AIO <-> caja
    if ($rf['radiador'] > 0 && !in_array($rf['radiador'], $cj['radiadores'], true)) {
        $err('La caja no admite ese radiador', "La refrigeración líquida de {$rf['radiador']}mm no se puede montar en esta caja.");
    }
    // 14. Disco: ranura M.2 y bahía de 3.5"
    if ($dk['tipo'] === 'NVMe' && $pl['m2'] < 1) {
        $err('La placa no tiene ranura M.2', 'El SSD NVMe necesita una ranura M.2.');
    }
    if ($dk['tipo'] === 'HDD' && $cj['bahias_35'] < 1) {
        $err('La caja no tiene bahía de 3.5"', 'El disco mecánico necesita una bahía de 3.5" y esta caja no tiene.');
    }

    // ===== AVISOS (funciona, pero no es buena idea) =====

    // 15. Conector de la gráfica
    if ($gpu['conector'] === '16pin') {
        $avi('Conector 12V-2x6 (16 pines)', 'Esta gráfica usa un conector de 16 pines. Comprueba que la fuente lo tenga (ATX 3.x) o que incluya adaptador.');
    }
    // 16. Cuello de botella (en ambos sentidos)
    $dif = $gpu['gama'] - $cpu['gama'];
    if ($gpu['tdp'] > 0 && $dif >= 2) {
        $avi('Cuello de botella: procesador', 'El procesador es demasiado flojo para esa gráfica y no la dejará rendir al máximo.');
    } elseif ($gpu['tdp'] > 0 && $dif <= -2) {
        $avi('Cuello de botella: gráfica', 'La gráfica es muy modesta para ese procesador; pagas una potencia de CPU que no vas a aprovechar.');
    }
    // 17. Temperatura / ruido con disipador justo
    if (!$rf['stock'] && $cpu['tdp'] <= $rf['tdp_max'] && $cpu['tdp'] > $rf['tdp_max'] * 0.85) {
        $avi('Refrigeración muy justa', 'El disipador cubre el procesador por muy poco margen: sonará más y se calentará.');
    }
    if ($cpu['gama'] >= 4 && $rf['stock']) {
        $avi('Riesgo de temperatura', 'Un procesador de gama alta con disipador de serie se calentará mucho.');
    }
    // 18. Fuente sobredimensionada
    if ($psu['vatios'] > $consumo * 3) {
        $avi('Fuente sobredimensionada', "Con {$consumo}W de consumo estimado, una fuente de {$psu['vatios']}W es más de lo necesario.");
    }
    // 19. Compras innecesarias
    $media = ($cpu['gama'] + ($gpu['tdp'] > 0 ? $gpu['gama'] : $cpu['gama'])) / 2;
    foreach (['placa', 'ram', 'disco', 'caja', 'refrigeracion'] as $cat) {
        if ($c[$cat]['gama'] >= $media + 1.5) {
            $avi('Compra innecesaria: ' . ETIQUETAS[$cat], 'Esta pieza es de una gama mucho más alta que tu procesador y gráfica; con una inferior rendirías igual.');
        }
    }
    // 20. RAM escasa / disco lento
    if ($ram['capacidad'] <= 8) {
        $avi('Poca memoria RAM', 'Con 8GB irás justo hoy en día; 16GB es lo mínimo recomendable.');
    }
    if ($dk['tipo'] === 'HDD') {
        $avi('Disco lento', 'Un HDD hace que el PC arranque y abra programas mucho más despacio. Recomendamos un SSD.');
    }
    // 21. RAM en un solo módulo
    if ($ram['modulos'] === 1) {
        $avi('RAM en un solo módulo', 'Con dos módulos (doble canal) el rendimiento mejora, sobre todo con gráficos integrados.');
    }

    // ===== PRESUPUESTO =====
    $total = precioTotal($c);
    if ($presupuesto > 0 && $total > $presupuesto) {
        $err('Te pasas del presupuesto', 'Llevas ' . number_format($total - $presupuesto, 2, ',', '.') . "€ por encima de tus {$presupuesto}€.");
    }

    if (!$a) {
        $a[] = ['ok', 'Configuración equilibrada', 'No hemos detectado problemas. ¡Buena elección!'];
    }
    return $a;
}

function hayErrores(array $alertas): bool {
    foreach ($alertas as $x) { if ($x[0] === 'error') return true; }
    return false;
}

/** ¿Hay algún aviso de "cuello de botella" o "compra innecesaria"? (la sugerencia automática los evita) */
function hayCuelloDeBotella(array $alertas): bool {
    foreach ($alertas as $x) {
        if (str_starts_with($x[1], 'Cuello de botella') || str_starts_with($x[1], 'Compra innecesaria')) return true;
    }
    return false;
}

/** Explicación personalizada "por qué te lo recomendamos" para cada pieza. */
function explicar(string $cat, array $pieza): string {
    return GUIAS[$cat] . ' Tu elección (' . $pieza['nombre'] . ') es adecuada para ' . PERFILES[$pieza['gama']] . '.';
}

function construir(array $catalogo, array $niv): array {
    $r = [];
    foreach ($catalogo as $cat => $lista) { $r[$cat] = $lista[$niv[$cat]]; }
    return $r;
}

/**
 * Sugiere una configuración compatible que cabe en el presupuesto:
 * 1) busca la gama uniforme más alta que sea compatible y quepa (así el socket/DDR cuadran);
 * 2) con lo que sobre, sube piezas de una en una sin romper compatibilidad ni crear cuellos de botella.
 */
function sugerirPorPresupuesto(array $catalogo, float $presupuesto): array {
    $cats = array_keys($catalogo);
    $niv = null;
    for ($g = 4; $g >= 0; $g--) {
        $try = array_fill_keys($cats, $g);
        $c = construir($catalogo, $try);
        if (precioTotal($c) <= $presupuesto && !hayErrores(analizar($c))) { $niv = $try; break; }
    }
    if ($niv === null) {
        // Ninguna gama uniforme cabe en el presupuesto: devolvemos la más barata que sea compatible
        // (el análisis mostrará cuánto te pasas) y, si ninguna lo es, la de gama 1.
        for ($g = 0; $g <= 4; $g++) {
            $c = construir($catalogo, array_fill_keys($cats, $g));
            if (!hayErrores(analizar($c))) return $c;
        }
        return construir($catalogo, array_fill_keys($cats, 0));
    }

    do {
        $mejora = false;
        foreach (['cpu', 'gpu', 'ram', 'disco', 'fuente', 'placa', 'caja', 'refrigeracion'] as $cat) {
            if ($niv[$cat] >= 4) continue;
            $try = $niv; $try[$cat]++;
            $c = construir($catalogo, $try);
            $al = analizar($c);
            if (precioTotal($c) <= $presupuesto && !hayErrores($al) && !hayCuelloDeBotella($al)) { $niv = $try; $mejora = true; }
        }
    } while ($mejora);
    return construir($catalogo, $niv);
}
