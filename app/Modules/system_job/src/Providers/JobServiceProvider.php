<?php 

namespace App\Modules\system_job\src\Providers;

use App\Modules\system_job\src\Jobs\TextJob;

class JobServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public $bindings = [
        'TEXT' => TextJob::class
    ];

    public function boot() { 
        if(file_exists(__DIR__.'/../Routes/routes.php')) { 
            $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
        }
    }

    public function register() 
    {
    }
}