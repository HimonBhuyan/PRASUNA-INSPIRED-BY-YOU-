@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
  <div class="container-wide">
    <div class="hero-grid">
      
      <!-- Left Editorial Text -->
      <div class="hero-content">
        <div class="hero-subhead">
          <span class="pulse-dot"></span>
          Drop 08 Live • Festive Edition
        </div>
        
        <h1 class="hero-title">
          Handmade Silhouettes, <em>Crafted for You</em>.
        </h1>
        
        <p class="hero-description">
          Slow fashion heirlooms handcrafted in Kathmandu. Lustrous raw silks, delicate zardozi embroidery, and modern Indo-western cuts. Each piece is strictly limited — <strong>no repeat prints, ever.</strong>
        </p>

        <!-- Live Drop Countdown & Scarcity Meter -->
        <div class="drop-countdown-box">
          <div class="countdown-label">
            <span><span>🌸</span> Drop 08 Archive Closes In</span>
            <span style="font-size:0.7rem; color:var(--color-crimson); font-weight:700;">84% Claimed</span>
          </div>
          <div class="countdown-timer">
            <div class="timer-unit">
              <div class="timer-number" id="timer-days">02</div>
              <div class="timer-text">Days</div>
            </div>
            <div class="timer-divider">:</div>
            <div class="timer-unit">
              <div class="timer-number" id="timer-hours">14</div>
              <div class="timer-text">Hours</div>
            </div>
            <div class="timer-divider">:</div>
            <div class="timer-unit">
              <div class="timer-number" id="timer-minutes">35</div>
              <div class="timer-text">Mins</div>
            </div>
            <div class="timer-divider">:</div>
            <div class="timer-unit">
              <div class="timer-number" id="timer-seconds">12</div>
              <div class="timer-text">Secs</div>
            </div>
          </div>

          <!-- Real-time Scarcity Tracker -->
          <div class="scarcity-wrap">
            <div class="scarcity-header">
              <span>Limited Batch Allocation</span>
              <span>Only 6 Pieces Left</span>
            </div>
            <div class="scarcity-track">
              <div class="scarcity-bar" style="width: 84%;"></div>
            </div>
          </div>
        </div>

        <!-- Call to Actions -->
        <div class="btn-group">
          <a href="?page=shop" class="btn btn-primary">
            Shop Drop 08 (Festive)
          </a>
          <button type="button" class="btn btn-secondary" onclick="openAtelierFilmModal()">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            Watch Atelier Film
          </button>
        </div>
      </div>

      <!-- Right Editorial Hero Visual (Multi-Look Showcase) -->
      <div class="hero-media">
        <div class="hero-image-wrap" id="hero-showcase-wrap">
          <span class="floating-badge" id="hero-badge">Look 01 • Iconic Fit</span>

          <!-- Fabric & Touch Inspector Card -->
          <div class="fabric-inspector-card" id="fabric-inspector" onclick="toggleFabricDetails(event)" title="Click to view artisan weave details">
            <div class="fabric-swatch-thumb">
              <img id="fabric-swatch-img" src="assets/images/gulabi_rose_detail.jpg" alt="Artisan Silk Weave">
              <span class="fabric-swatch-zoom-icon">🔍</span>
            </div>
            <div class="fabric-info-col">
              <span class="fabric-tag-label">✦ Touch Inspector</span>
              <span class="fabric-material-title" id="fabric-title">Mulberry Raw Silk</span>
              <span class="fabric-specs-snippet" id="fabric-specs">18 Hrs Hand Zardozi</span>
            </div>

            <!-- Expandable Detailed Weave Spec Popover -->
            <div class="fabric-inspector-modal" id="fabric-detail-modal">
              <div style="font-weight:700; color:var(--color-gold); font-size:0.85rem; margin-bottom:4px;">
                ✦ Handloom Weave DNA
              </div>
              <p id="fabric-dna-desc" style="color:#DDD5CC; font-size:0.75rem; margin-bottom:10px; line-height:1.5;">
                100% natural mulberry raw silk with zero synthetic blending. Hand-loomed on traditional wooden looms in Patan, Kathmandu.
              </p>
              <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px; font-size:0.72rem; color:#A89F95; border-top:1px solid rgba(255,255,255,0.12); padding-top:8px;">
                <div>Thread Count: <strong style="color:#fff;" id="fabric-thread-count">320 TPI</strong></div>
                <div>Natural Dye: <strong style="color:#fff;" id="fabric-dye">Mineral Gold</strong></div>
                <div>Breathability: <strong style="color:#fff;">High</strong></div>
                <div>Weight: <strong style="color:#fff;" id="fabric-weight">160 GSM</strong></div>
              </div>
            </div>
          </div>
          
          <img id="hero-slide-img" src="assets/images/hero_festive.jpg" alt="Prasuna Limited Silhouette" style="width:100%; height:100%; object-fit:cover; transition:opacity 0.28s ease;">
          
          <!-- Hotspot Pin 1: Bodice / Camisole -->
          <div class="hotspot-pin" id="hero-pin-top" style="top: 38%; left: 48%;" onclick="toggleHotspotPin(this, event)" title="Click to inspect silhouette top">
            <span style="font-size:0.75rem; color:var(--color-crimson); font-weight:700;">+</span>
            <div class="hotspot-popover" id="hero-popover-top">
              <strong id="hotspot-top-title">Sweetheart Raw Silk Camisole</strong>
              <span style="color:var(--color-gold); font-weight:700;" id="hotspot-top-price">Rs. 8,500</span>
              <span style="font-size:0.7rem; color:#D3CBBF;" id="hotspot-top-desc">Pure zardozi hand-embroidered bustier</span>
              <button type="button" class="hotspot-quick-add" onclick="addHotspotPieceToBag('top', event)">
                + Quick Bag
              </button>
            </div>
          </div>

          <!-- Hotspot Pin 2: Trouser / Sharara -->
          <div class="hotspot-pin" id="hero-pin-bottom" style="top: 74%; left: 52%;" onclick="toggleHotspotPin(this, event)" title="Click to inspect bottoms">
            <span style="font-size:0.75rem; color:var(--color-crimson); font-weight:700;">+</span>
            <div class="hotspot-popover" id="hero-popover-bottom">
              <strong id="hotspot-bottom-title">Flowing Pure Silk Palazzo</strong>
              <span style="color:var(--color-gold); font-weight:700;" id="hotspot-bottom-price">Rs. 6,000</span>
              <span style="font-size:0.7rem; color:#D3CBBF;" id="hotspot-bottom-desc">High-waisted fluid tailoring</span>
              <button type="button" class="hotspot-quick-add" onclick="addHotspotPieceToBag('bottom', event)">
                + Quick Bag
              </button>
            </div>
          </div>

          <!-- Hotspot Pin 3: Slit / Sleeve Border -->
          <div class="hotspot-pin" id="hero-pin-side" style="top: 56%; left: 28%;" onclick="toggleHotspotPin(this, event)" title="Click to inspect sleeve or slit">
            <span style="font-size:0.75rem; color:var(--color-crimson); font-weight:700;">+</span>
            <div class="hotspot-popover" id="hero-popover-side">
              <strong id="hotspot-side-title">Resham & Zari Slit Accent</strong>
              <span style="color:var(--color-gold); font-weight:700;" id="hotspot-side-price">Artisanal Detail</span>
              <span style="font-size:0.7rem; color:#D3CBBF;">Scalloped hand-finished edge</span>
              <button type="button" class="hotspot-quick-add" onclick="openAtelierFilmModal()">
                ✦ Watch Craft Film
              </button>
            </div>
          </div>

          <!-- Floating Product Card at Bottom -->
          <div class="hero-floating-card">
            <div>
              <div class="floating-product-title" id="hero-card-title">Gulabi Front-Slit Set</div>
              <div class="floating-product-meta" id="hero-card-meta">Olive Gold Raw Silk • Pure Zardozi</div>
            </div>
            <button type="button" class="btn btn-crimson btn-sm" id="hero-card-btn" onclick='addToCart({
              id: "gulabi-set",
              name: "Gulabi Embroidered Front-Slit Set",
              color: "Olive Antique Gold",
              size: "S",
              price_npr: 14500,
              image: "assets/images/hero_festive.jpg",
              qty: 1
            })'>
              + Quick Bag
            </button>
          </div>
        </div>

        <!-- Editorial Hero Carousel Controls & Pagination -->
        <div class="hero-controls-bar">
          <div class="hero-pagination-counter">
            <span class="active-num" id="hero-look-num">01</span>
            <span class="total-num">/ 03</span>
          </div>

          <div class="hero-progress-container">
            <div class="hero-progress-fill" id="hero-progress-bar"></div>
          </div>

          <div style="display:flex; align-items:center; gap:6px;">
            <button type="button" class="hero-nav-arrow" onclick="prevHeroLook()" aria-label="Previous Look">‹</button>
            <button type="button" class="hero-nav-arrow" onclick="nextHeroLook()" aria-label="Next Look">›</button>
          </div>

          <!-- Multi-Look Switcher Buttons -->
          <div class="hero-look-tabs">
            <button type="button" class="hero-look-btn active" id="look-btn-0" onclick="switchHeroLook(0, this)">
              <span>01</span> Gulabi Slit
            </button>
            <button type="button" class="hero-look-btn" id="look-btn-1" onclick="switchHeroLook(1, this)">
              <span>02</span> Suhani Mul
            </button>
            <button type="button" class="hero-look-btn" id="look-btn-2" onclick="switchHeroLook(2, this)">
              <span>03</span> Saya Sharara
            </button>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Instagram Stories Highlight Bubbles -->
