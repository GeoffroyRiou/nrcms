<?php

namespace GeoffroyRiou\NrCMS\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

abstract class CmsController extends Controller
{

    abstract public function __invoke(string $path): View;

    /**
     * Get the slug from the path.
     */
    protected function getSlug(string $path): string
    {
        $parts = explode('/', $path);
        return array_pop($parts);
    }
}
