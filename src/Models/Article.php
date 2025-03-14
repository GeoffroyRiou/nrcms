<?php

namespace GeoffroyRiou\NrCMS\Models;

use GeoffroyRiou\NrCMS\Traits\IsCmsModel;
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
}
