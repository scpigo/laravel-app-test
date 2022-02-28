<?php 

namespace App\Modules\posts_metrics\src\Providers;

use App\Modules\posts_metrics\src\Commands\GeneratePostsMetrics;
use App\Modules\posts_metrics\src\Services\Implems\PostsMetricsMongoService;
use App\Modules\posts_metrics\src\Services\Interfaces\PostsMetricsInterface;

class PostsMetricsServiceProvider extends \Illuminate\Support\ServiceProvider { 
    
    public $bindings = [
        PostsMetricsInterface::class => PostsMetricsMongoService::class,
    ];

    public function boot() { 
        if(file_exists(__DIR__.'/../Routes/routes.php')) { 
            $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
        }
        if(is_dir(__DIR__.'/../Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                GeneratePostsMetrics::class,
            ]);
        }
    }

    public function register() 
    {
        
    }
}