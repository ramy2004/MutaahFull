<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->file(public_path('index.html'));
});

Route::get('/products/{id}', function (string $id) {
    $staticPage = public_path('products/' . $id . '/index.html');

    if (!is_file($staticPage)) {
        $staticPage = public_path('products/1/index.html');
    }

    return response()->file($staticPage);
})->where('id', '[^/]+');

Route::get('/{path}', function (string $path) {
    $staticPage = public_path(trim($path, '/') . '/index.html');

    if (is_file($staticPage)) {
        return response()->file($staticPage);
    }

    return response()->file(public_path('index.html'));
})->where('path', '.*');
