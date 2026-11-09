<?php
require __DIR__ . '/includes/reglas.php';
$catalogo = require __DIR__ . '/includes/catalogo.php';

$enviado     = $_SERVER['REQUEST_METHOD'] === 'POST';
$presupuesto = $enviado ? max(0, (float)($_POST['presupuesto'] ?? 0)) : 0;
$config      = obtenerConfiguracion($catalogo, $enviado ? $_POST : []);

if ($enviado && isset($_POST['sugerir']) && $presupuesto > 0) {
    $config = sugerirPorPresupuesto($catalogo, $presupuesto);
}
$alertas = $enviado ? analizar($config, $presupuesto) : [];
$h = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Configurador de PC - PC Wilder</title>
<style>
 :root{--azul:#12284C;--dorado:#C8A24B;--crema:#F6F3EA;--texto:#1c2840;--gris:#5b6578}
 *{box-sizing:border-box}
 body{margin:0;font-family:system-ui,-apple-system,"Segoe UI",sans-serif;background:var(--crema);color:var(--texto);line-height:1.5}
 header.cab{background:var(--azul);color:#fff;padding:1.2rem 1rem;border-bottom:4px solid var(--dorado)}
 header.cab .in{max-width:900px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap}
 header.cab strong{font-size:1.4rem;letter-spacing:.08em}
 header.cab span{color:var(--dorado);font-size:.95rem}
 header.cab a{color:#fff;text-decoration:none;border:1px solid var(--dorado);padding:.4rem .9rem;border-radius:6px}
 header.cab a:hover{background:var(--dorado);color:var(--azul)}
 main{max-width:900px;margin:0 auto;padding:1.5rem 1rem 3rem}
 h1{color:var(--azul);margin:.5rem 0 .2rem}
 h2{color:var(--azul);margin-top:2rem}
 .intro{color:var(--gris);margin-top:0}
 form{background:#fff;padding:1.2rem 1.4rem 1.6rem;border:1px solid #e0dacb;border-radius:12px}
 label{display:block;margin:1rem 0 .2rem;font-weight:600;color:var(--azul)}
 select,input{width:100%;padding:.6rem;border:1px solid #c9c2ad;border-radius:6px;font-size:1rem;background:#fff}
 select:focus,input:focus{outline:2px solid var(--dorado);border-color:var(--dorado)}
 .guia{font-size:.9rem;color:var(--gris);margin:.25rem 0 0}
 button{margin:1.2rem .6rem 0 0;padding:.75rem 1.3rem;cursor:pointer;border:0;border-radius:6px;font-size:1rem;font-weight:600;background:var(--azul);color:#fff}
 button:hover{background:#1d3d70}
 button[name=sugerir]{background:var(--dorado);color:var(--azul)}
 button[name=sugerir]:hover{background:#d8b45c}
 .alerta{padding:.8rem 1rem;margin:.6rem 0;border-left:6px solid;border-radius:0 6px 6px 0}
 .error{background:#fdecea;border-color:#d32f2f}
 .aviso{background:#fff4e5;border-color:#ed6c02}
 .ok{background:#e8f5e9;border-color:#2e7d32}
 table{width:100%;border-collapse:collapse;margin-top:1rem;background:#fff;border-radius:8px;overflow:hidden}
 th{background:var(--azul);color:#fff}
 th,td{padding:.6rem .7rem;border-bottom:1px solid #e6e0d0;text-align:left}
 td a{color:var(--azul);font-weight:600}
 .nota{font-size:.85rem;color:var(--gris)}
 footer{background:var(--azul);color:#cfd6e4;text-align:center;padding:1rem;font-size:.9rem}
 footer a{color:var(--dorado)}
</style>
</head>
<body>
<header class="cab">
  <div class="in">
    <div style="display:flex;align-items:center;gap:1rem"><img src="logo.png" alt="PC Wilder" style="height:64px;border-radius:6px"><span>Configurador Inteligente y Seguro</span></div>
    <a href="http://www.pcwilder.com">Volver a la web</a>
  </div>
</header>
</header>
<main>
<h1>Monta tu PC</h1>
<p class="intro">Elige cada pieza y comprobamos que sean compatibles, que no haya cuellos de botella y que te ajustes al presupuesto.</p>
<form method="post">
  <label for="presupuesto">Presupuesto máximo (€) — opcional</label>
  <input type="number" id="presupuesto" name="presupuesto" min="0" value="<?= $presupuesto ?: '' ?>">

  <?php foreach ($catalogo as $cat => $lista): ?>
    <label for="<?= $cat ?>"><?= $h(ETIQUETAS[$cat]) ?></label>
    <select id="<?= $cat ?>" name="<?= $cat ?>">
      <?php foreach ($lista as $i => $p): ?>
        <option value="<?= $i ?>" <?= $config[$cat] === $p ? 'selected' : '' ?>>
          <?= $h($p['nombre']) ?> — <?= number_format($p['precio'], 2, ',', '.') ?>€<?= empty($p['verificado']) ? ' (revisar precio)' : '' ?>
        </option>
      <?php endforeach; ?>
    </select>
    <p class="guia"><?= $h(GUIAS[$cat]) ?></p>
  <?php endforeach; ?>

  <button type="submit">Analizar mi configuración</button>
  <button type="submit" name="sugerir" value="1">Sugerir según mi presupuesto</button>
</form>

<?php if ($enviado): ?>
  <h2>Precio total: <?= number_format(precioTotal($config), 2, ',', '.') ?>€</h2>
  <p>Consumo estimado: <?= consumoEstimado($config) ?>W</p>

  <h2>Análisis</h2>
  <?php foreach ($alertas as [$nivel, $titulo, $texto]): ?>
    <div class="alerta <?= $nivel ?>"><strong><?= $h($titulo) ?></strong><br><?= $h($texto) ?></div>
  <?php endforeach; ?>

  <h2>Por qué te recomendamos cada pieza</h2>
  <?php foreach ($config as $cat => $p): ?>
    <p><strong><?= $h(ETIQUETAS[$cat]) ?>:</strong> <?= $h(explicar($cat, $p)) ?></p>
  <?php endforeach; ?>

  <h2>Dónde comprarlo</h2>
  <table>
    <tr><th>Pieza</th><th>Modelo</th><th>Precio</th><th></th></tr>
    <?php foreach ($config as $cat => $p): $url = enlaceTienda($p); ?>
      <tr>
        <td><?= $h(ETIQUETAS[$cat]) ?></td>
        <td><?= $h($p['nombre']) ?></td>
        <td><?= number_format($p['precio'], 2, ',', '.') ?>€<?= empty($p['verificado']) ? '*' : '' ?></td>
        <td><?php if ($url): ?>
          <a href="<?= $h($url) ?>" target="_blank" rel="noopener noreferrer">Ver en PcComponentes</a>
        <?php else: ?>—<?php endif; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <p class="nota">* Precio pendiente de revisar. Los precios y la disponibilidad cambian: confírmalos en la tienda antes de comprar.</p>
<?php endif; ?>
</main>
<footer>
  © PC Wilder · <a href="http://www.pcwilder.com">www.pcwilder.com</a> · <a href="http://noticias.pcwilder.com">Noticias</a>
</footer>
</body>
</html>