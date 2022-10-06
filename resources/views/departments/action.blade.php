@if (request()->route()->getName() != 'department.show')
    <a href="{{ route('department.show', ['department' => $department->id]) }}" class="btn btn-success mx-1">
        <i class="fa-regular fa-eye"></i>
    </a>
@endif

@can('update-department')
    <a href="{{ route('department.edit', ['department' => $department->id]) }}" class="btn btn-warning mx-1">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
@endcan

@can('delete-department')
    <form action="{{ route('department.destroy', ['department' => $department->id]) }}" method="POST" onsubmit="return confirm('Do you want to delete department \'{{ $department->name }}?\'')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mx-1">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
@endcan