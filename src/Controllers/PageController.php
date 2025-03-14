<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCms\Controllers;

use GeoffroyRiou\NrCms\Controllers\CmsController;
use GeoffroyRiou\NrCms\Models\Page;
use Illuminate\View\View;

class PageController extends CmsController
{

    public function __invoke(string $path): View
    {
        $page = Page::published()->where('slug', $this->getSlug($path))->firstOrFail();
        return view('nrcms::pages.single-page', compact('page'));
    }
}
