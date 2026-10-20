@extends('layouts.app')

@section('content')

<div class="container-wide">
  
  <!-- Breadcrumbs -->
  <nav class="breadcrumb-nav">
    <a href="?page=home">Home</a> &nbsp;/&nbsp; 
    <a href="?page=shop">Silhouettes</a> &nbsp;/&nbsp; 
    <span>{{ $product['name'] }}</span>
  </nav>

  <!-- Product Detail Grid -->
  <div class="product-detail-grid">
    
    <!-- Image Gallery -->
    <div class="detail-gallery">
      <div class="thumb-strip">
        @foreach($product['gallery'] as $idx => $img)
          <button type="button" class="thumb-btn {{ $idx === 0 ? 'active' : '' }}" onclick="switchDetailImage('{{ $img }}', this)">
            <img src="{{ $img }}" alt="{{ $product['name'] }} view {{ $idx + 1 }}">
          </button>
        @endforeach
      </div>

      <div class="main-preview">
        <img id="detail-main-img" src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
      </div>
    </div>

    <!-- Product Info / Ordering Column -->
    <div class="detail-info">
      <div>
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
          <span class="badge-stock" style="position:static;">{{ $product['drop'] }}</span>
          @if($product['remaining_stock'] <= 5)
            <span class="pill-badge" style="background:#B32638;">Only {{ $product['remaining_stock'] }} Left</span>
          @endif
        </div>

        <h1 class="detail-title font-serif">{{ $product['name'] }}</h1>
        
        @if(!empty($product['nepali_name']))
          <div style="font-family:var(--font-nepali); font-size:1.1rem; color:var(--color-muted); margin-top:2px;">
            {{ $product['nepali_name'] }}
          </div>
        @endif

        <div class="detail-price" data-price-npr="{{ $product['price_npr'] }}" style="margin-top:14px;">
          {{ \App\Helpers::formatPrice($product['price_npr'], $currency) }}
        </div>
      </div>

      <p style="font-size:0.95rem; color:var(--color-body); line-height:1.7;">
        {{ $product['description'] }}
      </p>

      <!-- Color Swatch Picker -->
      @if(!empty($product['colors']))
        <div>
          <div class="variant-picker-label">
            <span>Colorway: <strong id="selected-color-label">{{ $product['colors'][0]['name'] }}</strong></span>
          </div>
          <div style="display:flex; gap:12px;">
            @foreach($product['colors'] as $idx => $color)
              <button type="button" class="color-swatch {{ $idx === 0 ? 'active' : '' }}" 
                      style="width:28px; height:28px; background-color:{{ $color['hex'] }}; border:2px solid {{ $idx === 0 ? 'var(--color-charcoal)' : 'transparent' }}; border-radius:50%;" 
                      title="{{ $color['name'] }}"
                      onclick="selectDetailColor(this, '{{ $color['name'] }}', '{{ $color['image'] }}')">
              </button>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Size Selector -->
      <div>
        <div class="variant-picker-label">
          <span>Select Size: <strong id="selected-size-label">S</strong></span>
          <button type="button" onclick="openSizeGuideModal()" style="font-size:0.75rem; text-decoration:underline; color:var(--color-crimson);">
            Size Guide & Measurements
          </button>
        </div>
        <div class="size-pill-group">
          @foreach($product['sizes'] as $idx => $s)
            <button type="button" class="size-pill {{ $idx === 1 ? 'active' : '' }} {{ str_contains($s, 'Custom') ? 'custom-pill' : '' }}" 
                    onclick="selectDetailSize(this, '{{ $s }}')">
              {{ $s }}
            </button>
          @endforeach
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="product-actions-group">
        <button type="button" class="btn btn-crimson" style="flex:2;" onclick="addCurrentProductToBag()">
          Add To Shopping Bag
        </button>
        <button type="button" class="btn btn-secondary" style="flex:1;" onclick="addCurrentProductToBag(); window.location.href='?page=checkout';">
          Buy Now
        </button>
      </div>

      <!-- Trust Badges -->
      <div class="product-trust-badges">
        <div>🌸 <strong>No Repeat Prints</strong> — Strictly limited run</div>
        <div>🪡 <strong>Made in Kathmandu</strong> — Ethical artisan wages</div>
        <div>📦 <strong>Signature Keepsake Box</strong> — Wax seal & note</div>
        <div>✈️ <strong>Worldwide Express</strong> — 3-7 day tracked delivery</div>
      </div>

      <!-- Accordion Details -->
      <div class="detail-accordion">
        <div class="accordion-item">
          <div class="accordion-trigger" onclick="toggleAccordion(this)">
            <span>Fabric & Composition</span>
            <span>+</span>
          </div>
          <div class="accordion-content">
            {{ $product['fabric'] }}
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-trigger" onclick="toggleAccordion(this)">
            <span>Artisanal Craftsmanship</span>
            <span>+</span>
          </div>
          <div class="accordion-content">
            {{ $product['craftsmanship'] }}
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-trigger" onclick="toggleAccordion(this)">
            <span>Garment Care</span>
            <span>+</span>
          </div>
          <div class="accordion-content">
            {{ $product['care'] }}
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Related Recommendations -->
  <div style="margin-top:60px; padding-top:40px; border-top:1px solid var(--color-border);">
    <div class="section-header">
      <span class="section-tag">Complete The Ensemble</span>
      <h2 class="section-title">You May Also Cherish</h2>
    </div>

    <div class="product-grid">
      @foreach($related as $rel)
        @include('components.product-card', ['product' => $rel, 'currency' => $currency])
      @endforeach
    </div>
  </div>

  <!-- Sticky Quick-Add Bar on Scroll -->
  <aside class="sticky-quick-bar" id="sticky-quick-bar" aria-label="Quick Add to Bag Bar">
    <div class="container-wide">
      <div class="sticky-bar-inner">
        <div class="sticky-product-meta">
          <div class="sticky-thumb">
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" id="sticky-bar-thumb">
          </div>
          <div>
            <div class="sticky-title">{{ $product['name'] }}</div>
            <div class="sticky-price" data-price-npr="{{ $product['price_npr'] }}">
              {{ \App\Helpers::formatPrice($product['price_npr'], $currency) }}
            </div>
          </div>
        </div>

        <div class="sticky-actions-group">
          <select class="sticky-size-select" id="sticky-size-picker" onchange="syncStickySize(this.value)">
            @foreach($product['sizes'] as $s)
              <option value="{{ $s }}" {{ $s === 'S' ? 'selected' : '' }}>Size: {{ $s }}</option>
            @endforeach
          </select>
          <button type="button" class="btn btn-crimson btn-sm" onclick="addCurrentProductToBag()" style="white-space:nowrap;">
            + Add To Bag
          </button>
        </div>
      </div>
    </div>
  </aside>

