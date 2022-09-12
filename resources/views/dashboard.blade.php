@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="fa-sharp fa-solid fa-laptop-code"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Available Devices</h6>
                                <h6 class="font-extrabold mb-0">100</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="fa-solid fa-network-wired"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Allocated Devices</h6>
                                <h6 class="font-extrabold mb-0">100</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon orange">
                                    <i class="fa-sharp fa-solid fa-screwdriver-wrench"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Repairing Devices</h6>
                                <h6 class="font-extrabold mb-0">100</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="fa-sharp fa-solid fa-circle-exclamation"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Damaged Devices</h6>
                                <h6 class="font-extrabold mb-0">100</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
