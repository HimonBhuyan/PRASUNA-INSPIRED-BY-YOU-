@extends('layouts.app')

@section('content')

<div class="container" style="padding-top: 36px; padding-bottom: 96px;">
  
  <!-- Breadcrumbs -->
  <nav class="breadcrumb-nav">
    <a href="?page=home">Home</a> &nbsp;/&nbsp; <span>The Atelier & Story</span>
  </nav>

  <!-- Hero Story Header -->
  <div style="text-align:center; max-width:760px; margin:24px auto 64px;">
    <span class="section-tag">Slow Fashion • Kathmandu, Nepal</span>
    <h1 class="font-serif" style="font-size: clamp(2.2rem, 4vw, 3.4rem); margin: 12px 0 20px;">
      Clothing Inspired By You, <em>Crafted By Human Hands</em>.
    </h1>
    <div style="font-family:var(--font-nepali); font-size:1.2rem; color:var(--color-crimson); margin-bottom:16px;">
      प्रसूना : तपाईंको लागि मायाले बनाइएको 🌸
    </div>
    <p style="font-size:1.05rem; color:var(--color-muted); line-height:1.8;">
      Prasuna began with a simple sketch and a deep respect for Nepali craftsmanship. In a world saturated with mass industrial clothing, we craft intimate, limited drops that honor the artisan behind the thread.
    </p>
  </div>

  <!-- Big Editorial Banner -->
  <div style="border-radius:var(--radius-lg); overflow:hidden; box-shadow:var(--shadow-lg); margin-bottom:72px;">
    <img src="assets/images/atelier_crafting.jpg" alt="Kathmandu Atelier Master Tailor" style="width:100%; max-height:560px; object-fit:cover;">
  </div>

  <!-- 3 Story Pillars Grid -->
  <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:40px; margin-bottom:80px;">
    
    <div style="background:var(--color-surface); padding:32px; border-radius:var(--radius-md); border:1px solid var(--color-border); box-shadow:var(--shadow-sm);">
      <div style="font-size:2.2rem; margin-bottom:14px;">🪡</div>
      <h3 class="font-serif" style="font-size:1.35rem; margin-bottom:10px;">No Repeat Prints</h3>
      <p style="font-size:0.9rem; color:var(--color-muted); line-height:1.6;">
        When a silhouette sells out, we retire the pattern. We never over-produce or reprint for commercial hype. Each piece you own remains a rare, individual artwork.
      </p>
    </div>

    <div style="background:var(--color-surface); padding:32px; border-radius:var(--radius-md); border:1px solid var(--color-border); box-shadow:var(--shadow-sm);">
      <div style="font-size:2.2rem; margin-bottom:14px;">🌸</div>
      <h3 class="font-serif" style="font-size:1.35rem; margin-bottom:10px;">Fair Living Wages</h3>
      <p style="font-size:0.9rem; color:var(--color-muted); line-height:1.6;">
        Our Kathmandu atelier operates with fair wages, healthy daylight studios, tea breaks, flexible family schedules, and dignified medical support for all tailoring staff.
      </p>
    </div>

    <div style="background:var(--color-surface); padding:32px; border-radius:var(--radius-md); border:1px solid var(--color-border); box-shadow:var(--shadow-sm);">
      <div style="font-size:2.2rem; margin-bottom:14px;">💌</div>
      <h3 class="font-serif" style="font-size:1.35rem; margin-bottom:10px;">The Keepsake Ritual</h3>
      <p style="font-size:0.9rem; color:var(--color-muted); line-height:1.6;">
        Opening a Prasuna parcel is an emotional experience: hand-wrapped blush tissue, dried Himalayan botanical sprigs, wax stamped seals, and a handwritten note from our founder.
      </p>
    </div>

  </div>

  <!-- Founder Feature Section -->
  <div style="display:grid; grid-template-columns: 1fr 1fr; gap:60px; align-items:center; background:var(--color-surface-subtle); border-radius:var(--radius-lg); padding:56px; margin-bottom:80px;">
    <div>
      <span class="section-tag">A Note From Our Founder</span>
      <h2 class="font-serif" style="font-size:2.2rem; margin:8px 0 16px;">"You Made Prasuna Happen"</h2>
      
      <p style="font-size:0.95rem; color:var(--color-body); line-height:1.7; margin-bottom:16px;">
        "When I posted our very first Gulabi slit kurti on Instagram, I never imagined that women from Sydney to Dallas, London to Kathmandu would feel so seen in our designs.
      </p>

      <p style="font-size:0.95rem; color:var(--color-body); line-height:1.7; margin-bottom:24px;">
        Prasuna isn't just about clothes; it's about celebrating who you are right now. No rigid standards, no discomfort — just flowing silk, thoughtful tailoring, and modern South Asian pride."
      </p>

      <div style="display:flex; align-items:center; gap:16px;">
        <div style="width:48px; height:48px; border-radius:50%; overflow:hidden; border:2px solid var(--color-crimson);">
          <img src="assets/images/founder.jpg" alt="Founder" style="width:100%; height:100%; object-fit:cover;">
        </div>
        <div>
          <div style="font-weight:700; color:var(--color-charcoal);">Prasuna</div>
          <div style="font-size:0.78rem; color:var(--color-muted);">Founder & Creative Director • @prasuna.clo</div>
        </div>
      </div>
    </div>

    <div>
      <div style="border-radius:var(--radius-md); overflow:hidden; box-shadow:var(--shadow-md); aspect-ratio:4/3;">
        <img src="assets/images/founder.jpg" alt="Founder Prasuna smiling in Kathmandu studio" style="width:100%; height:100%; object-fit:cover;">
      </div>
    </div>
  </div>

  <!-- Unboxing & Packaging Showcase -->
  <div style="display:grid; grid-template-columns: 1fr 1.1fr; gap:56px; align-items:center;">
    <div>
      <div style="border-radius:var(--radius-md); overflow:hidden; box-shadow:var(--shadow-md);">
        <img src="assets/images/packaging_unboxing.jpg" alt="Prasuna Luxury Packaging Experience" style="width:100%; height:auto; object-fit:cover;">
      </div>
    </div>

    <div>
      <span class="section-tag">Unboxing The Drop</span>
      <h2 class="font-serif" style="font-size:2.2rem; margin:8px 0 16px;">Every Parcel is a Love Letter</h2>
      <p style="font-size:0.95rem; color:var(--color-muted); line-height:1.7; margin-bottom:20px;">
        We believe the experience of dressing begins the second your courier arrives. Every Prasuna piece is protected in archival tissue paper, tied with recycled silk ribbon, stamped with our botanical wax seal, and accompanied by a personal message.
      </p>
      
      <div class="btn-group">
        <a href="?page=shop" class="btn btn-primary">
          Explore Current Silhouettes &rarr;
        </a>
        <button class="btn btn-secondary" onclick="openStoryModal('loves')">
          View Packaging Story Reel
        </button>
      </div>
    </div>
  </div>

</div>

@endsection
