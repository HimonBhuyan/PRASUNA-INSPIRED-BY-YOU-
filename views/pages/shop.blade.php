@extends('layouts.app')

@section('content')

<div class="container-wide" style="padding-top: 24px; padding-bottom: 80px;">
  
  <!-- Breadcrumbs -->
  <nav class="breadcrumb-nav">
    <a href="?page=home">Home</a> &nbsp;/&nbsp; <span>Silhouettes & Drops</span>
  </nav>

  <!-- Page Header -->
  <div style="margin-bottom: 36px; display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:20px;">
    <div>
      <span class="section-tag">Limited Edition Releases</span>
      <h1 class="font-serif" style="font-size:2.6rem; margin-top:4px;">All Handcrafted Silhouettes</h1>
      <p style="color:var(--color-muted); font-size:0.95rem; margin-top:6px;">
        Curated micro-batches. Once an edition is retired, it will never be reprinted.
      </p>
    </div>

    <div style="display:flex; align-items:center; gap:12px;">
      <button class="btn btn-secondary btn-sm" onclick="openSizeGuideModal()">
        📏 Measurement Guide
      </button>
      <button class="btn btn-secondary btn-sm" onclick="openCustomMeasureModal()">
        🪡 Custom Fit Order
      </button>
    </div>
  </div>

  <!-- Filter & Sort Bar -->
  <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid var(--color-border); border-bottom:1px solid var(--color-border); padding:16px 0; margin-bottom:36px; flex-wrap:wrap; gap:16px;">
    
    <!-- Category Pills -->
    <div class="category-tabs" style="margin-bottom:0; padding:0;">
      <button class="tab-btn active" onclick="filterCategory('All', this)">All ({{ count($products) }})</button>
      <button class="tab-btn" onclick="filterCategory('Mul Cotton & Applique', this)">Mul Cotton & Applique</button>
      <button class="tab-btn" onclick="filterCategory('Camisole Tunics', this)">Camisole Tunics</button>
      <button class="tab-btn" onclick="filterCategory('Festive Sets', this)">Festive Sets</button>
      <button class="tab-btn" onclick="filterCategory('Heirloom Sets', this)">Heirloom Sets</button>
      <button class="tab-btn" onclick="filterCategory('Co-Ords', this)">Co-Ords & Handlooms</button>
    </div>

    <!-- Active Drop Tag -->
    <div style="font-size:0.82rem; color:var(--color-muted);">
      Showing <strong style="color:var(--color-charcoal);">Drop 08 (Festive) & Drop 07</strong>
    </div>

  </div>

  <!-- Products Grid -->
  <div class="product-grid">
    @foreach($products as $product)
      @include('components.product-card', ['product' => $product, 'currency' => $currency])
    @endforeach
  </div>

  <!-- Made to Measure Banner -->
  <div style="margin-top: 80px; background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-lg); padding:48px; text-align:center; box-shadow:var(--shadow-sm);">
    <div style="font-size:2rem; margin-bottom:12px;">🌸</div>
    <h2 class="font-serif" style="font-size:1.8rem; margin-bottom:10px;">Cannot Find Your Exact Size?</h2>
    <p style="max-width:540px; margin:0 auto 24px; color:var(--color-muted); font-size:0.92rem; line-height:1.6;">
      At Prasuna, we celebrate every body. Our Kathmandu studio tailors bespoke proportions for bust, waist, hip, and tunic length at zero additional cost.
    </p>
    <button class="btn btn-crimson" onclick="openCustomMeasureModal()">
      Submit Your Measurements for Custom Tailoring
    </button>
  </div>

</div>

@endsection
