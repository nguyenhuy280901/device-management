@if (request()->route()->getName() != 'role.show')
    <a href="{{ route('role.show', ['role' => $role->id]) }}" class="btn btn-success mx-1">
        <i class="fa-regular fa-eye"></i>
    </a>
@endif

@can('update-role')
    <a href="{{ route('role.edit', ['role' => $role->id]) }}" class="btn btn-warning mx-1">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
@endcan

@can('delete-role')
    <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST" onsubmit="return confirm('Do you want to delete role \'{{ $role->name }}?\'')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mx-1">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
@endcan