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
    abstract public function getRouteName(): string;

    /**
     * Get the URL for the page.
     */
    public function getUrl(): string
    {
        return route($this->getRouteName(), [
            'path' => $this->getPath()
        ]);
    }

    public function getPath(): string
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