<section class="stories-section" aria-label="Brand Stories">
  <div class="container-wide">
    <div style="font-size:0.75rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:var(--color-muted); margin-bottom:12px;">
      ✦ Highlights from our Studio & Archives
    </div>
    <div class="stories-row">
      
      <button class="story-bubble" onclick="openStoryModal('suhani')">
        <div class="story-ring">
          <img src="assets/images/suhani_corset_back.jpg" alt="Suhani Set Corset Back" class="story-avatar">
        </div>
        <span class="story-name">✨ Suhani Set ✨</span>
      </button>

      <button class="story-bubble" onclick="openStoryModal('saya')">
        <div class="story-ring">
          <img src="assets/images/saya_mul_cotton.jpg" alt="Saya Mul Cotton Sharara" class="story-avatar">
        </div>
        <span class="story-name">✨ Saya Mul Cotton ✨</span>
      </button>

      <button class="story-bubble" onclick="openStoryModal('zoya')">
        <div class="story-ring">
          <img src="assets/images/zoya_handloom.jpg" alt="Zoya Handloom Set" class="story-avatar">
        </div>
        <span class="story-name">✨ Zoya Handloom ✨</span>
      </button>

      <button class="story-bubble" onclick="openStoryModal('gulabi')">
        <div class="story-ring">
          <img src="assets/images/hero_festive.jpg" alt="Gulabi Set Story" class="story-avatar">
        </div>
        <span class="story-name">✨ GULABI ✨</span>
      </button>

      <button class="story-bubble" onclick="openStoryModal('noor')">
        <div class="story-ring">
          <img src="assets/images/noor_fuchsia.jpg" alt="Noor Set Story" class="story-avatar">
        </div>
        <span class="story-name">✨ NOOR ✨</span>
      </button>

      <button class="story-bubble" onclick="openStoryModal('pooh')">
        <div class="story-ring">
          <img src="assets/images/pooh_yellow.jpg" alt="Pooh Set Story" class="story-avatar">
        </div>
        <span class="story-name">✨ POOH SET ✨</span>
      </button>

      <button class="story-bubble" onclick="openStoryModal('loves')">
        <div class="story-ring">
          <img src="assets/images/packaging_unboxing.jpg" alt="Packaging Story" class="story-avatar">
        </div>
        <span class="story-name">✨ LOVES (Care) ✨</span>
      </button>

      <button class="story-bubble" onclick="openStoryModal('atelier')">
        <div class="story-ring">
          <img src="assets/images/atelier_crafting.jpg" alt="Atelier Story" class="story-avatar">
        </div>
        <span class="story-name">✨ Store Unfiltered ✨</span>
      </button>

    </div>
  </div>
