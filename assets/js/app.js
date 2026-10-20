/**
 * PRASUNA (प्रसूना) • Luxury Himalayan Slow Fashion • Interactive Client Engine
 */

// Exchange rates relative to 1 NPR
const EXCHANGE_RATES = {
  NPR: { symbol: 'Rs. ', rate: 1, name: 'Nepali Rupee (NPR)' },
  USD: { symbol: '$', rate: 0.0076, name: 'US Dollar (USD)' },
  AUD: { symbol: 'A$', rate: 0.0118, name: 'Australian Dollar (AUD)' },
  GBP: { symbol: '£', rate: 0.0059, name: 'British Pound (GBP)' },
  EUR: { symbol: '€', rate: 0.0071, name: 'Euro (EUR)' },
  INR: { symbol: '₹', rate: 0.63, name: 'Indian Rupee (INR)' }
};

const FREE_SHIPPING_THRESHOLD_NPR = 20000;

// State management
const PrasunaState = {
  currency: localStorage.getItem('prasuna_currency') || 'NPR',
  cart: JSON.parse(localStorage.getItem('prasuna_cart')) || [
    {
      id: 'gulabi-set',
      name: 'Gulabi Embroidered Front-Slit Set',
      color: 'Olive Antique Gold',
      size: 'S',
      price_npr: 14500,
      image: 'assets/images/hero_festive.jpg',
      qty: 1
    }
  ],
  discountCode: localStorage.getItem('prasuna_promo') || null,
  discountPercent: 10
};

// Formatting helpers
function formatMoney(amountNpr) {
  const curr = EXCHANGE_RATES[PrasunaState.currency] || EXCHANGE_RATES.NPR;
  const converted = amountNpr * curr.rate;
  if (PrasunaState.currency === 'NPR' || PrasunaState.currency === 'INR') {
    return curr.symbol + Math.round(converted).toLocaleString();
  }
  return curr.symbol + converted.toFixed(2);
}

// Update all prices on DOM
function refreshDOMPrices() {
  document.querySelectorAll('[data-price-npr]').forEach(el => {
    const npr = parseFloat(el.getAttribute('data-price-npr'));
    if (!isNaN(npr)) {
      el.textContent = formatMoney(npr);
    }
  });

  const currTrigger = document.getElementById('current-currency-label');
  if (currTrigger) {
    currTrigger.textContent = PrasunaState.currency;
  }
  updateMobileCurrencyUI();
}

function updateMobileCurrencyUI() {
  document.querySelectorAll('.mobile-curr-pill').forEach(btn => {
    if (btn.getAttribute('data-curr') === PrasunaState.currency) {
      btn.classList.add('active');
    } else {
      btn.classList.remove('active');
    }
  });
}

// Set active currency
function setCurrency(currCode) {
  if (EXCHANGE_RATES[currCode]) {
    PrasunaState.currency = currCode;
    localStorage.setItem('prasuna_currency', currCode);
    refreshDOMPrices();
    renderCart();
    showToast(`Currency changed to ${EXCHANGE_RATES[currCode].name}`);
  }
  const menu = document.getElementById('currency-dropdown-menu');
  if (menu) menu.classList.remove('show');
}

// Cart Drawer open/close
function openCartDrawer() {
  const drawer = document.getElementById('cart-drawer');
  const backdrop = document.getElementById('cart-backdrop');
  if (drawer && backdrop) {
    drawer.classList.add('active');
    backdrop.classList.add('active');
    document.body.style.overflow = 'hidden';
    renderCart();
  }
}

