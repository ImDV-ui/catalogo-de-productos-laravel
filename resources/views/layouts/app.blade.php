<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware Store | Catálogo y Componentes de PC</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%230f172a'/><polygon points='50,20 80,38 80,72 50,88 20,72 20,38' fill='%232563eb'/><circle cx='50' cy='55' r='12' fill='%23ffffff'/></svg>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body>

    <header class="store-header">
        <div class="store-header-container">
            <a href="{{ route('home') }}" class="store-logo" title="Hardware Store">
                <div class="store-logo-icon">
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;">
                        <rect x="15" y="15" width="70" height="70" rx="14" stroke="#2563eb" stroke-width="8"/>
                        <circle cx="50" cy="50" r="14" fill="#2563eb"/>
                        <line x1="50" y1="2" x2="50" y2="15" stroke="#2563eb" stroke-width="6" stroke-linecap="round"/>
                        <line x1="50" y1="85" x2="50" y2="98" stroke="#2563eb" stroke-width="6" stroke-linecap="round"/>
                        <line x1="2" y1="50" x2="15" y2="50" stroke="#2563eb" stroke-width="6" stroke-linecap="round"/>
                        <line x1="85" y1="50" x2="98" y2="50" stroke="#2563eb" stroke-width="6" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="store-logo-text">
                    <span class="store-logo-main">Hardware<span>Store</span></span>
                    <span class="store-logo-sub">High-End PC Components</span>
                </div>
            </a>

            <nav class="store-nav-links">
                <a href="{{ route('home') }}" class="store-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('products.index') }}" class="store-nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Componentes</a>
                <a href="{{ route('products.index', ['only_offers' => 1]) }}" class="store-nav-link">Ofertas</a>
            </nav>

            <form action="{{ route('products.index') }}" method="GET" class="store-search-form" id="store-search-form">
                <input type="text" name="q" class="store-search-input" id="store-search-input" value="{{ request('q') }}" placeholder="Buscar tarjetas gráficas, procesadores, RAM, SSD..." autocomplete="off">
                <button type="submit" class="store-search-btn" aria-label="Buscar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>

            <div class="store-header-actions">
                <button type="button" class="store-cart-trigger" id="btn-header-cart" title="Ver carrito">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Carrito</span>
                    <span class="store-cart-badge" id="header-cart-badge">0</span>
                </button>
            </div>
        </div>
    </header>

    <nav class="store-toolbar" aria-label="Barra de utilidades">
        <div class="store-toolbar-container">
            <div class="store-toolbar-left">
                <div class="toolbar-status">
                    <span class="toolbar-dot"></span>
                    <span>Hardware 100% Original • Garantía oficial 3 años</span>
                </div>

                @if(request()->routeIs('products.index'))
                <div class="sort-select-wrapper" style="display: flex; align-items: center; gap: 0.5rem;">
                    <label for="catalog-sort-select" style="font-size: 0.82rem; color: #cbd5e1;">Ordenar:</label>
                    <select class="toolbar-sort-select" id="catalog-sort-select" name="sort">
                        <option value="relevance">Relevancia</option>
                        <option value="price_asc">Precio: menor a mayor</option>
                        <option value="price_desc">Precio: mayor a menor</option>
                        <option value="rating_desc">Mejor valorados</option>
                        <option value="name_asc">Nombre A-Z</option>
                    </select>
                </div>
                @endif
            </div>

            <div class="store-toolbar-right">
                <button type="button" class="btn-scroll-top" id="btn-scroll-top" aria-label="Subir al inicio">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    <span>Subir</span>
                </button>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <div class="cart-drawer-backdrop" id="cart-drawer-backdrop">
        <div class="cart-drawer">
            <div class="cart-drawer-header">
                <h3 class="cart-drawer-title">
                    <svg style="width: 20px; height: 20px; color: var(--store-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Tu Carrito de Compra
                </h3>
                <button type="button" class="cart-close-btn" id="cart-close-btn" aria-label="Cerrar">✕</button>
            </div>

            <div class="cart-drawer-items" id="cart-drawer-items"></div>

            <div class="cart-drawer-footer">
                <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: var(--store-text-muted);">
                    <span>Envío express</span>
                    <span style="color: var(--store-green); font-weight: 700;">Gratis</span>
                </div>
                <div class="cart-total-row">
                    <span>Total</span>
                    <span id="cart-total" style="color: var(--store-primary);">0,00€</span>
                </div>
                <button type="button" class="btn-checkout" id="btn-checkout">Tramitar Pedido</button>
            </div>
        </div>
    </div>

    <div class="store-toast" id="store-toast" role="status" aria-live="polite">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 22px; height: 22px; color: var(--store-primary);">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span id="store-toast-msg">Producto añadido</span>
    </div>

    <footer class="store-footer">
        <div class="footer-features-bar">
            <div class="footer-features-container">
                <div class="footer-feature">
                    <div class="footer-feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 22px; height: 22px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="footer-feature-text">
                        <h4>Envío 24 Horas</h4>
                        <p>Entrega rápida y asegurada en tu domicilio</p>
                    </div>
                </div>

                <div class="footer-feature">
                    <div class="footer-feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 22px; height: 22px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="footer-feature-text">
                        <h4>Garantía 3 Años</h4>
                        <p>Sustitución directa y soporte técnico</p>
                    </div>
                </div>

                <div class="footer-feature">
                    <div class="footer-feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 22px; height: 22px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div class="footer-feature-text">
                        <h4>Pago Seguro</h4>
                        <p>Pasarela encriptada y máxima protección</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                <span>© {{ date('Y') }} <strong>Hardware Store</strong>. Tienda especializada en componentes de PC.</span>
            </div>
            <div class="payment-methods-row">
                <span class="payment-badge">VISA</span>
                <span class="payment-badge">Mastercard</span>
                <span class="payment-badge">Bizum</span>
                <span class="payment-badge">PayPal</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/store.js') }}"></script>
</body>
</html>
