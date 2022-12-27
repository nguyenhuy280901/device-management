<table class="table table-striped" id="table-booking">
    <thead>
        <tr>
            <th>#</th>
            @empty($employee)
                <th>Employee Request</th>
            @endempty
            <th>Status</th>
            <th>Booking Date</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>
                    {{  $booking->employee->fullname }}
                </td>
                <td>
                    <span class="badge bg-{{  $booking->status->color() }}">
                        {{ $booking->status->description() }}
                    </span>
                </td>
                
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->content }}</td>
                <td style="width: 60px;">
                    @include('bookings.actions.action')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function submitForm(status, booking){
        document.querySelector(`.form-booking.form-booking-${ booking } input[name=status]`).setAttribute('value', status);
        document.querySelector(`.form-booking.form-booking-${ booking }`).submit();
    }
</script>