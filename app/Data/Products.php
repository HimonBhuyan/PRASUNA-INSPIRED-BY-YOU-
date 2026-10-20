<?php

namespace App\Data;

class Products
{
    public static function getAll(): array
    {
        return [
            [
                'id' => 'suhani-corset-set',
                'name' => 'Suhani Mul Cotton Applique & Corset Set',
                'nepali_name' => 'सुहानी मलमल सेट (घन्टी बाहुला)',
                'drop' => 'Drop 08 • The Festive Edit',
                'tag' => 'Instagram Viral',
                'is_limited' => true,
                'remaining_stock' => 3,
                'price_npr' => 11800,
                'price_usd' => 89,
                'category' => 'Mul Cotton & Applique',
                'badge' => 'High Demand',
                'image' => 'assets/images/suhani_lilac.jpg',
                'hover_image' => 'assets/images/suhani_corset_back.jpg',
                'gallery' => [
                    'assets/images/suhani_lilac.jpg',
                    'assets/images/suhani_corset_back.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Blush Lilac & Ivory', 'hex' => '#E8D3DC', 'image' => 'assets/images/suhani_lilac.jpg'],
                    ['name' => 'Pistachio Lime & Yellow Applique', 'hex' => '#D5E4A2', 'image' => 'assets/images/suhani_corset_back.jpg'],
                    ['name' => 'Sky Blue Breeze', 'hex' => '#BCE0F0', 'image' => 'assets/images/suhani_lilac.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'If you ask us what is so special about this piece: we used ultra-fine pure mul cotton with hand-cut floral applique, delicate glass beadwork, and romantic flowing flared bell sleeves. The back features an artisanal lace-up corset with criss-cross ties, paired with breezy relaxed trousers.',
                'fabric' => '100% Breathable Mul Cotton with Sheer Organza Bell Sleeve Details and Soft Cotton Lining.',
                'craftsmanship' => 'Hand-cut floral applique and delicate beadwork embroidered by female artisans in Kathmandu. Corset lace-up back allows customized body cinching.',
                'care' => 'Hey love, please treat it gently. Always hand wash in cold water separately, avoid machine washing, dry in shade, and iron on low heat.',
                'rating' => 5.0,
                'reviews_count' => 112
            ],
            [
                'id' => 'saya-mul-cotton',
                'name' => 'Saya Mul Cotton Corset & Tiered Sharara',
                'nepali_name' => 'साया मलमल कोर्सेट र शरारा',
                'drop' => 'Drop 08 • The Festive Edit',
                'tag' => 'Dashain Special',
                'is_limited' => true,
                'remaining_stock' => 4,
                'price_npr' => 13200,
                'price_usd' => 98,
                'category' => 'Mul Cotton & Applique',
                'badge' => 'Only 4 Left',
                'image' => 'assets/images/saya_mul_cotton.jpg',
                'hover_image' => 'assets/images/saya_mul_cotton.jpg',
                'gallery' => [
                    'assets/images/saya_mul_cotton.jpg',
                    'assets/images/atelier_crafting.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Pristine Cloud White', 'hex' => '#FBFBFA', 'image' => 'assets/images/saya_mul_cotton.jpg'],
                    ['name' => 'Buttercream Ivory', 'hex' => '#F6F1E3', 'image' => 'assets/images/saya_mul_cotton.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'Made from pure mul cotton, this silhouette is soft, lightweight, and breathable — perfect for festive days when you want to feel relaxed while looking effortlessly elegant. The corset-inspired fit hugs the torso beautifully, paired with a voluminous flowy sharara for romantic motion.',
                'fabric' => 'Pure Feather-Light Mul Cotton with Fine Pintuck Detailing.',
                'craftsmanship' => 'Precision patterned corset bust with vertical micro-pintucks, crafted in our Kathmandu atelier with soft cotton voile lining.',
                'care' => 'Hand wash in cold water with mild detergent. Iron on gentle heat.',
                'rating' => 4.9,
                'reviews_count' => 78
            ],
            [
                'id' => 'zoya-handloom',
                'name' => 'Zoya Handloom Tie-Back Tunic & Pant Set',
                'nepali_name' => 'जोया ह्यान्डलूम सेट',
                'drop' => 'Drop 07 • Contemporary Co-Ords',
                'tag' => 'Artisanal Weave',
                'is_limited' => true,
                'remaining_stock' => 5,
                'price_npr' => 9800,
                'price_usd' => 75,
                'category' => 'Co-Ords',
                'badge' => 'Handloom',
                'image' => 'assets/images/zoya_handloom.jpg',
                'hover_image' => 'assets/images/zoya_handloom.jpg',
                'gallery' => [
                    'assets/images/zoya_handloom.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Marigold Sun & Terracotta', 'hex' => '#E8972C', 'image' => 'assets/images/zoya_handloom.jpg'],
                    ['name' => 'Ivory Crisp Pant', 'hex' => '#F4F2EC', 'image' => 'assets/images/zoya_handloom.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'Woven on traditional Nepali handlooms with organic sunburst yellow yarn. Cut into a sleeveless longline tunic with high side slits, a matching cinch belt tie, and tailored white cigarette trousers.',
                'fabric' => '100% Pure Handloom Woven Cotton.',
                'craftsmanship' => 'Hand-spun yarn woven by heritage weaving collectives in Bhaktapur.',
                'care' => 'Hand wash separately in cold water.',
                'rating' => 4.8,
                'reviews_count' => 49
            ],
            [
                'id' => 'gulabi-set',
                'name' => 'Gulabi Embroidered Front-Slit Set (Olive Gold)',
                'nepali_name' => 'गुलाबी सेट (ओलिभ गोल्ड)',
                'drop' => 'Drop 08 • The Festive Edit',
                'tag' => 'Iconic Bestseller',
                'is_limited' => true,
                'remaining_stock' => 4,
                'price_npr' => 14500,
                'price_usd' => 110,
                'category' => 'Camisole Tunics',
                'badge' => 'High Demand',
                'image' => 'assets/images/hero_festive.jpg',
                'hover_image' => 'assets/images/gulabi_rose.jpg',
                'gallery' => [
                    'assets/images/hero_festive.jpg',
                    'assets/images/gulabi_rose.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Olive Antique Gold', 'hex' => '#7B7A42', 'image' => 'assets/images/hero_festive.jpg'],
                    ['name' => 'Dusty Rose Pink', 'hex' => '#C98B92', 'image' => 'assets/images/gulabi_rose.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'The celebrated Prasuna signature silhouette. Crafted from lustrous hand-spun raw silk featuring delicate golden zardozi embroidery and sequin floral vines. Designed with a structured sweetheart neckline, adjustable spaghetti straps, and a dramatic front slit revealing high-waisted flowing silk palazzo trousers.',
                'fabric' => '100% Handloom Raw Silk Top with Pure Silk Crepe Lining and Flowing Modal Satin Trousers.',
                'craftsmanship' => 'Hand-cut and stitched by master tailors in our Kathmandu atelier. Over 18 hours of hand-guided zardozi and sequin embroidery per piece.',
                'care' => 'Dry clean only. Store wrapped in muslin cloth away from direct sunlight.',
                'rating' => 4.9,
                'reviews_count' => 134
            ],
            [
                'id' => 'gulabi-rose-edition',
                'name' => 'Gulabi Rose Gold Embroidered Slit Kurti',
                'nepali_name' => 'गुलाबी रोज गोल्ड',
                'drop' => 'Drop 08 • The Festive Edit',
                'tag' => 'Exclusive Restock',
                'is_limited' => true,
                'remaining_stock' => 2,
                'price_npr' => 14500,
                'price_usd' => 110,
                'category' => 'Camisole Tunics',
                'badge' => 'Almost Gone',
                'image' => 'assets/images/gulabi_rose.jpg',
                'hover_image' => 'assets/images/hero_festive.jpg',
                'gallery' => [
                    'assets/images/gulabi_rose.jpg',
                    'assets/images/hero_festive.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Dusty Rose Pink', 'hex' => '#C98B92', 'image' => 'assets/images/gulabi_rose.jpg'],
                    ['name' => 'Olive Antique Gold', 'hex' => '#7B7A42', 'image' => 'assets/images/hero_festive.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'The ethereal dusty rose colorway of our celebrated Gulabi set. Rich golden floral embroidery frames the sweetheart neckline and cascades down the front slit. Tailored to perfection for festive evenings, destination weddings, and Dashain-Tihar gatherings.',
                'fabric' => 'Raw Silk Top with Pure Silk Crepe Lining.',
                'craftsmanship' => 'Handcrafted by Nepali master embroiderers with genuine micro-sequins and bullion gold wire.',
                'care' => 'Dry clean only.',
                'rating' => 5.0,
                'reviews_count' => 96
            ],
            [
                'id' => 'noor-set',
                'name' => 'Noor Fuchsia Mirrorwork Kurti Set',
                'nepali_name' => 'नूर सेट (रानी गुलाबी)',
                'drop' => 'Drop 08 • The Festive Edit',
                'tag' => 'Festive Favorite',
                'is_limited' => true,
                'remaining_stock' => 6,
                'price_npr' => 12800,
                'price_usd' => 95,
                'category' => 'Festive Sets',
                'badge' => 'Limited Drop',
                'image' => 'assets/images/noor_fuchsia.jpg',
                'hover_image' => 'assets/images/noor_fuchsia.jpg',
                'gallery' => [
                    'assets/images/noor_fuchsia.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Radiant Fuchsia', 'hex' => '#E0218A', 'image' => 'assets/images/noor_fuchsia.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'A burst of celebratory joy in vibrant rani fuchsia. Features a streamlined sleeveless kurti adorned with delicate floral mirrorwork, shimmering gold zari accents along the notched neckline, and coordinated relaxed palazzo pants.',
                'fabric' => 'Pure Chanderi Silk with Cotton Silk Lining.',
                'craftsmanship' => 'Authentic hand-set mirrorwork and fine resham embroidery created by female artisan collectives in Patan.',
                'care' => 'Dry clean only. Steam iron on reverse.',
                'rating' => 5.0,
                'reviews_count' => 62
            ],
            [
                'id' => 'pooh-set',
                'name' => 'Pooh Marigold Peplum & Dhoti Set',
                'nepali_name' => 'पूह सेट (पहेंलो र बैजनी)',
                'drop' => 'Drop 07 • Contemporary Co-Ords',
                'tag' => 'Viral Sensation',
                'is_limited' => true,
                'remaining_stock' => 5,
                'price_npr' => 11500,
                'price_usd' => 88,
                'category' => 'Co-Ords',
                'badge' => 'Viral on IG',
                'image' => 'assets/images/pooh_yellow.jpg',
                'hover_image' => 'assets/images/pooh_yellow.jpg',
                'gallery' => [
                    'assets/images/pooh_yellow.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Marigold Sun', 'hex' => '#F4B41A', 'image' => 'assets/images/pooh_yellow.jpg'],
                    ['name' => 'Lavender Shimmer', 'hex' => '#C4A1D8', 'image' => 'assets/images/pooh_yellow.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'Sun-drenched celebratory cheer! Crafted in vibrant marigold yellow with delicate floral threadwork along the bodice, a flirty pleated peplum flare, and draped dhoti-style tulip pants that move gracefully with every step.',
                'fabric' => 'Premium Modal Chanderi with Silk Sheen.',
                'craftsmanship' => 'Pleated and draped entirely by hand in our Kathmandu studio.',
                'care' => 'Dry clean recommended.',
                'rating' => 5.0,
                'reviews_count' => 71
            ],
            [
                'id' => 'suhari-set',
                'name' => 'Suhari Pristine Ivory Zari Set',
                'nepali_name' => 'सुहारी सेट (ऐभोरी)',
                'drop' => 'Drop 08 • The Festive Edit',
                'tag' => 'Heirloom Edition',
                'is_limited' => true,
                'remaining_stock' => 3,
                'price_npr' => 16000,
                'price_usd' => 125,
                'category' => 'Heirloom Sets',
                'badge' => 'Only 3 Left',
                'image' => 'assets/images/suhari_ivory.jpg',
                'hover_image' => 'assets/images/suhari_ivory.jpg',
                'gallery' => [
                    'assets/images/suhari_ivory.jpg',
                    'assets/images/atelier_crafting.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Pristine Ivory & Gold', 'hex' => '#F8F6F0', 'image' => 'assets/images/suhari_ivory.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'Ethereal and timeless. The Suhari Set embodies minimalist heritage luxury with hand-spun raw ivory silk, regal geometric and floral neckline zari embroidery, and an airy organza dupatta with scalloped golden border.',
                'fabric' => 'Hand-spun Mulberry Raw Silk with Organza Dupatta.',
                'craftsmanship' => 'Handcrafted using traditional needle embroidery techniques passed down through generations.',
                'care' => 'Strictly dry clean. Do not bleach or machine wash.',
                'rating' => 4.9,
                'reviews_count' => 47
            ],
            [
                'id' => 'lila-set',
                'name' => 'Lila Sage Peplum Co-Ord',
                'nepali_name' => 'लीला सेट (सेज ग्रीन)',
                'drop' => 'Drop 07 • Contemporary Co-Ords',
                'tag' => 'Effortless Chic',
                'is_limited' => false,
                'remaining_stock' => 8,
                'price_npr' => 10800,
                'price_usd' => 82,
                'category' => 'Co-Ords',
                'badge' => 'New Silhouette',
                'image' => 'assets/images/lila_sage.jpg',
                'hover_image' => 'assets/images/lila_sage.jpg',
                'gallery' => [
                    'assets/images/lila_sage.jpg',
                    'assets/images/packaging_unboxing.jpg'
                ],
                'colors' => [
                    ['name' => 'Sage Mist', 'hex' => '#9CAF88', 'image' => 'assets/images/lila_sage.jpg']
                ],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'Custom Fit'],
                'description' => 'A breath of fresh Himalayan air. The Lila Co-Ord fuses contemporary peplum tailoring with subtle tone-on-tone resham floral embroidery. Features a cinched empire waist, gathered flare, delicate back bow tie, and relaxed wide-leg trousers.',
                'fabric' => 'Soft Breathable Linen-Silk Blend.',
                'craftsmanship' => 'Precision patterned and finished with French seams for lasting comfort and fluid drape.',
                'care' => 'Gentle hand wash in cold water or mild dry clean.',
                'rating' => 4.8,
                'reviews_count' => 53
            ]
        ];
    }

    public static function find(string $id): ?array
    {
        foreach (self::getAll() as $item) {
            if ($item['id'] === $id) {
                return $item;
            }
        }
        return null;
    }

    public static function getCategories(): array
    {
        return ['All Silhouettes', 'Mul Cotton & Applique', 'Camisole Tunics', 'Festive Sets', 'Heirloom Sets', 'Co-Ords'];
    }

    public static function getDrops(): array
    {
        return [
            [
                'number' => '08',
                'title' => 'The Festive Edit (Dashain & Tihar)',
                'nepali_title' => 'चाडपर्व कलेक्सन',
                'date' => 'October 2026',
                'status' => 'Live Now',
                'pieces' => '35 Pieces Total',
                'image' => 'assets/images/hero_festive.jpg',
                'tagline' => 'Handcrafted heirlooms designed for intimate moments of celebration.'
            ],
            [
                'number' => '07',
                'title' => 'Contemporary Co-Ords & Handlooms',
                'nepali_title' => 'आधुनिक को-अर्ड्स',
                'date' => 'September 2026',
                'status' => 'Limited Stock',
                'pieces' => '40 Pieces Total',
                'image' => 'assets/images/zoya_handloom.jpg',
                'tagline' => 'Fluid silhouettes meeting ancient craftsmanship for everyday elevated living.'
            ],
            [
                'number' => '09',
                'title' => 'Winter Velvet & Heirlooms',
                'nepali_title' => 'हिउँदे मखमली',
                'date' => 'Dropping in November',
                'status' => 'Preview & Waitlist',
                'pieces' => '30 Pieces Worldwide',
                'image' => 'assets/images/atelier_crafting.jpg',
                'tagline' => 'Plum velvets, antique brass buttons, and warm raw silk linings.'
            ]
        ];
    }

    public static function getInstagramPosts(): array
    {
        return [
            [
                'id' => 'post-1',
                'image' => 'assets/images/suhani_corset_back.jpg',
                'caption' => '✨ SUHANI SET ✨ Back view love! Lace-up corset detailing, bell sleeves and pure mul cotton applique. Handcrafted for your comfort 🌸',
                'likes' => '5,420',
                'comments' => '289',
                'product_id' => 'suhani-corset-set',
                'product_name' => 'Suhani Set (Corset Back)'
            ],
            [
                'id' => 'post-2',
                'image' => 'assets/images/saya_mul_cotton.jpg',
                'caption' => '✨ SAYA MUL COTTON ✨ Corset-inspired fit hugging the body with a flowy tiered sharara for perfect Dashain weather 🌻',
                'likes' => '6,180',
                'comments' => '342',
                'product_id' => 'saya-mul-cotton',
                'product_name' => 'Saya Mul Cotton Set'
            ],
            [
                'id' => 'post-3',
                'image' => 'assets/images/zoya_handloom.jpg',
                'caption' => '✨ ZOYA HANDLOOM ✨ Marigold sunset stripes woven on traditional Nepali wooden looms. Zero repeat prints!',
                'likes' => '3,950',
                'comments' => '174',
                'product_id' => 'zoya-handloom',
                'product_name' => 'Zoya Handloom'
            ],
            [
                'id' => 'post-4',
                'image' => 'assets/images/hero_festive.jpg',
                'caption' => 'The iconic Gulabi in Olive Gold raw silk with pure zardozi sequins. Limited pieces remaining in Drop 08 ✨',
                'likes' => '4,890',
                'comments' => '210',
                'product_id' => 'gulabi-set',
                'product_name' => 'Gulabi Set (Olive Gold)'
            ],
            [
                'id' => 'post-5',
                'image' => 'assets/images/suhani_lilac.jpg',
                'caption' => 'Suhani in Blush Lilac. Flared bell sleeves catching the afternoon breeze in Kathmandu 🌸',
                'likes' => '4,310',
                'comments' => '188',
                'product_id' => 'suhani-corset-set',
                'product_name' => 'Suhani (Blush Lilac)'
            ],
            [
                'id' => 'post-6',
                'image' => 'assets/images/packaging_unboxing.jpg',
                'caption' => 'Hey love, Before you open this package... 💌 Every Prasuna order is wrapped like a personal love letter with our wax seal.',
                'likes' => '5,120',
                'comments' => '230',
                'product_id' => null,
                'product_name' => 'The Keepsake Ritual'
            ]
        ];
    }
}
