<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Services;

use ReflectionClass;

class ReflectionService
{
    /**
     * Extract namespace from a file path
     */
    public function extractNamespace(string $filePath): ?string
    {
        $content = file_get_contents($filePath);
        $pattern = '/namespace\s+([a-zA-Z_][a-zA-Z0-9_\\\\]*)\s*;/';

        if (preg_match($pattern, $content, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Check if the class uses a specific trait
     */
    public function usesTrait(string $className, string $traitName): bool
    {
        $reflection = new ReflectionClass($className);
        $traits = $reflection->getTraits();
        return array_key_exists($traitName, $traits);
    }

    /**
     * Get the class name from a file path
     */
    public function getClassNameFromFile(string $filePath): string
    {
        return $this->extractNamespace($filePath) . '\\' . basename($filePath, '.php');
    }
}
