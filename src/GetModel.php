<?php
namespace Laragetmodel\GetModel;

use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;

class GetModel
{
    protected Application $app;
    protected string $baseModelNamespace = 'App\\Models\\';

    public function __construct(Application $app)
    {
        $this->app = $app;

        // load config if available
        try {
            $config = $app['config']->get('getmodel.base_model_namespace');
            if (!empty($config)) {
                $this->baseModelNamespace = rtrim($config, '\\') . '\\\';
            }
        } catch (\Throwable $e) {
            // ignore if config not available yet
        }
    }

    /**
     * Resolve and return model instance.
     * Example: run('User') -> App\\Models\\User
     *          run('Admin\\User') -> App\\Models\\Admin\\User
     *          run(\\App\\Models\\User::class) -> instance
     */
    public function run(string $modelName)
    {
        $modelClass = $this->resolveModelClass($modelName);

        if (!class_exists($modelClass)) {
            throw new InvalidArgumentException("Model sınıfı bulunamadı: {$modelClass}");
        }

        return $this->app->make($modelClass);
    }

    protected function resolveModelClass(string $raw): string
    {
        // if it's a fully-qualified class name already
        if (str_contains($raw, '\\')) {
            return $raw;
        }

        // support nested names like Admin/User or Admin\\User
        $normalized = str_replace('/', '\\', $raw);

        return $this->baseModelNamespace . $normalized;
    }
}
