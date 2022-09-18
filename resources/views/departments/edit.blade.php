@extends('layouts.app')

@section('title') Edit Department {{ $department->name }} @endsection
@section('page-js')
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="js/validate.js"></script>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-department" method="POST" action="{{ route('department.update', ['department' => $department->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="department-name">Name</label>
                                            <input id="department-name" type="text"  class="form-control" placeholder="Department Name" value="{{ $department->name ?? old('name') }}" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">
                                                Description
                                            </label>
                                            <textarea class="form-control" id="description" placeholder="Department description" name="description" rows="8">{{ $department->description ?? old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection