<?php

namespace GeoffroyRiou\NrCMS\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'page_blocks',
    ];

    protected $casts = [
        'page_blocks' => 'array',
    ];
}
