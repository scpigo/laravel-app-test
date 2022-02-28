<?php

namespace App\Modules\posts_metrics\src\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class PostsMetricsSearchRequest extends FormRequest
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
            'group_type' => 'present|string|max:32|in:vk,ok,fb',
            'page' => 'present|integer',
            'pageSize' => 'present|integer',
            'sort' => 'present|string|max:32|in:post_id,views,likes,comments,reposts',
            'sortType' => 'present|string|max:32|in:asc,desc',
        ];
    }

    public function messages()
    {
        return [];
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
