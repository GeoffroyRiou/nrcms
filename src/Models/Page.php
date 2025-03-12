<?php

namespace GeoffroyRiou\NrCMS\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'publish_status',
        'page_blocks',
        'parent_id',
        'sort',
    ];

    protected $casts = [
        'page_blocks' => 'array',
    ];

    /**
     * Scope a query to only include published pages.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')->with('children')->orderBy('sort');
    }
}
