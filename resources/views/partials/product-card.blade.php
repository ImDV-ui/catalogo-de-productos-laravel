<div class="product-card" 
     id="product-card-{{ $product->id }}"
     data-id="{{ $product->id }}"
     data-name="{{ $product->name }}"
     data-desc="{{ $product->description }}"
     data-brand="{{ $product->brand }}"
     data-category="{{ $product->category }}"
     data-price="{{ $product->price }}"
     data-rating="{{ $product->rating }}"
     data-discount="{{ $product->discount_percent ?? '' }}">
    
    <div class="card-top-row">
        @if($product->discount_percent)
            <span class="badge-discount">-{{ $product->discount_percent }}%</span>
        @else
            <span></span>
        @endif
        
        <span class="badge-brand-pill">{{ $product->brand }}</span>
    </div>

    <a href="{{ route('products.show', $product) }}" class="product-card-link" title="{{ $product->name }}">
        <div class="product-image-container">
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image" loading="lazy">
            @else
                <div class="no-image-placeholder">
                    <span>Sin imagen</span>
                </div>
            @endif
        </div>

        <div class="product-content">
            <h3 class="product-title">
                {{ $product->name }}
            </h3>

            <p class="product-description" title="{{ $product->description }}">
                {{ $product->description }}
            </p>

            <div class="product-price-block">
                @if($product->discount_percent)
                    <span class="price-current has-discount">{{ $product->formatted_price }}</span>
                    <span class="price-original">{{ $product->formatted_original_price }}</span>
                @else
                    <span class="price-current">{{ $product->formatted_price }}</span>
                @endif
            </div>

            <div class="product-rating-row">
                <span class="rating-star">★</span>
                <span class="rating-score">{{ number_format($product->rating, 1, ',', '.') }}</span>
                <span class="rating-opinions">({{ $product->reviews_count }} opiniones)</span>
            </div>

            <div class="product-shipping-row">
                <span>Envío gratis 24h</span>
            </div>
        </div>
    </a>

    <div class="card-action-row">
        <button type="button" class="btn-add-cart" id="btn-add-{{ $product->id }}" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-image="{{ asset($product->image) }}">
            Añadir al carrito
        </button>
    </div>
</div>