</div>

<script>
  let activeDetailProduct = @json($product);
  let chosenDetailSize = 'S';
  let chosenDetailColor = activeDetailProduct.colors && activeDetailProduct.colors[0] ? activeDetailProduct.colors[0].name : 'Default';

  function switchDetailImage(src, btn) {
    document.getElementById('detail-main-img').src = src;
    const stickyThumb = document.getElementById('sticky-bar-thumb');
    if (stickyThumb) stickyThumb.src = src;
    document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');
  }

  function selectDetailColor(btn, colorName, imgSrc) {
    chosenDetailColor = colorName;
    document.getElementById('selected-color-label').textContent = colorName;
    document.querySelectorAll('.color-swatch').forEach(s => s.style.borderColor = 'transparent');
    btn.style.borderColor = 'var(--color-charcoal)';
    if (imgSrc) {
      document.getElementById('detail-main-img').src = imgSrc;
      const stickyThumb = document.getElementById('sticky-bar-thumb');
      if (stickyThumb) stickyThumb.src = imgSrc;
    }
  }

  function selectDetailSize(btn, size) {
    chosenDetailSize = size;
    document.getElementById('selected-size-label').textContent = size;
    document.querySelectorAll('.size-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');

    const picker = document.getElementById('sticky-size-picker');
    if (picker) picker.value = size;

    if (size.includes('Custom')) {
      openCustomMeasureModal();
    }
  }

  function syncStickySize(sz) {
    chosenDetailSize = sz;
    const pills = document.querySelectorAll('.size-pill');
    pills.forEach(p => {
      if (p.textContent.trim() === sz) {
        p.classList.add('active');
      } else {
        p.classList.remove('active');
      }
    });
    document.getElementById('selected-size-label').textContent = sz;
    if (sz.includes('Custom')) {
      openCustomMeasureModal();
    }
  }

  function addCurrentProductToBag() {
    addToCart({
      id: activeDetailProduct.id,
      name: activeDetailProduct.name,
      color: chosenDetailColor,
      size: chosenDetailSize,
      price_npr: activeDetailProduct.price_npr,
      image: document.getElementById('detail-main-img').src,
      qty: 1
    });
  }

  function toggleAccordion(trigger) {
    const content = trigger.nextElementSibling;
    const icon = trigger.querySelector('span:last-child');
    if (content.style.display === 'block') {
      content.style.display = 'none';
      icon.textContent = '+';
    } else {
      content.style.display = 'block';
      icon.textContent = '−';
    }
  }

  // Scroll listener for Sticky Quick-Add Bar
  window.addEventListener('scroll', () => {
    const bar = document.getElementById('sticky-quick-bar');
    if (!bar) return;
    if (window.scrollY > 380) {
      bar.classList.add('visible');
    } else {
      bar.classList.remove('visible');
    }
  });
</script>

@endsection
