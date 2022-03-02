<?php

namespace App\Modules\system_job\src\Repositories\Implems;

use App\Modules\system_job\src\Repositories\Interfaces\SystemJobRepositoryInterface;
use App\Modules\system_job\src\Models\SystemJob;
use App\Modules\system_job\src\Requests\SystemJobRequest;

class SystemJobRepository implements SystemJobRepositoryInterface
{
    public function findModelsByFilter(SystemJobRequest $request) {
        return SystemJob::action($request->action)
            ->attempt($request->attempt)
            ->status($request->status)
            ->get();
    }

    public function findIds(SystemJobRequest $request) {
        return SystemJob::select('id')
            ->action($request->action)
            ->attempt($request->attempt)
            ->status($request->status)
            ->pluck('id');
    }
}