</section>

<!-- Value Props / Brand Commitments -->
<section class="value-props-section">
  <div class="container-wide">
    <div class="value-props-grid">
      
      <div class="value-prop-card">
        <div class="value-prop-icon">🌸</div>
        <div>
          <div class="value-prop-title">No Repeat Prints</div>
          <div class="value-prop-desc">Each drop is strictly limited. Once an archive print is gone, it is retired forever.</div>
        </div>
      </div>

      <div class="value-prop-card">
        <div class="value-prop-icon">🪡</div>
        <div>
          <div class="value-prop-title">Handmade in Kathmandu</div>
          <div class="value-prop-desc">Crafted with fair living wages by master tailors in our local Nepal atelier.</div>
        </div>
      </div>

      <div class="value-prop-card">
        <div class="value-prop-icon">✨</div>
        <div>
          <div class="value-prop-title">Custom Sizing Available</div>
          <div class="value-prop-desc">We tailor to your exact bust, waist, and height at no additional charge.</div>
        </div>
      </div>

      <div class="value-prop-card">
        <div class="value-prop-icon">✈️</div>
        <div>
          <div class="value-prop-title">Worldwide Express Shipping</div>
          <div class="value-prop-desc">Fast, insured delivery to USA, Australia, UK, Canada, India, and worldwide.</div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Silhouettes & Current Drops Collection -->
