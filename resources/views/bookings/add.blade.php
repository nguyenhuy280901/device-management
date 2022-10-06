@extends('layouts.app')
@section('title') Book Device @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/choices.js/choices.min.css">
@endsection
@section('page-js')
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
                            <form class="form form-booking" method="POST" action="{{ route('book-device.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="employee">Employee</label>
                                            <input id="employee" type="text"  class="form-control" placeholder="Employee Name" value="{{ Auth::user()->fullname }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="equipment">Equipment</label>
                                            <select name="equipment_id" id="equipment" class="form-select choices">
                                                <option value="">Choose equipment</option>
                                                @foreach ($equipments as $equipment)
                                                    <option value="{{ $equipment->id }}" @selected(old('equipment_id') == $equipment->id)>
                                                        {{ $equipment->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="booking-content">Content</label>
                                            <textarea name="content" id="booking-content" class="form-control" rows="6" placeholder="Booking content">{{ old('content') }}</textarea>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <label for="datetimepicker">Intended return date</label>
                                            <input type='date' class="form-control" name="return_intented_date"  id='datetimepicker'/>
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