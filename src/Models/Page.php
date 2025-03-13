<?php

namespace GeoffroyRiou\NrCMS\Models;

use GeoffroyRiou\NrCMS\Traits\Menuable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use Menuable;

    protected $fillable = [
        'title',
        'slug',
        'published',
        'page_blocks',
        'parent_id',
        'sort',
    ];

    protected $casts = [
        'page_blocks' => 'array',
    ];

    /**
     * Get the URL for the page.
     */
    public function getUrl(): string{
        return route('nrcms.page', ['slug' => $this->slug]);
    }

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
