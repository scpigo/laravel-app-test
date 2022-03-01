<?php 

namespace App\Modules\calculator_service\src\Providers;

use App\Modules\cache\src\Commands\FillSystemSettings;
use App\Modules\cache\src\Services\Implems\CacheRedisService;
use App\Modules\cache\src\Services\Interfaces\CacheInterface;
use App\Modules\calculator_service\src\Services\Interfaces\CalculatorInterface;
use App\Modules\calculator_service\src\Services\Implems\CalculatorService;

use App\Modules\posts_metrics\src\Commands\GeneratePostsMetrics;

class CalculatorServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public $bindings = [
        CalculatorInterface::class => CalculatorService::class
    ];

    public function boot() { 
        if(file_exists(__DIR__.'/../Routes/routes.php')) { 
            $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
        }
        if(is_dir(__DIR__.'/../Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        }
    }

    public function register() 
    {

    }
}