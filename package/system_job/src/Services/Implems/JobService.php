<?php

namespace Scpigo\SystemJob\Services\Implems;

use Scpigo\SystemJob\Helpers\SystemJobStatus;
use Scpigo\SystemJob\Models\SystemJob;
use Scpigo\SystemJob\Services\Interfaces\JobServiceInterface;
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