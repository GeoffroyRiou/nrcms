<?php

namespace GeoffroyRiou\NrCMS\Models;

use GeoffroyRiou\NrCMS\Traits\Menuable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Page extends Model
{
    use Menuable, HasRecursiveRelationships;

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
    public function getUrl(): string
    {
        $path = $this->ancestorsAndSelf()->pluck('slug')->reverse()->implode('/');

        return route('nrcms.page', ['path' => $path]);
    }

    /**
     * Scope a query to only include published pages.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }
}
