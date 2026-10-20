<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Prasuna • Handmade Himalayan Slow Fashion & Limited Drops' }}</title>
  <base href="{{ \App\Helpers::basePath() }}">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌸</text></svg>">
  <script>
    (function() {
      const savedTheme = localStorage.getItem('prasuna_theme');
      if (savedTheme === 'candlelight') {
        document.documentElement.setAttribute('data-theme', 'candlelight');
      }
    })();
  </script>
</head>
<body>

  <!-- Announcement Bar -->
  <aside class="announcement-bar" aria-label="Store Announcement">
    <div class="announcement-marquee">
      <div class="announcement-item">
        <span>✨ DROP 08: THE FESTIVE EDIT IS LIVE NOW</span>
        <span class="announcement-sep">✦</span>
        <span>NO REPEAT PRINTS • STRICTLY LIMITED PIECES</span>
        <span class="announcement-sep">✦</span>
        <span>📍 WORLDWIDE EXPRESS SHIPPING (USA, AUS, UK, CA, IN)</span>
        <span class="announcement-sep">✦</span>
        <span>HANDMADE FOR YOU IN KATHMANDU 🌸</span>
        <span class="announcement-sep">✦</span>
        <span>FREE EXPRESS SHIPPING ON ORDERS OVER $150 / RS. 20,000</span>
        <span class="announcement-sep">✦</span>
      </div>
      <!-- Duplicate for seamless loop -->
      <div class="announcement-item">
        <span>✨ DROP 08: THE FESTIVE EDIT IS LIVE NOW</span>
        <span class="announcement-sep">✦</span>
        <span>NO REPEAT PRINTS • STRICTLY LIMITED PIECES</span>
        <span class="announcement-sep">✦</span>
        <span>📍 WORLDWIDE EXPRESS SHIPPING (USA, AUS, UK, CA, IN)</span>
        <span class="announcement-sep">✦</span>
        <span>HANDMADE FOR YOU IN KATHMANDU 🌸</span>
        <span class="announcement-sep">✦</span>
        <span>FREE EXPRESS SHIPPING ON ORDERS OVER $150 / RS. 20,000</span>
        <span class="announcement-sep">✦</span>
      </div>
    </div>
  </aside>

  <!-- Site Header -->
  <header class="site-header">
    <div class="container-wide">
      <div class="header-inner">
        
        <!-- Mobile Menu Toggle (Left on mobile <= 768px) -->
        <button class="action-btn mobile-menu-toggle" onclick="toggleMobileNav()" aria-label="Toggle Navigation Menu">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>

        <!-- Left Navigation (Desktop) -->
        <nav aria-label="Main Navigation">
          <ul class="nav-links">
            <li>
              <a href="?page=home" class="nav-link {{ ($currentPage ?? '') === 'home' ? 'active' : '' }}">Home</a>
            </li>
            <li>
              <a href="?page=shop" class="nav-link badge-link {{ ($currentPage ?? '') === 'shop' ? 'active' : '' }}">
                Silhouettes
                <span class="pill-badge">Drop 08</span>
              </a>
            </li>
            <li>
              <a href="?page=drops" class="nav-link {{ ($currentPage ?? '') === 'drops' ? 'active' : '' }}">The Drops</a>
            </li>
            <li>
              <a href="?page=atelier" class="nav-link {{ ($currentPage ?? '') === 'atelier' ? 'active' : '' }}">The Atelier</a>
            </li>
          </ul>
        </nav>

        <!-- Brand Identity / Logo -->
        <a href="?page=home" class="site-logo">
          <span class="brand-title">PRASUNA</span>
          <span class="brand-subtitle">प्रसूना • INSPIRED BY YOU 🪡</span>
        </a>

        <!-- Right Header Actions -->
        <div class="header-actions">
          
          <!-- Currency Selector (Desktop only) -->
          <div class="currency-dropdown desktop-only-action">
            <button class="currency-trigger" id="currency-toggle-btn" aria-label="Select Currency">
              <span id="current-currency-label">NPR</span>
              <svg width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </button>
            <div class="currency-menu" id="currency-dropdown-menu">
              <button class="currency-option" onclick="setCurrency('NPR')">
                <span>Nepali Rupee</span><strong>NPR (Rs.)</strong>
              </button>
              <button class="currency-option" onclick="setCurrency('USD')">
                <span>US Dollar</span><strong>USD ($)</strong>
              </button>
              <button class="currency-option" onclick="setCurrency('AUD')">
                <span>Australian Dollar</span><strong>AUD (A$)</strong>
              </button>
              <button class="currency-option" onclick="setCurrency('GBP')">
                <span>British Pound</span><strong>GBP (£)</strong>
              </button>
              <button class="currency-option" onclick="setCurrency('EUR')">
                <span>Euro</span><strong>EUR (€)</strong>
              </button>
              <button class="currency-option" onclick="setCurrency('INR')">
                <span>Indian Rupee</span><strong>INR (₹)</strong>
              </button>
            </div>
          </div>

          <!-- Predictive Live Search Button -->
          <button class="action-btn" id="search-toggle-btn" onclick="openSearchDrawer()" title="Search Silhouettes (Press /)" aria-label="Search">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </button>

          <!-- Candlelight / Evening View Toggle -->
          <button class="action-btn" id="theme-toggle-btn" onclick="toggleCandlelightTheme()" title="Switch to Candlelight / Evening View" aria-label="Toggle Candlelight Theme">
            <span id="theme-toggle-icon" style="font-size:1.15rem;">🕯️</span>
          </button>

          <!-- Size Guide Trigger (Desktop only) -->
          <button class="action-btn desktop-only-action" onclick="openSizeGuideModal()" title="Size Guide & Measurements" aria-label="Size Guide">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21.3 15.3l-6.6 6.6c-.4.4-1 .4-1.4 0l-11.6-11.6c-.4-.4-.4-1 0-1.4l6.6-6.6c.4-.4 1-.4 1.4 0l11.6 11.6c.4.4.4 1 0 1.4z"/><path d="M7 6l2 2"/><path d="M10 9l2 2"/><path d="M13 12l2 2"/><path d="M16 15l2 2"/></svg>
          </button>

          <!-- Instagram Link (Desktop only) -->
          <a href="https://www.instagram.com/prasuna.clo/" target="_blank" rel="noopener" class="action-btn desktop-only-action" title="@prasuna.clo on Instagram" aria-label="Instagram">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>

          <!-- Bag / Cart Trigger -->
          <button class="action-btn" onclick="openCartDrawer()" title="View Shopping Bag" aria-label="Shopping Bag">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            <span class="action-badge cart-count-badge" style="display:none;">0</span>
          </button>

        </div>
      </div>
    </div>
  </header>

  <!-- Mobile Drawer Navigation -->
  <div class="drawer-backdrop" id="mobile-nav-backdrop" onclick="toggleMobileNav()"></div>
  <aside class="mobile-nav-drawer" id="mobile-nav-drawer" aria-label="Mobile Navigation">
    <div class="drawer-header">
      <div class="brand-title" style="font-size:1.35rem; letter-spacing:0.1em;">PRASUNA</div>
      <button class="drawer-close" onclick="toggleMobileNav()" aria-label="Close Navigation">✕</button>
    </div>
    <div class="mobile-nav-body">
      <button class="mobile-nav-action-btn" onclick="toggleMobileNav(); openSearchDrawer();">
        <span>🔍</span> <span>Search Silhouettes</span>
      </button>
      <button class="mobile-nav-action-btn" onclick="toggleCandlelightTheme();">
        <span id="mobile-theme-icon">🕯️</span> <span id="mobile-theme-label">Candlelight View</span>
      </button>
      <button class="mobile-nav-action-btn" onclick="toggleMobileNav(); openSizeGuideModal();">
        <span>📏</span> <span>Size Guide & Measurements</span>
      </button>
      
      <!-- Mobile Currency Selector -->
      <div class="mobile-nav-currency-box">
        <div class="mobile-curr-title">
          ✦ Display Currency
        </div>
        <div class="mobile-currency-grid">
          <button type="button" class="mobile-curr-pill active" data-curr="NPR" onclick="setCurrency('NPR'); updateMobileCurrencyUI();">NPR (Rs.)</button>
          <button type="button" class="mobile-curr-pill" data-curr="USD" onclick="setCurrency('USD'); updateMobileCurrencyUI();">USD ($)</button>
          <button type="button" class="mobile-curr-pill" data-curr="AUD" onclick="setCurrency('AUD'); updateMobileCurrencyUI();">AUD (A$)</button>
          <button type="button" class="mobile-curr-pill" data-curr="GBP" onclick="setCurrency('GBP'); updateMobileCurrencyUI();">GBP (£)</button>
          <button type="button" class="mobile-curr-pill" data-curr="EUR" onclick="setCurrency('EUR'); updateMobileCurrencyUI();">EUR (€)</button>
          <button type="button" class="mobile-curr-pill" data-curr="INR" onclick="setCurrency('INR'); updateMobileCurrencyUI();">INR (₹)</button>
        </div>
      </div>

      <hr class="mobile-nav-divider">
      <nav class="mobile-nav-links">
        <a href="?page=home" onclick="toggleMobileNav()">Home</a>
        <a href="?page=shop" onclick="toggleMobileNav()">Silhouettes (Drop 08)</a>
        <a href="?page=drops" onclick="toggleMobileNav()">The Limited Drops</a>
        <a href="?page=atelier" onclick="toggleMobileNav()">Our Atelier & Story</a>
        <a href="?page=checkout" onclick="toggleMobileNav()" class="mobile-checkout-link">Express Checkout →</a>
      </nav>
      
      <hr class="mobile-nav-divider">
      <a href="https://www.instagram.com/prasuna.clo/" target="_blank" rel="noopener" class="mobile-nav-ig">
        <span>📸</span> <span>Follow @prasuna.clo (70.6K) ↗</span>
      </a>
      <div class="mobile-nav-footer-note">
        <p>🌸 Handmade Slow Fashion in Kathmandu</p>
        <p>No Repeat Prints • Worldwide Express Shipping</p>
      </div>
    </div>
  </aside>

  <!-- Main View Content -->
  <main id="main-content">
    @yield('content')
  </main>

  <!-- Slide-out Shopping Bag Drawer -->
  <div class="drawer-backdrop" id="cart-backdrop" onclick="closeCartDrawer()"></div>
  <aside class="cart-drawer" id="cart-drawer" aria-label="Shopping Bag">
    <div class="drawer-header">
      <h2 class="drawer-title">
        <span>Shopping Bag</span>
        <span class="pill-badge cart-count-badge" style="display:none;">0</span>
      </h2>
      <div style="display:flex; align-items:center; gap:10px;">
        <button type="button" class="cart-clear-btn" id="cart-clear-btn" onclick="clearCart()" style="display:none;" title="Clear all items from bag">Clear All</button>
        <button class="drawer-close" onclick="closeCartDrawer()" aria-label="Close Shopping Bag">✕</button>
      </div>
    </div>

    <!-- Free Shipping Progress Tracker -->
    <div class="shipping-bar-wrap">
      <div class="shipping-bar-text" id="shipping-progress-text">
        <span>Add items to qualify for Free Worldwide Express Shipping!</span>
      </div>
      <div class="progress-track">
        <div class="progress-fill" id="shipping-progress-fill" style="width: 0%;"></div>
      </div>
    </div>

    <!-- Items list -->
    <div class="cart-items-list" id="cart-items-container">
      <!-- Injected via JavaScript -->
    </div>

    <!-- Footer with subtotal and checkout CTA -->
    <div class="drawer-footer">
      <div class="drawer-subtotal-row">
        <span>Estimated Subtotal</span>
        <span id="cart-subtotal-val" data-price-npr="0">Rs. 0</span>
      </div>
      <div class="drawer-notes">
        ✦ Includes complimentary keepsake gift box, wax seal & handwritten note.
      </div>
      <a href="?page=checkout" class="btn btn-crimson" style="width: 100%;" onclick="closeCartDrawer()">
        Proceed to Express Checkout
      </a>
      <button class="btn btn-secondary btn-sm" onclick="closeCartDrawer()">
        Continue Shopping Drop 08
      </button>
    </div>
  </aside>

  <!-- Quick View Modal -->
  <div class="modal-backdrop" id="quickview-modal">
    <div class="modal-card">
      <button class="modal-close-btn" onclick="closeQuickView()">✕</button>
      <div class="quickview-grid">
        <div>
          <div style="aspect-ratio:3/4; border-radius: var(--radius-md); overflow:hidden; background:var(--color-surface-subtle);">
            <img id="qv-img" src="" alt="Product Preview" style="width:100%; height:100%; object-fit:cover;">
          </div>
        </div>
        <div style="display:flex; flex-direction:column; justify-content:space-between;">
          <div>
            <div id="qv-stock" class="badge-stock" style="position:static; display:inline-block; margin-bottom:12px;"></div>
            <h2 id="qv-title" class="font-serif" style="font-size:1.6rem; margin-bottom:4px;"></h2>
            <div id="qv-nepali" style="font-family:var(--font-nepali); color:var(--color-muted); font-size:0.9rem; margin-bottom:16px;"></div>
            <div id="qv-price" style="font-size:1.4rem; font-weight:700; color:var(--color-charcoal); margin-bottom:20px;"></div>
            <p id="qv-desc" style="font-size:0.88rem; color:var(--color-muted); line-height:1.6; margin-bottom:24px;"></p>

            <div style="margin-bottom:24px;">
              <div class="variant-picker-label">
                <span>Select Silhouette Size</span>
                <button type="button" onclick="openSizeGuideModal()" style="font-size:0.75rem; text-decoration:underline; color:var(--color-crimson);">Size Guide</button>
              </div>
              <div class="size-pill-group" id="qv-sizes"></div>
            </div>
          </div>

          <div>
            <button class="btn btn-crimson" id="qv-add-btn" style="width:100%; margin-bottom:10px;">
              Add To Shopping Bag
            </button>
            <div style="font-size:0.76rem; color:var(--color-muted); text-align:center;">
              Handmade in Kathmandu • No Repeat Prints • Ready to Ship
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Story Highlights Reel Modal -->
  <div class="modal-backdrop" id="story-modal">
    <div class="modal-card" style="max-width:440px; background:#141211; color:#fff; border-radius:var(--radius-lg); overflow:hidden;">
      <button class="modal-close-btn" style="background:rgba(255,255,255,0.2); color:#fff;" onclick="closeStoryModal()">✕</button>
      <div style="position:relative; aspect-ratio:9/16; max-height:80vh;">
        <img id="story-modal-img" src="" alt="Story Media" style="width:100%; height:100%; object-fit:cover;">
        <div style="position:absolute; inset:0; background:linear-gradient(180deg, rgba(0,0,0,0.5) 0%, transparent 25%, transparent 70%, rgba(0,0,0,0.85) 100%);"></div>
        <div style="position:absolute; top:20px; left:20px; right:60px;">
          <div id="story-modal-title" style="font-weight:700; font-size:1.05rem; letter-spacing:0.04em;"></div>
          <div id="story-modal-note" style="font-size:0.75rem; color:#D4AF37;"></div>
        </div>
        <div style="position:absolute; bottom:24px; left:20px; right:20px;">
          <p id="story-modal-desc" style="font-size:0.88rem; line-height:1.5; color:#F0ECE4; margin-bottom:16px;"></p>
          <a href="?page=shop" class="btn btn-crimson btn-sm" style="width:100%;" onclick="closeStoryModal()">
            Shop This Collection
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Size Guide Modal -->
  <div class="modal-backdrop" id="size-guide-modal">
    <div class="modal-card size-guide-card">
      <button class="modal-close-btn" onclick="closeSizeGuideModal()">✕</button>
      <div class="section-tag">Prasuna Tailoring Standard</div>
      <h2 class="font-serif" style="font-size:1.8rem; margin-bottom:8px;">Garment Measurement Guide</h2>
      <p style="font-size:0.88rem; color:var(--color-muted); margin-bottom:24px;">
        All Prasuna silhouettes are tailored with 1.5 inches of internal margin for effortless alterations. Measurements in Inches.
      </p>

      <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:0.86rem; text-align:left;">
          <thead>
            <tr style="border-bottom:2px solid var(--color-charcoal); background:var(--color-surface-subtle);">
              <th style="padding:12px 14px;">Size</th>
              <th style="padding:12px 14px;">Bust</th>
              <th style="padding:12px 14px;">Waist</th>
              <th style="padding:12px 14px;">Hip</th>
              <th style="padding:12px 14px;">Kurti Length</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom:1px solid var(--color-border);"><td style="padding:12px 14px; font-weight:600;">XS (US 0-2)</td><td style="padding:12px 14px;">32 - 33"</td><td style="padding:12px 14px;">25 - 26"</td><td style="padding:12px 14px;">35 - 36"</td><td style="padding:12px 14px;">44"</td></tr>
            <tr style="border-bottom:1px solid var(--color-border); background:var(--color-surface-subtle);"><td style="padding:12px 14px; font-weight:600;">S (US 4-6)</td><td style="padding:12px 14px;">34 - 35"</td><td style="padding:12px 14px;">27 - 28"</td><td style="padding:12px 14px;">37 - 38"</td><td style="padding:12px 14px;">44.5"</td></tr>
            <tr style="border-bottom:1px solid var(--color-border);"><td style="padding:12px 14px; font-weight:600;">M (US 8-10)</td><td style="padding:12px 14px;">36 - 37"</td><td style="padding:12px 14px;">29 - 30"</td><td style="padding:12px 14px;">39 - 40"</td><td style="padding:12px 14px;">45"</td></tr>
            <tr style="border-bottom:1px solid var(--color-border); background:var(--color-surface-subtle);"><td style="padding:12px 14px; font-weight:600;">L (US 12)</td><td style="padding:12px 14px;">38 - 39"</td><td style="padding:12px 14px;">31 - 32"</td><td style="padding:12px 14px;">41 - 42"</td><td style="padding:12px 14px;">45.5"</td></tr>
            <tr style="border-bottom:1px solid var(--color-border);"><td style="padding:12px 14px; font-weight:600;">XL (US 14)</td><td style="padding:12px 14px;">40 - 41"</td><td style="padding:12px 14px;">33 - 34"</td><td style="padding:12px 14px;">43 - 44"</td><td style="padding:12px 14px;">46"</td></tr>
            <tr style="background:#FFF9E6; color:#8C6D1F; font-weight:600;"><td style="padding:12px 14px;">Custom Fit</td><td colspan="4" style="padding:12px 14px;">Made to your exact measurements at zero additional tailoring charge!</td></tr>
          </tbody>
        </table>
      </div>

      <div style="margin-top:24px; text-align:center;">
        <button class="btn btn-primary btn-sm" onclick="closeSizeGuideModal(); openCustomMeasureModal();">
          Request Custom Measurements
        </button>
      </div>
    </div>
  </div>

  <!-- Custom Tailoring Modal -->
  <div class="modal-backdrop" id="custom-tailor-modal">
    <div class="modal-card custom-measure-card">
      <button class="modal-close-btn" onclick="closeCustomMeasureModal()">✕</button>
      <div class="section-tag">Made For You 🪡</div>
      <h2 class="font-serif" style="font-size:1.8rem; margin-bottom:8px;">Custom Fit Atelier Form</h2>
      <p style="font-size:0.86rem; color:var(--color-muted); margin-bottom:24px;">
        Provide your dimensions and our master tailors in Kathmandu will craft your piece exclusively for your body silhouette.
      </p>

      <form onsubmit="event.preventDefault(); showToast('Custom dimensions noted! Adding to bag...'); closeCustomMeasureModal(); addToCart({id:'gulabi-set', name:'Gulabi Custom Tailored Set', color:'Olive Antique Gold', size:'Custom Fit', price_npr:14500, image:'assets/images/hero_festive.jpg', qty:1});">
        <div class="custom-measure-grid">
          <div>
            <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Bust (Inches)</label>
            <input type="number" step="0.5" placeholder="e.g. 35" required style="width:100%; padding:10px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
          </div>
          <div>
            <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Natural Waist (Inches)</label>
            <input type="number" step="0.5" placeholder="e.g. 28" required style="width:100%; padding:10px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
          </div>
          <div>
            <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Fullest Hip (Inches)</label>
            <input type="number" step="0.5" placeholder="e.g. 38" required style="width:100%; padding:10px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
          </div>
          <div>
            <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Height (Feet/Inches)</label>
            <input type="text" placeholder="e.g. 5' 4&quot;" required style="width:100%; padding:10px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);">
          </div>
        </div>

        <div style="margin-bottom:20px;">
          <label style="font-size:0.78rem; font-weight:600; display:block; margin-bottom:6px;">Special Tailoring Requests / Notes</label>
          <textarea rows="3" placeholder="e.g., Slit height preference, strap adjustments, or festive date needed..." style="width:100%; padding:10px 14px; border:1px solid var(--color-border); border-radius:var(--radius-sm); background:var(--color-surface);"></textarea>
        </div>

        <button type="submit" class="btn btn-crimson" style="width:100%;">
          Save Custom Fit & Add To Bag
        </button>
      </form>
    </div>
  </div>

  <!-- Atelier Film Modal -->
  <div class="modal-backdrop" id="atelier-film-modal">
    <div class="modal-card" style="max-width:820px; background:#161413; color:#F5EFEB; border-radius:var(--radius-lg); overflow:hidden;">
      <button class="modal-close-btn" style="background:rgba(255,255,255,0.25); color:#fff; z-index:10;" onclick="closeAtelierFilmModal()">✕</button>
      <div style="position:relative; aspect-ratio:16/9; overflow:hidden; background:#000;">
        <video id="atelier-modal-video" controls playsinline style="width:100%; height:100%; object-fit:cover;" src="assets/videos/hero_runway_walk.mp4" poster="assets/images/atelier_crafting.jpg">
        </video>
      </div>
      <div class="atelier-modal-body" style="background:#1A1715;">
        <div style="color:var(--color-gold); font-size:0.75rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; margin-bottom:6px;">
          ✦ The Stitches of Kathmandu • Documentary Short
        </div>
        <h2 class="font-serif" style="color:#fff; font-size:1.6rem; margin-bottom:8px;">
          Inside the Prasuna Workshop & Runway
        </h2>
        <p style="color:#D2CBC4; font-size:0.86rem; max-width:680px; line-height:1.6; margin-bottom:16px;">
          Watch master didis and pattern cutters transform pure handloom raw silks into limited heirlooms. No assembly lines. Just human hands, generational pride, and flowing silhouettes in Kathmandu sunlight.
        </p>
        <div style="display:flex; gap:14px; align-items:center;">
          <a href="?page=atelier" class="btn btn-crimson btn-sm" onclick="closeAtelierFilmModal()">
            Read The Full Atelier Story
          </a>
          <span style="font-size:0.76rem; color:#A79F97;">
            🪡 Kathmandu Atelier Live Footage
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container-wide">
      <div class="footer-grid">
        
        <!-- Brand Info -->
        <div class="footer-brand">
          <div class="brand-title">PRASUNA</div>
          <div class="brand-subtitle">प्रसूना • INSPIRED BY YOU 🪡</div>
          <p class="footer-about">
            A Nepali artisanal slow-fashion brand founded in Kathmandu. We craft limited drop silhouettes with handloom silks, fine resham embroidery, and zero repeat prints.
          </p>
          <div style="margin-top: 20px; display:flex; gap:12px;">
            <a href="https://www.instagram.com/prasuna.clo/" target="_blank" rel="noopener" style="color:var(--color-gold); font-size:0.86rem; font-weight:600;">
              ✦ Follow @prasuna.clo on Instagram (70.6K)
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <div class="footer-heading">Collections</div>
          <ul class="footer-links">
            <li><a href="?page=shop">The Festive Edit (Drop 08)</a></li>
            <li><a href="?page=shop&category=Camisole+Tunics">Gulabi Slit Tunics</a></li>
            <li><a href="?page=shop&category=Festive+Sets">Noor Fuchsia Collection</a></li>
            <li><a href="?page=shop&category=Co-Ords">Pooh & Lila Co-Ords</a></li>
            <li><a href="?page=drops">Upcoming Drop Calendar</a></li>
          </ul>
        </div>

        <!-- Brand Links -->
        <div>
          <div class="footer-heading">Philosophy</div>
          <ul class="footer-links">
            <li><a href="?page=atelier">The Kathmandu Atelier</a></li>
            <li><a href="?page=atelier#slow-fashion">Why No Repeat Prints?</a></li>
            <li><a href="javascript:void(0)" onclick="openSizeGuideModal()">Size & Custom Fit Guide</a></li>
            <li><a href="javascript:void(0)" onclick="openStoryModal('loves')">Signature Keepsake Packaging</a></li>
            <li><a href="?page=checkout">Worldwide Shipping Policy</a></li>
          </ul>
        </div>

        <!-- Studio & Contact -->
        <div>
          <div class="footer-heading">Kathmandu Atelier</div>
          <div style="font-size:0.86rem; line-height:1.7; color:#A39D97;">
            <p>📍 Kathmandu, Nepal</p>
            <p>🕒 Open Monday – Saturday: 11:00 AM – 6:00 PM</p>
            <p>💌 Inquiries & Custom Orders:</p>
            <p><a href="mailto:info@prasuna.np" style="color:#FFFFFF; font-weight:600;">info@prasuna.np</a></p>
            <p>💬 WhatsApp Concierge: <span style="color:var(--color-gold);">+977 980-0000000</span></p>
          </div>
        </div>

      </div>

      <!-- Footer Bottom Bar -->
      <div class="footer-bottom">
        <div>
          © {{ date('Y') }} PRASUNA (प्रसूना). All rights reserved. Slow Handmade Fashion from Nepal.
        </div>
        <div class="payment-badges">
          <span class="payment-pill">Khalti</span>
          <span class="payment-pill">eSewa</span>
          <span class="payment-pill">Visa</span>
          <span class="payment-pill">MasterCard</span>
          <span class="payment-pill">Cash on Delivery</span>
        </div>
      </div>
    </div>
  </footer>

  <!-- Predictive Live Search Drawer -->
  <div class="search-backdrop" id="search-backdrop" onclick="closeSearchDrawer()"></div>
  <aside class="search-drawer" id="search-drawer" role="dialog" aria-modal="true" aria-label="Search Silhouettes">
    <div class="container-wide">
      <div class="search-header-inner">
        <div class="section-tag" style="margin:0;">✦ Predictive Archive Search • Drop 08</div>
        <div style="display:flex; align-items:center; gap:16px;">
          <span style="font-size:0.75rem; color:var(--color-muted); display:inline-block; border:1px solid var(--color-border); padding:3px 10px; border-radius:4px; font-weight:600;">ESC to Close</span>
          <button class="drawer-close" onclick="closeSearchDrawer()" aria-label="Close Search" style="font-size:1.3rem;">✕</button>
        </div>
      </div>

      <!-- Search Input -->
      <div class="search-input-wrap">
        <div class="search-input-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <input type="text" id="live-search-input" class="search-main-input" placeholder="Search silhouettes, mul cotton, festive sets, zardozi, bell sleeves, corset back..." autocomplete="off" oninput="handleLiveSearchInput(this.value)">
        <button type="button" id="search-clear-btn" class="search-clear-btn" onclick="clearLiveSearch()">✕</button>
      </div>

      <!-- Trending Search Pills -->
      <div class="trending-pills-row">
        <span style="font-size:0.75rem; font-weight:700; color:var(--color-muted); text-transform:uppercase; letter-spacing:0.06em;">Trending Searches:</span>
        <button type="button" class="trending-pill" onclick="searchForTrending('Gulabi Set')">Gulabi Set</button>
        <button type="button" class="trending-pill" onclick="searchForTrending('Mul Cotton')">Mul Cotton</button>
        <button type="button" class="trending-pill" onclick="searchForTrending('Bell Sleeves')">Bell Sleeves</button>
        <button type="button" class="trending-pill" onclick="searchForTrending('Corset Back')">Corset Back</button>
        <button type="button" class="trending-pill" onclick="searchForTrending('Sharara')">Dashain Sharara</button>
        <button type="button" class="trending-pill" onclick="searchForTrending('Zardozi')">Zardozi</button>
        <button type="button" class="trending-pill" onclick="searchForTrending('Noor Fuchsia')">Noor Fuchsia</button>
        <button type="button" class="trending-pill" onclick="searchForTrending('Pooh Peplum')">Pooh Peplum</button>
      </div>

      <!-- Results Container -->
      <div id="search-results-container" style="margin-top:24px;">
        <div id="search-results-status" style="font-size:0.84rem; color:var(--color-muted); font-weight:600; margin-bottom:12px;"></div>
        <div class="search-results-grid" id="search-results-grid">
          <!-- Populated via JavaScript -->
        </div>
      </div>

    </div>
  </aside>

  <!-- Global Product Catalog Payload for Instant Live Search -->
  <script>
    window.PRASUNA_CATALOG = @json(\App\Data\Products::getAll());
  </script>
  <script src="assets/js/app.js"></script>
  <script>
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
    </script>
</body>
</html>
