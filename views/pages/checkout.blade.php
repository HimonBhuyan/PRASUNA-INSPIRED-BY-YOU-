@extends('layouts.app')

@section('content')

<div class="container checkout-container">
  
  <!-- Breadcrumbs -->
  <nav class="breadcrumb-nav">
    <a href="?page=home">Home</a> &nbsp;/&nbsp; 
    <a href="?page=shop">Silhouettes</a> &nbsp;/&nbsp; 
    <span>Express Checkout</span>
  </nav>

  <div id="checkout-view-container">
    
    <div class="checkout-header-block">
      <span class="section-tag">Secure Himalayan Dispatch</span>
      <h1 class="checkout-main-title font-serif">Express Checkout</h1>
    </div>

    <div class="checkout-grid">
      
      <!-- Checkout Form Column -->
      <form id="order-checkout-form" onsubmit="processOrder(event)">
        
        <!-- Step 1: Customer Info -->
        <div class="checkout-card">
          <h2 class="checkout-card-title">
            <span>1. Contact & Recipient</span>
          </h2>

          <div class="checkout-form-row">
            <div class="checkout-form-group">
              <label class="checkout-label">First Name *</label>
              <input type="text" required placeholder="e.g. Alisha" class="checkout-input">
            </div>
            <div class="checkout-form-group">
              <label class="checkout-label">Last Name *</label>
              <input type="text" required placeholder="e.g. Shrestha" class="checkout-input">
            </div>
          </div>

          <div class="checkout-form-row">
            <div class="checkout-form-group">
              <label class="checkout-label">Email Address *</label>
              <input type="email" required placeholder="alisha@example.com" class="checkout-input">
            </div>
            <div class="checkout-form-group">
              <label class="checkout-label">Phone / WhatsApp *</label>
              <input type="tel" required placeholder="+977 98..." class="checkout-input">
            </div>
          </div>
        </div>

        <!-- Step 2: Shipping Destination -->
        <div class="checkout-card">
          <h2 class="checkout-card-title">
            2. Delivery Destination
          </h2>

          <div style="margin-bottom:16px;">
            <label class="checkout-label">Country / Region *</label>
            <select id="checkout-country" onchange="updateShippingMethod(this.value)" class="checkout-select">
              <option value="NP">Nepal (Local Delivery)</option>
              <option value="US">United States (Worldwide Express)</option>
              <option value="AU">Australia (Worldwide Express)</option>
              <option value="UK">United Kingdom (Worldwide Express)</option>
              <option value="CA">Canada (Worldwide Express)</option>
              <option value="IN">India (Cross-Border Express)</option>
              <option value="OTHER">Other International Destination</option>
            </select>
          </div>

          <div style="margin-bottom:16px;">
            <label class="checkout-label">Street Address & Landmark *</label>
            <input type="text" required placeholder="House / Apartment, Street, Ward No." class="checkout-input">
          </div>

          <div class="checkout-form-row">
            <div class="checkout-form-group">
              <label class="checkout-label">City / Town *</label>
              <input type="text" required placeholder="Kathmandu, Lalitpur, Pokhara, New York..." class="checkout-input">
            </div>
            <div class="checkout-form-group">
              <label class="checkout-label">Postal / Zip Code</label>
              <input type="text" placeholder="e.g. 44600" class="checkout-input">
            </div>
          </div>
        </div>

        <!-- Step 3: Payment Method -->
        <div class="checkout-card" style="margin-bottom:28px;">
          <h2 class="checkout-card-title">
            3. Payment Method
          </h2>

          <div class="checkout-payment-methods">
            
            <label class="checkout-payment-option">
              <input type="radio" name="payment_method" value="khalti" checked>
              <div class="checkout-payment-info">
                <div class="checkout-payment-title">Khalti Digital Wallet</div>
                <div class="checkout-payment-desc">Instant payment via Khalti app or e-Banking</div>
              </div>
              <span class="payment-pill" style="background:#5D2E8E; color:#fff;">Khalti</span>
            </label>

            <label class="checkout-payment-option">
              <input type="radio" name="payment_method" value="esewa">
              <div class="checkout-payment-info">
                <div class="checkout-payment-title">eSewa Mobile Wallet</div>
                <div class="checkout-payment-desc">Pay securely using your eSewa account</div>
              </div>
              <span class="payment-pill" style="background:#60BB46; color:#fff;">eSewa</span>
            </label>

            <label class="checkout-payment-option">
              <input type="radio" name="payment_method" value="card">
              <div class="checkout-payment-info">
                <div class="checkout-payment-title">Credit / Debit Card (Worldwide)</div>
                <div class="checkout-payment-desc">Visa, MasterCard, American Express, Apple Pay</div>
              </div>
              <span class="payment-pill" style="background:#1A1F71; color:#fff;">Visa / MC</span>
            </label>

            <label class="checkout-payment-option">
              <input type="radio" name="payment_method" value="cod">
              <div class="checkout-payment-info">
                <div class="checkout-payment-title">Cash on Delivery (Kathmandu Valley)</div>
                <div class="checkout-payment-desc">Pay with cash or QR scan upon receiving parcel</div>
              </div>
              <span class="payment-pill" style="background:var(--color-charcoal); color:#fff;">COD</span>
            </label>

          </div>
        </div>

        <button type="submit" class="btn btn-crimson checkout-submit-btn" id="checkout-submit-btn">
          Place Order & Reserve Drop
        </button>

      </form>

      <!-- Right Column: Order Summary -->
      <div class="checkout-summary-card">
        <h2 class="checkout-summary-title">
          Order Summary (<span id="checkout-item-count">0</span> items)
        </h2>

        <!-- Items preview -->
        <div id="checkout-items-list" class="checkout-items-list">
          <!-- Injected via JavaScript -->
        </div>

        <!-- Voucher Code Input -->
        <div class="checkout-promo-row">
          <input type="text" id="promo-code-input" placeholder="Promo code (try PRASUNA10)" class="checkout-promo-input">
          <button type="button" class="btn btn-secondary btn-sm" onclick="applyPromoCode()">Apply</button>
        </div>

        <!-- Calculations -->
        <div class="checkout-calc-block">
          <div class="checkout-calc-row">
            <span style="color:var(--color-muted);">Subtotal</span>
            <span id="co-subtotal" style="font-weight:600;">Rs. 0</span>
          </div>

          <div class="checkout-calc-row" id="co-discount-row">
            <span style="color:var(--color-emerald); font-weight:600;">Drop Promo (10% Off)</span>
            <span id="co-discount" style="color:var(--color-emerald); font-weight:600;">-Rs. 0</span>
          </div>

          <div class="checkout-calc-row">
            <span style="color:var(--color-muted);">Shipping</span>
            <span id="co-shipping" style="font-weight:600; color:var(--color-emerald);">FREE (Worldwide)</span>
          </div>

          <div class="checkout-total-row">
            <span>Total Payable</span>
            <span id="co-total">Rs. 0</span>
          </div>
        </div>

        <!-- Packaging reassurance -->
        <div class="checkout-keepsake-badge">
          💌 <strong>Complimentary Keepsake Gift Box:</strong> Sealed with dried botanical sprigs, brass wax stamp, and a handwritten card.
        </div>
      </div>

    </div>

  </div>

  <!-- Order Success Screen (Hidden by default) -->
  <div id="order-success-screen" class="checkout-success-card" style="display:none;">
    <div style="font-size:3.5rem; margin-bottom:16px;">🌸</div>
    <span class="section-tag">Order Confirmed • Dhanyabad!</span>
    <h2 class="font-serif" style="font-size:2.2rem; margin:10px 0 16px;">Thank You For Choosing Prasuna</h2>
    
    <div style="font-family:var(--font-nepali); font-size:1.15rem; color:var(--color-crimson); margin-bottom:20px;">
      तपाईंको अर्डर सुरक्षित भएको छ 🪡
    </div>

    <p style="font-size:0.95rem; color:var(--color-muted); line-height:1.7; margin-bottom:28px;">
      Order Reference: <strong id="order-ref-num" style="color:var(--color-charcoal);">#PR-8924</strong><br>
      Our master tailors in Kathmandu have begun preparing your garment. A confirmation invoice and tracked dispatch details have been sent to your contact.
    </p>

    <div style="background:var(--color-surface-subtle); border-radius:var(--radius-md); padding:20px; text-align:left; font-size:0.86rem; margin-bottom:32px;">
      <div style="font-weight:700; margin-bottom:8px;">Estimated Dispatch:</div>
      <div style="color:var(--color-muted);">• Express Handcrafting: 2 business days in atelier</div>
      <div style="color:var(--color-muted);">• DHL / Courier Tracking will be pinged to your WhatsApp</div>
    </div>

    <div class="btn-group" style="justify-content:center;">
      <a href="?page=home" class="btn btn-primary">Return to Boutique</a>
      <a href="https://www.instagram.com/prasuna.clo/" target="_blank" class="btn btn-secondary">Follow Our Studio on IG</a>
    </div>
  </div>

