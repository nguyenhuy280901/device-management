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

                    <div class="wrapper">
                        <strong>Action</strong>
                        <div class="border border-danger p-2">
                            @include('bookings.actions.action')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 px-0 mt-4    ">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <h4>Equipment Information</h4>
                        </div>
                        <div class="cart-body">
                            
                            <table class="table table-striped" id="table-detail" style="min-height: 270px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ($booking->details as $item)
                                        @php
                                            $equipment = $item->equipment;
                                        @endphp
                                        <tr>
                                            <th>{{ $loop->index + 1 }}</th>
                                            <th>{{ $equipment->name }}</th>
                                            <th style="width: 120px;">
                                                <img class="w-100" src="{{ asset('') }}images/equipments/{{ $equipment->image }}" alt="{{ $equipment->name }}">
                                            </th>
                                            <th>{{ $item->quantity }}</th>
                                            <th>{{ $equipment->category->name }}</th>
                                            <th>
                                                <span class="badge bg-{{  $equipment->status->color() }}">
                                                    {{ $equipment->status->description() }}
                                                </span>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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