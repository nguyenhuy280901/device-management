<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name.required' => 'Please types category\'s name',
            'name.max' => 'The category\'s name is too long. Please truncates your category\'s name!',
            'description.required' => 'Please types category\'s description',
            'description.max' => 'The category\'s description is too long. Please truncates your category\'s description!',
        ];
    }
}