</div>

<script>
  let promoApplied = false;

  function renderCheckoutSummary() {
    const list = document.getElementById('checkout-items-list');
    const countEl = document.getElementById('checkout-item-count');
    const subtotalEl = document.getElementById('co-subtotal');
    const discountEl = document.getElementById('co-discount');
    const discountRow = document.getElementById('co-discount-row');
    const totalEl = document.getElementById('co-total');

    if (!list) return;

    let subtotalNpr = 0;
    let count = 0;
    let html = '';

    PrasunaState.cart.forEach(item => {
      subtotalNpr += item.price_npr * item.qty;
      count += item.qty;
      html += `
        <div style="display:flex; gap:10px; align-items:center; width:100%; min-width:0;">
          <img src="${item.image}" alt="${item.name}" style="width:46px; height:58px; object-fit:cover; border-radius:var(--radius-sm); flex-shrink:0;">
          <div style="flex:1; min-width:0; overflow:hidden;">
            <div style="font-weight:600; font-size:0.82rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${item.name}</div>
            <div style="font-size:0.72rem; color:var(--color-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${item.color} • Size ${item.size} × ${item.qty}</div>
          </div>
          <div style="font-weight:700; font-size:0.84rem; flex-shrink:0; white-space:nowrap; margin-left:6px;">
            ${formatMoney(item.price_npr * item.qty)}
          </div>
        </div>
      `;
    });

    list.innerHTML = html || '<div style="color:var(--color-muted); font-size:0.86rem;">Your bag is empty.</div>';
    if (countEl) countEl.textContent = count;
    if (subtotalEl) subtotalEl.textContent = formatMoney(subtotalNpr);

    let discountNpr = promoApplied ? (subtotalNpr * 0.1) : 0;
    if (discountRow) discountRow.style.display = promoApplied ? 'flex' : 'none';
    if (discountEl) discountEl.textContent = `-${formatMoney(discountNpr)}`;

    let finalTotal = Math.max(0, subtotalNpr - discountNpr);
    if (totalEl) totalEl.textContent = formatMoney(finalTotal);
  }

  function applyPromoCode() {
    const input = document.getElementById('promo-code-input');
    const val = input.value.trim().toUpperCase();

    if (val === 'PRASUNA10') {
      promoApplied = true;
      renderCheckoutSummary();
      showToast('10% VIP Drop Discount Applied! 🌸');
    } else if (val) {
      showToast('Invalid promo code. Try PRASUNA10');
    }
  }

  function processOrder(e) {
    e.preventDefault();
    const btn = document.getElementById('checkout-submit-btn');
    btn.textContent = 'Securing Your Limited Drop...';
    btn.disabled = true;

    setTimeout(() => {
      document.getElementById('checkout-view-container').style.display = 'none';
      document.getElementById('order-success-screen').style.display = 'block';
      document.getElementById('order-ref-num').textContent = '#PR-' + Math.floor(1000 + Math.random() * 9000);
      
      // Clear cart
      PrasunaState.cart = [];
      saveCart();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }, 1200);
  }

  function updateShippingMethod(country) {
    const shipEl = document.getElementById('co-shipping');
    if (country === 'NP') {
      shipEl.textContent = 'FREE (Inside Ringroad)';
    } else {
      shipEl.textContent = 'FREE (Worldwide Express on Drop 08)';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderCheckoutSummary();
  });
</script>

@endsection