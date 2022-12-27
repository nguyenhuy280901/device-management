<table class="table table-striped" id="table-equipments">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $item)
        
            @php
            // dd($item);
                $equipment = $item->equipment;

            @endphp
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $equipment->name }}</td>
                <td>
                    <img style="width: 140px; height: 100px;" src="images/equipments/{{ $equipment->image }}" alt="{{ $equipment->name }}">
                </td>
                <td>{{ $equipment->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $equipment->category->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>