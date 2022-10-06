@extends('layouts.app')

@section('title') My Information @endsection

@section('page-css')
    <link rel="stylesheet" href="vendor/filepond/css/filepond.min.css">
    <link rel="stylesheet" href="vendor/filepond/css/filepond-plugin-image-preview.min.css">
@endsection
@section('page-js')
    <script src="vendor/filepond/js/filepond.min.js"></script>
    <script src="vendor/filepond/js/filepond-plugin-image-preview.min.js"></script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview
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
            styleButtonRemoveItemPosition: 'none',
            styleLoadIndicatorPosition: 'none',
            files: [
                {
                    source: "/images/employees/{{ $employee->image }}"
                }
            ]
        });
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
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <input type="file" id="image" class="filepond" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-9 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="employee-name">FullName</label>
                                                <input id="employee-name" type="text"  class="form-control" placeholder="Employee Name" value="{{ $employee->fullname }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="employee-email">Email</label>
                                                <input id="employee-email" type="email"  class="form-control" placeholder="Employee Email" value="{{ $employee->email }}" disabled>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="employee-password">Password</label>
                                                
                                                <div class="input-group">
                                                    <input id="employee-password" type="password"  class="form-control" placeholder="Password" value="{{ Str::limit($employee->password, 15) }}" disabled>
                                                    <a href="{{ route('change-password.index') }}" class="btn btn-secondary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="department">Department</label>
                                                <input id="department" type="text"  class="form-control" placeholder="Employee Department" value="{{ $employee->department->name }}" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <input id="role" type="text"  class="form-control" placeholder="Employee Role" value="{{ $employee->role->name }}" disabled>
                                            </div>
                                        </div>
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