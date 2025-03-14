<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCms\Traits;

trait Menuable
{
    public static function getModelLabel(): string
    {
        return __('Page');
    }

    public static function getLabelKey(): string
    {
        return 'title';
    }

    abstract public function getUrl(): string;
}
