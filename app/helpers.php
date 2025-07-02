<?php

function view(string $file, array $data = []): string
{
    extract($data);
    ob_start();
    require __DIR__ . "/Views/{$file}.php";
    return ob_get_clean();
}
