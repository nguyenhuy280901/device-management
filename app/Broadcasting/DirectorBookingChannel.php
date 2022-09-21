<?php

namespace App\Broadcasting;

use App\Models\Employee;
use Illuminate\Support\Facades\Gate;

class DirectorBookingChannel
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
     * @param  \App\Models\Employee  $user
     * @return array|bool
     */
    public function join(Employee $user)
    {
        return Gate::allows('approve-booking-director');
    }
}
