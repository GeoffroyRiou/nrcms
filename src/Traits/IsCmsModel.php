<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCms\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsCmsModel
{

    use Menuable;

    /**
     * Initialize the IsCmsModel trait.
     * Merge the fillable attributes with the default ones.
     */
    public function initializeIsCmsModel()
    {
        $this->fillable = array_merge(
            $this->fillable,
            [
                'title',
                'slug',
                'published',
                'page_blocks',
            ]
        );

        $this->casts = array_merge(
            $this->casts,
            [
                'page_blocks' => 'array',
            ]
        );
    }

    /**
     * Get the route name for the page.
     */
    public function getRouteName(): string
    {
        return 'nrcms.cms_model';
    }

    /**
     * Get the route name for the page.
     */
    abstract public function getViewName(): string;

    /**
     * Get the URL for the page.
     */
    public function getUrl(): string
    {
        return url($this->getUrlPath());
    }

    /**
     * Get the URL path for the page.
     */
    public function getUrlPath(): string
    {
        return $this->slug;
    }

    /**
     * Scope a query to only include published pages.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }
}
