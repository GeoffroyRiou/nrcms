<?php

use GeoffroyRiou\NrCms\Controllers\CmsController;
use Illuminate\Support\Facades\Route;


Route::fallback(CmsController::class)->name('nrcms.cms_model');
