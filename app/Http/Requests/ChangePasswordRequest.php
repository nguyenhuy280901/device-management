<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', function($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect'));
                }
            }],
            'new_password' => 'required|max:255|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'current_password.required' => 'Please type the current password',
            'new_password.required' => 'Please type the current password',
            'new_password.max' => 'The new password is too long. Please truncate it!',
            'new_password.regex' => 'New password should have minimum eight characters, at least one letter and one number',
            'confirm_password.required' => 'Please type the current password',
            'confirm_password.same' => 'Confirm password does not match with new password',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationException($validator);
    }
}
