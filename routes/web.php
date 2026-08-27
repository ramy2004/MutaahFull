<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->file(public_path('index.html'));
});

Route::get('/{path}', function (string $path) {
    $staticPage = public_path(trim($path, '/') . '/index.html');

    if (is_file($staticPage)) {
        return response()->file($staticPage);
    }

    return response()->file(public_path('index.html'));
})->where('path', '.*');
