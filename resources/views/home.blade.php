@extends('layouts.app')

@section('content')
<section class="hero-banner">
    <div class="hero-container">
        <div>
            <span class="hero-tag">Hardware Store • Calidad Premium</span>
            <h1 class="hero-title">El Hardware Definitivo para tu <span>Próximo Build</span></h1>
            <p class="hero-subtitle">
                Descubre componentes de alto rendimiento para gaming y creación de contenido. Tarjetas gráficas de última generación, procesadores potentes y almacenamiento ultrarrápido con envío en 24 horas.
            </p>
            <div class="hero-actions">
                <a href="{{ route('products.index') }}" class="btn-primary">
                    Explorar Catálogo
                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
                <a href="{{ route('products.index', ['only_offers' => 1]) }}" class="btn-secondary">
                    Ver Ofertas
                </a>
            </div>
        </div>

        <div>
            <div class="hero-card-preview">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 1rem;">
                    <div>
                        <strong style="color: #ffffff; font-size: 1.1rem; display: block;">Hardware Store</strong>
                        <span style="color: #94a3b8; font-size: 0.8rem;">Garantía oficial y stock verificado</span>
                    </div>
                    <span style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
                        ● Envíos 24h
                    </span>
                </div>

                <div class="hero-stat-row">
                    <div class="hero-stat">
                        <span class="hero-stat-val">{{ $totalCount }}</span>
                        <span class="hero-stat-lbl">Componentes top</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-val">3 Años</span>
                        <span class="hero-stat-lbl">Garantía oficial</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-val">24h</span>
                        <span class="hero-stat-lbl">Entrega rápida</span>
                    </div>
                </div>

                <p style="margin: 0; color: #94a3b8; font-size: 0.85rem; line-height: 1.5;">
                    Asesoramiento técnico y componentes originales de marcas líderes como NVIDIA, AMD, Asus, Corsair, Samsung e Intel.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="section-header">
        <div>
            <h2 class="section-title">Categorías de Hardware</h2>
            <p class="section-subtitle">Explora los componentes por tipo y encuentra la pieza exacta para tu equipo</p>
        </div>
        <a href="{{ route('products.index') }}" class="section-link">
            Ver todas las categorías →
        </a>
    </div>

    <div class="categories-grid">
        @foreach($categories as $categoryName => $count)
            <a href="{{ route('products.index', ['category' => $categoryName]) }}" class="category-card">
                <div class="category-card-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                </div>
                <h3 class="category-card-title">{{ $categoryName }}</h3>
                <p class="category-card-count">{{ $count }} componentes disponibles</p>
            </a>
        @endforeach
    </div>
</section>

@if($discountedProducts->isNotEmpty())
<section class="section-block" style="background: #ffffff; border-radius: var(--radius-lg); margin-top: 1rem; border: 1px solid var(--store-border);">
    <div class="section-header">
        <div>
            <span style="color: var(--store-red); font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">Descuentos Exclusivos</span>
            <h2 class="section-title">Ofertas Destacadas</h2>
            <p class="section-subtitle">Componentes de máxima potencia al mejor precio disponible</p>
        </div>
        <a href="{{ route('products.index', ['only_offers' => 1]) }}" class="section-link">
            Ver todas las ofertas →
        </a>
    </div>

    <div class="product-grid">
        @foreach($discountedProducts as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

<section class="section-block">
    <div class="section-header">
        <div>
            <h2 class="section-title">Hardware Recomendado</h2>
            <p class="section-subtitle">Los componentes más solicitados por nuestra comunidad</p>
        </div>
        <a href="{{ route('products.index') }}" class="section-link">
            Explorar catálogo completo →
        </a>
    </div>

    <div class="product-grid">
        @foreach($featuredProducts as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endsection
