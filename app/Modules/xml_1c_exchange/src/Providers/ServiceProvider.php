<?php 

namespace App\Modules\xml_1c_exchange\src\Providers;

class ServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public function boot() { 
        if(file_exists(__DIR__.'/../Routes/routes.php')) { 
            $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
        }
    }

    public function register() 
    {
    }
}