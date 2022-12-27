@extends('layouts.app')

@section('title') Backup Database @endsection

@section('action-button')
    @can('backup')
        <div class="action-button d-flex justify-content-end p-3">
            <a href="{{ route('backup.create') }}" class="btn btn-success mx-2" title="Create new backup">
                <i class="fa-solid fa-plus"></i>  Create new backup
            </a>
        </div>
    @endcan
@endsection
@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="backup-hour">Backup After (Hour)</label>
                        <input id="backup-hour" type="text"  class="form-control" placeholder="" value="{{ Auth::user()->fullname }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection