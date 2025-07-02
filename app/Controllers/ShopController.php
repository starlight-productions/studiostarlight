<?php
namespace App\Controllers;

class ShopController
{
    public static function index(): string
    {
        $content = '<h2 class="text-xl font-rounded">Shop</h2>
                    <p class="mt-4">Shop page placeholder.</p>';

        return self::render('Shop', $content);
    }

    private static function render(string $title, string $content): string
    {
        ob_start();
        require dirname(__DIR__) . '/Views/layouts/main.php';
        return ob_get_clean();
    }
}
