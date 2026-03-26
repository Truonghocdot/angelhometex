<?php

use App\Http\Controllers\StaticContentController;
use Illuminate\Support\Facades\Route;

// Public system files.
Route::get('/robots.txt', [StaticContentController::class, 'robots'])->name('robots.txt');
Route::redirect('/sitemap.xml', '/sitemap.html', 301)->name('sitemap.xml.redirect');

// Legacy SEO-friendly aliases.
Route::permanentRedirect('/index.html', '/')->name('index.html.redirect');

// End-user content routes.
Route::get('/', [StaticContentController::class, 'show'])->name('content.home');
Route::get('/{path}', [StaticContentController::class, 'show'])
    ->where('path', '^(?!admin(?:/|$)|livewire(?:/|$)|storage(?:/|$)|up$).+')
    ->name('content.show');
