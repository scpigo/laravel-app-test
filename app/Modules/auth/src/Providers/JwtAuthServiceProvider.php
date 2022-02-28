<?php 

namespace App\Modules\auth\src\Providers;

class JwtAuthServiceProvider extends \Illuminate\Support\ServiceProvider { 
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