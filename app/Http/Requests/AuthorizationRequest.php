<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class AuthorizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('authorize');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role_id' => 'required|exists:roles,id',
        ];
    }

     /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'role_id.required' => 'Missing role id',
            'role_id.exists' => 'Invalid role',
        ];
    }
}