<section class="products-section" id="collection-grid">
  <div class="container-wide">
    
    <div class="section-header">
      <span class="section-tag">Current Release • Drop 08</span>
      <h2 class="section-title">The Festive Edit & Heirlooms</h2>
      <p class="section-desc">
        Designed for celebrations that linger in memory. Modern silhouettes meeting ancient Himalayan textile traditions.
      </p>
    </div>

    <!-- Category Filter Tabs -->
    <div class="category-tabs">
      <button class="tab-btn active" onclick="filterCategory('All', this)">All Silhouettes</button>
      <button class="tab-btn" onclick="filterCategory('Mul Cotton & Applique', this)">Mul Cotton & Applique</button>
      <button class="tab-btn" onclick="filterCategory('Camisole Tunics', this)">Camisole Tunics</button>
      <button class="tab-btn" onclick="filterCategory('Festive Sets', this)">Festive Sets</button>
      <button class="tab-btn" onclick="filterCategory('Heirloom Sets', this)">Heirloom Sets</button>
      <button class="tab-btn" onclick="filterCategory('Co-Ords', this)">Co-Ords & Handlooms</button>
    </div>

    <!-- Product Grid -->
    <div class="product-grid">
      @foreach($products as $product)
        @include('components.product-card', ['product' => $product, 'currency' => $currency])
      @endforeach
    </div>

    <div style="text-align: center; margin-top: 54px;">
      <a href="?page=shop" class="btn btn-secondary">
        View All Silhouettes & Sizing &rarr;
      </a>
    </div>

  </div>
</section>

<!-- The Drops Runway / Calendar Section -->
<section class="drops-section">
  <div class="container-wide">
    <div class="section-header">
      <span class="section-tag">Limited Batch Model</span>
      <h2 class="section-title">The Drop Schedule</h2>
      <p class="section-desc">
        We release clothing in micro-batches to respect our artisans' craft and eliminate textile waste.
      </p>
    </div>

    <div class="drop-cards-grid">
      @foreach($drops as $d)
        <div class="drop-card">
          <div class="drop-media">
            <span class="drop-number-badge">DROP {{ $d['number'] }}</span>
            <span class="drop-status-badge {{ $d['status'] === 'Live Now' ? 'status-live' : ($d['status'] === 'Limited Stock' ? 'status-limited' : 'status-waitlist') }}">
              {{ $d['status'] }}
            </span>
            <img src="{{ $d['image'] }}" alt="{{ $d['title'] }}" loading="lazy">
          </div>
          <div class="drop-body">
            <div class="drop-pieces">{{ $d['pieces'] }} • {{ $d['date'] }}</div>
            <h3 class="drop-title">{{ $d['title'] }}</h3>
            <div style="font-family:var(--font-nepali); color:var(--color-muted); font-size:0.86rem; margin-bottom:12px;">{{ $d['nepali_title'] }}</div>
            <p class="drop-text">{{ $d['tagline'] }}</p>
            @if($d['status'] === 'Live Now')
              <a href="?page=shop" class="btn btn-crimson btn-sm">Shop Available Pieces</a>
            @elseif($d['status'] === 'Limited Stock')
              <a href="?page=shop" class="btn btn-secondary btn-sm">View Last Pieces</a>
            @else
              <button class="btn btn-primary btn-sm" onclick="document.getElementById('vip-newsletter-section').scrollIntoView({behavior:'smooth'})">
                Join VIP Early Waitlist
              </button>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Global Social Proof & Client Reviews (Loved in 18+ Countries) -->
