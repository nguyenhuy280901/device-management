@extends('layouts.app')

@section('title') List Devices @endsection
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
@section('action-button')
    <div class="action-button d-flex justify-content-end p-3">
        <a href="{{ route('equipment.create') }}" class="btn btn-success mx-2" title="Add new device">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
@endsection
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table-equipments">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $equipment->name }}</td>
                                <td>
                                    <img style="width: 140px; height: 100px;" src="images/equipments/{{ $equipment->image }}" alt="{{ $equipment->name }}">
                                </td>
                                <td>{{ $equipment->description }}</td>
                                <td>{{ $equipment->category->name }}</td>
                                <td>
                                    <span class="badge bg-{{  $equipment->status->color() }}">
                                        {{ $equipment->status->description() }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('equipment.destroy', ['equipment' => $equipment->id]) }}" method="POST">
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection