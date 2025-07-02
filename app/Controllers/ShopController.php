<?php
namespace App\Controllers;
use function view;  
class ShopController
{
    public static function index(): string
    {
        $content = \view('shop'); 

        return self::render('Shop', $content);
    }

    private static function render(string $title, string $content): string
    {
        ob_start();
        require dirname(__DIR__) . '/Views/layouts/main.php';
        return ob_get_clean();
    }
}
