@php
    use \App\Enumerations\BookingStatus;
    use \App\Enumerations\ApproveLevel;
@endphp

@if(in_array(request()->route()->getName(), ['all-booking.show', 'department-booking.show', 'my-booking.show']))
    <a href="{{ url()->previous() }}" class="btn btn-secondary" title="Return back">
        <i class="fa-solid fa-rotate-left"></i>
    </a>
@else
    @include('bookings.actions.view-detail')
@endif

@if($booking->status == BookingStatus::PENDINGDIRECTOR)
    @can('approve-booking-director')
        @include('bookings.actions.approve-director')
    @endcan
@endif

@if ($booking->status == BookingStatus::PENDINGMANAGER)
    @can('approve-booking-director')
        @include('bookings.actions.approve-director')
    @elsecan('approve-booking-manager')
        @include('bookings.actions.approve-manager')
    @endcan
@endif

@if($booking->status == BookingStatus::APPROVED)
    @can('allocate-device')
        @include('bookings.actions.allocate')
    @endcan
@endif