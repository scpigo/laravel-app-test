<?php

namespace App\Modules\system_job\src\Repositories\Interfaces;

use App\Modules\system_job\src\Requests\SystemJobRequest;

interface SystemJobRepositoryInterface
{
    public function findModelsByFilter(SystemJobRequest $request);
    public function findIds(SystemJobRequest $request);
}
