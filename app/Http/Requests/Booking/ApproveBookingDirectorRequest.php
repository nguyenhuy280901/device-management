<?php

namespace App\Http\Requests\Booking;

use App\Enumerations\BookingStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ApproveBookingDirectorRequest extends FormRequest
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
            'status' => ['required', Rule::in(
                [BookingStatus::APPROVED->value, BookingStatus::DISAPPROVED->value]
            )]
        ];
    }
    
    /**
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'status.required' => 'Please choose booking\'s status',
            'status.in' => 'Invalid booking\'s status',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationException($validator);
    }
}
