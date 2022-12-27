<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique|max:255',
            'description' => 'required|max:255'
        ];
    }

    /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please types category\'s name',
            'name.unique' => 'The category has already exist. Please type the difference category!',
            'name.max' => 'The category\'s name is too long. Please truncates your category\'s name!',
            'description.required' => 'Please types category\'s description',
            'description.max' => 'The category\'s description is too long. Please truncates your category\'s description!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationException($validator);
    }
}
