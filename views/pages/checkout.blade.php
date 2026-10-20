@extends('layouts.app')

@section('content')

<div class="container" style="padding-top: 36px; padding-bottom: 96px;">
  
  <!-- Breadcrumbs -->
  <nav class="breadcrumb-nav">
    <a href="?page=home">Home</a> &nbsp;/&nbsp; 
    <a href="?page=shop">Silhouettes</a> &nbsp;/&nbsp; 
    <span>Express Checkout</span>
  </nav>

  <div id="checkout-view-container">
    
    <div style="margin-bottom: 32px;">
      <span class="section-tag">Secure Himalayan Dispatch</span>
      <h1 class="font-serif" style="font-size:2.4rem; margin-top:4px;">Express Checkout</h1>
    </div>

    <div style="display:grid; grid-template-columns: 1.25fr 1fr; gap:48px; align-items:flex-start;">
      
      <!-- Checkout Form Column -->
      <form id="order-checkout-form" onsubmit="processOrder(event)">
        
        <!-- Step 1: Customer Info -->
        <div style="background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-md); padding:28px; margin-bottom:24px;">
          <h2 class="font-serif" style="font-size:1.25rem; margin-bottom:18px; display:flex; align-items:center; gap:8px;">
            <span>1. Contact & Recipient</span>
          </h2>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:16px;">
            <div>
              <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">First Name *</label>
              <input type="text" required placeholder="e.g. Alisha" style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
            </div>
            <div>
              <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Last Name *</label>
              <input type="text" required placeholder="e.g. Shrestha" style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
            </div>
          </div>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div>
              <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Email Address *</label>
              <input type="email" required placeholder="alisha@example.com" style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
            </div>
            <div>
              <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Phone / WhatsApp *</label>
              <input type="tel" required placeholder="+977 98..." style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
            </div>
          </div>
        </div>

        <!-- Step 2: Shipping Destination -->
        <div style="background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-md); padding:28px; margin-bottom:24px;">
          <h2 class="font-serif" style="font-size:1.25rem; margin-bottom:18px;">
            2. Delivery Destination
          </h2>

          <div style="margin-bottom:16px;">
            <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Country / Region *</label>
            <select id="checkout-country" onchange="updateShippingMethod(this.value)" style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
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
            <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Street Address & Landmark *</label>
            <input type="text" required placeholder="House / Apartment, Street, Ward No." style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
          </div>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div>
              <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">City / Town *</label>
              <input type="text" required placeholder="Kathmandu, Lalitpur, Pokhara, New York..." style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
            </div>
            <div>
              <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Postal / Zip Code</label>
              <input type="text" placeholder="e.g. 44600" style="width:100%; padding:11px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
            </div>
          </div>
        </div>

        <!-- Step 3: Payment Method -->
        <div style="background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-md); padding:28px; margin-bottom:28px;">
          <h2 class="font-serif" style="font-size:1.25rem; margin-bottom:18px;">
            3. Payment Method
          </h2>

          <div style="display:flex; flex-direction:column; gap:12px;">
            
            <label style="display:flex; align-items:center; gap:14px; padding:14px 18px; border:1px solid var(--color-border); border-radius:var(--radius-sm); cursor:pointer; background:var(--color-surface);">
              <input type="radio" name="payment_method" value="khalti" checked>
              <div style="flex:1;">
                <div style="font-weight:600; font-size:0.9rem;">Khalti Digital Wallet</div>
                <div style="font-size:0.76rem; color:var(--color-muted);">Instant payment via Khalti app or e-Banking</div>
              </div>
              <span class="payment-pill" style="background:#5D2E8E; color:#fff;">Khalti</span>
            </label>

            <label style="display:flex; align-items:center; gap:14px; padding:14px 18px; border:1px solid var(--color-border); border-radius:var(--radius-sm); cursor:pointer; background:var(--color-surface);">
              <input type="radio" name="payment_method" value="esewa">
              <div style="flex:1;">
                <div style="font-weight:600; font-size:0.9rem;">eSewa Mobile Wallet</div>
                <div style="font-size:0.76rem; color:var(--color-muted);">Pay securely using your eSewa account</div>
              </div>
              <span class="payment-pill" style="background:#60BB46; color:#fff;">eSewa</span>
            </label>

            <label style="display:flex; align-items:center; gap:14px; padding:14px 18px; border:1px solid var(--color-border); border-radius:var(--radius-sm); cursor:pointer; background:var(--color-surface);">
              <input type="radio" name="payment_method" value="card">
              <div style="flex:1;">
                <div style="font-weight:600; font-size:0.9rem;">Credit / Debit Card (Worldwide)</div>
                <div style="font-size:0.76rem; color:var(--color-muted);">Visa, MasterCard, American Express, Apple Pay</div>
              </div>
              <span class="payment-pill" style="background:#1A1F71; color:#fff;">Visa / MC</span>
            </label>

            <label style="display:flex; align-items:center; gap:14px; padding:14px 18px; border:1px solid var(--color-border); border-radius:var(--radius-sm); cursor:pointer; background:var(--color-surface);">
              <input type="radio" name="payment_method" value="cod">
              <div style="flex:1;">
                <div style="font-weight:600; font-size:0.9rem;">Cash on Delivery (Kathmandu Valley)</div>
                <div style="font-size:0.76rem; color:var(--color-muted);">Pay with cash or QR scan upon receiving parcel</div>
              </div>
              <span class="payment-pill" style="background:var(--color-charcoal); color:#fff;">COD</span>
            </label>

          </div>
        </div>

        <button type="submit" class="btn btn-crimson" id="checkout-submit-btn" style="width:100%; padding:18px; font-size:1rem;">
          Place Order & Reserve Limited Drop
        </button>

      </form>

      <!-- Right Column: Order Summary -->
      <div style="background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-md); padding:28px; position:sticky; top:100px;">
        <h2 class="font-serif" style="font-size:1.25rem; margin-bottom:20px; border-bottom:1px solid var(--color-border); padding-bottom:12px;">
          Order Summary (<span id="checkout-item-count">0</span> items)
        </h2>

        <!-- Items preview -->
        <div id="checkout-items-list" style="display:flex; flex-direction:column; gap:16px; margin-bottom:24px; max-height:300px; overflow-y:auto;">
          <!-- Injected via JavaScript -->
        </div>

        <!-- Voucher Code Input -->
        <div style="display:flex; gap:8px; margin-bottom:20px;">
          <input type="text" id="promo-code-input" placeholder="Promo code (try PRASUNA10)" style="flex:1; padding:9px 12px; border:1px solid var(--color-border); border-radius:var(--radius-sm); font-size:0.84rem; text-transform:uppercase;">
          <button type="button" class="btn btn-secondary btn-sm" onclick="applyPromoCode()">Apply</button>
        </div>

        <!-- Calculations -->
        <div style="display:flex; flex-direction:column; gap:10px; font-size:0.88rem; border-top:1px solid var(--color-border); padding-top:16px;">
          <div style="display:flex; justify-content:space-between;">
            <span style="color:var(--color-muted);">Subtotal</span>
            <span id="co-subtotal" style="font-weight:600;">Rs. 0</span>
          </div>

          <div style="display:flex; justify-content:space-between;" id="co-discount-row">
            <span style="color:var(--color-emerald); font-weight:600;">Drop Promo (10% Off)</span>
            <span id="co-discount" style="color:var(--color-emerald); font-weight:600;">-Rs. 0</span>
          </div>

          <div style="display:flex; justify-content:space-between;">
            <span style="color:var(--color-muted);">Shipping</span>
            <span id="co-shipping" style="font-weight:600; color:var(--color-emerald);">FREE (Worldwide)</span>
          </div>

          <div style="display:flex; justify-content:space-between; font-size:1.2rem; font-weight:700; color:var(--color-charcoal); border-top:1px solid var(--color-border); padding-top:14px; margin-top:6px;">
            <span>Total Payable</span>
            <span id="co-total">Rs. 0</span>
          </div>
        </div>

        <!-- Packaging reassurance -->
        <div style="margin-top:24px; padding:16px; background:var(--color-surface-subtle); border-radius:var(--radius-sm); font-size:0.78rem; color:var(--color-muted); line-height:1.5;">
          💌 <strong>Complimentary Keepsake Gift Box:</strong> Sealed with dried botanical sprigs, brass wax stamp, and a handwritten card.
        </div>
      </div>

    </div>

  </div>

  <!-- Order Success Screen (Hidden by default) -->
  <div id="order-success-screen" style="display:none; text-align:center; max-width:640px; margin:40px auto; background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-lg); padding:56px 40px; box-shadow:var(--shadow-md);">
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
        <div style="display:flex; gap:12px; align-items:center;">
          <img src="${item.image}" alt="${item.name}" style="width:54px; height:68px; object-fit:cover; border-radius:var(--radius-sm);">
          <div style="flex:1;">
            <div style="font-weight:600; font-size:0.86rem;">${item.name}</div>
            <div style="font-size:0.75rem; color:var(--color-muted);">${item.color} • Size ${item.size} × ${item.qty}</div>
          </div>
          <div style="font-weight:700; font-size:0.86rem;">
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
