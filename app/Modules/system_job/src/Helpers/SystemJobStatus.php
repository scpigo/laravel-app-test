<?php

namespace App\Modules\system_job\src\Helpers;

class SystemJobStatus
{
    public const SCHEDULED = 'SCHEDULED';
    public const PUSH = "PUSH";
    public const QUEUED = "QUEUED";
    public const FAILED = "FAILED";
    public const EXECUTED = "EXECUTED";
    public const CANCELED = 'CANCELED';
}
