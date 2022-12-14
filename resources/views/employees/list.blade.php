@foreach ($employees as $employee)
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-content">
                <div class="img-wrapper" style="height: 260px;">
                    <img class="w-100 h-100" style="object-fit: cover; object-position: top;" src="images/employees/{{ $employee->image }}" alt="{{ $employee->fullname }}">
                </div>
                <div class="card-body px-3 py-2">
                    <h4 class="card-title">
                        {{ $employee->fullname }}
                    </h4>
                    <div class="field">
                        <strong>Email: </strong>
                        <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                    </div>
                    <div class="field">
                        <strong>Department: </strong> {{ $employee->department->name }}
                    </div>
                    <div class="field">
                        <strong>Role: </strong> {{ $employee->role->name }}
                    </div>
                </div>
            </div>
            <div class="card-footer py-2 d-flex justify-content-end">
                @include('employees.action')
            </div>
        </div>
    </div>
@endforeach