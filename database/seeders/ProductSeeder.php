<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'NVIDIA GeForce RTX 4090 24GB',
                'description' => 'Tarjeta gráfica de gama extrema con 24GB GDDR6X, DLSS 3 y Ray Tracing de 3ª generación. Ideal para jugar en 4K ultra y renderizado profesional.',
                'price' => 1599.99,
                'image' => 'images/products/rtx4090.jpg',
            ],
            [
                'name' => 'AMD Ryzen 7 7800X3D',
                'description' => 'El procesador gaming número 1 del mundo. 8 núcleos y 16 hilos con revolucionaria tecnología 3D V-Cache de 96MB y socket AM5 de máxima eficiencia.',
                'price' => 449.00,
                'image' => 'images/products/ryzen7_7800x3d.jpg',
            ],
            [
                'name' => 'ASUS ROG Strix GeForce RTX 4080 SUPER 16GB',
                'description' => 'Tarjeta gráfica de alto rendimiento con 16GB GDDR6X, refrigeración axial de triple ventilador, iluminación Aura Sync y arquitectura NVIDIA Ada Lovelace.',
                'price' => 1149.00,
                'image' => 'images/products/rtx4080super_rog.jpg',
            ],
            [
                'name' => 'AMD Ryzen 9 7950X3D',
                'description' => 'Procesador de 16 núcleos y 32 hilos con tecnología 3D V-Cache para un rendimiento gaming insuperable. Frecuencia boost hasta 5.7GHz en socket AM5.',
                'price' => 699.00,
                'image' => 'images/products/ryzen9.jpg',
            ],
            [
                'name' => 'Sapphire AMD Radeon RX 7900 XTX Nitro+ 24GB',
                'description' => 'Tarjeta gráfica buque insignia con 24GB de memoria GDDR6, arquitectura RDNA 3, disipador Vapor-X de triple ventilador y salida DisplayPort 2.1.',
                'price' => 979.99,
                'image' => 'images/products/rx7900xtx_nitro.jpg',
            ],
            [
                'name' => 'PowerColor Hellhound AMD Radeon RX 7800 XT 16GB',
                'description' => 'Potente tarjeta gráfica con 16GB GDDR6 a 256-bit, arquitectura RDNA 3 y doble ventilador LED para jugar a 1440p con altos FPS.',
                'price' => 529.90,
                'image' => 'images/products/rx7800xt.jpg',
            ],
            [
                'name' => 'Intel Core i7-14700K',
                'description' => 'Procesador de 14ª generación con 20 núcleos (8 P-cores + 12 E-cores) y 28 hilos hasta 5.6 GHz. Rendimiento top para gaming y producción audiovisual.',
                'price' => 419.99,
                'image' => 'images/products/intel_i7_14700k.jpg',
            ],
            [
                'name' => 'Intel Core i5-13600K',
                'description' => 'Procesador de 14 núcleos (6 P-cores y 8 E-cores) y 20 hilos con hasta 5.1GHz de frecuencia. Excelente equilibrio para juegos competitivos y multitarea.',
                'price' => 299.00,
                'image' => 'images/products/intel_i5.jpg',
            ],
            [
                'name' => 'Corsair Vengeance RGB DDR5 32GB (2x16GB) 6000MHz',
                'description' => 'Kit de memoria RAM DDR5 de 32GB (2x16GB) a 6000MHz CL30 con perfiles AMD EXPO e Intel XMP. Iluminación RGB dinámica por zonas y disipador de aluminio.',
                'price' => 149.50,
                'image' => 'images/products/ram_corsair.jpg',
            ],
            [
                'name' => 'G.Skill Trident Z5 Neo RGB 32GB (2x16GB) DDR5 6000MHz',
                'description' => 'Memoria RAM ultrarrápida DDR5 de 32GB con latencias ultrabajas CL30, perfiles AMD EXPO y disipador de diseño aerodinámico con barra RGB difusa.',
                'price' => 139.99,
                'image' => 'images/products/ram_gskill.jpg',
            ],
            [
                'name' => 'Corsair Dominator Titanium RGB DDR5 64GB (2x32GB) 6600MHz',
                'description' => 'Kit insignia de memoria RAM DDR5 para entusiastas con 64GB de capacidad, barras superiores intercambiables y conectividad con software iCUE.',
                'price' => 329.00,
                'image' => 'images/products/ram_dominator_titanium.webp',
            ],
            [
                'name' => 'Samsung 990 PRO NVMe M.2 2TB con Disipador',
                'description' => 'Unidad SSD M.2 PCIe 4.0 NVMe con disipador térmico integrado, lectura de hasta 7450 MB/s y escritura de 6900 MB/s. Compatible con PS5 y PC.',
                'price' => 189.99,
                'image' => 'images/products/ssd_samsung.jpg',
            ],
            [
                'name' => 'Crucial T700 PCIe 5.0 NVMe M.2 2TB',
                'description' => 'SSD de última generación PCIe 5.0 con velocidades de vértigo de hasta 12400 MB/s en lectura secuencial. Diseñado para cargas extremas de trabajo.',
                'price' => 289.99,
                'image' => 'images/products/ssd_crucial_t700.jpg',
            ],
            [
                'name' => 'Kingston NV2 PCIe 4.0 NVMe SSD 2TB',
                'description' => 'Unidad sólida de almacenamiento M.2 2280 NVMe con velocidades de lectura de hasta 3500 MB/s. Eficiencia y rendimiento para presupuestos equilibrados.',
                'price' => 119.99,
                'image' => 'images/products/ssd_kingston_nv2.jpg',
            ],
            [
                'name' => 'ASUS ROG Maximus Z790 Hero',
                'description' => 'Placa base gaming de gama alta para Intel Core de 13ª/14ª Gen. Soporte PCIe 5.0, WiFi 6E, audio SupremeFX y robusto VRM de 20+1 fases.',
                'price' => 599.99,
                'image' => 'images/products/motherboard_asus.jpg',
            ],
            [
                'name' => 'MSI MAG B650 TOMAHAWK WIFI',
                'description' => 'Placa base ATX para procesadores AMD Ryzen serie 7000/8000/9000 con socket AM5, soporte DDR5, PCIe 4.0 M.2 Shield Frozr y Wi-Fi 6E.',
                'price' => 199.90,
                'image' => 'images/products/motherboard_msi_b650.png',
            ],
            [
                'name' => 'Gigabyte B650 AORUS ELITE AX V2',
                'description' => 'Placa base gaming sólida y eficiente para socket AM5 con disipadores térmicos integrales, PCIe 5.0 M.2, LAN 2.5GbE y conectividad inalámbrica rápida.',
                'price' => 219.00,
                'image' => 'images/products/motherboard_gigabyte_b650.png',
            ],
            [
                'name' => 'NZXT Kraken Elite 360 RGB LCD',
                'description' => 'Sistema de refrigeración líquida AIO de 360mm con pantalla LCD gran angular de 2.36", bomba Asetek de 7ª generación y ventiladores F120 RGB Core.',
                'price' => 279.99,
                'image' => 'images/products/cooler_nzxt.jpg',
            ],
            [
                'name' => 'Arctic Liquid Freezer III 360 A-RGB Black',
                'description' => 'Refrigeración líquida todo en uno de alto rendimiento con radiador de 38mm de grosor, ventilador para VRM dedicado y ventiladores P12 PWM A-RGB.',
                'price' => 114.99,
                'image' => 'images/products/cooler_arctic_freezer.png',
            ],
            [
                'name' => 'Noctua NH-D15 chromax.black Doble Torre',
                'description' => 'Disipador por aire de élite silencioso para CPU de doble torre con 6 heatpipes y dos ventiladores NF-A15 PWM de 140mm en acabado negro mate total.',
                'price' => 119.90,
                'image' => 'images/products/cooler_noctua_nhd15.jpg',
            ],
            [
                'name' => 'Seasonic Vertex GX-1000 1000W 80 Plus Gold',
                'description' => 'Fuente de alimentación totalmente modular de 1000W con certificación 80 Plus Gold, estándar ATX 3.0 nativo y cable PCIe 5.0 12VHPWR para GPUs modernas.',
                'price' => 199.90,
                'image' => 'images/products/psu_seasonic.jpg',
            ],
            [
                'name' => 'Corsair RM850x Shift 850W 80 Plus Gold Modular',
                'description' => 'Fuente modular revolucionaria con conectores laterales en el panel para un acceso y gestión de cableado sin precedentes en chasis ATX.',
                'price' => 159.99,
                'image' => 'images/products/psu_corsair_rm850x.webp',
            ],
            [
                'name' => 'MSI MAG A850GL PCIE5 850W 80 Plus Gold',
                'description' => 'Fuente de alimentación compacta ATX 3.0 con conectores amarillos bicolor de seguridad para PCIe 5.0 12V-2x6 y protección eléctrica integral.',
                'price' => 124.90,
                'image' => 'images/products/psu_msi_a850gl.webp',
            ],
            [
                'name' => 'Fractal Design North Charcoal Black Walnut',
                'description' => 'Chasis semi-torre ATX elegante con panel frontal de listones de madera natural de nogal, paneles laterales de malla y diseño escandinavo moderno.',
                'price' => 139.99,
                'image' => 'images/products/case_fractal.jpg',
            ],
            [
                'name' => 'Lian Li O11 Dynamic EVO RGB Cristal Templado',
                'description' => 'Chasis semitorre premium con visión panorámica sin pilar frontal, tiras RGB difusas superiores e inferiores y modo reversible de montaje.',
                'price' => 179.90,
                'image' => 'images/products/case_lian_li_o11.jpg',
            ],
            [
                'name' => 'NZXT H9 Flow Dual-Chamber Mid-Tower',
                'description' => 'Caja de doble cámara con panel de cristal envolvente ininterrumpido, capacidad para hasta 10 ventiladores y flujo de aire directo a la GPU.',
                'price' => 169.99,
                'image' => 'images/products/case_nzxt_h9.jpg',
            ],
            [
                'name' => 'Logitech G PRO X Superlight 2 Lightspeed Wireless',
                'description' => 'Ratón gaming inalámbrico ultra-ligero de tan solo 60 gramos con sensor HERO 2 de 32.000 DPI, switches óptico-mecánicos LIGHTFORCE y sondeo a 4000Hz.',
                'price' => 149.00,
                'image' => 'images/products/mouse_logitech.jpg',
            ],
            [
                'name' => 'Razer DeathAdder V3 Pro Wireless Ultra-Ligero',
                'description' => 'Ratón ergonómico para esports con un peso de 63g, sensor óptico Focus Pro 30K, switches ópticos Gen-3 y hasta 90 horas de batería.',
                'price' => 139.99,
                'image' => 'images/products/mouse_razer_deathadder.jpg',
            ],
            [
                'name' => 'Logitech G PRO X TKL Lightspeed RGB Mecánico',
                'description' => 'Teclado gaming inalámbrico formato TKL (sin teclado numérico) para torneos, teclas PBT de doble inyección, tecnología LIGHTSPEED y luces LIGHTSYNC RGB.',
                'price' => 189.99,
                'image' => 'images/products/keyboard_gaming.jpg',
            ],
            [
                'name' => 'ASUS ROG Swift OLED PG27AQDM 27" QHD 240Hz',
                'description' => 'Monitor gaming OLED de 27 pulgadas con resolución 2560x1440, tasa de refresco de 240Hz, tiempo de respuesta de 0.03ms y disipador térmico personalizado.',
                'price' => 899.00,
                'image' => 'images/products/monitor_oled.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
