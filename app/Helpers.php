<?php

namespace App;

class Helpers
{
    public static function getCurrencies(): array
    {
        return [
            'NPR' => ['symbol' => 'Rs. ', 'rate' => 1, 'name' => 'Nepali Rupee (NPR)'],
            'USD' => ['symbol' => '$', 'rate' => 0.0076, 'name' => 'US Dollar (USD)'],
            'AUD' => ['symbol' => 'A$', 'rate' => 0.0118, 'name' => 'Australian Dollar (AUD)'],
            'GBP' => ['symbol' => '£', 'rate' => 0.0059, 'name' => 'British Pound (GBP)'],
            'EUR' => ['symbol' => '€', 'rate' => 0.0071, 'name' => 'Euro (EUR)'],
            'INR' => ['symbol' => '₹', 'rate' => 0.63, 'name' => 'Indian Rupee (INR)']
        ];
    }

    public static function formatPrice(int|float $npr, string $currency = 'NPR'): string
    {
        $currencies = self::getCurrencies();
        $c = $currencies[$currency] ?? $currencies['NPR'];
        $amount = $npr * $c['rate'];

        if ($currency === 'NPR' || $currency === 'INR') {
            return $c['symbol'] . number_format($amount);
        } else {
            return $c['symbol'] . number_format($amount, 2);
        }
    }

    public static function route(string $page = '', array $params = []): string
    {
        $query = array_merge(['page' => $page], $params);
        return '?' . http_build_query($query);
    }

    public static function asset(string $path): string
    {
        return self::basePath() . ltrim($path, '/');
    }

    public static function basePath(): string
    {
        $script = $_SERVER['SCRIPT_NAME'] ?? '';
        $dir = str_replace('\\', '/', dirname($script));
        if ($dir === '/' || $dir === '/api' || $dir === '.' || $dir === '') {
            return '/';
        }
        return rtrim($dir, '/') . '/';
    }
}
