<?php
declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\BlogController;
use App\Controllers\GalleryController;
use App\Controllers\ShopController;
use App\Controllers\AboutController;

/**
 * --------------------------------------------------------------------------
 *  Front controller router (Task 11)
 * --------------------------------------------------------------------------
 *  Maps clean paths to their controllers. Each controller returns full HTML
 *  rendered through the global layout.
 */

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$routes = [
    ''         => [HomeController::class,    'index'],
    'blog'     => [BlogController::class,    'index'],
    'gallery'  => [GalleryController::class, 'index'],
    'shop'     => [ShopController::class,    'index'],
    'about'    => [AboutController::class,   'index'],
];

// Dispatch or 404
if (isset($routes[$uri])) {
    [$class, $method] = $routes[$uri];
    echo $class::$method();          // ← call the controller method
} else {
    http_response_code(404);
    echo notFoundPage();
}

/**
 * Fallback 404 view (uses same layout helper inside for consistency).
 */
function notFoundPage(): string
{
    $title   = '404 Not Found';
    $content = '<p class="mt-4">The page you requested does not exist.</p>';

    ob_start();
    require dirname(__DIR__) . '/app/Views/layouts/main.php';
    return ob_get_clean();
}
