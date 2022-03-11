<?php

namespace App\Modules\system_job\src\Jobs;

use Scpigo\SystemJob\Jobs\SystemJobAbstract;

class TextJob extends SystemJobAbstract
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $text = $this->jobParams->text;
        $file = $this->jobParams->path;

        file_put_contents(base_path().$file, 'ID: '.$this->jobId.', Driver: '.$this->Driver.', Text: '.$text."\n", FILE_APPEND);
    }
}
