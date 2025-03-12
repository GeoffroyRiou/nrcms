<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Services;

use GeoffroyRiou\NrCMS\Models\Menu;
use ReflectionClass;
use Illuminate\Support\Str;
use GeoffroyRiou\NrCMS\Traits\Menuable;

class MenuService
{

    /**
     * Get all models that implement the Menuable interface
     */
    public function getMenuableModels(): array
    {
        $models = [];
        $modelPaths = [
            app_path('Models'),
            __DIR__ . '/../Models',
        ]; // Adjust the path if your models are in a different directory

        foreach ($modelPaths as $modelPath) {
            // Scan the models directory for all PHP files
            foreach (glob($modelPath . '/*.php') as $file) {

                $namespace = $this->extractNamespace($file);
                $className = $namespace . '\\' . basename($file, '.php');

                if (class_exists($className)) {
                    $reflection = new ReflectionClass($className);
                    // Check if the class uses the Menuable trait
                    $traits = $reflection->getTraits();
                    if (array_key_exists(Menuable::class, $traits)) {

                        $items = $className::all()->map(function ($item) use ($className) {
                            return [
                                'key' => $className.':'.$item->id,
                                'value' => $item->{$className::getLabelKey()},
                            ];
                        });
                        $models = array_merge($models, $items
                        ->pluck('value', 'key')
                        ->toArray());
                    }
                }
            }
        }

        return $models;
    }

    /**
     * Extract namespace from a file path
     * @param string $filePath
     * @return string|null
     */
    private function extractNamespace(string $filePath)
    {
        // Read the file content
        $content = file_get_contents($filePath);

        // Define the regular expression pattern to match the namespace declaration
        $pattern = '/namespace\s+([a-zA-Z_][a-zA-Z0-9_\\\\]*)\s*;/';

        // Search for the namespace declaration in the file content
        if (preg_match($pattern, $content, $matches)) {
            // Return the captured namespace
            return $matches[1];
        }

        // Return null if no namespace is found
        return null;
    }
}
