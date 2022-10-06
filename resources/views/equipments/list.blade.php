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
                    @include('equipments.action')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>