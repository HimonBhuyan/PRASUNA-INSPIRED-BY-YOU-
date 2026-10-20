<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\BladeEngine;
use App\Data\Products;
use App\Helpers;

// Initialize Blade Engine
$blade = new BladeEngine(__DIR__ . '/views', __DIR__ . '/cache');

// Detect route and parameters
$page = $_GET['page'] ?? 'home';
$currency = $_GET['currency'] ?? 'NPR';

// Simple Clean Router
switch ($page) {
    case 'shop':
        $allProducts = Products::getAll();
        $selectedCategory = $_GET['category'] ?? 'All';

        if ($selectedCategory !== 'All' && !empty($selectedCategory)) {
            $filteredProducts = array_filter($allProducts, function ($p) use ($selectedCategory) {
                return $p['category'] === $selectedCategory;
            });
        } else {
            $filteredProducts = $allProducts;
        }

        echo $blade->render('pages.shop', [
            'title' => 'Silhouettes & Drops • Prasuna Handmade',
            'currentPage' => 'shop',
            'products' => $filteredProducts,
            'categories' => Products::getCategories(),
            'currency' => $currency
        ]);
        break;

    case 'product':
        $productId = $_GET['id'] ?? 'gulabi-set';
        $product = Products::find($productId) ?? Products::find('gulabi-set');
        
        $allProducts = Products::getAll();
        $related = array_filter($allProducts, function ($p) use ($product) {
            return $p['id'] !== $product['id'];
        });

        echo $blade->render('pages.product', [
            'title' => $product['name'] . ' • Prasuna Kathmandu',
            'currentPage' => 'shop',
            'product' => $product,
            'related' => array_slice($related, 0, 3),
            'currency' => $currency
        ]);
        break;

    case 'atelier':
        echo $blade->render('pages.atelier', [
            'title' => 'The Kathmandu Atelier & Story • Prasuna',
            'currentPage' => 'atelier',
            'currency' => $currency
        ]);
        break;

    case 'drops':
        echo $blade->render('pages.drops', [
            'title' => 'The Drops Schedule & Archive • Prasuna',
            'currentPage' => 'drops',
            'drops' => Products::getDrops(),
            'currency' => $currency
        ]);
        break;

    case 'checkout':
        echo $blade->render('pages.checkout', [
            'title' => 'Express Checkout • Prasuna Kathmandu',
            'currentPage' => 'checkout',
            'currency' => $currency
        ]);
        break;

    case 'home':
    default:
        echo $blade->render('pages.home', [
            'title' => 'Prasuna • Handmade Himalayan Slow Fashion & Limited Drops',
            'currentPage' => 'home',
            'products' => Products::getAll(),
            'drops' => Products::getDrops(),
            'instagram_posts' => Products::getInstagramPosts(),
            'currency' => $currency
        ]);
        break;
}
