<?php

namespace App\Modules\system_job\src\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\system_job\src\Repositories\Interfaces\SystemJobRepositoryInterface;
use App\Modules\system_job\src\Requests\JobRequest;
use App\Modules\system_job\src\Requests\SystemJobRequest;
use App\Modules\system_job\src\Services\Interfaces\JobServiceInterface;

class JobController extends Controller
{
    public function add(JobRequest $request) {
        $data = $request->validated();

        $jobService = app()->make(JobServiceInterface::class);

        if ($systemJob = $jobService->addJob($data)) {
            return response()->json([
                'data' => [
                    'id' => $systemJob
                ],
                'statusText' => 'Задача запланирована',
                'status' => 'ok'
            ], 201);
        }

        return response()->json([
            'data' => [],
            'statusText' => 'Произошла ошибка',
            'status' => 'error'
        ], 401);
    }

    public function find() {
        $request = new SystemJobRequest();
        $request->status = ['EXECUTED'];

        $repository = app()->make(SystemJobRepositoryInterface::class);
        $ids = $repository->findIds($request);

        return $ids;
    }
}
