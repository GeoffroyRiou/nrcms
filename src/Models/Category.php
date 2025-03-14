<?php

namespace GeoffroyRiou\NrCms\Models;

use GeoffroyRiou\NrCms\Traits\IsCmsModel;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use IsCmsModel, HasRecursiveRelationships;

    protected $fillable = [
        'title',
        'slug',
        'published',
        'page_blocks',
        'parent_id',
    ];

    protected $casts = [
        'page_blocks' => 'array',
    ];

    public function getUrlPath(bool $includeSelf = true): string
    {
        $method = $includeSelf ? 'ancestorsAndSelf' : 'ancestors';

        return $this->$method()->pluck('slug')->reverse()->implode('/');
    }

    public function getViewName(): string
    {
        return 'nrcms::categories.single-category';
    }
}
