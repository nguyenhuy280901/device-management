<?php

namespace App\Broadcasting;

use App\Models\Employee;
use Illuminate\Support\Facades\Gate;

class ManagerBookingChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param \App\Models\Employee $user
     * @param  $department_id
     * @return array|bool
     */
    public function join(Employee $user, $department_id)
    {
        return Gate::allows('approve-booking-manager') && $user->department_id == $department_id;
    }
}
