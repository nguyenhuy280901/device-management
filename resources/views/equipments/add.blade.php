@extends('layouts.app')

@section('title') Add Device @endsection
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
                            <form class="form form-equipment" method="POST" action="{{ route('equipment.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="wrapper d-flex align-items-center w-100 h-100">
                                            <div class="form-group w-100">
                                                <input type="file" class="filepond mt-auto" name="image_json"/>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-5 col-12 border-start border-dark">
                                        <div class="form-group">
                                            <label for="device-name">Device Name</label>
                                            <input id="device-name" type="text"  class="form-control" placeholder="Device Name" value="{{ old('name') }}" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="device-status">Status</label>
                                            <select name="status" id="device-status" class="form-select choices">
                                                <option value="">Choose device's status</option>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->value }}" @selected(old('status') == $status->value)>
                                                        {{ $status->description() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category_id" id="category" class="form-select choices">
                                                <option value="">Choose category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="approve-level">Approve Level</label>
                                            <select name="approve_level" id="approve-level" class="form-select choices">
                                                <option value="">Choose approve level</option>
                                                @foreach ($approveLevels as $level)
                                                    <option value="{{ $level->value }}" @selected(old('approve_level') == $level->value)>
                                                        {{ $level->description() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="description">
                                                Description
                                            </label>
                                            <textarea class="form-control" id="description" placeholder="Device description" name="description" rows="11">{{ old('description') }}</textarea>
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