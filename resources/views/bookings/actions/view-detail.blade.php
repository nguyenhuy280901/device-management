@can('view-all-booking')
    <a class="btn btn-warning my-1" href="{{ route('all-booking.show', ['all_booking' => $booking->id]) }}">
        <i class="fa-regular fa-eye"></i>
    </a>
@elsecan('view-department-booking')
    <a class="btn btn-warning my-1" href="{{ route('department-booking.show', ['department_booking' => $booking->id]) }}">
        <i class="fa-regular fa-eye"></i>
    </a>
@else
    <a class="btn btn-warning my-1" href="{{ route('my-booking.show', ['my_booking' => $booking->id]) }}">
        <i class="fa-regular fa-eye"></i>
    </a>
@endcan