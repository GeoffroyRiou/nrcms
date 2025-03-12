<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Services;

use GeoffroyRiou\NrCMS\Models\Menu;
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

    /**
     * Get menu from id
     * @param int $menuId
     * @return Menu|null
     */
    public function getMenuFromId(int $menuId): Menu | null
    {
        return Menu::find($menuId);
    }

    /**
     * Hydrate menu generating all urls from items
     * @param array $items
     * @return array
     */
    public function hydrateMenu(array $items): array
    {
        $result = [];
        $pageIds = [];

        // First pass: collect all page IDs grouped by model
        foreach ($items as $item) {
            if ($item['type'] === 'page') {
                $pageDatas = explode(':', $item['page']);
                $pageModel = $pageDatas[0];
                $pageId = $pageDatas[1];

                // Initialize the array for the model if it doesn't exist
                if (!isset($pageIds[$pageModel])) {
                    $pageIds[$pageModel] = [];
                }
                $pageIds[$pageModel][] = $pageId; // Collecting IDs for each model
            }
        }

        // Fetch all pages in one query for each model
        $pages = [];
        foreach ($pageIds as $model => $ids) {
            $modelClass = $model; // Assuming the model name is the class name
            if (class_exists($modelClass)) {
                $pages[$model] = $modelClass::whereIn('id', $ids)->get()->keyBy('id');
            }
        }

        // Second pass: hydrate menu with URLs
        foreach ($items as $item) {
            $url = $item['url'] ?? '';

            // Check if the type is 'page' and extract the classpath:id
            if ($item['type'] === 'page') {
                $pageDatas = explode(':', $item['page']);
                $pageModel = $pageDatas[0];
                $pageId = $pageDatas[1];

                // Use the pre-fetched pages to get the URL
                $page = $pages[$pageModel]->get($pageId) ?? null;
                $url = $page ? $page->getUrl() : '#';
            }

            $currentItem = [
                'label' => $item['label'],
                'url' => $url,
                'children' => [],
            ];

            // If there are children, recursively call this function
            if (!empty($item['children'])) {
                $currentItem['children'] = $this->hydrateMenu($item['children']);
            }

            // Add the item to the result
            $result[] = $currentItem;
        }

        return $result;
    }

    protected function getPageUrl(string $model, string $id): string
    {
        // Implement logic to retrieve the URL for the page based on the model and ID
        // For example, you might have a Page model with a method to get the URL
        $page = $model::find($id);
        return $page ? $page->getUrl() : '#';
    }
}
