<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsCmsModel
{

    use Menuable;

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
