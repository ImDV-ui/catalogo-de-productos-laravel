document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('store-search-input');
  const sortSelect = document.getElementById('catalog-sort-select');
  const brandSearchInput = document.getElementById('brand-search-input');
  const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
  const categoryPills = document.querySelectorAll('.category-pill');
  const minPriceInput = document.getElementById('filter-min-price');
  const maxPriceInput = document.getElementById('filter-max-price');
  const btnPriceApply = document.getElementById('btn-apply-price');
  const btnResetFilters = document.getElementById('btn-reset-filters');
  const onlyOffersCheckbox = document.getElementById('checkbox-only-offers');
  const scrollTopBtn = document.getElementById('btn-scroll-top');
  
  const productCards = document.querySelectorAll('.product-card');
  const productCountDisplay = document.getElementById('catalog-count-display');
  const emptyState = document.getElementById('catalog-empty-state');
  
  const cartTrigger = document.getElementById('btn-header-cart');
  const cartDrawerBackdrop = document.getElementById('cart-drawer-backdrop');
  const cartCloseBtn = document.getElementById('cart-close-btn');
  const cartBadge = document.getElementById('header-cart-badge');
  const cartItemsContainer = document.getElementById('cart-drawer-items');
  const cartSubtotalEl = document.getElementById('cart-subtotal');
  const cartTotalEl = document.getElementById('cart-total');
  const btnCheckout = document.getElementById('btn-checkout');
  
  const toast = document.getElementById('store-toast');
  const toastMsg = document.getElementById('store-toast-msg');

  function getCart() {
    try {
      return JSON.parse(localStorage.getItem('hardware_store_cart')) || [];
    } catch {
      return [];
    }
  }

  function saveCart(cart) {
    localStorage.setItem('hardware_store_cart', JSON.stringify(cart));
    updateCartUI();
  }

  function updateCartUI() {
    const cart = getCart();
    const totalQty = cart.reduce((acc, item) => acc + item.qty, 0);
    if (cartBadge) cartBadge.textContent = totalQty;

    if (!cartItemsContainer) return;

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = `
        <div class="cart-empty-message">
          <svg style="width: 48px; height: 48px; margin-bottom: 0.75rem; color: #cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          <strong style="color: var(--store-text);">Tu carrito está vacío</strong>
          <span style="font-size: 0.85rem; margin-top: 0.25rem;">Añade componentes para comenzar tu pedido.</span>
        </div>
      `;
      if (cartSubtotalEl) cartSubtotalEl.textContent = '0,00€';
      if (cartTotalEl) cartTotalEl.textContent = '0,00€';
      return;
    }

    let subtotal = 0;
    cartItemsContainer.innerHTML = '';

    cart.forEach(item => {
      const itemTotal = item.price * item.qty;
      subtotal += itemTotal;

      const row = document.createElement('div');
      row.className = 'cart-item-row';
      row.innerHTML = `
        <img src="${item.image}" alt="${item.name}" class="cart-item-img">
        <div class="cart-item-info">
          <h4 class="cart-item-title">${item.name}</h4>
          <span class="cart-item-price">${formatCurrency(item.price)}</span>
          <div class="cart-item-actions">
            <div class="qty-control" style="transform: scale(0.85); transform-origin: left center;">
              <button type="button" class="qty-btn" data-action="dec" data-id="${item.id}">-</button>
              <span style="padding: 0 0.5rem; font-weight: 700; font-size: 0.9rem;">${item.qty}</span>
              <button type="button" class="qty-btn" data-action="inc" data-id="${item.id}">+</button>
            </div>
            <button type="button" class="cart-remove-btn" data-action="remove" data-id="${item.id}">Eliminar</button>
          </div>
        </div>
      `;
      cartItemsContainer.appendChild(row);
    });

    if (cartSubtotalEl) cartSubtotalEl.textContent = formatCurrency(subtotal);
    if (cartTotalEl) cartTotalEl.textContent = formatCurrency(subtotal);
  }

  function formatCurrency(num) {
    return Number(num).toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '€';
  }

  function addToCart(product) {
    const cart = getCart();
    const existing = cart.find(item => item.id === product.id);
    if (existing) {
      existing.qty += product.qty;
    } else {
      cart.push(product);
    }
    saveCart(cart);
    showToast(`Añadido al carrito: ${product.name}`);
  }

  function openCartDrawer() {
    if (cartDrawerBackdrop) {
      updateCartUI();
      cartDrawerBackdrop.classList.add('open');
    }
  }

  function closeCartDrawer() {
    if (cartDrawerBackdrop) {
      cartDrawerBackdrop.classList.remove('open');
    }
  }

  if (cartTrigger) {
    cartTrigger.addEventListener('click', (e) => {
      e.preventDefault();
      openCartDrawer();
    });
  }

  if (cartCloseBtn) {
    cartCloseBtn.addEventListener('click', closeCartDrawer);
  }

  if (cartDrawerBackdrop) {
    cartDrawerBackdrop.addEventListener('click', (e) => {
      if (e.target === cartDrawerBackdrop) closeCartDrawer();
    });
  }

  if (cartItemsContainer) {
    cartItemsContainer.addEventListener('click', (e) => {
      const btn = e.target.closest('button[data-action]');
      if (!btn) return;
      const action = btn.getAttribute('data-action');
      const id = parseInt(btn.getAttribute('data-id'), 10);
      let cart = getCart();

      if (action === 'inc') {
        const item = cart.find(i => i.id === id);
        if (item) item.qty++;
      } else if (action === 'dec') {
        const item = cart.find(i => i.id === id);
        if (item) {
          item.qty--;
          if (item.qty <= 0) cart = cart.filter(i => i.id !== id);
        }
      } else if (action === 'remove') {
        cart = cart.filter(i => i.id !== id);
      }

      saveCart(cart);
    });
  }

  if (btnCheckout) {
    btnCheckout.addEventListener('click', () => {
      const cart = getCart();
      if (cart.length === 0) {
        showToast('El carrito está vacío');
        return;
      }
      showToast('¡Pedido completado con éxito!');
      saveCart([]);
      setTimeout(closeCartDrawer, 1200);
    });
  }

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-add-cart');
    if (btn) {
      e.preventDefault();
      const id = parseInt(btn.getAttribute('data-id'), 10);
      const name = btn.getAttribute('data-name');
      const price = parseFloat(btn.getAttribute('data-price'));
      const image = btn.getAttribute('data-image') || '';
      const qtyInput = document.getElementById('detail-qty-input');
      const qty = qtyInput ? parseInt(qtyInput.value, 10) || 1 : 1;

      addToCart({ id, name, price, image, qty });
    }
  });

  const detailQtyInput = document.getElementById('detail-qty-input');
  const btnDetailDec = document.getElementById('detail-qty-dec');
  const btnDetailInc = document.getElementById('detail-qty-inc');

  if (btnDetailDec && detailQtyInput) {
    btnDetailDec.addEventListener('click', () => {
      let val = parseInt(detailQtyInput.value, 10) || 1;
      if (val > 1) detailQtyInput.value = val - 1;
    });
  }

  if (btnDetailInc && detailQtyInput) {
    btnDetailInc.addEventListener('click', () => {
      let val = parseInt(detailQtyInput.value, 10) || 1;
      detailQtyInput.value = val + 1;
    });
  }

  function showToast(message) {
    if (!toast || !toastMsg) return;
    toastMsg.textContent = message;
    toast.classList.add('show');
    setTimeout(() => {
      toast.classList.remove('show');
    }, 2800);
  }

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  function filterAndSortProducts() {
    const q = (searchInput?.value || '').toLowerCase().trim();
    
    const selectedBrands = Array.from(brandCheckboxes)
      .filter(cb => cb.checked)
      .map(cb => cb.value.toLowerCase());

    const activePill = document.querySelector('.category-pill.active');
    const selectedCategory = activePill ? (activePill.getAttribute('data-category') || 'all') : 'all';
    const onlyOffers = onlyOffersCheckbox ? onlyOffersCheckbox.checked : false;

    const minVal = parseFloat(minPriceInput?.value) || 0;
    const maxVal = parseFloat(maxPriceInput?.value) || 999999;

    let visibleCount = 0;
    const cardsArray = Array.from(productCards);

    cardsArray.forEach(card => {
      const name = (card.getAttribute('data-name') || '').toLowerCase();
      const desc = (card.getAttribute('data-desc') || '').toLowerCase();
      const brand = (card.getAttribute('data-brand') || '').toLowerCase();
      const category = card.getAttribute('data-category') || '';
      const price = parseFloat(card.getAttribute('data-price') || '0');
      const hasDiscount = (card.getAttribute('data-discount') || '') !== '';

      const matchText = !q || name.includes(q) || desc.includes(q) || brand.includes(q) || category.toLowerCase().includes(q);
      const matchBrand = selectedBrands.length === 0 || selectedBrands.includes(brand);
      const matchCategory = selectedCategory === 'all' || category === selectedCategory;
      const matchOffers = !onlyOffers || hasDiscount;
      const matchPrice = price >= minVal && price <= maxVal;

      if (matchText && matchBrand && matchCategory && matchOffers && matchPrice) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (productCountDisplay) {
      productCountDisplay.textContent = `${visibleCount} producto${visibleCount === 1 ? '' : 's'} disponible${visibleCount === 1 ? '' : 's'}`;
    }

    if (emptyState) {
      emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
    }
  }

  if (searchInput) {
    searchInput.addEventListener('input', filterAndSortProducts);
  }

  brandCheckboxes.forEach(cb => {
    cb.addEventListener('change', filterAndSortProducts);
  });

  if (brandSearchInput) {
    brandSearchInput.addEventListener('input', (e) => {
      const term = e.target.value.toLowerCase().trim();
      const brandItems = document.querySelectorAll('.filter-item[data-brand-item]');
      brandItems.forEach(item => {
        const brandName = item.getAttribute('data-brand-item').toLowerCase();
        item.style.display = brandName.includes(term) ? 'flex' : 'none';
      });
    });
  }

  categoryPills.forEach(pill => {
    pill.addEventListener('click', (e) => {
      e.preventDefault();
      categoryPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      filterAndSortProducts();
    });
  });

  if (btnPriceApply) {
    btnPriceApply.addEventListener('click', (e) => {
      e.preventDefault();
      filterAndSortProducts();
      showToast('Filtro de precio aplicado');
    });
  }

  if (onlyOffersCheckbox) {
    onlyOffersCheckbox.addEventListener('change', filterAndSortProducts);
  }

  if (btnResetFilters) {
    btnResetFilters.addEventListener('click', (e) => {
      e.preventDefault();
      if (searchInput) searchInput.value = '';
      if (brandSearchInput) brandSearchInput.value = '';
      brandCheckboxes.forEach(cb => cb.checked = false);
      if (onlyOffersCheckbox) onlyOffersCheckbox.checked = false;
      categoryPills.forEach(p => p.classList.remove('active'));
      const firstPill = document.querySelector('.category-pill[data-category="all"]');
      if (firstPill) firstPill.classList.add('active');
      if (minPriceInput) minPriceInput.value = minPriceInput.getAttribute('data-default-min') || '0';
      if (maxPriceInput) maxPriceInput.value = maxPriceInput.getAttribute('data-default-max') || '2000';
      filterAndSortProducts();
      showToast('Filtros restablecidos');
    });
  }

  if (sortSelect) {
    sortSelect.addEventListener('change', () => {
      const val = sortSelect.value;
      const grid = document.querySelector('.product-grid');
      if (!grid) return;

      const cards = Array.from(productCards);
      cards.sort((a, b) => {
        const priceA = parseFloat(a.getAttribute('data-price') || '0');
        const priceB = parseFloat(b.getAttribute('data-price') || '0');
        const ratingA = parseFloat(a.getAttribute('data-rating') || '0');
        const ratingB = parseFloat(b.getAttribute('data-rating') || '0');
        const nameA = a.getAttribute('data-name') || '';
        const nameB = b.getAttribute('data-name') || '';

        if (val === 'price_asc') return priceA - priceB;
        if (val === 'price_desc') return priceB - priceA;
        if (val === 'rating_desc') return ratingB - ratingA;
        if (val === 'name_asc') return nameA.localeCompare(nameB);
        return 0;
      });

      cards.forEach(c => grid.appendChild(c));
    });
  }

  const btnMoreBrands = document.getElementById('btn-more-brands');
  if (btnMoreBrands) {
    btnMoreBrands.addEventListener('click', () => {
      const hiddenBrands = document.querySelectorAll('.extra-brand-item');
      const isExpanded = btnMoreBrands.getAttribute('data-expanded') === 'true';
      hiddenBrands.forEach(item => {
        item.style.display = isExpanded ? 'none' : 'flex';
      });
      btnMoreBrands.textContent = isExpanded ? 'Ver más marcas' : 'Ver menos';
      btnMoreBrands.setAttribute('data-expanded', isExpanded ? 'false' : 'true');
    });
  }

  updateCartUI();
});
