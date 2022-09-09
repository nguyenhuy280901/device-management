@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Devices</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Simple Datatable
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $equipment->name }}</td>
                                <td>{{ $equipment->image }}</td>
                                <td>{{ $equipment->description }}</td>
                                <td>
                                    <span class="badge bg-{{ $equipment->status->color() }}">
                                        {{ $equipment->status->description() }}
                                    </span>
                                </td>
                                <td>{{ $equipment->category_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
