<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RoleRequest extends FormRequest
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
            'name' => 'required|max:255'
        ];
    }

    /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please types role\'s name',
            'name.max' => 'The role\'s name is too long. Please truncates your role\'s name!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationException($validator);
    }
}
