@extends('layouts.app')

@section('title') {{ $title }} @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
@endsection
@section('page-js')
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script>
        let table = document.querySelector("#table-equipments");
        let dataTable =  new simpleDatatables.DataTable(table);
    </script>
@endsection

@can('create-device')
    @section('action-button')
    <div class="action-button d-flex justify-content-end p-3">
        <a href="{{ route('equipment.create') }}" class="btn btn-success mx-2" title="Add new device">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    @endsection
@endcan

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('equipments.list')
            </div>
        </div>
    </section>
@endsection