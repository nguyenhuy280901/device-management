@extends('layouts.app')

@section('title') List Employees @endsection

@section('action-button')
    <div class="action-button d-flex justify-content-end p-3">
        <a href="{{ route('employee.create') }}" class="btn btn-success mx-2" title="Add new employee">
            <i class="fa-solid fa-user-plus"></i>
        </a>
    </div>
@endsection
@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                @include('employees.list')
            </div>
        </div>
    </section>
@endsection