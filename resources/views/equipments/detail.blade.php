@extends('layouts.app')

@section('title') Device "{{ $equipment->name }}" @endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 border border-success me-2">
                                    <img class="w-100" src="/images/equipments/{{ $equipment->image }}" alt="{{ $equipment->name }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <strong>Equipment information</strong>
                                    <div class="border border-primary px-2">
                                        <div class="field">Name: {{ $equipment->name }}</div>
                                        <div class="field">Status: 
                                            <span class="badge bg-{{  $equipment->status->color() }}">
                                                {{ $equipment->status->description() }}
                                            </span>
                                        </div>
                                        <div class="field">Category: {{ $equipment->category->name }}</div>
                                        <div class="field col-6">Description: {{ $equipment->description }}</div>
                                    </div>
                                    
                                    <div class="action">
                                        <strong>Action</strong>
                                        <div class="border border-danger p-2 round-2 d-flex justify-content-center">
                                            @can('update-device')
                                                <a href="{{ route('equipment.edit', ['equipment' => $equipment->id]) }}" class="btn btn-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            @endcan
                                            
                                            @can('delete-device')
                                                <form action="{{ route('equipment.destroy', ['equipment' => $equipment->id]) }}" method="POST" class="mx-2" onsubmit="return confirm('Do you want to delete device \'{{ $equipment->name }}?\'')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                            
                                            <a href="{{ url()->previous() }}" class="btn btn-secondary" title="Return back">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </a>
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