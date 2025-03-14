<?php

namespace GeoffroyRiou\NrCms\Models;

use GeoffroyRiou\NrCms\Traits\IsCmsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use IsCmsModel;

    protected $fillable = [
        'title',
        'slug',
        'illustration',
        'published',
        'page_blocks',
        'category_id',
        'sort',
    ];

    protected $casts = [
        'page_blocks' => 'array',
    ];

    public function getViewName(): string
    {
        return 'nrcms::articles.single-article';
    }

    public function getUrlPath(): string
    {
        return $this->ancestors()
            ->pluck('slug')
            ->reverse()
            ->push($this->slug)
            ->implode('/');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->with('ancestorsAndSelf');
    }

    public function ancestors()
    {
        return $this->category->ancestorsAndSelf;
    }
}
