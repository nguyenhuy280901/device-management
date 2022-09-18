@extends('layouts.app')

@section('title') List Categories @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
@endsection
@section('page-js')
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script>
        let table = document.querySelector("#table-categories");
        let dataTable =  new simpleDatatables.DataTable(table);
    </script>
@endsection
@section('action-button')
    <div class="action-button d-flex justify-content-end p-3">
        <a href="{{ route('category.create') }}" class="btn btn-success mx-2" title="Add new category">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
@endsection
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table-categories">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="d-flex justify-content-between">
                                    <a href="{{ route('category.show', ['category' => $category->id]) }}" class="btn btn-success">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST" onsubmit="return confirm('Do you want to delete category \'{{ $category->name }}?\'')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection