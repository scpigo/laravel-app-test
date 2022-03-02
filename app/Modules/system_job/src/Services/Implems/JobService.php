<?php

namespace App\Modules\system_job\src\Services\Implems;

use App\Modules\system_job\src\Helpers\SystemJobStatus;
use App\Modules\system_job\src\Models\SystemJob;
use App\Modules\system_job\src\Services\Interfaces\JobServiceInterface;
use Illuminate\Support\Arr;

class JobService implements JobServiceInterface {
    public function addJob($data)
    {
        $systemJob = SystemJob::create([
            'action' => Arr::get($data, 'action'),
            'action_vars' => Arr::get($data, 'action_vars'),
            'scheduled_at' => Arr::get($data, 'scheduled_at'),
            'status' => SystemJobStatus::SCHEDULED
        ]);

        if ($systemJob) {
            return $systemJob->id;
        }

        return false;
    }
}