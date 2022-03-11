<?php

namespace App\Modules\system_job\src\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\system_job\src\Forms\CreateJobForm;
use Scpigo\SystemJob\Repositories\Interfaces\SystemJobRepositoryInterface;
use Scpigo\SystemJob\Requests\SystemJobRequest;

class SystemJobController extends Controller
{
    public function schedule(Request $request) {
        $form = new CreateJobForm;

        if ($jobId = $form->schedule($request)) {
            return response()->json([
                'data' => [
                    'id' => $jobId
                ],
                'statusText' => 'Задача запланирована',
                'status' => 'ok'
            ], 201);
        }

        return response()->json([
            'data' => $form->getErrors(),
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

    public function test() {
        ////

        ////


        /////
        $scheduler = SystemJobManager::scheduler('sql');

        $user = null;

        $password = 123456;

        $dto = new SystemJob();
        $dto->action = 'USER_SEND_PASSWORD';
        $dto->action_params = [
            'email' => $email,
            'password' => hash($password),
            'channel' => 'email'
        ];

        $job1 = $scheduler->schedule($dto);

        $dto = new SystemJob();
        $dto->action = 'USER_SEND_PASSWORD';
        $dto->action_params = [
            'email' => $email,
            'password' => hash($password),
            'channel' => 'email'
        ];
        
        $job2 = $scheduler->schedule($dto);
    }
}
