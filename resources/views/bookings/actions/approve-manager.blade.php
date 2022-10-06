@php
    use \App\Enumerations\BookingStatus;
@endphp

<form class="d-inline" method="POST" action="{{ route('approve-booking-manager.update', ['approve_booking_manager' => $booking->id]) }}">
    @method('PUT')
    @csrf
    <input type="hidden" name="status" value="{{ BookingStatus::APPROVED->value }}">

    <button type="submit" class="btn btn-success my-1" title="Approve">
        <i class="fa-solid fa-check"></i>
    </button>
</form>

<form class="d-inline" method="POST" action="{{ route('approve-booking-manager.update', ['approve_booking_manager' => $booking->id]) }}">
    @method('PUT')
    @csrf
    <input type="hidden" name="status" value="{{ BookingStatus::DISAPPROVED->value }}">

    <button type="submit" class="btn btn-danger my-1" title="Disapprove">
        <i class="fa-solid fa-xmark"></i>
    </button>
</form>