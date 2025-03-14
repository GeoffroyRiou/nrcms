<?php

namespace GeoffroyRiou\NrCms\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = [
        'title',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
