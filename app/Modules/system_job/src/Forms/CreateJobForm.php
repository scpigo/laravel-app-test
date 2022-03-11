<?php

namespace App\Modules\system_job\src\Forms;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Scpigo\SystemJob\Dto\SystemJobSchedulerDto;
use SystemJobManager;

class CreateJobForm {
    private $rules = [
        'action' => 'required|string',
        'action_params' => 'required|json',
        'scheduled_at' => 'required|date_format:Y-m-d H:i:s'
    ];

    private $errors = [];

    public function schedule(Request $request) {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $dto = new SystemJobSchedulerDto;

        $dto->action = $request->action;
        $dto->action_params = $request->action_params;
        $dto->scheduled_at =  Carbon::createFromFormat('Y-m-d H:i:s', $request->scheduled_at);

        $data = SystemJobManager::scheduler('sql')->schedule($dto);

        if (!$data) {
            return false;
        }

        return $data;
    }

    public function getErrors() {
        return $this->errors;
    }
}