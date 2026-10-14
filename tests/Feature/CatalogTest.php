<?php

use App\Models\Product;

test('the home landing page loads with Hardware Store branding and categories', function () {
    Product::create([
        'name' => 'NVIDIA GeForce RTX 4090 Gaming OC',
        'description' => 'Tarjeta gráfica de gama extrema con 24GB GDDR6X y Ray Tracing',
        'price' => 1799.99,
        'image' => 'images/products/rtx4090.jpg',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Hardware');
    $response->assertSee('Store');
    $response->assertSee('Explorar Catálogo');
    $response->assertSee('NVIDIA GeForce RTX 4090');
});

test('the catalog page loads with filters and products', function () {
    Product::create([
        'name' => 'AMD Ryzen 9 7950X3D',
        'description' => 'Procesador de 16 núcleos y 32 hilos con tecnología 3D V-Cache',
        'price' => 699.00,
        'image' => 'images/products/ryzen9.jpg',
    ]);

    $response = $this->get('/productos');

    $response->assertStatus(200);
    $response->assertSee('Catálogo de Hardware');
    $response->assertSee('AMD Ryzen 9 7950X3D');
    $response->assertSee('Limpiar filtros');
});

test('the individual product detail page loads with description and specs', function () {
    $product = Product::create([
        'name' => 'NVIDIA GeForce RTX 4090 Gaming OC',
        'description' => 'Tarjeta gráfica de gama extrema con 24GB GDDR6X y Ray Tracing',
        'price' => 1799.99,
        'image' => 'images/products/rtx4090.jpg',
    ]);

    $response = $this->get('/productos/'.$product->id);

    $response->assertStatus(200);
    $response->assertSee('NVIDIA GeForce RTX 4090');
    $response->assertSee('Tarjeta gráfica de gama extrema con 24GB GDDR6X y Ray Tracing');
    $response->assertSee('Especificaciones Técnicas (Specs)');
    $response->assertSee('Memoria VRAM');
    $response->assertSee('24 GB GDDR6X');
    $response->assertSee('Añadir al Carrito');
});

test('the catalog filters by search query', function () {
    Product::create([
        'name' => 'ASUS ROG Maximus Z790 Hero',
        'description' => 'Placa base gaming de gama alta para Intel',
        'price' => 599.99,
        'image' => 'images/products/motherboard_asus.jpg',
    ]);

    Product::create([
        'name' => 'NZXT Kraken Elite 360 RGB',
        'description' => 'Sistema de refrigeración líquida AIO de 360mm',
        'price' => 279.99,
        'image' => 'images/products/cooler_nzxt.jpg',
    ]);

    $response = $this->get('/productos?q=Kraken');

    $response->assertStatus(200);
    $response->assertSee('NZXT Kraken Elite 360 RGB');
    $response->assertDontSee('ASUS ROG Maximus Z790 Hero');
});

test('the cart page loads successfully', function () {
    $response = $this->get('/carrito');

    $response->assertStatus(200);
    $response->assertSee('Tu Carrito de Compra');
    $response->assertSee('Resumen del pedido');
});

test('peripherals and hardware are correctly categorized and display specs', function () {
    $mouse = Product::create([
        'name' => 'Logitech G PRO X Superlight 2 Lightspeed Wireless',
        'description' => 'Ratón gaming inalámbrico ultra-ligero de 60g',
        'price' => 149.00,
        'image' => 'images/products/mouse_logitech.jpg',
    ]);

    $cpu = Product::create([
        'name' => 'AMD Ryzen 7 7800X3D',
        'description' => 'Procesador gaming con tecnología 3D V-Cache',
        'price' => 449.00,
        'image' => 'images/products/ryzen9.jpg',
    ]);

    expect($mouse->category)->toBe('Periféricos');
    expect($mouse->brand)->toBe('Logitech');
    expect($cpu->category)->toBe('Procesadores');
    expect($cpu->brand)->toBe('AMD');

    $response = $this->get('/productos/'.$mouse->id);
    $response->assertStatus(200);
    $response->assertSee('Logitech G PRO X Superlight 2');
});
