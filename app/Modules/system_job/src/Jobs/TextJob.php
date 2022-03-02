<?php

namespace App\Modules\system_job\src\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class TextJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $jobId;
    private $jobVars;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($jobId, $jobVars)
    {
        $this->jobId = $jobId;
        $this->jobVars = $jobVars;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $text = $this->jobVars->text;
        $file = $this->jobVars->path;

        file_put_contents(base_path().$file, $this->jobId.': '.$text."\n", FILE_APPEND);
    }
}
