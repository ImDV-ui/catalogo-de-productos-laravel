@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 1.75rem 1.25rem 4rem 1.25rem;">
    <nav class="store-breadcrumbs" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Inicio</a>
        <span class="separator">/</span>
        <a href="{{ route('products.index') }}">Componentes</a>
        <span class="separator">/</span>
        <span class="current">Todos los productos</span>
    </nav>

    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 0.75rem;">
        <h1 style="margin: 0; font-size: 1.8rem; font-weight: 800; color: var(--store-text);">Catálogo de Hardware y Componentes</h1>
        <span id="catalog-count-display" style="font-size: 0.9rem; color: var(--store-text-muted); font-weight: 500;">
            {{ $totalCount }} productos disponibles
        </span>
    </div>

    <div class="category-pills">
        <button type="button" class="category-pill {{ empty($selectedCategory) ? 'active' : '' }}" data-category="all">Todos los componentes</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Tarjetas Gráficas' ? 'active' : '' }}" data-category="Tarjetas Gráficas">Tarjetas Gráficas</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Procesadores' ? 'active' : '' }}" data-category="Procesadores">Procesadores</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Memorias RAM' ? 'active' : '' }}" data-category="Memorias RAM">Memorias RAM</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Discos Duros SSD' ? 'active' : '' }}" data-category="Discos Duros SSD">Discos Duros SSD</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Placas Base' ? 'active' : '' }}" data-category="Placas Base">Placas Base</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Refrigeración Líquida' ? 'active' : '' }}" data-category="Refrigeración Líquida">Refrigeración</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Fuentes de Alimentación' ? 'active' : '' }}" data-category="Fuentes de Alimentación">Fuentes</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Torres y Chasis' ? 'active' : '' }}" data-category="Torres y Chasis">Torres y Cajas</button>
        <button type="button" class="category-pill {{ $selectedCategory === 'Periféricos' ? 'active' : '' }}" data-category="Periféricos">Periféricos y Monitores</button>
    </div>

    <div class="catalog-layout">
        @include('partials.filters')

        <section style="display: flex; flex-direction: column; gap: 1.5rem;" aria-label="Listado de productos">
            <div class="product-grid" id="main-product-grid">
                @foreach($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>

            <div class="empty-catalog-state" id="catalog-empty-state" style="display: {{ $products->isEmpty() ? 'flex' : 'none' }};">
                <svg class="empty-catalog-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 style="margin: 0; font-size: 1.2rem; font-weight: 700;">No se encontraron productos con estos filtros</h3>
                <p style="margin: 0; color: var(--store-text-muted); font-size: 0.9rem;">Prueba a cambiar los términos de búsqueda o limpia los filtros.</p>
                <button type="button" class="btn-price-apply" onclick="document.getElementById('btn-reset-filters').click();" style="width: auto; padding: 0.6rem 1.5rem; margin-top: 0.5rem;">
                    Restablecer filtros
                </button>
            </div>
        </section>
    </div>
</div>
@endsection
