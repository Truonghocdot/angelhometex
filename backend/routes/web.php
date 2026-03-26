<?php

use App\Http\Controllers\StaticContentController;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', [StaticContentController::class, 'robots'])->name('robots.txt');
Route::get('/{path?}', [StaticContentController::class, 'show'])
    ->where('path', '.*')
    ->name('content.show');
