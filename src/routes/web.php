<?php

use GeoffroyRiou\NrCMS\Controllers\CmsController;
use Illuminate\Support\Facades\Route;

$prefixPages = config('nrcms.pages_url_prefix', 'pages');
$prefixArticles = config('nrcms.articles_url_prefix', 'articles');


Route::get("/{$prefixPages}/{path}", [CmsController::class,'page'])
    ->name('nrcms.page')
    ->where('path', '.*');

Route::get("/{$prefixArticles}/{path}", [CmsController::class,'article'])
    ->name('nrcms.article')
    ->where('path', '.*');
