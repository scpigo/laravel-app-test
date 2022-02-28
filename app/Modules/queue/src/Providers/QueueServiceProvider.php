<?php 

namespace App\Modules\queue\src\Providers;

use App\Modules\cache\src\Commands\FillSystemSettings;
use App\Modules\cache\src\Services\Implems\CacheRedisService;
use App\Modules\cache\src\Services\Interfaces\CacheInterface;
use App\Modules\posts_metrics\src\Commands\GeneratePostsMetrics;

class QueueServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public function boot() { 
        if(file_exists(__DIR__.'/../Routes/routes.php')) { 
            $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
        }
        if(is_dir(__DIR__.'/../Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        }

        /* if ($this->app->runningInConsole()) {
            $this->commands([
                FillSystemSettings::class,
            ]);
        } */
    }

    public function register() 
    {
        /* $this->app->singleton(CacheInterface::class, function($app) {
            return new CacheRedisService();
        });

        $this->app->alias(CacheInterface::class, 'CacheManager'); */
    }
}