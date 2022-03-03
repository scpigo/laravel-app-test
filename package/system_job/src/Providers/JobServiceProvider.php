<?php 

namespace Scpigo\SystemJob\Providers;

use Scpigo\SystemJob\Commands\PushJobQueue;
use Scpigo\SystemJob\Helpers\SystemJobStatus;
use Scpigo\SystemJob\Jobs\TextJob;
use Scpigo\SystemJob\Models\SystemJob;
use Scpigo\SystemJob\Repositories\Implems\SystemJobRepository;
use Scpigo\SystemJob\Repositories\Interfaces\SystemJobRepositoryInterface;
use Scpigo\SystemJob\Services\Interfaces\JobServiceInterface;
use Scpigo\SystemJob\Services\Implems\JobService;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;

class JobServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public $bindings = [
        JobServiceInterface::class => JobService::class,
        SystemJobRepositoryInterface::class => SystemJobRepository::class,
    ];

    public function boot() { 
        if(is_dir(__DIR__.'/../Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                PushJobQueue::class,
            ]);
        }

        $this->mergeConfigFrom(__DIR__.'/../../config/systemjob.php', 'systemjob');

        $this->publishes([
            __DIR__.'/../../config/systemjob.php' => config_path('systemjob.php'),
        ]);

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