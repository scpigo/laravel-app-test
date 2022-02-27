<?php

namespace App\Modules\posts_metrics\src\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'group_type' => 'present|string|max:32',
            'page' => 'present|integer',
            'pageSize' => 'present|integer',
            'sort' => 'present|string|max:32',
            'sortType' => 'present|string|max:32',
        ];
    }

    public function messages()
    {
        return [];
    }
}
