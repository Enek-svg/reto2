<?php
/*
 * CATÁLOGO v4 — productos de PcComponentes elegidos y revisados por el equipo.
 *
 * Campos:
 *   url         enlace a la ficha del producto en PcComponentes
 *   busqueda    (solo si no hay url) texto para generar un enlace de búsqueda
 *   verificado  true = precio copiado de PcComponentes por el equipo (anotad la fecha al entregar)
 *   specs_ok    true = datos técnicos (mm, vatios, ranuras...) leídos de la ficha del producto
 *               false = datos estimados o de otro modelo -> comprobar
 *
 * IMPORTANTE: el precio que se muestra debe ser el que cobra PcComponentes. La web envía al cliente a esa
 * tienda; si mostramos otro precio, el cliente verá una diferencia al hacer clic.
 */
return [

    'cpu' => [
        ['nombre' => 'AMD Ryzen 5 5500 3.6GHz Box (sin gráficos integrados)', 'gama' => 1, 'precio' => 103.70, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/procesador-amd-ryzen-5-5500-3-6ghz-box',
         'socket' => 'AM4', 'tdp' => 65, 'igpu' => false, 'cooler_incluido' => true],
        ['nombre' => 'AMD Ryzen 5 5600 3.5GHz Box (sin gráficos integrados)', 'gama' => 2, 'precio' => 154.15, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/procesador-amd-ryzen-5-5600-3-5ghz-box',
         'socket' => 'AM4', 'tdp' => 65, 'igpu' => false, 'cooler_incluido' => true],
        ['nombre' => 'AMD Ryzen 5 7600 3.8/5.1GHz Box', 'gama' => 3, 'precio' => 187.98, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/procesador-amd-ryzen-5-7600-3-8-5-1-ghz-box',
         'socket' => 'AM5', 'tdp' => 65, 'igpu' => true, 'cooler_incluido' => true],
        ['nombre' => 'AMD Ryzen 7 7700 8 núcleos 3.8GHz Box', 'gama' => 4, 'precio' => 296.15, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/procesador-amd-ryzen-7-7700-8-nucleos-3-8-ghz-frecuencia-base-5-3-ghz-turbo-graficos-integrados-box',
         'socket' => 'AM5', 'tdp' => 65, 'igpu' => true, 'cooler_incluido' => true],
        ['nombre' => 'AMD Ryzen 9 9900X 4.4/5.6GHz (sin disipador)', 'gama' => 5, 'precio' => 365.95, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/procesador-amd-ryzen-9-9900x-4-4-5-6ghz',
         'socket' => 'AM5', 'tdp' => 120, 'igpu' => true, 'cooler_incluido' => false],
    ],

    'gpu' => [
        ['nombre' => 'ASUS GeForce GT 710 SL EVO BRK 2GB GDDR5 (solo ofimática y multimedia)', 'gama' => 1, 'precio' => 60.98, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/tarjeta-grafica-asus-geforce-gt-710-sl-evo-brk-2gb-gddr5',
         'tdp' => 19, 'longitud' => 170, 'psu_min' => 300, 'conector' => null],
        ['nombre' => 'Gigabyte GeForce RTX 3050 WINDFORCE OC V2 6GB', 'gama' => 2, 'precio' => 333.19, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/tarjeta-grafica-gigabyte-geforce-rtx-3050-windforce-oc-v2-6gb-gddr6',
         'tdp' => 70, 'longitud' => 191, 'psu_min' => 300, 'conector' => null],
        ['nombre' => 'MSI GeForce RTX 5060 Ti VENTUS 2X OC PLUS 8GB', 'gama' => 3, 'precio' => 609.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/tarjeta-grafica-msi-geforce-rtx-5060-ti-ventus-2x-oc-plus-8gb-gddr7-reflex-2-rtx-ai-dlss4',
         'tdp' => 180, 'longitud' => 227, 'psu_min' => 600, 'conector' => '8pin'],
        ['nombre' => 'Gigabyte GeForce RTX 5070 Ti AERO OC 16GB', 'gama' => 4, 'precio' => 1641.92, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/tarjeta-grafica-gigabyte-geforce-rtx-5070-ti-aero-oc-16gb-gddr7-reflex-2-rtx-ai-dlss4',
         'tdp' => 300, 'longitud' => 360, 'psu_min' => 750, 'conector' => '16pin'],
        ['nombre' => 'MSI GeForce RTX 5080 INSPIRE OC 3X 16GB', 'gama' => 5, 'precio' => 2748.03, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/tarjeta-grafica-msi-geforce-rtx-5080-inspire-oc-3x-16gb-gddr7-dlss4-5-reflex-2-ia-rtx-ray-tracing',
         'tdp' => 360, 'longitud' => 288, 'psu_min' => 850, 'conector' => '16pin'],
    ],

    'placa' => [
        ['nombre' => 'MSI A520M-A PRO (AM4, DDR4, mATX)', 'gama' => 1, 'precio' => 54.99, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/msi-a520m-a-pro',
         'socket' => 'AM4', 'ddr' => 'DDR4', 'formato' => 'mATX', 'ram_slots' => 2, 'ram_max' => 64, 'm2' => 1],
        ['nombre' => 'Gigabyte B550M DS3H R2 (AM4, DDR4, mATX)', 'gama' => 2, 'precio' => 79.94, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/placa-base-gigabyte-b550m-ds3h-r2-am4-micro-atx-ddr4-dual-m-2-128gb-lan-1gbe',
         'socket' => 'AM4', 'ddr' => 'DDR4', 'formato' => 'mATX', 'ram_slots' => 4, 'ram_max' => 128, 'm2' => 2],
        ['nombre' => 'ASUS PRIME B650M-A WIFI II (AM5, DDR5, mATX)', 'gama' => 3, 'precio' => 136.19, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/placa-base-asus-prime-b650m-a-wifi-ii-b650-am5-ddr5-micro-atx-wifi-6-2-5gbe-aura-sync-rgb',
         'socket' => 'AM5', 'ddr' => 'DDR5', 'formato' => 'mATX', 'ram_slots' => 4, 'ram_max' => 192, 'm2' => 2],
        ['nombre' => 'ASUS TUF GAMING B850-PLUS WIFI (AM5, DDR5, ATX)', 'gama' => 4, 'precio' => 199.95, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/placa-base-asus-tuf-gaming-b850-plus-wifi',
         'socket' => 'AM5', 'ddr' => 'DDR5', 'formato' => 'ATX', 'ram_slots' => 4, 'ram_max' => 192, 'm2' => 3],
        ['nombre' => 'MSI MAG X870E TOMAHAWK WIFI (AM5, DDR5, ATX)', 'gama' => 5, 'precio' => 345.00, 'verificado' => true, 'specs_ok' => false,
         'url' => 'https://www.pccomponentes.com/placa-base-msi-mag-x870e-tomahawk-wifi',
         'socket' => 'AM5', 'ddr' => 'DDR5', 'formato' => 'ATX', 'ram_slots' => 4, 'ram_max' => 256, 'm2' => 4],
    ],

    'ram' => [
        ['nombre' => 'Silicon Power DDR4 3200MHz 8GB CL22', 'gama' => 1, 'precio' => 69.95, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/silicon-power-sp008gblfu320x02-ddr4-3200mhz-8gb-cl22',
         'ddr' => 'DDR4', 'capacidad' => 8, 'modulos' => 1],
        ['nombre' => 'KingBank KJXB DDR4 16GB (2x8GB) 3200MHz CL16', 'gama' => 2, 'precio' => 139.95, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/memoria-ram-kingbank-kjxb-ddr4-16gb-2x8gb-udimm-3200mhz-cl16-negro-xmp',
         'ddr' => 'DDR4', 'capacidad' => 16, 'modulos' => 2],
        ['nombre' => 'Corsair Vengeance RGB 16GB (2x8GB) DDR5 5200MHz CL40', 'gama' => 3, 'precio' => 309.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/memoria-ram-corsair-vengeance-rgb-16gb-2x8gb-ddr5-5200mhz-cl40-kit-xmp-iluminacion-multicolor-negro',
         'ddr' => 'DDR5', 'capacidad' => 16, 'modulos' => 2],
        ['nombre' => 'Corsair Vengeance RGB 32GB (2x16GB) DDR5 6000MHz CL38 EXPO', 'gama' => 4, 'precio' => 573.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/memoria-ram-corsair-vengeance-rgb-32gb-2x16gb-ddr5-6000mhz-cl38-amd-expo-gris',
         'ddr' => 'DDR5', 'capacidad' => 32, 'modulos' => 2],
        ['nombre' => 'G.Skill Trident Z5 Neo RGB 64GB (2x32GB) DDR5 6000MHz', 'gama' => 5, 'precio' => 1445.94, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/memoria-ram-g-skill-64gb-ddr5-6000mhz-trident-z5-neo-rgb-f5-6000j3040g32gx2-tz5nr',
         'ddr' => 'DDR5', 'capacidad' => 64, 'modulos' => 2],
    ],

    'fuente' => [
        ['nombre' => 'Tacens Anima APIII500 500W 80+ Bronze', 'gama' => 1, 'precio' => 16.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/tacens-anima-apiii500-fuente-alimentacion-pc-atx-500w-85-bronze-ventilador-12cm-negro',
         'vatios' => 500],
        ['nombre' => 'Yeyian Raiden 650W 80+ Gold no modular', 'gama' => 2, 'precio' => 59.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/fuente-alimentacion-fuente-de-alimentacion-yeyian-raiden-650w-certificacion-80-plus-gold-no-modular',
         'vatios' => 650],
        ['nombre' => 'Enermax Marblebron II 650W 80+ Bronze ATX 3.1', 'gama' => 3, 'precio' => 69.90, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/fuente-alimentacion-fuente-de-alimentacion-enermax-marblebron-ii-650w-80-plus-bronze-atx-3-1-dc-dc-modul-condens-japones',
         'vatios' => 650],
        ['nombre' => 'FSP VIC GD 750W 80+ Gold ATX 3.1', 'gama' => 4, 'precio' => 78.73, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/fuente-alimentacion-fuente-de-alimentacion-fsp-vic-gd-750w-certificacion-80-plus-gold-atx-31',
         'vatios' => 750],
        ['nombre' => 'Forgeon Reactor 850W Cybenetics Platinum ATX 3.1 modular', 'gama' => 5, 'precio' => 106.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/fuente-alimentacion-forgeon-reactor-850w-cybenetics-platinum-atx-3-1-pcie-5-1-full-modular-fuente-de-alimentacion-negra',
         'vatios' => 850],
    ],

    'disco' => [
        ['nombre' => 'Kingston NV3 500GB SSD M.2 NVMe PCIe 4.0', 'gama' => 1, 'precio' => 99.95, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/disco-duro-kingston-nv3-500gb-ssd-m-2-nvme-2280-pcie-4-0-3d-nand', 'tipo' => 'NVMe'],
        ['nombre' => 'Kingston NV3 1TB SSD M.2 NVMe PCIe 4.0', 'gama' => 2, 'precio' => 149.95, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/disco-duro-kingston-nv3-1tb-disco-ssd-6000mb-s-nvme-pcie-4-0-m-2-gen4-2280-3d-nand', 'tipo' => 'NVMe'],
        ['nombre' => 'Crucial P310 1TB SSD M.2 NVMe PCIe Gen4', 'gama' => 3, 'precio' => 179.00, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/disco-duro-crucial-p310-1tb-disco-ssd-2280-7100mb-s-nvme-m-2-pcie-gen4', 'tipo' => 'NVMe'],
        ['nombre' => 'Lexar NQ790 2TB SSD M.2 NVMe PCIe 4.0', 'gama' => 4, 'precio' => 349.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/disco-duro-lexar-nq790-2tb-disco-ssd-7000-mb-s-nvme-pcie-4-0-m-2-gen4', 'tipo' => 'NVMe'],
        ['nombre' => 'Lexar NQ790 4TB SSD M.2 NVMe PCIe 4.0', 'gama' => 5, 'precio' => 575.26, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/disco-duro-lexar-nq790-4tb-m-2-nvme-pcie-4-0-7000mb-s-alta-durabilidad', 'tipo' => 'NVMe'],
    ],

    // Datos técnicos de las cajas copiados de las fichas (PDF del equipo).
    // A290: la ficha dice "compatible con AIO" sin indicar tamaño -> se asume 240mm superior (estimado).
    'caja' => [
        ['nombre' => 'Tacens Anima AC4 USB 3.0 (mATX / mini-ITX)', 'gama' => 1, 'precio' => 22.91, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/torre-pc-tacens-anima-ac4-usb-3-0-negro',
         'formatos' => ['mATX', 'ITX'], 'gpu_max' => 310, 'cooler_max' => 155, 'radiadores' => [], 'bahias_35' => 3],
        ['nombre' => 'Darkflash A290 ARGB cristal templado (ATX)', 'gama' => 2, 'precio' => 34.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/torre-pc-caja-de-torre-darkflash-a290-negro-argb-cristal-templado-mesh-media-atx',
         'formatos' => ['mATX', 'ATX', 'ITX'], 'gpu_max' => 260, 'cooler_max' => 160, 'radiadores' => [240], 'bahias_35' => 1],
        ['nombre' => 'MSI MAG Forge 100M cristal templado (ATX)', 'gama' => 3, 'precio' => 50.15, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/torre-pc-msi-mag-forge-100m-cristal-templado-usb-3-2-rgb-negra',
         'formatos' => ['mATX', 'ATX', 'ITX'], 'gpu_max' => 330, 'cooler_max' => 160, 'radiadores' => [240], 'bahias_35' => 2],
        ['nombre' => 'NOX Hummer GLOCK ARGB semitorre ATX', 'gama' => 4, 'precio' => 109.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/torre-pc-nox-hummer-glock-argb-semitorre-atx-cristal-templado-usb-c-negra',
         'formatos' => ['mATX', 'ATX', 'ITX'], 'gpu_max' => 410, 'cooler_max' => 180, 'radiadores' => [240, 280, 360], 'bahias_35' => 4],
        ['nombre' => 'Darkflash FLOATRON F1 ATX Full Tower', 'gama' => 5, 'precio' => 113.38, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/torre-pc-caja-pc-darkflash-floatron-f1-atx-full-tower-6-ventiladores-argb',
         'formatos' => ['mATX', 'ATX', 'ITX'], 'gpu_max' => 415, 'cooler_max' => 180, 'radiadores' => [240, 360], 'bahias_35' => 2],
    ],

    // tdp_max: el de la gama 2 es el que anuncia el fabricante (350W); el resto no figuran en las fichas (estimados).
    'refrigeracion' => [
        ['nombre' => 'Disipador de serie (el que trae la CPU)', 'gama' => 1, 'precio' => 0, 'verificado' => true, 'specs_ok' => true,
         'url' => null, 'stock' => true, 'sockets' => ['AM4', 'AM5'], 'tdp_max' => 65, 'altura' => 55, 'radiador' => 0],
        ['nombre' => 'Mars Gaming MCPU-X26 ARGB Dual Tower 158mm', 'gama' => 2, 'precio' => 36.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/ventilador-cpu-refrigeracion-aire-mars-gaming-socket-intel-lga-amd-158mm-mcpu-x26-argb-dual-tower',
         'stock' => false, 'sockets' => ['AM4', 'AM5'], 'tdp_max' => 350, 'altura' => 158, 'radiador' => 0],
        ['nombre' => 'Thermalright Peerless Assassin 120 SE ARGB', 'gama' => 3, 'precio' => 49.95, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/ventilador-cpu-thermalright-peerless-assassin-120-se-argb-ventilador-cpu-120mm-negro',
         'stock' => false, 'sockets' => ['AM4', 'AM5'], 'tdp_max' => 220, 'altura' => 155, 'radiador' => 0],
        ['nombre' => 'Cooler Master MasterLiquid 240 ATMOS', 'gama' => 4, 'precio' => 80.63, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/cooler-master-masterliquid-240-atmos-kit-de-refrigeracion-liquida-240mm',
         'stock' => false, 'sockets' => ['AM4', 'AM5'], 'tdp_max' => 250, 'altura' => 0, 'radiador' => 240],
        ['nombre' => 'Cooler Master MasterLiquid 360 ATMOS', 'gama' => 5, 'precio' => 104.99, 'verificado' => true, 'specs_ok' => true,
         'url' => 'https://www.pccomponentes.com/cooler-master-masterliquid-360-atmos-kit-de-refrigeracion-liquida-360mm',
         'stock' => false, 'sockets' => ['AM4', 'AM5'], 'tdp_max' => 300, 'altura' => 0, 'radiador' => 360],
    ],
];
