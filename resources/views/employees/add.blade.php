@extends('layouts.app')

@section('title') Add Employee @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/filepond/css/filepond.min.css">
    <link rel="stylesheet" href="vendor/filepond/css/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="vendor/choices.js/choices.min.css">
@endsection
@section('page-js')
    <script src="vendor/filepond/js/filepond.min.js"></script>
    <script src="vendor/filepond/js/filepond-plugin-image-preview.min.js"></script>
    <script src="vendor/filepond/js/filepond-plugin-file-validate-type.min.js"></script>
    <script src="vendor/filepond/js/filepond-plugin-file-encode.min.js"></script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileEncode
        );

        // Select the file input and use 
        // create() to turn it into a pond
        FilePond.create(document.querySelector('.filepond'),  {
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg'],
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleButtonRemoveItemPosition: 'center bottom',
            styleLoadIndicatorPosition: 'center bottom',
        });
    </script>
    <script src="vendor/choices.js/choices.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="js/validate.js"></script>
@endsection
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-employee" method="POST" action="{{ route('employee.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <input type="file" id="image" class="filepond" name="image_json"/>
                                            <label for="image" class="d-block text-center">
                                                <strong>Choose Avatar</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="employee-name">FullName</label>
                                                    <input id="employee-name" type="text"  class="form-control" placeholder="Employee Name" value="{{ old('fullname') }}" name="fullname">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="employee-email">Email</label>
                                                    <input id="employee-email" type="email"  class="form-control" placeholder="Employee Email" value="{{ old('email') }}" name="email">
                                                </div>
                                            </div>
        
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="employee-password">Password</label>
                                                    <input id="employee-password" type="password"  class="form-control" placeholder="Password" value="{{ old('password') }}" name="password">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="department">Department</label>
                                                    <select name="department_id" id="department" class="form-select choices">
                                                        <option value="">Choose department</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>
                                                                {{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select name="role_id" id="role" class="form-select choices">
                                                        <option value="">Choose role</option>

                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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