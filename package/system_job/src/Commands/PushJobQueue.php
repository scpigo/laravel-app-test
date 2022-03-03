<?php

namespace Scpigo\SystemJob\Commands;

use Scpigo\SystemJob\Helpers\SystemJobStatus;
use Scpigo\SystemJob\Jobs\TextJob;
use Scpigo\SystemJob\Models\SystemJob;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\Dispatcher;

class PushJobQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push system jobs in queue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jobs = SystemJob::where('event_id', null)
            ->where('scheduled_at', '<', gmdate('Y-m-d H:i:s'))
            ->orderBy('id')
            ->get();
        
        foreach ($jobs as $job) {
            $event_id = null;

            $task = app()->makeWith($job->action, [
                'jobId' => $job->id,
                'jobVars' => json_decode($job->action_vars)
            ]);

            $task->onConnection(config('systemjob.queue_connection'));

            if ($task instanceof ShouldQueue) {
                $event_id = app(Dispatcher::class)->dispatch($task);
            }

            if ($event_id) {
                SystemJob::where('id', $job->id)
                    ->update([
                        'event_id' => $event_id,
                        'status' => SystemJobStatus::PUSH
                    ]);
                
                $this->info('Job '.$job->id.': '.$job->action.' was pushed! ['.$event_id.']');
            }
        }

        return 0;
    }
}
