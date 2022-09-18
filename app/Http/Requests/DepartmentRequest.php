<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => 'required|max:255',
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
            'name.required' => 'Please types department\'s name',
            'name.max' => 'The category\'s name is too long. Please truncates your department\'s name!',
            'description.required' => 'Please types department\'s description',
            'description.max' => 'The department\'s description is too long. Please truncates your department\'s description!',
        ];
    }
}
