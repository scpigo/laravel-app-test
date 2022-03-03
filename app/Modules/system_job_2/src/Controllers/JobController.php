<?php

namespace App\Modules\system_job_2\src\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\system_job_2\src\Requests\JobRequest;
use Scpigo\SystemJob\Repositories\Interfaces\SystemJobRepositoryInterface;
use Scpigo\SystemJob\Requests\SystemJobRequest;
use Scpigo\SystemJob\Services\Interfaces\JobServiceInterface;

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
