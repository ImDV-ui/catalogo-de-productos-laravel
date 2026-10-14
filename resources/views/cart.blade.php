@extends('layouts.app')

@section('content')
<div style="max-width: 1100px; margin: 0 auto; padding: 2rem 1.25rem 4rem 1.25rem;">
    <nav class="store-breadcrumbs" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Inicio</a>
        <span class="separator">/</span>
        <span class="current">Carrito de compra</span>
    </nav>

    <h1 style="font-size: 2rem; font-weight: 800; color: var(--store-text); margin: 0 0 1.5rem 0;">
        Tu Carrito de Compra
    </h1>

    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 2rem; align-items: start;">
        <div style="background: #ffffff; border: 1px solid var(--store-border); border-radius: var(--radius-lg); padding: 1.5rem; box-shadow: var(--shadow-card);">
            <div id="cart-page-items"></div>
        </div>

        <div style="background: #ffffff; border: 1px solid var(--store-border); border-radius: var(--radius-lg); padding: 1.5rem; box-shadow: var(--shadow-card); display: flex; flex-direction: column; gap: 1rem;">
            <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800; color: var(--store-text); border-bottom: 1px solid var(--store-border); padding-bottom: 0.75rem;">
                Resumen del pedido
            </h3>

            <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: var(--store-text-muted);">
                <span>Subtotal</span>
                <span id="cart-page-subtotal" style="font-weight: 700; color: var(--store-text);">0,00€</span>
            </div>

            <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: var(--store-text-muted);">
                <span>Envío express</span>
                <span style="font-weight: 700; color: var(--store-green);">Gratis</span>
            </div>

            <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: var(--store-text-muted);">
                <span>Garantía 3 años</span>
                <span style="font-weight: 700; color: var(--store-text);">Incluida</span>
            </div>

            <div style="border-top: 1px solid var(--store-border); padding-top: 1rem; display: flex; justify-content: space-between; align-items: baseline; font-size: 1.3rem; font-weight: 800;">
                <span>Total</span>
                <span id="cart-page-total" style="color: var(--store-primary);">0,00€</span>
            </div>

            <button type="button" class="btn-checkout" id="btn-page-checkout" style="margin-top: 0.5rem;">
                Confirmar y Pagar
            </button>

            <a href="{{ route('products.index') }}" style="text-align: center; font-size: 0.85rem; color: var(--store-primary); font-weight: 600; margin-top: 0.25rem;">
                ← Continuar comprando
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('cart-page-items');
    const subtotalEl = document.getElementById('cart-page-subtotal');
    const totalEl = document.getElementById('cart-page-total');
    const checkoutBtn = document.getElementById('btn-page-checkout');

    function renderCartPage() {
        let cart = [];
        try {
            cart = JSON.parse(localStorage.getItem('hardware_store_cart')) || [];
        } catch {
            cart = [];
        }

        if (!container) return;

        if (cart.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 3rem 1rem;">
                    <svg style="width: 56px; height: 56px; color: #cbd5e1; margin-bottom: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h3 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: var(--store-text);">El carrito está vacío</h3>
                    <p style="margin: 0.5rem 0 1.5rem 0; color: var(--store-text-muted); font-size: 0.9rem;">No tienes componentes añadidos todavía.</p>
                    <a href="{{ route('products.index') }}" class="btn-primary" style="display: inline-block;">
                        Ir a la tienda
                    </a>
                </div>
            `;
            if (subtotalEl) subtotalEl.textContent = '0,00€';
            if (totalEl) totalEl.textContent = '0,00€';
            return;
        }

        let total = 0;
        let html = '';

        cart.forEach(item => {
            const line = item.price * item.qty;
            total += line;
            html += `
                <div style="display: flex; gap: 1.25rem; align-items: center; padding: 1rem 0; border-bottom: 1px solid var(--store-border);">
                    <img src="${item.image}" alt="${item.name}" style="width: 72px; height: 72px; object-fit: contain; border: 1px solid var(--store-border); border-radius: var(--radius-sm); padding: 4px;">
                    <div style="flex-grow: 1;">
                        <h4 style="margin: 0 0 0.25rem 0; font-size: 0.95rem; font-weight: 700;">${item.name}</h4>
                        <span style="font-size: 0.85rem; color: var(--store-text-muted);">${Number(item.price).toLocaleString('es-ES', {minimumFractionDigits: 2})}€ unidad</span>
                    </div>
                    <div style="font-weight: 800; font-size: 1rem; color: var(--store-text); min-width: 90px; text-align: right;">
                        ${Number(line).toLocaleString('es-ES', {minimumFractionDigits: 2})}€
                    </div>
                    <button type="button" style="background: none; border: none; color: var(--store-red); cursor: pointer; padding: 4px;" data-remove-id="${item.id}">
                        ✕
                    </button>
                </div>
            `;
        });

        container.innerHTML = html;
        const fmt = Number(total).toLocaleString('es-ES', {minimumFractionDigits: 2}) + '€';
        if (subtotalEl) subtotalEl.textContent = fmt;
        if (totalEl) totalEl.textContent = fmt;
    }

    if (container) {
        container.addEventListener('click', (e) => {
            const btn = e.target.closest('[data-remove-id]');
            if (btn) {
                const id = parseInt(btn.getAttribute('data-remove-id'), 10);
                let cart = JSON.parse(localStorage.getItem('hardware_store_cart')) || [];
                cart = cart.filter(i => i.id !== id);
                localStorage.setItem('hardware_store_cart', JSON.stringify(cart));
                renderCartPage();
                const badge = document.getElementById('header-cart-badge');
                if (badge) badge.textContent = cart.reduce((acc, i) => acc + i.qty, 0);
            }
        });
    }

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            let cart = JSON.parse(localStorage.getItem('hardware_store_cart')) || [];
            if (cart.length === 0) return;
            alert('¡Gracias por tu compra en Hardware Store! Tu pedido ha sido procesado.');
            localStorage.setItem('hardware_store_cart', JSON.stringify([]));
            renderCartPage();
            const badge = document.getElementById('header-cart-badge');
            if (badge) badge.textContent = '0';
        });
    }

    renderCartPage();
});
</script>
@endsection
