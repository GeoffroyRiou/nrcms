<?php

namespace GeoffroyRiou\NrCMS\Controllers;

use App\Http\Controllers\Controller;
use GeoffroyRiou\NrCMS\Services\ReflectionService;
use Illuminate\View\View;
use GeoffroyRiou\NrCMS\Traits\IsCmsModel;
use Illuminate\Database\Eloquent\Model;

class CmsController extends Controller
{
    protected array $modelPaths;

    public function __construct(private ReflectionService $reflectionService)
    {
        $defaultPaths = config('nrcms.model_paths', []);
        $this->modelPaths = array_merge($defaultPaths, [__DIR__ . '/../Models']);
    }

    public function __invoke(string $path): View
    {
        $model = $this->getModel($this->getSlug($path));

        if (!$model) {
            abort(404);
        }

        return view($model->getViewName() ?? null, compact('model'));
    }

    /**
     * Get the slug from the path.
     */
    private function getSlug(string $path): string
    {
        $parts = explode('/', $path);
        return array_pop($parts);
    }

    /**
     * Tries to retrieve a model based on the slug.
     * Only for models that implement the IsCmsModel trait
     * @param string $slug
     * @return Model|null
     */
    protected function getModel(string $slug): ?Model
    {
        $modelClasses = $this->reflectionService->getModelClassesFromPaths(
            $this->modelPaths,
        );

        foreach ($modelClasses as $modelClass) {

            if (!$this->reflectionService->usesTrait($modelClass, IsCmsModel::class)) {
                continue;
            }

            $query = $modelClass::where('slug', $slug);

            if ($query->exists()) {
                return $query->first();
            }
        }

        return null;
    }
}
