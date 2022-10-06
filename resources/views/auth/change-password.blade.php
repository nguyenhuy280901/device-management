@extends('layouts.app')

@section('title') Change Password @endsection

@section('page-js')
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="js/validate.js"></script>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-5">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-change-password" method="POST" action="{{ route('change-password.update', ['change_password' => Auth::id()]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="current-password">Current Password</label>
                                            
                                            <input id="current-password" type="password"  class="form-control" value="{{ old('current_password') }}" name="current_password">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="current-password">New Password</label>
                                            
                                            <input id="new-password" type="password"  class="form-control" value="{{ old('new_password') }}" name="new_password">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password</label>
                                            
                                            <input id="confirm-password" type="password"  class="form-control" value="{{ old('confirm_password') }}" name="confirm_password">
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