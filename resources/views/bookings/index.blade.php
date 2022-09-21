@extends('layouts.app')

@section('title') List Bookings @endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                @include('bookings.list')
            </div>
        </div>
    </section>
@endsection