<?php

use Illuminate\Support\Facades\Route;
use GeoffroyRiou\NrCMS\Controllers\PageController;
use GeoffroyRiou\NrCMS\Controllers\ArticleController;


$prefixPages = config('nrcms.pages_url_prefix', 'pages');
$prefixArticles = config('nrcms.articles_url_prefix', 'articles');


Route::get("/{$prefixPages}/{path}", PageController::class)
    ->name('nrcms.page')
    ->where('path', '.*');

Route::get("/{$prefixArticles}/{path}", ArticleController::class)
    ->name('nrcms.article')
    ->where('path', '.*');
