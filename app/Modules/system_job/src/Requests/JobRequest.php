<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'action' => 'required|string',
            'action_vars' => 'required|json',
            'scheduled_at' => 'required|date_format:Y-m-d H:i:s'
        ];
    }

    protected function failedValidation(Validator $validator) {
        $json = [
            'data' => $validator->errors(),
            'statusText' => 'Ошибка валидации',
            'status' => 'error'
        ];

        $response = new JsonResponse($json, 422);
        
        throw (new ValidationException($validator, $response))->status(422);
    }
}
