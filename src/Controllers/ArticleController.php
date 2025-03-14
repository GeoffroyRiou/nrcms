<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Controllers;

use GeoffroyRiou\NrCMS\Controllers\CmsController;
use GeoffroyRiou\NrCMS\Models\Article;
use Illuminate\View\View;

class ArticleController extends CmsController{

    public function __invoke(string $path): View
    {
        $article = Article::published()->where('slug', $this->getSlug($path))->firstOrFail();
        return view('nrcms::articles.single-article', compact('article'));
    }
}