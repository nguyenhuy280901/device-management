@extends('layouts.app')

@section('title') List Roles @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
@endsection
@section('page-js')
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script>
        let table = document.querySelector("#table-roles");
        let dataTable =  new simpleDatatables.DataTable(table);
    </script>
@endsection

@can('create-role')
    @section('action-button')
    <div class="action-button d-flex justify-content-end p-3">
        <a href="{{ route('role.create') }}" class="btn btn-success mx-2" title="Add new role">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    @endsection
@endcan

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table-roles">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td class="d-flex justify-content-between">
                                    @include('roles.action')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection