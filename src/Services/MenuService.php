<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Services;

use GeoffroyRiou\NrCMS\Traits\Menuable;

class MenuService
{
    protected array $modelPaths;

    public function __construct(protected ReflectionService $reflectionService)
    {
        $defaultPaths = config('nrcms.model_paths', []);
        $this->modelPaths = array_merge($defaultPaths, [__DIR__ . '/../Models']);
    }

    /**
     * Get all models that implement the Menuable interface
     */
    public function getMenuableModels(): array
    {
        $models = [];

        foreach ($this->modelPaths as $modelPath) {
            $models = array_merge($models, $this->getModelsFromPath($modelPath));
        }

        return $models;
    }

    /**
     * Get models from a specific path
     */
    protected function getModelsFromPath(string $modelPath): array
    {
        $items = [];

        foreach (glob($modelPath . '/*.php') as $file) {
            $className = $this->reflectionService->getClassNameFromFile($file);

            if (class_exists($className) && $this->reflectionService->usesTrait($className, Menuable::class)) {
                $items = array_merge($items, $this->getMenuableItems($className));
            }
        }

        return $items;
    }

    /**
     * Get menuable items from a class
     */
    protected function getMenuableItems(string $className): array
    {
        return $className::all()->map(function ($item) use ($className) {
            return [
                'key' => $className . ':' . $item->id,
                'value' => $item->{$className::getLabelKey()},
            ];
        })->pluck('value', 'key')->toArray();
    }
}
