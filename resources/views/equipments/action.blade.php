@can('view-all-device')
    <a href="{{ route('all-equipment.show', ['all_equipment' => $equipment->id]) }}" class="btn btn-success d-block">
        <i class="fa-regular fa-eye"></i>
    </a>
@elsecan('view-department-device')
    <a href="{{ route('department-equipment.show', ['department_equipment' => $equipment->id]) }}" class="btn btn-success d-block">
        <i class="fa-regular fa-eye"></i>
    </a>
@elsecan('view-allocated-device')
    <a href="{{ route('allocated-equipment.show', ['department_equipment' => $equipment->id]) }}" class="btn btn-success d-block">
        <i class="fa-regular fa-eye"></i>
    </a>
@endcan

@can('recover-device')
    <form class="d-block" method="POST" action="{{ route('recover.update', ['recover' => $equipment->id]) }}">
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-primary my-1 w-100" title="Recover Device">
            <i class="fa-solid fa-recycle"></i>
        </button>
    </form>
@endcan

@can('update-device')
    <a href="{{ route('equipment.edit', ['equipment' => $equipment->id]) }}" class="btn btn-warning d-block">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
@endcan

@can('delete-device')
    <form action="{{ route('equipment.destroy', ['equipment' => $equipment->id]) }}" method="POST" class="w-100" onsubmit="return confirm('Do you want to delete device \'{{ $equipment->name }}?\'')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger w-100">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
@endcan