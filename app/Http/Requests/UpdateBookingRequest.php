<?php

namespace App\Http\Requests;

use App\Enumerations\BookingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookingRequest extends FormRequest
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
            'status' => ['required', Rule::in(BookingStatus::values())],
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
}
