<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image'];

    protected $appends = [
        'brand',
        'category',
        'discount_percent',
        'original_price',
        'rating',
        'reviews_count',
        'formatted_price',
        'formatted_original_price',
        'specs',
    ];

    public function getBrandAttribute(): string
    {
        $name = strtolower($this->name);

        if (str_contains($name, 'asus') || str_contains($name, 'rog')) {
            return 'Asus';
        }

        if (str_contains($name, 'msi')) {
            return 'MSI';
        }

        if (str_contains($name, 'gigabyte') || str_contains($name, 'aorus')) {
            return 'Gigabyte';
        }

        if (str_contains($name, 'powercolor')) {
            return 'PowerColor';
        }

        if (str_contains($name, 'sapphire')) {
            return 'Sapphire';
        }

        if (str_contains($name, 'nvidia') || str_contains($name, 'geforce')) {
            return 'NVIDIA';
        }

        if (str_contains($name, 'amd') || str_contains($name, 'ryzen') || str_contains($name, 'radeon')) {
            return 'AMD';
        }

        if (str_contains($name, 'intel')) {
            return 'Intel';
        }

        if (str_contains($name, 'corsair')) {
            return 'Corsair';
        }

        if (str_contains($name, 'samsung')) {
            return 'Samsung';
        }

        if (str_contains($name, 'crucial')) {
            return 'Crucial';
        }

        if (str_contains($name, 'kingston')) {
            return 'Kingston';
        }

        if (str_contains($name, 'g.skill')) {
            return 'G.Skill';
        }

        if (str_contains($name, 'nzxt')) {
            return 'NZXT';
        }

        if (str_contains($name, 'arctic')) {
            return 'Arctic';
        }

        if (str_contains($name, 'noctua')) {
            return 'Noctua';
        }

        if (str_contains($name, 'seasonic')) {
            return 'Seasonic';
        }

        if (str_contains($name, 'fractal')) {
            return 'Fractal Design';
        }

        if (str_contains($name, 'lian li')) {
            return 'Lian Li';
        }

        if (str_contains($name, 'logitech')) {
            return 'Logitech';
        }

        if (str_contains($name, 'razer')) {
            return 'Razer';
        }

        return 'Hardware Store';
    }

    public function getCategoryAttribute(): string
    {
        $name = strtolower($this->name);

        if (str_contains($name, 'superlight') || str_contains($name, 'deathadder') || str_contains($name, 'teclado') || str_contains($name, 'tkl') || str_contains($name, 'monitor') || str_contains($name, 'ratón') || str_contains($name, 'periférico') || str_contains($name, 'pg27aqdm')) {
            return 'Periféricos';
        }

        if (str_contains($name, 'rtx') || str_contains($name, 'radeon') || str_contains($name, 'rx 7') || str_contains($name, 'gráfica')) {
            return 'Tarjetas Gráficas';
        }

        if (str_contains($name, 'ryzen') || str_contains($name, 'intel core') || str_contains($name, 'i7-') || str_contains($name, 'i5-') || str_contains($name, 'i9-') || str_contains($name, '7800x3d') || str_contains($name, '7950x3d') || str_contains($name, 'procesador')) {
            return 'Procesadores';
        }

        if (str_contains($name, 'ddr5') || str_contains($name, 'vengeance') || str_contains($name, 'trident') || str_contains($name, 'dominator') || str_contains($name, 'ram')) {
            return 'Memorias RAM';
        }

        if (str_contains($name, 'ssd') || str_contains($name, 'nvme') || str_contains($name, '990 pro') || str_contains($name, 't700') || str_contains($name, 'nv2')) {
            return 'Discos Duros SSD';
        }

        if (str_contains($name, 'z790') || str_contains($name, 'b650') || str_contains($name, 'x670') || str_contains($name, 'placa')) {
            return 'Placas Base';
        }

        if (str_contains($name, 'kraken') || str_contains($name, 'freezer') || str_contains($name, 'nh-d15') || str_contains($name, 'cooler') || str_contains($name, 'refrigeración')) {
            return 'Refrigeración Líquida';
        }

        if (str_contains($name, 'seasonic') || str_contains($name, 'rm850x') || str_contains($name, 'a850gl') || str_contains($name, '1000w') || str_contains($name, '850w') || str_contains($name, 'fuente') || str_contains($name, 'psu')) {
            return 'Fuentes de Alimentación';
        }

        if (str_contains($name, 'fractal') || str_contains($name, 'o11') || str_contains($name, 'h9 flow') || str_contains($name, 'chasis') || str_contains($name, 'torre') || str_contains($name, 'caja')) {
            return 'Torres y Chasis';
        }

        return 'Componentes';
    }

    public function getDiscountPercentAttribute(): ?int
    {
        $discounts = [
            1 => null,
            2 => 12,
            3 => 8,
            4 => 15,
            5 => 10,
            6 => 14,
            7 => 9,
            8 => 11,
            9 => 13,
            10 => 16,
            11 => null,
            12 => 18,
            13 => 10,
            14 => 20,
            15 => null,
            16 => 15,
            17 => 12,
            18 => 10,
            19 => 14,
            20 => null,
            21 => 14,
            22 => 12,
            23 => 16,
            24 => 8,
            25 => null,
            26 => 10,
            27 => 15,
            28 => 12,
            29 => null,
            30 => 11,
        ];

        return $discounts[$this->id] ?? null;
    }

    public function getOriginalPriceAttribute(): ?float
    {
        $discount = $this->discount_percent;
        if ($discount === null || $discount <= 0) {
            return null;
        }

        return round($this->price / (1 - ($discount / 100)), 2);
    }

    public function getRatingAttribute(): float
    {
        $ratings = [
            1 => 4.9,
            2 => 5.0,
            3 => 4.9,
            4 => 4.8,
            5 => 4.8,
            6 => 4.7,
            7 => 4.8,
            8 => 4.7,
            9 => 4.8,
            10 => 4.9,
            11 => 4.9,
            12 => 4.9,
            13 => 4.8,
            14 => 4.6,
            15 => 4.8,
            16 => 4.7,
            17 => 4.7,
            18 => 4.6,
            19 => 4.8,
            20 => 4.9,
            21 => 4.9,
            22 => 4.8,
            23 => 4.7,
            24 => 4.8,
            25 => 4.9,
            26 => 4.8,
            27 => 4.9,
            28 => 4.8,
            29 => 4.8,
            30 => 4.9,
        ];

        return $ratings[$this->id] ?? 4.8;
    }

    public function getReviewsCountAttribute(): int
    {
        $counts = [
            1 => 330,
            2 => 582,
            3 => 194,
            4 => 245,
            5 => 168,
            6 => 142,
            7 => 210,
            8 => 275,
            9 => 318,
            10 => 294,
            11 => 86,
            12 => 512,
            13 => 134,
            14 => 320,
            15 => 98,
            16 => 215,
            17 => 176,
            18 => 142,
            19 => 265,
            20 => 410,
            21 => 87,
            22 => 193,
            23 => 118,
            24 => 164,
            25 => 280,
            26 => 205,
            27 => 490,
            28 => 320,
            29 => 180,
            30 => 145,
        ];

        return $counts[$this->id] ?? 95;
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2, ',', '.').'€';
    }

    public function getFormattedOriginalPriceAttribute(): ?string
    {
        if ($this->original_price === null) {
            return null;
        }

        return number_format($this->original_price, 2, ',', '.').'€';
    }

    public function getSpecsAttribute(): array
    {
        $name = strtolower($this->name);

        if (str_contains($name, '4090')) {
            return [
                'Memoria VRAM' => '24 GB GDDR6X',
                'Interfaz de memoria' => '384-bit',
                'Frecuencia reloj' => '2235 MHz Base / 2520 MHz Boost',
                'Núcleos CUDA' => '16384',
                'Conectividad' => '3x DisplayPort 1.4a, 1x HDMI 2.1a',
                'Consumo recomendado' => '850W - 1000W',
                'Tecnologías' => 'DLSS 3, Ray Tracing Gen 3, NVIDIA Reflex',
            ];
        }

        $specsMap = [
            1 => [
                'Memoria VRAM' => '24 GB GDDR6X',
                'Interfaz de memoria' => '384-bit',
                'Frecuencia reloj' => '2235 MHz Base / 2520 MHz Boost',
                'Núcleos CUDA' => '16384',
                'Conectividad' => '3x DisplayPort 1.4a, 1x HDMI 2.1a',
                'Consumo recomendado' => '850W - 1000W',
                'Tecnologías' => 'DLSS 3, Ray Tracing Gen 3, NVIDIA Reflex',
            ],
            2 => [
                'Núcleos / Hilos' => '8 núcleos / 16 hilos',
                'Frecuencia Base' => '4.2 GHz',
                'Frecuencia Turbo' => 'Hasta 5.0 GHz',
                'Caché L3' => '96 MB 3D V-Cache (104 MB total)',
                'Socket' => 'AM5',
                'TDP' => '120 W',
                'Tecnología' => 'TSMC 5nm FinFET, AMD EXPO',
            ],
            3 => [
                'Memoria VRAM' => '16 GB GDDR6X',
                'Interfaz de memoria' => '256-bit',
                'Frecuencia reloj' => '2295 MHz Base / 2550 MHz Boost',
                'Núcleos CUDA' => '10240',
                'Refrigeración' => 'Triple ventilador Axial-tech con 3.5 slots',
                'Conectividad' => '2x HDMI 2.1a, 3x DisplayPort 1.4a',
                'Tecnologías' => 'NVIDIA DLSS 3.5, Aura Sync RGB',
            ],
            4 => [
                'Núcleos / Hilos' => '16 núcleos / 32 hilos',
                'Frecuencia Base' => '4.2 GHz',
                'Frecuencia Turbo' => 'Hasta 5.7 GHz',
                'Caché Total' => '144 MB (Tecnología 3D V-Cache)',
                'Socket' => 'AM5',
                'TDP' => '120 W',
                'Gráficos integrados' => 'AMD Radeon Graphics (2 núcleos RDNA 2)',
            ],
            5 => [
                'Memoria VRAM' => '24 GB GDDR6',
                'Interfaz de memoria' => '384-bit',
                'Arquitectura' => 'AMD RDNA 3 con Chiplets',
                'Stream Processors' => '6144',
                'Infinity Cache' => '96 MB',
                'Puertos' => '2x DisplayPort 2.1, 1x HDMI 2.1, 1x USB Tipo-C',
                'Refrigeración' => 'Vapor-X con disipador de triple ventilador',
            ],
            6 => [
                'Memoria VRAM' => '16 GB GDDR6',
                'Interfaz de memoria' => '256-bit',
                'Frecuencia Game / Boost' => '2124 MHz / 2430 MHz',
                'Stream Processors' => '3840',
                'Infinity Cache' => '64 MB',
                'Refrigeración' => 'Doble ventilador de 100mm con rodamientos dobles',
                'Alimentación' => '2x 8-pin PCIe (fuente 700W recomendada)',
            ],
            7 => [
                'Núcleos' => '20 núcleos (8 P-cores + 12 E-cores)',
                'Hilos' => '28 hilos',
                'Frecuencia Base' => '3.4 GHz (P-core) / 2.5 GHz (E-core)',
                'Frecuencia Turbo' => 'Hasta 5.6 GHz con Intel Turbo Boost Max 3.0',
                'Caché L3' => '33 MB Intel Smart Cache',
                'Socket' => 'LGA 1700 (Chipset Intel 600/700)',
                'TDP' => '125 W Base / 253 W Turbo',
            ],
            8 => [
                'Núcleos' => '14 núcleos (6 P-cores + 8 E-cores)',
                'Hilos' => '20 hilos',
                'Frecuencia Base' => '3.5 GHz (P-core) / 2.6 GHz (E-core)',
                'Frecuencia Turbo' => 'Hasta 5.1 GHz',
                'Caché L3' => '24 MB Intel Smart Cache',
                'Socket' => 'LGA 1700',
                'TDP' => '125 W Base / 181 W Turbo',
            ],
            9 => [
                'Capacidad' => '32 GB (Kit 2x16 GB)',
                'Tipo' => 'DDR5 DIMM 288 contactos',
                'Frecuencia' => '6000 MHz',
                'Latencia probada' => 'CL30 (30-36-36-76)',
                'Voltaje' => '1.35 V',
                'Perfiles' => 'Intel XMP 3.0 / AMD EXPO',
                'Iluminación' => 'RGB direccionable multizona en diez zonas',
            ],
            10 => [
                'Capacidad' => '32 GB (Kit 2x16 GB)',
                'Tipo' => 'DDR5 DIMM 288 contactos',
                'Frecuencia' => '6000 MHz',
                'Latencia probada' => 'CL30 (30-38-38-96)',
                'Voltaje' => '1.35 V',
                'Perfiles' => 'Optimizado para AMD EXPO',
                'Diseño' => 'Aluminio negro anodizado con tira de luz RGB difusa',
            ],
            11 => [
                'Capacidad' => '64 GB (Kit 2x32 GB)',
                'Tipo' => 'DDR5 DIMM 288 contactos',
                'Frecuencia' => '6600 MHz',
                'Latencia probada' => 'CL32',
                'Voltaje' => '1.40 V',
                'Personalización' => 'Barras superiores modulares intercambiables',
                'Iluminación' => '11 LEDs RGB CAPELLIX ultrabrillantes',
            ],
            12 => [
                'Capacidad' => '2 TB (2000 GB)',
                'Factor de forma' => 'M.2 2280',
                'Interfaz' => 'PCIe Gen 4.0 x4, NVMe 2.0',
                'Velocidad de lectura' => 'Hasta 7.450 MB/s',
                'Velocidad de escritura' => 'Hasta 6.900 MB/s',
                'Disipador' => 'Disipador térmico de aluminio incluido',
                'Durabilidad' => '1200 TBW',
            ],
            13 => [
                'Capacidad' => '2 TB (2000 GB)',
                'Factor de forma' => 'M.2 2280',
                'Interfaz' => 'PCIe Gen 5.0 x4, NVMe 2.0',
                'Velocidad de lectura' => 'Hasta 12.400 MB/s',
                'Velocidad de escritura' => 'Hasta 11.800 MB/s',
                'Controlador' => 'Phison PS5026-E26',
                'Durabilidad' => '1200 TBW con memoria Micron 232-Layer 3D TLC',
            ],
            14 => [
                'Capacidad' => '2 TB (2000 GB)',
                'Factor de forma' => 'M.2 2280',
                'Interfaz' => 'PCIe 4.0 x4 NVMe',
                'Lectura secuencial' => 'Hasta 3500 MB/s',
                'Escritura secuencial' => 'Hasta 2800 MB/s',
                'Durabilidad' => '640 TBW',
                'Consumo' => 'Bajo consumo energético en reposo',
            ],
            15 => [
                'Factor de forma' => 'ATX (30.5 cm x 24.4 cm)',
                'Socket' => 'LGA 1700 (Intel 12ª, 13ª y 14ª Gen)',
                'Chipset' => 'Intel Z790',
                'Fases de alimentación' => '20+1 fases de 90A con disipadores masivos',
                'Memoria RAM' => '4x DDR5 hasta 7800+ MHz (OC), máx. 192GB',
                'Ranuras PCIe' => '2x PCIe 5.0 x16, 1x PCIe 4.0 x16',
                'Conectividad' => 'Wi-Fi 6E, 2.5G LAN, Dual Thunderbolt 4',
            ],
            16 => [
                'Factor de forma' => 'ATX',
                'Socket' => 'AM5 (AMD Ryzen Serie 7000, 8000 y 9000)',
                'Chipset' => 'AMD B650',
                'Memoria RAM' => '4x DDR5 hasta 7600+ MHz (OC), máx. 192GB',
                'Almacenamiento' => '3x M.2 PCIe 4.0 Shield Frozr, 6x SATA 6Gb/s',
                'Red' => 'Realtek 2.5G LAN + Wi-Fi 6E + Bluetooth 5.3',
                'Audio' => 'Audio Boost 5 con códec Realtek ALC4080',
            ],
            17 => [
                'Factor de forma' => 'ATX',
                'Socket' => 'AM5 (AMD Ryzen serie 7000/8000/9000)',
                'Chipset' => 'AMD B650',
                'Alimentación' => 'Digital Twin 12+2+2 fases VRM',
                'Almacenamiento' => '1x PCIe 5.0 M.2 + 2x PCIe 4.0 M.2',
                'Conectividad' => 'Wi-Fi 6E 802.11ax, LAN 2.5GbE, USB 3.2 Gen 2x2 Tipo-C',
                'Tecnología EZ' => 'PCIe EZ-Latch y M.2 EZ-Latch sin tornillos',
            ],
            18 => [
                'Dimensiones radiador' => '394 x 121 x 27 mm (aluminio)',
                'Ventiladores' => '3x F120 RGB Core (500 - 1800 RPM)',
                'Pantalla' => 'LCD IPS de 2.36 pulgadas (640x640 px, 60Hz)',
                'Bomba' => 'Asetek Gen 7 (800 - 2800 RPM)',
                'Nivel sonoro' => '17.9 - 30.6 dBA',
                'Compatibilidad' => 'Intel LGA 1700/1200/115x, AMD AM5/AM4',
            ],
            19 => [
                'Radiador' => '398 x 120 x 38 mm (grosor aumentado de 38mm)',
                'Ventiladores' => '3x Arctic P12 PWM A-RGB (200 - 2000 RPM)',
                'Ventilador VRM' => 'Ventilador integrado de 60mm para disipadores VRM',
                'Bomba' => 'Bomba PWM controlada por frecuencia (800 - 2800 RPM)',
                'Nivel de ruido' => '0.3 Sone a máxima velocidad',
                'Compatibilidad' => 'Intel LGA 1700/1851, AMD AM5/AM4',
            ],
            20 => [
                'Tipo' => 'Disipador por aire de doble torre',
                'Material' => 'Cobre niquelado en base y heatpipes, aletas de aluminio',
                'Heatpipes' => '6 tubos de calor de alto rendimiento de 6mm',
                'Ventiladores' => '2x Noctua NF-A15 HS-PWM chromax.black (140mm)',
                'Nivel de ruido' => 'Máximo 24.6 dBA (19.2 dBA con adaptador L.N.A.)',
                'Compatibilidad' => 'Intel LGA 1700/1200/115x, AMD AM5/AM4',
            ],
            21 => [
                'Potencia' => '1000 W continua',
                'Certificación' => '80 Plus Gold (hasta 90% eficiencia)',
                'Estándar' => 'ATX 3.0 nativo PCIe 5.0 12VHPWR',
                'Modularidad' => '100% Modular',
                'Ventilador' => '135 mm Fluid Dynamic Bearing (FDB)',
                'Protecciones' => 'OPP, OVP, UVP, SCP, OCP, OTP',
            ],
            22 => [
                'Potencia' => '850 W continua',
                'Certificación' => '80 Plus Gold y Cybenetics Gold',
                'Interfaz' => 'Panel de conexiones lateral patentado para fácil acceso',
                'Cables' => 'Totalmente modulares con microconectores tipo 5',
                'Estándar' => 'ATX 3.0 compatible con cable PCIe 5.0 12VHPWR',
                'Ventilador' => '140mm FDB con modo Zero RPM a baja carga',
            ],
            23 => [
                'Potencia' => '850 W',
                'Certificación' => '80 Plus Gold',
                'Conector PCIe 5.0' => 'Cable nativo 16 pines con cabezal amarillo de seguridad',
                'Formato' => 'ATX compacto (140 mm de profundidad)',
                'Topología' => 'Diseño LLC Half Bridge con convertidor DC-DC',
                'Protecciones' => 'OCP, OVP, OPP, OTP, SCP, UVP',
            ],
            24 => [
                'Factor de forma' => 'Semi-torre ATX',
                'Material frontal' => 'Madera natural de nogal certificada FSC',
                'Soporte placas' => 'ATX, Micro-ATX, Mini-ITX',
                'Longitud máx. GPU' => '355 mm con ventilador frontal',
                'Bahías' => '2x 3.5 pulgadas / 2.5 pulgadas, 2x 2.5 pulgadas dedicadas',
                'Puertos frontales' => '1x USB 3.1 Gen 2 Tipo-C, 2x USB 3.0, Audio HD',
            ],
            25 => [
                'Factor de forma' => 'Torre media de doble cámara ATX',
                'Paneles' => 'Cristal templado panorámico sin pilar esquinero',
                'Iluminación' => 'Tiras RGB difusas superior e inferior integradas',
                'Soporte radiadores' => 'Hasta 3x 360mm simultáneos (superior, lateral, inferior)',
                'Longitud máx. GPU' => '455 mm',
                'Versatilidad' => 'Chasis reversible y soporte para tarjeta vertical',
            ],
            26 => [
                'Factor de forma' => 'Torre media de doble cámara',
                'Paneles' => 'Vidrio envolvente continuo sin obstrucciones de esquina',
                'Ventilación' => 'Soporte para hasta 10 ventiladores de 120mm',
                'Soporte radiadores' => 'Radiadores de hasta 360mm en la parte superior, lateral e inferior',
                'Gestión de cables' => 'Cámara trasera espaciosa con canales de enrutamiento',
                'Longitud máx. GPU' => 'Hasta 435 mm',
            ],
            27 => [
                'Conectividad' => 'LIGHTSPEED inalámbrico + USB-C',
                'Sensor' => 'HERO 2 de próxima generación (100 - 32.000 DPI)',
                'Velocidad de sondeo' => 'Hasta 4000 Hz / 0.25 ms de respuesta',
                'Interruptores' => 'LIGHTFORCE híbridos óptico-mecánicos',
                'Peso' => '60 gramos ultra-ligero',
                'Batería' => 'Hasta 95 horas de movimiento constante',
            ],
            28 => [
                'Conectividad' => 'Razer HyperSpeed Wireless (2.4 GHz) + cable USB-C Speedflex',
                'Sensor' => 'Óptico Focus Pro 30K (hasta 30.000 DPI)',
                'Velocidad / Aceleración' => '750 IPS / 70 G',
                'Interruptores' => 'Switches ópticos de ratón Razer Gen-3 (90 millones de clics)',
                'Peso' => '63 gramos ultra-ligero ergonómico para diestros',
                'Batería' => 'Hasta 90 horas de autonomía continua',
            ],
            29 => [
                'Formato' => 'Tenkeyless (TKL) sin teclado numérico',
                'Conectividad' => 'LIGHTSPEED inalámbrico, Bluetooth y USB con cable',
                'Teclas' => 'PBT de doble inyección resistentes al brillo',
                'Iluminación' => 'LIGHTSYNC RGB configurable tecla por tecla',
                'Batería' => 'Hasta 50 horas de autonomía con iluminación activa',
                'Controles multimedia' => 'Rueda de volumen metálica y botones multimedia dedicados',
            ],
            30 => [
                'Panel' => 'OLED de 26.5 pulgadas antirreflejos Micro-texture',
                'Resolución' => 'QHD 2560 x 1440 píxeles a 16:9',
                'Tasa de refresco' => '240 Hz nativos',
                'Tiempo de respuesta' => '0.03 ms (gris a gris)',
                'Gama de colores' => 'DCI-P3 99%, sRGB 135%, brillo pico 1000 nits en HDR',
                'Refrigeración' => 'Disipador térmico personalizado y diseño de flujo de aire térmico',
                'Puertos' => '2x HDMI 2.0, 1x DisplayPort 1.4 (DSC), 2x USB 3.2 Gen 1',
            ],
        ];

        return $specsMap[$this->id] ?? [
            'Categoría' => $this->category,
            'Fabricante' => $this->brand,
            'Garantía' => '3 años oficial Hardware Store',
            'Disponibilidad' => 'En stock para entrega inmediata',
        ];
    }
}
