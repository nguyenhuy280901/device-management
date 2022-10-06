@extends('layouts.app')

@section('title') Employee "{{ $employee->fullname }}" @endsection
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

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 border border-success me-2">
                                    <img class="w-100" src="/images/employees/{{ $employee->image }}" alt="{{ $employee->fullname }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <strong>Employee information</strong>
                                    <div class="border border-primary px-2">
                                        <div class="field">
                                            <strong>Fullname: </strong>{{ $employee->fullname }}
                                        </div>
                                        <div class="field">
                                            <strong>Email: </strong>
                                            <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                        </div>
                                        <div class="field">
                                            <strong>Department: </strong> {{ $employee->department->name }}
                                        </div>
                                        <div class="field col-6">
                                            <strong>Role: </strong> {{ $employee->role->name }}
                                        </div>
                                    </div>
                                    
                                    <div class="action">
                                        <strong>Action</strong>
                                        <div class="border border-danger p-2 round-2 d-flex justify-content-center">
                                            @include('employees.action')
                                        </div>
                                    </div>
                                </div>

                                @canany(['view-all-device', 'view-department-device'])
                                    <div class="col-12 mt-4">
                                        <h4>List Devices</h4>
                                        @include('equipments.list')
                                    </div>
                                @endcanany
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection