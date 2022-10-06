@extends('layouts.app')
@section('title') Booking Detail @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="wrapper">
                    <strong>Employee Information</strong>
                    <div class="row border border-primary p-2">
                        <div class="col-md-4 col-6">
                            <div class="image-wrapper">
                                <img src="images/employees/{{ $booking->employee->image }}" alt="{{ $booking->employee->fullname }}" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-8 col-6">
                            <div class="field">
                                <strong>Fullname: </strong>
                                {{ $booking->employee->fullname }}
                            </div>
                            <div class="field">
                                <strong>Role: </strong>
                                {{ $booking->employee->role->name }}
                            </div>
                            <div class="field">
                                <strong>Department: </strong>
                                {{ $booking->employee->department->name }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <strong>Equipment Information</strong>
                    <div class="row border border-success p-2">
                        <div class="col-md-4 col-6">
                            <div class="image-wrapper">
                                <img src="images/equipments/{{ $booking->equipment->image }}" alt="{{ $booking->equipment->name }}" class="w-100">
                            </div>
                        </div>
                        
                        <div class="col-md-8 col-6">
                            <div class="field">
                                <strong>Name: </strong>
                                {{ $booking->equipment->name }}
                            </div>
                            <div class="field">
                                <strong>Category: </strong>
                                {{ $booking->equipment->category->name }}
                            </div>
                            <div class="field">
                                <strong>Status: </strong>
                                <span class="badge bg-{{  $booking->equipment->status->color() }}">
                                    {{ $booking->equipment->status->description() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="wrapper">
                    <strong>Booking Infomation</strong>
                    <div class="border border-info p-2">
                        <div class="field">
                            <strong>Content: </strong>
                                {{ $booking->content }}
                        </div>
                        <div class="field">
                            <strong>Status: </strong>
                            <span class="badge bg-{{  $booking->status->color() }}">
                                {{ $booking->status->description() }}
                            </span>
                        </div>
                        <div class="field">
                            <strong>Booking date: </strong>
                            {{ $booking->booking_date }}
                        </div>
                        <div class="field">
                            <strong>Allocated date: </strong>
                            {{ $booking->allocated_date ?? 'Unallocated' }}
                        </div>
                        <div class="field">
                            <strong>Intented return date: </strong>
                            {{ $booking->return_intented_date ?? 'None' }}
                        </div>
                        <div class="field">
                            <strong>Actual return date: </strong>
                            {{ $booking->return_actual_date ?? 'None' }}
                        </div>
                    </div>
                </div>

                <div class="wrapper">
                    <strong>Action</strong>
                    <div class="border border-danger p-2">
                        @include('bookings.actions.action')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm(status, booking){
            document.querySelector(`.form-booking.form-booking-${ booking } input[name=status]`).setAttribute('value', status);
            document.querySelector(`.form-booking.form-booking-${ booking }`).submit();
        }
    </script>
@endsection