<section class="reviews-section" aria-label="Global Client Reviews">
  <div class="container-wide">
    
    <div class="section-header">
      <span class="section-tag">Global Client Voices • 18+ Countries</span>
      <h2 class="section-title">Loved in Kathmandu, Sydney, London & Dallas</h2>
      <p class="section-desc">
        Real stories from women who cherish artisanal slow fashion. Made-to-measure precision, heirloom handlooms, and zero repeat designs.
      </p>
    </div>

    <!-- Trust Stats Strip -->
    <div class="reviews-stats-strip">
      <div class="reviews-stat-item">
        <div class="reviews-stat-number">4.97 ★</div>
        <div class="reviews-stat-label">Average Client Rating</div>
      </div>
      <div class="reviews-stat-item">
        <div class="reviews-stat-number">18+</div>
        <div class="reviews-stat-label">Countries Delivered</div>
      </div>
      <div class="reviews-stat-item">
        <div class="reviews-stat-number">98.4%</div>
        <div class="reviews-stat-label">Custom Fit Accuracy</div>
      </div>
      <div class="reviews-stat-item">
        <div class="reviews-stat-number">3-7 Days</div>
        <div class="reviews-stat-label">DHL Express Worldwide</div>
      </div>
    </div>

    <!-- Testimonial Cards Grid -->
    <div class="reviews-grid">
      
      <!-- Review 1: Kathmandu -->
      <div class="review-card">
        <div class="review-card-top">
          <div class="review-client-meta">
            <div class="review-avatar-wrap">AS</div>
            <div>
              <div class="review-name">Alisha Shrestha</div>
              <div class="review-location">🇳🇵 Kathmandu, Jhamsikhel</div>
            </div>
          </div>
          <div class="review-stars">★★★★★</div>
        </div>
        <p class="review-quote">
          "Wore the Gulabi Front-Slit Set for my sister's reception. The raw silk drape is breathtaking in person. Zero loose threads, and knowing it won't be repeated makes it feel so intimate and special."
        </p>
        <div class="review-card-bottom">
          <span class="review-piece-tag">Wore: Gulabi Front-Slit Set</span>
          <span class="verified-pill">✓ Verified Buyer</span>
        </div>
      </div>

      <!-- Review 2: Sydney -->
      <div class="review-card">
        <div class="review-card-top">
          <div class="review-client-meta">
            <div class="review-avatar-wrap">PT</div>
            <div>
              <div class="review-name">Prerana Thapa</div>
              <div class="review-location">🇦🇺 Sydney, Surry Hills</div>
            </div>
          </div>
          <div class="review-stars">★★★★★</div>
        </div>
        <p class="review-quote">
          "Ordering from Nepal to Australia was seamless with DHL tracking. The custom bust & waist tailoring was spot on without needing any local alterations. The lavender packaging note made my entire week!"
        </p>
        <div class="review-card-bottom">
          <span class="review-piece-tag">Wore: Suhani Mul Cotton Set</span>
          <span class="verified-pill">✓ International Client</span>
        </div>
      </div>

      <!-- Review 3: London -->
      <div class="review-card">
        <div class="review-card-top">
          <div class="review-client-meta">
            <div class="review-avatar-wrap">SK</div>
            <div>
              <div class="review-name">Sonia Khadka</div>
              <div class="review-location">🇬🇧 London, Kensington</div>
            </div>
          </div>
          <div class="review-stars">★★★★★</div>
        </div>
        <p class="review-quote">
          "The bell sleeves on the Suhani tunic are pure poetry. Lightweight, luxurious, breathable. Prasuna's slow fashion philosophy is exactly what the modern festive wardrobe needs."
        </p>
        <div class="review-card-bottom">
          <span class="review-piece-tag">Wore: Saya Mul Cotton Sharara</span>
          <span class="verified-pill">✓ International Client</span>
        </div>
      </div>

      <!-- Review 4: Dallas -->
      <div class="review-card">
        <div class="review-card-top">
          <div class="review-client-meta">
            <div class="review-avatar-wrap">BG</div>
            <div>
              <div class="review-name">Bina Gurung</div>
              <div class="review-location">🇺🇸 Dallas, Texas</div>
            </div>
          </div>
          <div class="review-stars">★★★★★</div>
        </div>
        <p class="review-quote">
          "The Dashain sharara arrived 2 days earlier than scheduled. The zardozi embroidery sparkles under evening lights like real gold dust. Truly museum-grade Himalayan craftsmanship."
        </p>
        <div class="review-card-bottom">
          <span class="review-piece-tag">Wore: Noor Fuchsia Mirrorwork</span>
          <span class="verified-pill">✓ International Client</span>
        </div>
      </div>

      <!-- Review 5: Toronto -->
      <div class="review-card">
        <div class="review-card-top">
          <div class="review-client-meta">
            <div class="review-avatar-wrap">TD</div>
            <div>
              <div class="review-name">Tenzin Dolkar</div>
              <div class="review-location">🇨🇦 Toronto, Ontario</div>
            </div>
          </div>
          <div class="review-stars">★★★★★</div>
        </div>
        <p class="review-quote">
          "Third drop I've bought from. Every piece comes with its own keepsake garment care letter and dried petals. The corset lace-up back makes sizing so forgiving and flattering."
        </p>
        <div class="review-card-bottom">
          <span class="review-piece-tag">Wore: Zoya Handloom Set</span>
          <span class="verified-pill">✓ 3rd Drop Collector</span>
        </div>
      </div>

      <!-- Review 6: Melbourne -->
      <div class="review-card">
        <div class="review-card-top">
          <div class="review-client-meta">
            <div class="review-avatar-wrap">AM</div>
            <div>
              <div class="review-name">Aayusha M.</div>
              <div class="review-location">🇦🇺 Melbourne, Victoria</div>
            </div>
          </div>
          <div class="review-stars">★★★★★</div>
        </div>
        <p class="review-quote">
          "The yellow peplum set has that effortless blend of Kathmandu tradition and European tailoring. Received countless compliments at a summer wedding in the Yarra Valley."
        </p>
        <div class="review-card-bottom">
          <span class="review-piece-tag">Wore: Pooh Peplum Co-Ord</span>
          <span class="verified-pill">✓ International Client</span>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- The Atelier & Behind The Stitches -->
