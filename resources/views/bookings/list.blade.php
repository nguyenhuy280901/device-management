<table class="table table-striped" id="table-equipments">
    <thead>
        <tr>
            <th>#</th>
            @empty($employee)
                <th>Employee Request</th>
            @endempty
            <th>Equipment Name</th>
            <th>Image</th>
            <th>Status</th>
            <th>Booking Date</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                @empty($employee)
                    <td>
                        <a href="{{ route('employee.show', ['employee' => $booking->employee->id]) }}">
                            {{  $booking->employee->fullname }}
                        </a>
                    </td>
                @endempty
                <td>
                    <a href="{{ route('equipment.show', ['equipment' => $booking->equipment->id]) }}">
                        {{ $booking->equipment->name }}
                    </a>
                </td>
                <td>
                    <img style="width: 140px; height: 100px;" src="images/equipments/{{ $booking->equipment->image }}" alt="{{ $booking->equipment->name }}">
                </td>
                <td>
                    <span class="badge bg-{{  $booking->status->color() }}">
                        {{ $booking->status->description() }}
                    </span>
                </td>
                
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->content }}</td>
                <td>
                    @include('bookings.action')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>