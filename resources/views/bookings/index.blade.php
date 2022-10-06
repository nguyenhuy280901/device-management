@extends('layouts.app')

@section('title') {{ $title }} @endsection

@section('page-css')
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
@endsection
@section('page-js')
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script>
        let table = document.querySelector("#table-booking");
        let dataTable =  new simpleDatatables.DataTable(table);
    </script>
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                @include('bookings.list')
            </div>
        </div>
    </section>
@endsection