<section class="atelier-section">
  <div class="container-wide">
    <div class="atelier-grid">
      
      <!-- Visual Collage -->
      <div class="atelier-collage">
        <div class="atelier-img-main">
          <img src="assets/images/atelier_crafting.jpg" alt="Kathmandu Atelier Tailoring" loading="lazy">
        </div>
        <div class="atelier-side-stack">
          <div class="atelier-img-sub">
            <img src="assets/images/founder.jpg" alt="Founder Prasuna at Atelier" loading="lazy">
          </div>
          <div class="atelier-img-sub">
            <img src="assets/images/packaging_unboxing.jpg" alt="Signature Keepsake Packaging" loading="lazy">
          </div>
        </div>

        <div class="atelier-badge-floater">
          <div class="atelier-badge-icon">🪡</div>
          <div class="atelier-badge-text">
            <strong>100% Nepali Crafted</strong>
            <span>Kathmandu • Fair Living Wages</span>
          </div>
        </div>
      </div>

      <!-- Text / Story Content -->
      <div class="atelier-content">
        <span class="section-tag">Slow Fashion Manifesto</span>
        <h2 class="section-title">Behind Every Single Stitch</h2>
        
        <blockquote class="atelier-quote">
          "Clothing shouldn't just be worn; it should hold meaning. In our atelier, every piece is touched by real hands who care about the finished seam as much as you do."
        </blockquote>

        <p style="font-size: 0.95rem; color: var(--color-muted); line-height: 1.7; margin-bottom: 20px;">
          Founded in Kathmandu, Prasuna was created as a rebellion against throwaway fast fashion. We don't believe in endless warehouses or reprinted trends. When you purchase a Prasuna silhouette, you are supporting a slow, dignified craft ecosystem where master tailors and embroiderers are celebrated as artists.
        </p>

        <ul class="features-list">
          <li class="feature-item">
            <span class="feature-check">✓</span>
            <span><strong>Zero Waste Philosophy:</strong> Every silk cutoff is repurposed into hair scrunchies and packaging ties.</span>
          </li>
          <li class="feature-item">
            <span class="feature-check">✓</span>
            <span><strong>Bespoke Proportions:</strong> Standard sizes plus free custom length and bust alterations.</span>
          </li>
          <li class="feature-item">
            <span class="feature-check">✓</span>
            <span><strong>Keepsake Experience:</strong> Delivered in recyclable boxes with dried botanicals, wax seal, and handwritten note.</span>
          </li>
        </ul>

        <a href="?page=atelier" class="btn btn-primary">
          Explore The Atelier Story &rarr;
        </a>
      </div>

    </div>
  </div>
