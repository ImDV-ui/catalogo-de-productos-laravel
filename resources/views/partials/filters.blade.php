<aside class="store-sidebar" id="catalog-sidebar">
    <button type="button" class="btn-reset-filters" id="btn-reset-filters">
        <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        <span>Limpiar filtros</span>
    </button>

    <div class="filter-section">
        <div class="filter-header">
            <span>Rango de Precio</span>
        </div>
        <div class="filter-body" id="filter-body-price">
            <div class="price-inputs-row">
                <div class="price-input-box">
                    <input type="number" id="filter-min-price" value="{{ $selectedMinPrice ?? $catalogMinPrice }}" min="0" max="{{ $catalogMaxPrice }}" data-default-min="{{ $catalogMinPrice }}" placeholder="{{ $catalogMinPrice }}">
                    <span>€</span>
                </div>
                <span style="color: var(--store-text-muted); font-size: 0.85rem;">—</span>
                <div class="price-input-box">
                    <input type="number" id="filter-max-price" value="{{ $selectedMaxPrice ?? $catalogMaxPrice }}" min="0" max="{{ $catalogMaxPrice }}" data-default-max="{{ $catalogMaxPrice }}" placeholder="{{ $catalogMaxPrice }}">
                    <span>€</span>
                </div>
            </div>
            <button type="button" class="btn-price-apply" id="btn-apply-price">Aplicar rango</button>
        </div>
    </div>

    <div class="filter-section">
        <div class="filter-header">
            <span>Fabricantes y Marcas</span>
        </div>
        <div class="filter-body" id="filter-body-brands">
            <div class="filter-search-box">
                <input type="text" class="filter-search-input" id="brand-search-input" placeholder="Buscar marca...">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            @php
                $allBrandsList = $brands->toArray();
                $firstBatch = array_slice($allBrandsList, 0, 7, true);
                $remainingBatch = array_slice($allBrandsList, 7, null, true);
            @endphp

            @foreach($firstBatch as $brandName => $count)
                <label class="filter-item" data-brand-item="{{ $brandName }}">
                    <div class="filter-label-group">
                        <input type="checkbox" class="filter-checkbox brand-checkbox" value="{{ $brandName }}" {{ in_array($brandName, $selectedBrands ?? [], true) ? 'checked' : '' }}>
                        <span>{{ $brandName }}</span>
                    </div>
                    <span class="filter-count">({{ $count }})</span>
                </label>
            @endforeach

            @if(!empty($remainingBatch))
                @foreach($remainingBatch as $brandName => $count)
                    <label class="filter-item extra-brand-item" data-brand-item="{{ $brandName }}" style="display: none;">
                        <div class="filter-label-group">
                            <input type="checkbox" class="filter-checkbox brand-checkbox" value="{{ $brandName }}" {{ in_array($brandName, $selectedBrands ?? [], true) ? 'checked' : '' }}>
                            <span>{{ $brandName }}</span>
                        </div>
                        <span class="filter-count">({{ $count }})</span>
                    </label>
                @endforeach

                <button type="button" class="btn-filter-more" id="btn-more-brands" data-expanded="false">Ver más marcas</button>
            @endif
        </div>
    </div>

    <div class="filter-section">
        <div class="filter-header">
            <span>Categorías</span>
        </div>
        <div class="filter-body" id="filter-body-categories">
            @foreach($categories as $categoryName => $count)
                <div class="filter-item" style="cursor: default;">
                    <div class="filter-label-group">
                        <span style="color: var(--store-primary); font-size: 0.8rem;">•</span>
                        <span>{{ $categoryName }}</span>
                    </div>
                    <span class="filter-count">({{ $count }})</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="filter-section">
        <div class="filter-header">
            <span>Promociones</span>
        </div>
        <div class="filter-body">
            <label class="filter-item">
                <div class="filter-label-group">
                    <input type="checkbox" class="filter-checkbox" id="checkbox-only-offers" {{ !empty($onlyOffers) ? 'checked' : '' }}>
                    <span style="color: var(--store-red); font-weight: 600;">Solo productos con descuento</span>
                </div>
            </label>
        </div>
    </div>
</aside>
