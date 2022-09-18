@extends('layouts.app')

@section('title') Category "{{ $category->name }}" @endsection
@section('page-css')
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
@endsection
@section('page-js')
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script>
        let table = document.querySelector("#table-equipments");
        let dataTable =  new simpleDatatables.DataTable(table);
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
                                <div class="col-12 col-md-4">
                                    <strong>Category Infomation</strong>
                                    <div class="border border-primary mb-3 px-2">
                                        <div class="field">Name: {{ $category->name }}</div>
                                        <div class="field">Description: {{ $category->description }}</div>
                                    </div>
                                    <strong>Action</strong>
                                    <div class="action border border-danger p-2 round-2 d-flex justify-content-center">
                                        <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('category.destroy', ['category' => $category->id]) }}" class="mx-2" method="POST" onsubmit="return confirm('Do you want to delete category \'{{ $category->name }}?\'')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('category.index') }}" class="btn btn-secondary" title="Return back">
                                            <i class="fa-solid fa-rotate-left"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8">
                                    <strong>List Devices</strong>
                                    @include('equipments.list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection