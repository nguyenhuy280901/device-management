@extends('layouts.app')
@section('title') Booking Detail @endsection

@section('content')
    <div class="container">
        <div class="row">
            {{ $booking->employee->fullname }}
            {{ $booking->equipment->name }}
            {{ $booking->booking_date }}
            {{ $booking->status->description() }}
        </div>
    </div>
@endsection