<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreEmployeeRequest extends FormRequest
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
            'fullname' => 'required|max:255',
            'image_json' => 'required',
            'email' => 'required|unique:employees|email',
            'password' => 'required|max:255|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'fullname.required' => 'Please types fullname of employee',
            'image_json.required' => 'Please choose image of employee',
            'fullname.max' => 'The fullname is too long. Please truncates the employee\'s fullname!',
            'email.required' => 'Please types employee\'s email',
            'email.unique' => 'The employee\'s email has already exist. Please type the difference email!',
            'email.email' => 'The employee\'s email is invalid. Please type the difference email!',
            'password.required' => 'Please types the password of employee\'s account',
            'password.max' => 'The password is too long. Please truncates the employee\'s password!',
            'password.regex' => 'New password should have minimum eight characters, at least one letter and one number',
            'department_id.required' => 'Please choose the deparment that employee is working at',
            'department_id.exists' => 'Invalid the employee\'s department',
            'role_id.required' => 'Please choose the employee\'s role',
            'role_id.exists' => 'Invalid the employee\'s role',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationException($validator);
    }
}
