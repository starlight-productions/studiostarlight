<?php
namespace App\Controllers;

class GalleryController
{
    public static function index(): string
    {
        $content = '<h2 class="text-xl font-rounded">Welcome to Studio Starlight</h2>
                    <p class="mt-4">Gallery page placeholder.</p>';

        return self::render('Gallery', $content);
    }

    private static function render(string $title, string $content): string
    {
        ob_start();
        require dirname(__DIR__) . '/Views/layouts/main.php';
        return ob_get_clean();
    }
}
