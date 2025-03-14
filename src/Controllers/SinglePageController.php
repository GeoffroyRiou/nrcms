<?php

namespace GeoffroyRiou\NrCMS\Controllers;

use App\Http\Controllers\Controller;
use GeoffroyRiou\NrCMS\Models\Page;
use Illuminate\View\View;

class SinglePageController extends Controller
{
    public function __invoke(string $path): View
    {
        $page = Page::published()->where('slug', $this->getSlug($path))->firstOrFail();
        return view('nrcms::pages.single-page', compact('page'));
    }

    /**
     * Get the slug from the path.
     */
    private function getSlug(string $path): string
    {
        $parts = explode('/', $path);
        return array_pop($parts);
    }
}
