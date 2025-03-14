<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCms\Controllers;

use GeoffroyRiou\NrCms\Controllers\CmsController;
use GeoffroyRiou\NrCms\Models\Article;
use Illuminate\View\View;

class ArticleController extends CmsController
{

    public function __invoke(string $path): View
    {
        $article = Article::published()->where('slug', $this->getSlug($path))->firstOrFail();
        return view('nrcms::articles.single-article', compact('article'));
    }
}
