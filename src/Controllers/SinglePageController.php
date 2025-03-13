<?php

namespace GeoffroyRiou\NrCMS\Controllers;

use App\Http\Controllers\Controller;
use GeoffroyRiou\NrCMS\Models\Page;
use Illuminate\View\View;

class SinglePageController extends Controller
{
    public function __invoke(string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();
        return view('nrcms::pages.single-page', compact('page'));
    }
}
