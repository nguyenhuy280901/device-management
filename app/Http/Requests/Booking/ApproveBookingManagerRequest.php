<?php

namespace App\Http\Requests\Booking;

use App\Enumerations\ApproveLevel;
use App\Enumerations\BookingStatus;
use App\Models\Booking;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ApproveBookingManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $booking = Booking::find($this->approve_booking_manager);
        $checkLevel = true;

        foreach($booking->details as $item)
        {
            if($item->equipment->approve_level == ApproveLevel::DIRECTOR)
            {
                $checkLevel = false;
                break;
            }
        }
        
        $employee = $booking->employee;

        return $checkLevel && Auth::user()->department_id == $employee->department_id;
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
