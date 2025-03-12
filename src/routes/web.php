<?php

use GeoffroyRiou\NrCMS\Controllers\SinglePageController;
use Illuminate\Support\Facades\Route;

$prefix = config('nrcms.page_url_prefix', 'pages');

Route::get("/{$prefix}/{slug}", SinglePageController::class)->name('nrcms.page');
