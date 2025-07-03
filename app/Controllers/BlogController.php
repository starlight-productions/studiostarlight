<?php
namespace App\Controllers;
use App\Models\Post;
use function view;  
class BlogController
{
    public static function index(): string
    {
        $posts = Post::latest();            // ‹— NEW
        $content = \view('blog',compact('posts'));

        return self::render('Blog', $content);
    }

    private static function render(string $title, string $content): string
    {
        ob_start();
        require dirname(__DIR__) . '/Views/layouts/main.php';
        return ob_get_clean();
    }
}