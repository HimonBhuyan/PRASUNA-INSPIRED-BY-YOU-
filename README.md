# PRASUNA (प्रसूना) • Luxury Himalayan Slow Fashion & Limited Drops

A modern, high-converting boutique e-commerce demo website crafted for **Prasuna** ([@prasuna.clo](https://www.instagram.com/prasuna.clo/) / Prasuna.np).

Built with **PHP 8.3 & Laravel Blade Engine (`illuminate/view`)**, featuring editorial luxury aesthetics, limited drop mechanics, multi-currency switching, interactive story highlights, made-to-measure customization, slide-out shopping bag, and express checkout.

---

## 🌸 Brand Highlights & Concept

- **Brand Inspiration**: Inspired directly by [@prasuna.clo](https://www.instagram.com/prasuna.clo/) — Nepali slow fashion label with a 70.6K+ community.
- **Core Philosophy**: *"No Repeat Prints | Limited Drops | Handmade For You 🌸"*
- **Atelier**: Handcrafted in Kathmandu with fair artisan wages, pure raw silks, and featherlight mul cotton.
- **Global Reach**: Worldwide Express Shipping with currency toggles for NPR (Rs.), USD ($), AUD (A$), GBP (£), EUR (€), and INR (₹).

---

## 🛠️ Tech Stack & Architecture

- **Templating Engine**: Laravel Blade (`illuminate/view` v11) with component architecture (`@extends`, `@include`, `@yield`).
- **Styling**: Tailored Vanilla CSS design system with CSS custom properties, Google Fonts (*Playfair Display*, *Italiana*, *Plus Jakarta Sans*, *Mukta*), glassmorphic navbars, and micro-animations.
- **JavaScript**: Zero-dependency vanilla JS engine managing cart state (`localStorage`), currency conversion, countdown timer, story highlights modal, and checkout discounts.
- **Backend / Routing**: Lightweight, clean PHP router (`index.php`), `app/BladeEngine.php`, and serverless entrypoint (`api/index.php`).

---

## ✨ Features Included

1. **Editorial Hero Section**:
   - Live drop countdown clock (`Drop 08 closes in 02d 14h 35m 12s`).
   - High-fashion hero imagery with floating product badge.
   - Dual CTAs: *Shop Drop 08* and *Our Story & Atelier*.
2. **Instagram Stories Row (Highlights)**:
   - Story rings for `✨ Suhani Set ✨`, `✨ Saya Mul Cotton ✨`, `✨ Zoya Handloom ✨`, `✨ Gulabi ✨`, `✨ Noor ✨`, `✨ Pooh Set ✨`, and `✨ Loves (Care) ✨`.
   - Clicking opens an interactive Instagram-style reel viewer modal with captions & songs.
3. **Curated Product Collections & Silhouettes**:
   - **Suhani Set** (Pure mul cotton, floral applique, glass beadwork, flared bell sleeves & lace-up corset back).
   - **Saya Mul Cotton** (Corset-inspired fit with a voluminous tiered sharara for Dashain).
   - **Zoya Handloom Set** (Marigold sun & terracotta traditional Nepali weave with tie-back waist & cigarette pants).
   - **Gulabi Front-Slit Set** (Iconic raw silk with zardozi in Olive Antique Gold and Dusty Rose Pink).
   - **Noor Mirrorwork Kurti** (Radiant Rani Fuchsia with Patan mirrorwork).
   - **Pooh Peplum & Dhoti** (Marigold Sun and Lavender Shimmer editions).
   - **Suhari Pristine Ivory** (Hand-spun mulberry raw silk with pure scalloped organza dupatta).
   - **Lila Sage Co-Ord** (Pastel linen-silk with back bow tie).
   - Filter tabs: *All Silhouettes*, *Mul Cotton & Applique*, *Camisole Tunics*, *Festive Sets*, *Heirloom Sets*, *Co-Ords & Handlooms*.
4. **Signature Keepsake Packaging & Care Letter**:
   - Replicates the viral customer care note: *"Hey love, Before you open this package... Your piece is made with soft fabrics and lots of love, so please treat it gently. With love, प्रसूना 🌸"*.
5. **Interactive Quick View & Sizing**:
   - Size selection (`XS`, `S`, `M`, `L`, `XL`, and `Custom Fit`).
   - Detailed Measurement Guide modal (Inches & CM for Bust, Waist, Hip, Kurti length).
   - Custom Tailor Modal: enter personal measurements for zero-fee bespoke tailoring.
6. **Slide-out Shopping Bag (Cart Drawer)**:
   - Dynamic Free Worldwide Express Shipping progress bar ($150 / NPR 20,000 threshold).
   - Quantity increments, item removal, and persistent `localStorage` cart.
7. **Express Checkout Flow**:
   - Contact details, country-specific shipping (Nepal Local, USA, Australia, UK, Canada, India).
   - Payment options: **Khalti**, **eSewa**, **Credit/Debit Cards**, and **Cash on Delivery**.
   - Promo code field with support for **`PRASUNA10`** (10% discount).
   - Order reservation confirmation screen with order reference number.
8. **The Drops Calendar & Archive**:
   - History of past drops and waitlist registration for upcoming *Drop 09: Winter Velvet*.
9. **The Atelier & Founder Story**:
   - Behind the scenes at the Kathmandu workshop, ethical artisan wages, zero-waste silk cutoffs, and signature keepsake packaging.

---

## 🚀 Deployment & Running

### Option 1: Deploy to Vercel (1-Click Ready)
This repository is pre-configured for **Vercel** serverless PHP deployment:
1. Go to [vercel.com/new](https://vercel.com/new).
2. Import this repository: **`HimonBhuyan/PRASUNA-INSPIRED-BY-YOU-`**.
3. Keep default settings:
   - Framework Preset: **Other**
   - Root Directory: `./`
4. Click **Deploy**!
   - Runtime: `vercel-php@0.7.0` (PHP 8.3) configured in `vercel.json`.
   - Entrypoint: `api/index.php`.
   - Writable cache: Automatically routes compiled Blade views to `/tmp/prasuna_cache`.

### Option 2: PHP Built-in Server
```bash
cd "C:\xampp\htdocs\Pursana Drops"
php -S localhost:8000
```
Open **[http://localhost:8000](http://localhost:8000)** in your browser.

### Option 3: XAMPP Apache
Start Apache from the XAMPP Control Panel, then navigate to:
**[http://localhost/Pursana%20Drops/](http://localhost/Pursana%20Drops/)**

---

© Prasuna (प्रसूना) • Handmade for you 🌸
