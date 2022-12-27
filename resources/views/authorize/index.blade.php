@extends('layouts.app')

@section('title') Authorize @endsection

@section('page-css')
    <link rel="stylesheet" href="vendor/choices.js/choices.min.css">
@endsection

@section('page-js')
    <script src="vendor/choices.js/choices.min.js"></script>
    <script src="js/authorize.js"></script>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-3">
                <strong>Roles</strong>
                <div class="border border-primary rounded p-4">
                    <select name="role_id" id="role" class="choices form-control">
                        <option value="">Choose role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <label style="corlor:red;" class="error"></label>
                    
                    <button id="load-pemissions" style="width: 160px;" class="btn btn-primary ms-auto">
                        Load Permissions
                    </button>
                </div>
            </div>

            <div class="col-12 col-md-9">
                <strong>Permissions</strong>
                <div class="wrapper border border-success rounded p-4">
                    <div class="d-flex flex-column flex-wrap justify-content-between" style="max-height: 290px;">
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success permission-check" name="permissions[]" id="checkbox-{{ $permission->id }}" value="{{ $permission->id }}" disabled>
                                    <label class="form-check-label" for="checkbox-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="action pt-3 d-flex justify-content-end">
                        <button id="reset" class="btn btn-secondary me-2" disabled>Clear All</button>
                        <button id="update-permissions" class="btn btn-info" disabled>Update Permissions</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection