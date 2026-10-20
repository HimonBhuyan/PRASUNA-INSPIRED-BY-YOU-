@php
    $currency = $currency ?? 'NPR';
@endphp

<article class="product-card" data-category="{{ $product['category'] }}" data-id="{{ $product['id'] }}">
  <div class="product-media">
    <div class="product-badges-stack">
      @if(!empty($product['remaining_stock']) && $product['remaining_stock'] <= 5)
        <span class="badge-stock">Only {{ $product['remaining_stock'] }} Left</span>
      @elseif(!empty($product['badge']))
        <span class="badge-stock">{{ $product['badge'] }}</span>
      @endif

      @if(!empty($product['tag']))
        <span class="badge-tag">{{ $product['tag'] }}</span>
      @endif
    </div>

    <a href="?page=product&id={{ $product['id'] }}" class="product-media-link" onclick="if(window.innerWidth <= 768) { event.preventDefault(); openQuickView({!! json_encode($product, JSON_HEX_APOS | JSON_HEX_QUOT) !!}); }">
      <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="primary-img" loading="lazy">
      <img src="{{ $product['hover_image'] ?? $product['image'] }}" alt="{{ $product['name'] }}" class="hover-img" loading="lazy">
    </a>

    <!-- Overlay Actions -->
    <div class="product-overlay-actions">
      <button type="button" class="overlay-btn overlay-btn-qv" onclick='openQuickView({!! json_encode($product, JSON_HEX_APOS | JSON_HEX_QUOT) !!})'>
        Quick View
      </button>
      <button type="button" class="overlay-btn overlay-btn-dark overlay-btn-add" onclick='addToCart({
        id: "{{ $product['id'] }}",
        name: "{{ addslashes($product['name']) }}",
        color: "{{ addslashes($product['colors'][0]['name'] ?? 'Default') }}",
        size: "S",
        price_npr: {{ $product['price_npr'] }},
        image: "{{ $product['image'] }}",
        qty: 1
      })'>
        + Quick Add
      </button>
    </div>
  </div>

  <div class="product-info">
    <div class="product-meta-row">
      <span class="product-drop-tag">{{ $product['drop'] }}</span>
      @if(!empty($product['rating']))
        <span style="display:flex; align-items:center; gap:3px; color:var(--color-gold); font-size:0.75rem;">
          ★ {{ $product['rating'] }} ({{ $product['reviews_count'] }})
        </span>
      @endif
    </div>

    <h3 class="product-title">
      <a href="?page=product&id={{ $product['id'] }}">{{ $product['name'] }}</a>
    </h3>

    @if(!empty($product['nepali_name']))
      <div class="product-nepali-title">{{ $product['nepali_name'] }}</div>
    @endif

    <div class="product-bottom-row">
      <div class="product-price" data-price-npr="{{ $product['price_npr'] }}">
        {{ \App\Helpers::formatPrice($product['price_npr'], $currency) }}
      </div>

      @if(!empty($product['colors']))
        <div class="color-swatches" title="{{ count($product['colors']) }} colors available">
          @foreach($product['colors'] as $c)
            <span class="color-swatch" style="background-color: {{ $c['hex'] }};" title="{{ $c['name'] }}"></span>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</article>
