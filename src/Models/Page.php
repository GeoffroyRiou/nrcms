<?php

namespace GeoffroyRiou\NrCMS\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'publish_status',
        'page_blocks',
    ];

    protected $casts = [
        'page_blocks' => 'array',
    ];
}