</section>

<!-- Signature Keepsake Care Letter Section -->
<section style="padding:64px 0; background:var(--color-bg); border-top:1px solid var(--color-border); border-bottom:1px solid var(--color-border);">
  <div class="container">
    <div style="background:#EFE6DD; border:2px dashed #C8B9A6; border-radius:var(--radius-lg); padding:48px 40px; position:relative; box-shadow:var(--shadow-sm); max-width:860px; margin:0 auto;">
      <div style="position:absolute; top:-16px; right:32px; background:var(--color-crimson); color:#fff; padding:4px 16px; border-radius:var(--radius-full); font-size:0.75rem; font-weight:700; letter-spacing:0.06em; text-transform:uppercase;">
        From Our Kathmandu Atelier 🌸
      </div>

      <div style="display:grid; grid-template-columns:1.2fr 0.8fr; gap:36px; align-items:center;">
        <div>
          <h3 class="font-serif" style="font-size:1.8rem; font-style:italic; margin-bottom:14px; color:var(--color-charcoal);">
            "Hey love, Before you open this package..."
          </h3>
          <p style="font-size:0.95rem; color:var(--color-body); line-height:1.75; margin-bottom:16px;">
            Your piece is made with soft fabrics and lots of love, so please treat it gently. Wash it separately, always hand wash in cold water, avoid machine washing, dry it in the shade, and iron on low heat to keep it looking beautiful for longer.
          </p>
          <div style="font-family:var(--font-nepali); font-size:1.25rem; color:var(--color-crimson); font-weight:600;">
            With love,<br>
            प्रसूना 🪡
          </div>
        </div>

        <div style="border-radius:var(--radius-md); overflow:hidden; box-shadow:var(--shadow-md);">
          <img src="assets/images/packaging_unboxing.jpg" alt="Prasuna Packaging and Care Note" style="width:100%; height:auto; object-fit:cover;">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Shoppable Instagram Grid (@prasuna.clo) -->
<section class="instagram-section">
  <div class="container-wide">
    
    <div class="instagram-header">
      <div>
        <span class="section-tag">Community & Looks</span>
        <h2 class="section-title" style="margin-bottom:6px;">Worn By You on Instagram</h2>
        <a href="https://www.instagram.com/prasuna.clo/" target="_blank" rel="noopener" class="insta-handle">
          <span>@prasuna.clo</span>
          <span class="insta-pill">70.6K Community</span>
        </a>
      </div>
      <a href="https://www.instagram.com/prasuna.clo/" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">
        Follow on Instagram ↗
      </a>
    </div>

    <div class="instagram-grid">
      @foreach($instagram_posts as $post)
        <div class="insta-card" onclick='openStoryModal("{{ $loop->iteration % 2 === 0 ? "gulabi" : "noor" }}")'>
          <img src="{{ $post['image'] }}" alt="Instagram look by @prasuna.clo" loading="lazy">
          <div class="insta-overlay">
            <div class="insta-stats">
              <span>❤️ {{ $post['likes'] }}</span>
              <span>💬 {{ $post['comments'] }}</span>
            </div>
            @if(!empty($post['product_name']))
              <span class="insta-tag-pill">🛍️ {{ $post['product_name'] }}</span>
            @endif
          </div>
        </div>
      @endforeach
    </div>

  </div>
</section>

<!-- VIP Waitlist / Drop Radar Banner -->
<section class="newsletter-section" id="vip-newsletter-section">
  <div class="container-wide">
    <div class="newsletter-card">
      <div style="font-size:1.8rem; margin-bottom:12px;">🌸</div>
      <h2 class="newsletter-title font-serif">Get VIP Access to Drop 09</h2>
      <p class="newsletter-desc">
        Because our drops sell out quickly, VIP subscribers receive WhatsApp or email access 15 minutes before public drop launch. Strictly no spam.
      </p>

      <form class="newsletter-form" onsubmit="submitVipForm(event)">
        <input type="email" class="newsletter-input" placeholder="Enter your email or WhatsApp number" required>
        <button type="submit" class="btn btn-crimson btn-sm" style="white-space:nowrap;">
          Join Drop VIP List
        </button>
      </form>
    </div>
  </div>
</section>

@endsection
