<?php 

namespace App\Modules\system_job\src\Providers;

use App\Modules\system_job\src\Commands\PushJobQueue;
use App\Modules\system_job\src\Helpers\SystemJobStatus;
use App\Modules\system_job\src\Jobs\TextJob;
use App\Modules\system_job\src\Models\SystemJob;
use App\Modules\system_job\src\Repositories\Implems\SystemJobRepository;
use App\Modules\system_job\src\Repositories\Interfaces\SystemJobRepositoryInterface;
use App\Modules\system_job\src\Services\Interfaces\JobServiceInterface;
use App\Modules\system_job\src\Services\Implems\JobService;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;

class JobServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public $bindings = [
        JobServiceInterface::class => JobService::class,
        SystemJobRepositoryInterface::class => SystemJobRepository::class,
        'TEXT' => TextJob::class
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
                PushJobQueue::class,
            ]);
        }

        Queue::before(function (JobProcessing $event) {
            SystemJob::where('event_id', $event->job->getJobId())
                ->update([
                    'status' => SystemJobStatus::QUEUED
                ]);
        });

        Queue::after(function (JobProcessed $event) {
            SystemJob::where('event_id', $event->job->getJobId())
                ->update([
                    'executed_at' => gmdate('Y-m-d H:i:s'),
                    'attempt' => $event->job->attempts(),
                    'status' => SystemJobStatus::EXECUTED
                ]);
        });

        Queue::failing(function (JobFailed $event) {
            SystemJob::where('event_id', $event->job->getJobId())
                ->update([
                    'status' => SystemJobStatus::FAILED
                ]);
        });
    }

    public function register() 
    {
    }
}