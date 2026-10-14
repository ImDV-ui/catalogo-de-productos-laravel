@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 1.75rem 1.25rem 4rem 1.25rem;">
    <nav class="store-breadcrumbs" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Inicio</a>
        <span class="separator">/</span>
        <a href="{{ route('products.index') }}">Componentes</a>
        <span class="separator">/</span>
        <a href="{{ route('products.index', ['category' => $product->category]) }}">{{ $product->category }}</a>
        <span class="separator">/</span>
        <span class="current">{{ $product->name }}</span>
    </nav>

    <div class="product-detail-view">
        <div class="detail-gallery">
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="detail-img-main">
            @else
                <div class="no-image-placeholder">
                    <span>Sin imagen disponible</span>
                </div>
            @endif
        </div>

        <div class="detail-info">
            <span class="detail-brand-badge">{{ $product->brand }} • {{ $product->category }}</span>
            <h1 class="detail-title">{{ $product->name }}</h1>

            <div class="product-rating-row" style="margin-bottom: 1rem;">
                <span class="rating-star">★</span>
                <span class="rating-score">{{ number_format($product->rating, 1, ',', '.') }}</span>
                <span class="rating-opinions">({{ $product->reviews_count }} valoraciones de clientes)</span>
            </div>

            <div class="detail-price-box">
                <div>
                    @if($product->discount_percent)
                        <div style="display: flex; align-items: center; gap: 0.6rem;">
                            <span class="price-current has-discount">{{ $product->formatted_price }}</span>
                            <span class="price-original">{{ $product->formatted_original_price }}</span>
                            <span class="badge-discount">-{{ $product->discount_percent }}%</span>
                        </div>
                    @else
                        <span class="price-current">{{ $product->formatted_price }}</span>
                    @endif
                    <div style="font-size: 0.75rem; color: var(--store-text-muted); margin-top: 2px;">IVA incluido</div>
                </div>

                <div class="detail-stock-badge">
                    <span class="toolbar-dot"></span>
                    <span>En stock • Envío 24h Gratis</span>
                </div>
            </div>

            <div style="color: var(--store-text); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                <strong>Descripción general:</strong>
                <p style="margin: 0.5rem 0 0 0; color: var(--store-text-muted);">
                    {{ $product->description }}
                </p>
            </div>

            <div class="detail-actions">
                <div class="qty-control">
                    <button type="button" class="qty-btn" id="detail-qty-dec">-</button>
                    <input type="text" class="qty-input" id="detail-qty-input" value="1" readonly>
                    <button type="button" class="qty-btn" id="detail-qty-inc">+</button>
                </div>

                <button type="button" class="btn-add-cart detail-buy-btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-image="{{ asset($product->image) }}">
                    Añadir al Carrito
                </button>
            </div>

            <div class="specs-section">
                <h3 class="specs-heading">Especificaciones Técnicas (Specs)</h3>
                <table class="specs-table">
                    <tbody>
                        @foreach($product->specs as $key => $val)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $val }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
    <div style="margin-top: 3rem;">
        <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--store-text); margin-bottom: 1.25rem;">
            Componentes Relacionados
        </h2>
        <div class="product-grid">
            @foreach($relatedProducts as $relProduct)
                @include('partials.product-card', ['product' => $relProduct])
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
