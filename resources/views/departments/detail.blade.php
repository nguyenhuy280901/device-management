@extends('layouts.app')

@section('title') Department "{{ $department->name }}" @endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12 col-md-5">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <strong>Department Infomation</strong>
                                    <div class="border border-primary mb-3 px-2">
                                        <div class="field">
                                            <strong>Name: </strong>{{ $department->name }}
                                        </div>
                                        <div class="field">
                                            <strong>Description: </strong> {{ $department->description }}</div>
                                    </div>
                                    <strong>Action</strong>
                                    <div class="action border border-danger p-2 round-2 d-flex justify-content-center">
                                        @include('departments.action')
                                        <a href="{{ route('department.index') }}" class="btn btn-secondary" title="Return back">
                                            <i class="fa-solid fa-rotate-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection