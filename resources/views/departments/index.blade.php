@extends('layouts.app')

@section('title') List Departments @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
@endsection
@section('page-js')
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script>
        let table = document.querySelector("#table-departments");
        let dataTable =  new simpleDatatables.DataTable(table);
    </script>
@endsection
@can('create-department')
    @section('action-button')
    <div class="action-button d-flex justify-content-end p-3">
        <a href="{{ route('department.create') }}" class="btn btn-success mx-2" title="Add new department">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    @endsection
@endcan
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table-departments">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description }}</td>
                                <td class="d-flex justify-content-between">
                                    @include('departments.action')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection