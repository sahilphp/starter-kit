<?php

declare(strict_types=1);

namespace App\Providers;

use RuntimeException;
use Sahil\Contracts\Foundation\ApplicationContract;
use Sahil\Foundation\ServiceProvider;
use Sahil\Http\Kernel;
use Sahil\Http\Route;
use Sahil\Http\Router;

/**
 * Registers the HTTP surface for this installation:
 * the route table (from routes/web.php) and the Kernel singleton
 * wired with the application's debug mode.
 */
final class WebRoutesProvider extends ServiceProvider
{
    public function register(): void
    {
        $router = $this->routeTable();

        $this->app()->container()->singleton(
            Router::class,
            static fn (): Router => $router
        );

        $this->app()->container()->singleton(
            Kernel::class,
            static function (\Sahil\Container\Container $container): Kernel {
                $application = $container->make(ApplicationContract::class);

                return (new Kernel($container->make(Router::class), $container, $application))
                    ->useDebugMode($application->config()->get('app.debug') === true)
                    ->using($container->make(\Sahil\Http\Middleware\StartSession::class))
                    ->using($container->make(\Sahil\Http\Middleware\VerifyCsrfToken::class))
                    ->using(new \Sahil\Http\Middleware\RequestIdMiddleware());
            }
        );
    }

    private function routeTable(): Router
    {
        $file = dirname(__DIR__, 2) . '/routes/web.php';

        if (!is_file($file)) {
            throw new RuntimeException(sprintf('routes/web.php is missing; expected it at [%s].', $file));
        }

        // `require`, not `require_once`: every freshly booted application
        // (tests, workers) needs its own route table, while `require_once`
        // returns true on the second boot in the same process.
        /** @var mixed $definitions */
        $definitions = require $file;

        if (!is_array($definitions)) {
            throw new RuntimeException('routes/web.php must return an array of Sahil\Http\Route objects.');
        }

        $router = new Router();

        foreach ($definitions as $definition) {
            if (!$definition instanceof Route) {
                throw new RuntimeException(
                    sprintf('routes/web.php must return Sahil\Http\Route entries, got %s.', get_debug_type($definition))
                );
            }

            $router->register($definition);
        }

        return $router;
    }
}
