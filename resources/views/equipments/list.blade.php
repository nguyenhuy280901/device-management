<table class="table table-striped" id="table-equipments">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($equipments as $equipment)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $equipment->name }}</td>
                <td>
                    <img style="width: 140px; height: 100px;" src="images/equipments/{{ $equipment->image }}" alt="{{ $equipment->name }}">
                </td>
                <td>{{ $equipment->description }}</td>
                <td>{{ $equipment->category->name }}</td>
                <td>
                    <span class="badge bg-{{  $equipment->status->color() }}">
                        {{ $equipment->status->description() }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('equipment.show', ['equipment' => $equipment->id]) }}" class="btn btn-success d-block">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    <a href="{{ route('equipment.edit', ['equipment' => $equipment->id]) }}" class="btn btn-warning d-block">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('equipment.destroy', ['equipment' => $equipment->id]) }}" method="POST" class="w-100" onsubmit="return confirm('Do you want to delete device \'{{ $equipment->name }}?\'')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger w-100">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>