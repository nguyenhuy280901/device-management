<?php

namespace App\Http\Requests;

use App\Enumerations\ApproveLevel;
use App\Enumerations\EquipmentStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class EquipmentRequest extends FormRequest
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
            'name' => 'required|max:255',
            'status' => ['required', Rule::in(EquipmentStatus::values())],
            'approve_level' => ['required', Rule::in(ApproveLevel::values())],
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|max:255',
            'image_json' => 'required'
        ];
    }

    /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please types device\'s name',
            'name.max' => 'The device\'s name is too long. Please truncates your device\'s name!',
            'status.required' => 'Please choose device\'s status',
            'status.in' => 'Invalid device\'s status',
            'approve_level.required' => 'Please choose approve level',
            'approve_level.in' => 'Invalid approve level',
            'category_id.required' => 'Please choose category',
            'category_id.exists' => 'Invalid category',
            'description.required' => 'Please types device\'s description',
            'description.max' => 'The device\'s description is too long. Please truncates your device\'s description!',
            'image_json.required' => 'Please choose image of device',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationException($validator);
    }
}