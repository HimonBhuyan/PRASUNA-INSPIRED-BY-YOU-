@extends('layouts.app')

@section('content')

<div class="container-wide" style="padding-top: 36px; padding-bottom: 96px;">
  
  <!-- Breadcrumbs -->
  <nav class="breadcrumb-nav">
    <a href="?page=home">Home</a> &nbsp;/&nbsp; <span>The Drops Calendar</span>
  </nav>

  <!-- Header -->
  <div style="text-align:center; max-width:720px; margin:24px auto 64px;">
    <span class="section-tag">Archive & Calendar</span>
    <h1 class="font-serif" style="font-size: clamp(2.2rem, 4vw, 3.2rem); margin: 12px 0 16px;">
      The Prasuna Drop Architecture
    </h1>
    <p style="font-size:1rem; color:var(--color-muted); line-height:1.7;">
      Instead of mass seasons, we release tightly curated micro-capsules. Once a drop is archived, the print is retired forever.
    </p>
  </div>

  <!-- Drops Grid -->
  <div class="drop-cards-grid" style="margin-bottom:80px;">
    @foreach($drops as $d)
      <div class="drop-card">
        <div class="drop-media">
          <span class="drop-number-badge">DROP {{ $d['number'] }}</span>
          <span class="drop-status-badge {{ $d['status'] === 'Live Now' ? 'status-live' : ($d['status'] === 'Limited Stock' ? 'status-limited' : 'status-waitlist') }}">
            {{ $d['status'] }}
          </span>
          <img src="{{ $d['image'] }}" alt="{{ $d['title'] }}">
        </div>
        <div class="drop-body">
          <div class="drop-pieces">{{ $d['pieces'] }} • {{ $d['date'] }}</div>
          <h3 class="drop-title">{{ $d['title'] }}</h3>
          <div style="font-family:var(--font-nepali); color:var(--color-muted); font-size:0.86rem; margin-bottom:12px;">{{ $d['nepali_title'] }}</div>
          <p class="drop-text">{{ $d['tagline'] }}</p>
          
          @if($d['status'] === 'Live Now')
            <a href="?page=shop" class="btn btn-crimson btn-sm">Shop Remaining Pieces</a>
          @elseif($d['status'] === 'Limited Stock')
            <a href="?page=shop" class="btn btn-secondary btn-sm">View Last Pieces</a>
          @else
            <button class="btn btn-primary btn-sm" onclick="document.getElementById('vip-form-box').scrollIntoView({behavior:'smooth'})">
              Request VIP Early Access
            </button>
          @endif
        </div>
      </div>
    @endforeach
  </div>

  <!-- VIP Drop Notification Box -->
  <div id="vip-form-box" class="vip-banner-box">
    <div style="font-size:2.2rem; margin-bottom:12px;">🌸</div>
    <h2 class="font-serif" style="color:#fff; font-size:clamp(1.6rem, 4vw, 2.2rem); margin-bottom:12px;">Be the First Through The Doors</h2>
    <p style="color:#B3ADA7; font-size:0.95rem; max-width:540px; margin:0 auto 28px; line-height:1.6;">
      Drop 09 (Winter Velvet Heirlooms) will be strictly limited to 30 pieces worldwide. Enter your email or WhatsApp to receive private shopping access 15 minutes ahead of social media release.
    </p>

    <form class="newsletter-form" onsubmit="submitVipForm(event)">
      <input type="text" class="newsletter-input" placeholder="Your WhatsApp or Email" required>
      <button type="submit" class="btn btn-crimson btn-sm">
        Register for Drop 09
      </button>
    </form>
  </div>

</div>

@endsection
