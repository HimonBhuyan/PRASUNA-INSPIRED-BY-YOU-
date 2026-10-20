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

  // Close modals on backdrop click
  document.querySelectorAll('.modal-backdrop').forEach(bd => {
    bd.addEventListener('click', (e) => {
      if (e.target === bd) {
        bd.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  });
});