function closeCartDrawer() {
  const drawer = document.getElementById('cart-drawer');
  const backdrop = document.getElementById('cart-backdrop');
  if (drawer && backdrop) {
    drawer.classList.remove('active');
    backdrop.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// Add to Cart
function addToCart(product) {
  const existingIndex = PrasunaState.cart.findIndex(
    item => item.id === product.id && item.size === product.size && item.color === product.color
  );

  if (existingIndex > -1) {
    PrasunaState.cart[existingIndex].qty += (product.qty || 1);
  } else {
    PrasunaState.cart.push({
      id: product.id,
      name: product.name,
      color: product.color || 'Default',
      size: product.size || 'S',
      price_npr: product.price_npr,
      image: product.image,
      qty: product.qty || 1
    });
  }

  saveCart();
  renderCart();
  openCartDrawer();
  showToast(`Added "${product.name}" to your bag ✨`);
}

function updateCartQty(index, delta) {
  if (PrasunaState.cart[index]) {
    PrasunaState.cart[index].qty += delta;
    if (PrasunaState.cart[index].qty <= 0) {
      PrasunaState.cart.splice(index, 1);
    }
    saveCart();
    renderCart();
  }
}

function removeCartItem(index) {
  if (PrasunaState.cart[index]) {
    const removedName = PrasunaState.cart[index].name;
    PrasunaState.cart.splice(index, 1);
    saveCart();
    renderCart();
    showToast(`Removed "${removedName}" from bag`);
  }
}

function saveCart() {
  localStorage.setItem('prasuna_cart', JSON.stringify(PrasunaState.cart));
  updateCartBadge();
}

function updateCartBadge() {
  const count = PrasunaState.cart.reduce((sum, item) => sum + item.qty, 0);
  document.querySelectorAll('.cart-count-badge').forEach(el => {
    el.textContent = count;
    el.style.display = count > 0 ? 'flex' : 'none';
  });
}

// Render Cart Drawer
function renderCart() {
  const container = document.getElementById('cart-items-container');
  const subtotalEl = document.getElementById('cart-subtotal-val');
  const progressFill = document.getElementById('shipping-progress-fill');
  const progressText = document.getElementById('shipping-progress-text');

  if (!container) return;

  const clearBtn = document.getElementById('cart-clear-btn');
  if (clearBtn) {
    clearBtn.style.display = PrasunaState.cart.length > 0 ? 'inline-block' : 'none';
  }

  if (PrasunaState.cart.length === 0) {
    container.innerHTML = `
      <div class="empty-cart-view">
        <div class="empty-cart-icon">🌸</div>
        <h3 class="font-serif" style="margin-bottom:8px;">Your Bag is Empty</h3>
        <p style="font-size:0.86rem; margin-bottom: 24px;">Discover our handcrafted limited drops.</p>
        <button class="btn btn-primary btn-sm" onclick="closeCartDrawer(); window.location.href='?page=shop';">Explore Drop 08</button>
      </div>
    `;
    if (subtotalEl) subtotalEl.textContent = formatMoney(0);
    if (progressFill) progressFill.style.width = '0%';
    if (progressText) progressText.innerHTML = `Add <strong>${formatMoney(FREE_SHIPPING_THRESHOLD_NPR)}</strong> for Free Worldwide Express Shipping!`;
    return;
  }

  let subtotalNpr = 0;
  let itemsHtml = '';

  PrasunaState.cart.forEach((item, index) => {
    const lineTotalNpr = item.price_npr * item.qty;
    subtotalNpr += lineTotalNpr;

    itemsHtml += `
      <div class="cart-item">
        <img src="${item.image}" alt="${item.name}" class="cart-item-img">
        <div class="cart-item-details">
          <div>
            <h4 class="cart-item-title">${item.name}</h4>
            <div class="cart-item-variant">${item.color} • Size ${item.size}</div>
          </div>
          <div class="cart-item-controls">
            <div class="qty-stepper">
              <button class="qty-btn" onclick="updateCartQty(${index}, -1)" aria-label="Decrease quantity">−</button>
              <span class="qty-val">${item.qty}</span>
              <button class="qty-btn" onclick="updateCartQty(${index}, 1)" aria-label="Increase quantity">+</button>
            </div>
            <div style="text-align: right;">
              <div class="cart-item-price">${formatMoney(lineTotalNpr)}</div>
              <span class="remove-btn" onclick="removeCartItem(${index})">Remove</span>
            </div>
          </div>
        </div>
      </div>
    `;
  });

  container.innerHTML = itemsHtml;
  if (subtotalEl) subtotalEl.textContent = formatMoney(subtotalNpr);

  // Free shipping calculation
  const remainingForFreeShipping = Math.max(0, FREE_SHIPPING_THRESHOLD_NPR - subtotalNpr);
  const percentage = Math.min(100, Math.round((subtotalNpr / FREE_SHIPPING_THRESHOLD_NPR) * 100));

  if (progressFill) progressFill.style.width = `${percentage}%`;
  if (progressText) {
    if (remainingForFreeShipping === 0) {
      progressText.innerHTML = `🎉 <strong>Congratulations!</strong> You unlocked <em>Free Worldwide Express Shipping</em>!`;
    } else {
      progressText.innerHTML = `Add <strong>${formatMoney(remainingForFreeShipping)}</strong> more for Free Worldwide Express Shipping!`;
    }
  }
}

// Clear all items from cart
function clearCart() {
  if (!PrasunaState.cart || PrasunaState.cart.length === 0) return;
  if (confirm("Remove all silhouettes from your shopping bag?")) {
    PrasunaState.cart = [];
    saveCart();
    renderCart();
    updateCartBadges();
    showToast("Shopping bag cleared");
  }
}

// Toast notification
function showToast(message) {
  let container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.innerHTML = `<span>🌸</span> <span>${message}</span>`;
  container.appendChild(toast);

  setTimeout(() => {
    if (toast.parentNode) {
      toast.parentNode.removeChild(toast);
    }
  }, 3200);
}

// Live Countdown Timer for Drops
function startCountdown() {
  const timerElements = {
    days: document.getElementById('timer-days'),
    hours: document.getElementById('timer-hours'),
    minutes: document.getElementById('timer-minutes'),
    seconds: document.getElementById('timer-seconds')
  };

  if (!timerElements.days) return;

  // Target: 2 days, 14 hours, 35 minutes from now (dynamic drop window)
  const targetDate = new Date();
  targetDate.setDate(targetDate.getDate() + 2);
  targetDate.setHours(targetDate.getHours() + 14);
  targetDate.setMinutes(targetDate.getMinutes() + 35);

  function update() {
    const now = new Date();
    const diff = targetDate - now;

    if (diff <= 0) {
      timerElements.days.textContent = '00';
      timerElements.hours.textContent = '00';
      timerElements.minutes.textContent = '00';
      timerElements.seconds.textContent = '00';
      return;
    }

    const d = Math.floor(diff / (1000 * 60 * 60 * 24));
    const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
    const m = Math.floor((diff / (1000 * 60)) % 60);
    const s = Math.floor((diff / 1000) % 60);

    timerElements.days.textContent = String(d).padStart(2, '0');
    timerElements.hours.textContent = String(h).padStart(2, '0');
    timerElements.minutes.textContent = String(m).padStart(2, '0');
    timerElements.seconds.textContent = String(s).padStart(2, '0');
  }

  update();
  setInterval(update, 1000);
}

// Story Highlights Viewer Modal
const STORIES_DATA = {
  suhani: {
    title: '✨ SUHANI SET ✨',
    tagline: 'Pure Mul Cotton with Applique & Bead Work',
    image: 'assets/images/suhani_corset_back.jpg',
    videoNote: '🎵 Mohit Chauhan • Bheegi Si Bhaagi Si',
    desc: 'If you ask me what is so special about this piece: we used pure mul cotton with applique and bead work. Flared bell sleeves & artisanal criss-cross corset tie-up back.'
  },
  saya: {
    title: '✨ SAYA MUL COTTON ✨',
    tagline: 'Breathable Festive Corset & Tiered Sharara',
    image: 'assets/images/saya_mul_cotton.jpg',
    videoNote: '🎵 Abhijeet • Mere Khayalon Ki Malika',
    desc: 'Made from mul cotton, this kurti is soft, lightweight and breathable. The corset-inspired fit hugs the body beautifully, paired with a flowy sharara for the Dashain weather 🌻'
  },
  zoya: {
    title: '✨ ZOYA HANDLOOM ✨',
    tagline: 'Marigold Sunset Traditional Weave',
    image: 'assets/images/zoya_handloom.jpg',
    videoNote: '🎵 Handloom Weave • Kathmandu Valley',
    desc: 'Sleeveless longline tunic woven on Nepali wooden looms with high side slits, cinch sash belt, and crisp white cigarette pants.'
  },
  loves: {
    title: '✨ LOVES • CARE LETTER ✨',
    tagline: 'Hey love, Before you open this package...',
    image: 'assets/images/packaging_unboxing.jpg',
    videoNote: '🎵 Nika Jane • Pretty Little Things',
    desc: 'Your piece is made with soft fabrics and lots of love, so please treat it gently. Always hand wash in cold water separately, dry in shade. With love, प्रसूना 🌸'
  },
  gulabi: {
    title: '✨ GULABI ✨',
    tagline: 'Hand-embroidered Raw Silk in Olive Gold & Dusty Rose',
    image: 'assets/images/hero_festive.jpg',
    videoNote: '🎵 Ritviz • Saawariya',
    desc: 'Our iconic sweetheart camisole slit set, hand-embroidered with micro-sequins and bullion gold zardozi.'
  },
  noor: {
    title: '✨ NOOR ✨',
    tagline: 'Festive Rani Fuchsia Kurti & Relaxed Pants',
    image: 'assets/images/noor_fuchsia.jpg',
    videoNote: '🎵 Patan Folk Fusion • Rani Pink',
    desc: 'Lightweight festive glamour tailored with fine Patan mirrorwork and resham thread embroidery.'
  },
  pooh: {
    title: '✨ POOH SET ✨',
    tagline: 'Sunshine Yellow Peplum & Lavender Shimmer',
    image: 'assets/images/pooh_yellow.jpg',
    videoNote: '🎵 Studio Kathmandu • Flared Dhoti',
    desc: 'Gathered by hand, effortless movement for day celebrations in festive marigold and shimmer lilac.'
  },
  atelier: {
    title: '✨ STORE UNFILTERED ✨',
    tagline: 'Inside our Kathmandu Workshop',
    image: 'assets/images/atelier_crafting.jpg',
    videoNote: '🎵 Fair wages • No repeat prints',
    desc: 'Where magic happens every day on Kartik drops. Master tailors creating heirlooms with heart.'
  }
};

function openStoryModal(key) {
  const story = STORIES_DATA[key];
  if (!story) return;

  const modal = document.getElementById('story-modal');
  const titleEl = document.getElementById('story-modal-title');
  const imgEl = document.getElementById('story-modal-img');
  const descEl = document.getElementById('story-modal-desc');
  const noteEl = document.getElementById('story-modal-note');

  if (modal && titleEl && imgEl) {
    titleEl.textContent = story.title;
    imgEl.src = story.image;
    if (descEl) descEl.textContent = story.desc;
    if (noteEl) noteEl.textContent = story.videoNote;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeStoryModal() {
  const modal = document.getElementById('story-modal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// Quick View Modal
function openQuickView(productData) {
  const modal = document.getElementById('quickview-modal');
  if (!modal) return;

  document.getElementById('qv-title').textContent = productData.name;
  document.getElementById('qv-nepali').textContent = productData.nepali_name || '';
  document.getElementById('qv-price').setAttribute('data-price-npr', productData.price_npr);
  document.getElementById('qv-price').textContent = formatMoney(productData.price_npr);
  document.getElementById('qv-desc').textContent = productData.description;
  document.getElementById('qv-img').src = productData.image;
  document.getElementById('qv-stock').textContent = `Only ${productData.remaining_stock} pieces remaining`;

  // Render sizes
  const sizesWrap = document.getElementById('qv-sizes');
  if (sizesWrap) {
    sizesWrap.innerHTML = productData.sizes.map((s, idx) => `
      <button class="size-pill ${idx === 0 ? 'active' : ''} ${s.includes('Custom') ? 'custom-pill' : ''}" 
              onclick="selectModalSize(this, '${s}')">${s}</button>
    `).join('');
  }

  // Setup Add button
  const addBtn = document.getElementById('qv-add-btn');
  if (addBtn) {
    addBtn.onclick = function() {
      const activeSizeEl = sizesWrap.querySelector('.size-pill.active');
      const chosenSize = activeSizeEl ? activeSizeEl.textContent.trim() : 'S';
      
      addToCart({
        id: productData.id,
        name: productData.name,
        color: productData.colors && productData.colors[0] ? productData.colors[0].name : 'Default',
        size: chosenSize,
        price_npr: productData.price_npr,
        image: productData.image,
        qty: 1
      });
      closeQuickView();
    };
  }

  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function selectModalSize(btn, size) {
  const parent = btn.parentElement;
  parent.querySelectorAll('.size-pill').forEach(el => el.classList.remove('active'));
  btn.classList.add('active');

  if (size.includes('Custom')) {
    openCustomMeasureModal();
  }
}

function closeQuickView() {
  const modal = document.getElementById('quickview-modal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// Size Guide Modal
function openSizeGuideModal() {
  const modal = document.getElementById('size-guide-modal');
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeSizeGuideModal() {
  const modal = document.getElementById('size-guide-modal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// Custom Tailoring Modal
function openCustomMeasureModal() {
  const modal = document.getElementById('custom-tailor-modal');
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeCustomMeasureModal() {
  const modal = document.getElementById('custom-tailor-modal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// VIP Waitlist form
function submitVipForm(e) {
  e.preventDefault();
  const input = e.target.querySelector('input');
  if (input && input.value) {
    showToast(`You're in! We will notify you 15 min before Drop 09 goes live 🌸`);
    input.value = '';
  }
}

// Category Tabs on Shop / Home
function filterCategory(category, btn) {
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add('active');

  document.querySelectorAll('.product-card').forEach(card => {
    const cardCat = card.getAttribute('data-category');
    if (category === 'All' || category === 'All Silhouettes' || cardCat === category) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

// Global DOM initialization
document.addEventListener('DOMContentLoaded', () => {
  refreshDOMPrices();
  updateCartBadge();
  startCountdown();
  initCandlelightTheme();
  initHeroCarousel();

  // Currency Dropdown Toggle
  const currBtn = document.getElementById('currency-toggle-btn');
  const currMenu = document.getElementById('currency-dropdown-menu');
  if (currBtn && currMenu) {
    currBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      currMenu.classList.toggle('show');
    });

    document.addEventListener('click', () => {
      currMenu.classList.remove('show');
    });
  }

  // Global Keyboard Shortcuts
  document.addEventListener('keydown', (e) => {
    // Esc closes drawers & modals
    if (e.key === 'Escape') {
      closeMobileNav();
      closeSearchDrawer();
      closeCartDrawer();
      closeQuickView();
      closeSizeGuideModal();
      closeCustomMeasureModal();
      closeStoryModal();
      closeAtelierFilmModal();
    }
    // "/" opens Search Drawer when not already typing
    if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
      e.preventDefault();
      openSearchDrawer();
    }
  });

  // Close modals on backdrop click
  document.querySelectorAll('.modal-backdrop, .drawer-backdrop, .search-backdrop').forEach(bd => {
    bd.addEventListener('click', (e) => {
      if (e.target === bd) {
        bd.classList.remove('active');
        document.querySelectorAll('.modal-card, .search-drawer, .cart-drawer, .mobile-nav-drawer').forEach(el => el.classList.remove('active'));
        document.body.style.overflow = '';
      }
    });
  });
});

/* ==========================================================================
   Candlelight / Evening View Luxury Theme Toggle
   ========================================================================== */
function initCandlelightTheme() {
  const currentTheme = localStorage.getItem('prasuna_theme') || 'daylight';
  applyThemeUI(currentTheme);
}

function applyThemeUI(theme) {
  const icon = document.getElementById('theme-toggle-icon');
  const mobIcon = document.getElementById('mobile-theme-icon');
  const mobLabel = document.getElementById('mobile-theme-label');
  
  if (theme === 'candlelight') {
    document.documentElement.setAttribute('data-theme', 'candlelight');
    if (icon) icon.textContent = '☀️';
    if (mobIcon) mobIcon.textContent = '☀️';
    if (mobLabel) mobLabel.textContent = 'Daylight View';
  } else {
    document.documentElement.removeAttribute('data-theme');
    if (icon) icon.textContent = '🕯️';
    if (mobIcon) mobIcon.textContent = '🕯️';
    if (mobLabel) mobLabel.textContent = 'Candlelight View';
  }
}

function toggleCandlelightTheme() {
  const isCandlelight = document.documentElement.getAttribute('data-theme') === 'candlelight';
  const newTheme = isCandlelight ? 'daylight' : 'candlelight';
  
  localStorage.setItem('prasuna_theme', newTheme);
  applyThemeUI(newTheme);
  
  if (newTheme === 'candlelight') {
    showToast('Entered Candlelight Evening View 🕯️');
  } else {
    showToast('Switched to Daylight View ☀️');
  }
}

/* ==========================================================================
   Predictive Live Search Engine
   ========================================================================== */
function openSearchDrawer() {
  const drawer = document.getElementById('search-drawer');
  const backdrop = document.getElementById('search-backdrop');
  const input = document.getElementById('live-search-input');
  
  if (drawer && backdrop) {
    drawer.classList.add('active');
    backdrop.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    if (input) {
      setTimeout(() => input.focus(), 150);
      if (!input.value.trim()) {
        renderSearchCatalog(window.PRASUNA_CATALOG || [], 'Popular Heirlooms & Drop 08 Silhouettes:');
      }
    }
  }
}

function closeSearchDrawer() {
  const drawer = document.getElementById('search-drawer');
  const backdrop = document.getElementById('search-backdrop');
  if (drawer && backdrop) {
    drawer.classList.remove('active');
    backdrop.classList.remove('active');
    document.body.style.overflow = '';
  }
}

function clearLiveSearch() {
  const input = document.getElementById('live-search-input');
  const clearBtn = document.getElementById('search-clear-btn');
  if (input) {
    input.value = '';
    input.focus();
  }
  if (clearBtn) clearBtn.classList.remove('visible');
  renderSearchCatalog(window.PRASUNA_CATALOG || [], 'Popular Heirlooms & Drop 08 Silhouettes:');
}

function searchForTrending(keyword) {
  const input = document.getElementById('live-search-input');
  if (input) {
    input.value = keyword;
    handleLiveSearchInput(keyword);
    input.focus();
  }
}

function handleLiveSearchInput(query) {
  const clearBtn = document.getElementById('search-clear-btn');
  const trimmed = query.trim().toLowerCase();
  
  if (clearBtn) {
    if (trimmed) {
      clearBtn.classList.add('visible');
    } else {
      clearBtn.classList.remove('visible');
    }
  }

  const catalog = window.PRASUNA_CATALOG || [];
  if (!trimmed) {
    renderSearchCatalog(catalog, 'Popular Heirlooms & Drop 08 Silhouettes:');
    return;
  }

  const matches = catalog.filter(p => {
    return (
      (p.name && p.name.toLowerCase().includes(trimmed)) ||
      (p.nepali_name && p.nepali_name.toLowerCase().includes(trimmed)) ||
      (p.category && p.category.toLowerCase().includes(trimmed)) ||
      (p.description && p.description.toLowerCase().includes(trimmed)) ||
      (p.fabric && p.fabric.toLowerCase().includes(trimmed))
    );
  });

  const statusText = matches.length > 0 
    ? `Found ${matches.length} matching silhouette${matches.length > 1 ? 's' : ''} for "${query}":`
    : `No silhouettes found matching "${query}". Try searching "Mul Cotton", "Sharara", or "Zardozi".`;

  renderSearchCatalog(matches, statusText);
}

function renderSearchCatalog(items, statusText) {
  const grid = document.getElementById('search-results-grid');
  const status = document.getElementById('search-results-status');
  if (!grid || !status) return;

  status.textContent = statusText;
  grid.innerHTML = '';

  if (items.length === 0) {
    grid.innerHTML = `
      <div style="grid-column: 1 / -1; padding: 32px 0; text-align: center; color: var(--color-muted);">
        <div style="font-size: 2rem; margin-bottom: 8px;">🌸</div>
        <div style="font-weight: 600; font-size: 1rem; color: var(--color-charcoal); margin-bottom: 4px;">
          No matching archive pieces found
        </div>
        <p style="font-size: 0.85rem; max-width: 420px; margin: 0 auto 18px;">
          All our silhouettes are limited slow-fashion creations. Browse the full Festive Edit to find your perfect fit.
        </p>
        <a href="?page=shop" class="btn btn-secondary btn-sm" onclick="closeSearchDrawer()">
          Explore Full Collection &rarr;
        </a>
      </div>
    `;
    return;
  }

  items.forEach(prod => {
    const card = document.createElement('a');
    card.href = `?page=product&id=${encodeURIComponent(prod.id)}`;
    card.className = 'search-result-card';
    card.onclick = () => { closeMobileNav(); closeSearchDrawer(); };

    card.innerHTML = `
      <div class="search-thumb">
        <img src="${prod.image}" alt="${prod.name}" loading="lazy">
      </div>
      <div class="search-info">
        <span class="search-category-badge">${prod.category || 'Silhouettes'}</span>
        <h4 class="search-title">${prod.name}</h4>
        ${prod.nepali_name ? `<span style="font-family:var(--font-nepali); font-size:0.75rem; color:var(--color-muted);">${prod.nepali_name}</span>` : ''}
        <span class="search-price" data-price-npr="${prod.price_npr}">
          ${formatMoney(prod.price_npr)}
        </span>
      </div>
    `;
    grid.appendChild(card);
  });
}

/* ==========================================================================
   Editorial Hero Multi-Look Carousel & Hotspot System
   ========================================================================== */
const HERO_LOOKS = [
  {
    badge: 'Look 01 • Iconic Fit',
    image: 'assets/images/hero_festive.jpg',
    video: 'assets/videos/hero_runway_walk.mp4',
    title: 'Gulabi Front-Slit Set',
    meta: 'Olive Gold Raw Silk • Pure Zardozi',
    productId: 'gulabi-set',
    priceNpr: 14500,
    swatch: 'assets/images/gulabi_rose.jpg',
    fabricTitle: 'Mulberry Raw Silk',
    fabricSpecs: '18 Hrs Hand Zardozi',
    fabricDna: '100% natural mulberry raw silk with zero synthetic blending. Hand-loomed on traditional wooden looms in Patan, Kathmandu.',
    threadCount: '320 TPI',
    naturalDye: 'Mineral Gold',
    weight: '160 GSM',
    topTitle: 'Sweetheart Raw Silk Camisole',
    topPrice: 'Rs. 8,500',
    topPriceNpr: 8500,
    topDesc: 'Pure zardozi hand-embroidered bustier',
    bottomTitle: 'Flowing Pure Silk Palazzo',
    bottomPrice: 'Rs. 6,000',
    bottomPriceNpr: 6000,
    bottomDesc: 'High-waisted fluid tailoring',
    sideTitle: 'Resham & Zari Slit Accent',
    sidePrice: 'Artisanal Detail',
    sideDesc: 'Scalloped hand-finished edge'
  },
  {
    badge: 'Look 02 • Mul Cotton Special',
    image: 'assets/images/suhani_lilac.jpg',
    video: 'assets/videos/hero_sunflower_walk.mp4',
    title: 'Suhani Applique & Bell-Sleeve Set',
    meta: 'Pure Mul Cotton • Corset Lace-Up Back',
    productId: 'suhani-corset-set',
    priceNpr: 11800,
    swatch: 'assets/images/suhani_corset_back.jpg',
    fabricTitle: 'Mul Cotton & Organza',
    fabricSpecs: 'Hand Applique & Flared Sleeves',
    fabricDna: 'Featherlight pure mul cotton with organza flared bell sleeves and criss-cross corset back ties for an adjustable made-to-measure fit.',
    threadCount: '280 TPI',
    naturalDye: 'Blush Lilac Tint',
    weight: '90 GSM',
    topTitle: 'Flared Bell-Sleeve Mul Tunic',
    topPrice: 'Rs. 7,200',
    topPriceNpr: 7200,
    topDesc: 'Artisanal applique & glass beadwork',
    bottomTitle: 'Breezy Blossom Pink Trousers',
    bottomPrice: 'Rs. 4,600',
    bottomPriceNpr: 4600,
    bottomDesc: 'Straight cut with elasticated comfort waist',
    sideTitle: 'Lace-Up Corset Back',
    sidePrice: 'Custom Fit',
    sideDesc: 'Adjusts up to 2 inches to your body'
  },
  {
    badge: 'Look 03 • Dashain Heirloom',
    image: 'assets/images/saya_mul_cotton.jpg',
    video: 'assets/videos/hero_runway_walk.mp4',
    title: 'Saya Corset & Tiered Sharara',
    meta: 'Pintuck Mul Cotton • Billowing Tiered Sharara',
    productId: 'saya-mul-cotton',
    priceNpr: 13200,
    swatch: 'assets/images/saya_mul_cotton.jpg',
    fabricTitle: 'Pintuck Mul Cotton',
    fabricSpecs: 'Voluminous Tiered Sharara',
    fabricDna: 'Multiple tiers of gathered mul cotton requiring 6.5 meters of fabric per set for fluid cinematic movement during festive dances.',
    threadCount: '300 TPI',
    naturalDye: 'Ivory & Saffron',
    weight: '110 GSM',
    topTitle: 'Mul Cotton Corset Bodice',
    topPrice: 'Rs. 7,500',
    topPriceNpr: 7500,
    topDesc: 'Hand-pleated structure with soft lining',
    bottomTitle: 'Tiered Voluminous Sharara',
    bottomPrice: 'Rs. 5,700',
    bottomPriceNpr: 5700,
    bottomDesc: 'Double-flared hem for festive sway',
    sideTitle: 'Gold Gota Border',
    sidePrice: 'Hand Stitched',
    sideDesc: 'Delicate metallic ribbon trim'
  }
];

let currentHeroIndex = 0;
let heroAutoTimer = null;
let heroProgressStep = 0;
const HERO_DURATION_MS = 6000;
const HERO_TICK_MS = 100;

function initHeroCarousel() {
  const showcase = document.getElementById('hero-showcase-wrap');
  if (!showcase) return;

  startHeroProgress();

  // Pause carousel progress on hover
  showcase.addEventListener('mouseenter', () => {
    pauseHeroProgress();
  });

  // Resume carousel progress on mouse leave
  showcase.addEventListener('mouseleave', () => {
    resumeHeroProgress();
  });
}

function startHeroProgress() {
  clearInterval(heroAutoTimer);
  heroProgressStep = 0;
  
  heroAutoTimer = setInterval(() => {
    heroProgressStep += (HERO_TICK_MS / HERO_DURATION_MS) * 100;
    const bar = document.getElementById('hero-progress-bar');
    if (bar) bar.style.width = `${Math.min(heroProgressStep, 100)}%`;

    if (heroProgressStep >= 100) {
      nextHeroLook(false);
    }
  }, HERO_TICK_MS);
}

function pauseHeroProgress() {
  clearInterval(heroAutoTimer);
}

function resumeHeroProgress() {
  startHeroProgress();
}

function prevHeroLook() {
  let prevIdx = currentHeroIndex - 1;
  if (prevIdx < 0) prevIdx = HERO_LOOKS.length - 1;
  switchHeroLook(prevIdx);
}

function nextHeroLook(manual = true) {
  let nextIdx = (currentHeroIndex + 1) % HERO_LOOKS.length;
  switchHeroLook(nextIdx);
}

function switchHeroLook(index, btn = null) {
  const look = HERO_LOOKS[index];
  if (!look) return;

  currentHeroIndex = index;
  heroProgressStep = 0;
  const bar = document.getElementById('hero-progress-bar');
  if (bar) bar.style.width = '0%';

  // Update Buttons
  document.querySelectorAll('.hero-look-btn').forEach((b, idx) => {
    if (idx === index) {
      b.classList.add('active');
    } else {
      b.classList.remove('active');
    }
  });

  // Update Counter
  const lookNum = document.getElementById('hero-look-num');
  if (lookNum) lookNum.textContent = `0${index + 1}`;

  // Update Hero Image with fade transition
  const img = document.getElementById('hero-slide-img');
  if (img) {
    img.style.opacity = '0';
    setTimeout(() => {
      img.src = look.image;
      img.style.opacity = '1';
    }, 180);
  }

  // Update Floating Card & Badge
  const badge = document.getElementById('hero-badge');
  if (badge) badge.textContent = look.badge;

  const cardTitle = document.getElementById('hero-card-title');
  if (cardTitle) cardTitle.textContent = look.title;

  const cardMeta = document.getElementById('hero-card-meta');
  if (cardMeta) cardMeta.textContent = look.meta;

  const cardBtn = document.getElementById('hero-card-btn');
  if (cardBtn) {
    cardBtn.onclick = function() {
      addToCart({
        id: look.productId,
        name: look.title,
        color: 'Default',
        size: 'S',
        price_npr: look.priceNpr,
        image: look.image,
        qty: 1
      });
    };
  }

  // Update Fabric Inspector
  const swatchImg = document.getElementById('fabric-swatch-img');
  if (swatchImg && look.swatch) swatchImg.src = look.swatch;

  const fabricTitle = document.getElementById('fabric-title');
  if (fabricTitle) fabricTitle.textContent = look.fabricTitle;

  const fabricSpecs = document.getElementById('fabric-specs');
  if (fabricSpecs) fabricSpecs.textContent = look.fabricSpecs;

  const fabricDna = document.getElementById('fabric-dna-desc');
  if (fabricDna) fabricDna.textContent = look.fabricDna;

  const threadCount = document.getElementById('fabric-thread-count');
  if (threadCount) threadCount.textContent = look.threadCount;

  const dye = document.getElementById('fabric-dye');
  if (dye) dye.textContent = look.naturalDye;

  const weight = document.getElementById('fabric-weight');
  if (weight) weight.textContent = look.weight;

  // Update Hotspot Pins Data
  const topTitle = document.getElementById('hotspot-top-title');
  if (topTitle) topTitle.textContent = look.topTitle;

  const topPrice = document.getElementById('hotspot-top-price');
  if (topPrice) topPrice.textContent = formatMoney(look.topPriceNpr);

  const topDesc = document.getElementById('hotspot-top-desc');
  if (topDesc) topDesc.textContent = look.topDesc;

  const bottomTitle = document.getElementById('hotspot-bottom-title');
  if (bottomTitle) bottomTitle.textContent = look.bottomTitle;

  const bottomPrice = document.getElementById('hotspot-bottom-price');
  if (bottomPrice) bottomPrice.textContent = formatMoney(look.bottomPriceNpr);

  const bottomDesc = document.getElementById('hotspot-bottom-desc');
  if (bottomDesc) bottomDesc.textContent = look.bottomDesc;

  const sideTitle = document.getElementById('hotspot-side-title');
  if (sideTitle) sideTitle.textContent = look.sideTitle;

  const sidePrice = document.getElementById('hotspot-side-price');
  if (sidePrice) sidePrice.textContent = look.sidePrice;

  // Reset any open modals/popovers
  document.querySelectorAll('.hotspot-pin').forEach(p => p.classList.remove('active'));
  const fabricModal = document.getElementById('fabric-detail-modal');
  if (fabricModal) fabricModal.classList.remove('show');
}

// Hotspot Pin Mobile/Click Toggle
function toggleHotspotPin(pin, event) {
  event.stopPropagation();
  const isActive = pin.classList.contains('active');
  document.querySelectorAll('.hotspot-pin').forEach(p => p.classList.remove('active'));
  if (!isActive) {
    pin.classList.add('active');
  }
}

// 1-Click Hotspot Piece Quick Add
function addHotspotPieceToBag(pieceType, event) {
  event.stopPropagation();
  const look = HERO_LOOKS[currentHeroIndex];
  if (!look) return;

  const pieceName = pieceType === 'top' ? look.topTitle : look.bottomTitle;
  const piecePrice = pieceType === 'top' ? look.topPriceNpr : look.bottomPriceNpr;

  addToCart({
    id: `${look.productId}-${pieceType}`,
    name: `${pieceName} (${look.title})`,
    color: 'Default',
    size: 'S',
    price_npr: piecePrice,
    image: look.image,
    qty: 1
  });
}

// Fabric & Touch Inspector Popover
function toggleFabricDetails(event) {
  event.stopPropagation();
  const modal = document.getElementById('fabric-detail-modal');
  if (modal) {
    modal.classList.toggle('show');
  }
}

// Global click closes fabric modal and hotspots
document.addEventListener('click', () => {
  const fabricModal = document.getElementById('fabric-detail-modal');
  if (fabricModal) fabricModal.classList.remove('show');
  document.querySelectorAll('.hotspot-pin').forEach(p => p.classList.remove('active'));
});

// Atelier Film Modal
function openAtelierFilmModal() {
  const modal = document.getElementById('atelier-film-modal');
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    const video = document.getElementById('atelier-modal-video');
    if (video) {
      video.currentTime = 0;
      video.play().catch(() => {});
    }
  }
}

function closeAtelierFilmModal() {
  const modal = document.getElementById('atelier-film-modal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
    const video = document.getElementById('atelier-modal-video');
    if (video) {
      video.pause();
    }
  }
}


/* Mobile Navigation Drawer Handlers */
function toggleMobileNav() {
  const drawer = document.getElementById('mobile-nav-drawer');
  const backdrop = document.getElementById('mobile-nav-backdrop');
  if (drawer && backdrop) {
    const willOpen = !drawer.classList.contains('active');
    drawer.classList.toggle('active', willOpen);
    backdrop.classList.toggle('active', willOpen);
    document.body.style.overflow = willOpen ? 'hidden' : '';
  }
}

function closeMobileNav() {
  const drawer = document.getElementById('mobile-nav-drawer');
  const backdrop = document.getElementById('mobile-nav-backdrop');
  if (drawer && backdrop) {
    drawer.classList.remove('active');
    backdrop.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// Keep navbar fixed and elevated on scroll down
window.addEventListener('scroll', () => {
  const header = document.querySelector('.site-header');
  if (header) {
    if (window.scrollY > 8) {
      header.classList.add('is-scrolled');
    } else {
      header.classList.remove('is-scrolled');
    }
  }
}, { passive: true });

// Story Marquee pause on mobile touch
document.addEventListener('DOMContentLoaded', () => {
  const marqueeWrap = document.getElementById('stories-marquee-wrap');
  if (marqueeWrap) {
    const track = marqueeWrap.querySelector('.stories-marquee-track');
    if (track) {
      marqueeWrap.addEventListener('touchstart', () => {
        track.style.animationPlayState = 'paused';
      }, { passive: true });
      marqueeWrap.addEventListener('touchend', () => {
        track.style.animationPlayState = 'running';
      }, { passive: true });
    }
  }
});