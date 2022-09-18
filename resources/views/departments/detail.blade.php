@extends('layouts.app')

@section('title') Department "{{ $department->name }}" @endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4 mb-3">
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
                                        <a href="{{ route('department.edit', ['department' => $department->id]) }}" class="btn btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('department.destroy', ['department' => $department->id]) }}" class="mx-2" method="POST" onsubmit="return confirm('Do you want to delete department \'{{ $department->name }}?\'')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('department.index') }}" class="btn btn-secondary" title="Return back">
                                            <i class="fa-solid fa-rotate-left"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8">
                                    <strong>Manager</strong>
                                    @empty($manager)
                                        <div>
                                            The {{ $department->name }} department does not have a manager!
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="image-wrapper"class="overflow-hidden">
                                                    <img src="images/employees/{{ $manager->image }}"  style="width: 160px; height: 160px; object-fit:cover; object-position: top;" alt="{{ $manager->fullname }}" class="rounded-circle">
                                                </div>
                                            </div>
                                            <div class="col-9 d-flex flex-column justify-content-center">
                                                <div class="field">
                                                    <strong>Name: </strong>
                                                    <a href="{{ route('employee.show', ['employee' => $manager->id]) }}">
                                                        {{ $manager->fullname }}
                                                    </a>
                                                </div>
                                                <div class="field">
                                                    <strong>Email: </strong>
                                                    <a href="mailto:{{ $manager->email }}">
                                                        {{ $manager->email }}
                                                    </a>
                                                </div>
                                                <div class="action">
                                                    <strong>Action: </strong>
                                                    <a href="{{ route('employee.show', ['employee' => $manager->id]) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('employee.edit', ['employee' => $manager->id]) }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endempty
                                </div>

                                <div class="col-12">
                                    <strong>Employees working at {{ $department->name }} Department</strong>
                                    <div class="row mt-2">
                                        @include('employees.list')
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