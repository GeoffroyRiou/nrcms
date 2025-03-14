<?php

namespace GeoffroyRiou\NrCms\Models;

use GeoffroyRiou\NrCms\Traits\IsCmsModel;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use IsCmsModel;

    protected $fillable = [
        'title',
        'slug',
        'illustration',
        'published',
        'page_blocks',
        'parent_id',
        'sort',
    ];

    protected $casts = [
        'page_blocks' => 'array',
    ];

    public function getViewName(): string
    {
        return 'nrcms::articles.single-article';
    }
}
