<?php

namespace App\Http\Requests\Booking;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreBookingRequest extends FormRequest
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
            // 'equipment_id' => 'required|exists:equipments,id',
            'content' => 'required|max:255',
            'return_intented_date' => 'required|after:now'
        ];
    }

    /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'equipment_id.required' => 'Please choose equipment',
            'equipment_id.exists' => 'Not found equipment',
            'content.required' => 'Please types the content of your booking',
            'content.max' => 'The booking\'s content is too long. Please truncates booking\'s content!',
            'return_intented_date.required' => 'Please choose equipment intented return date',
            'return_intented_date.after' => 'Intented return date must be after today',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationException($validator);
    }
}
