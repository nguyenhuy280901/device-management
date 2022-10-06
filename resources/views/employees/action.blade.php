@if (in_array(request()->route()->getname(), ['all-employee.show', 'department-employee.show']))
    @can('update-employee')
        <a href="{{ route('employee.edit', ['employee' => $employee->id]) }}" class="btn btn-warning" title="Edit employee's profile">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    @endcan
    
    @can('delete-employee')
        <form action="{{ route('employee.destroy', ['employee' => $employee->id]) }}" method="POST" class="mx-2" onsubmit="return confirm('Do you want to delete employee \'{{ $employee->fullname }}?\'')">
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
@else
    @can('view-all-employee')
        <a href="{{ route('all-employee.show', ['all_employee' => $employee->id]) }}" class="card-link">
            <i class="fa-solid fa-eye"></i>
        </a>
    @elsecan('view-department-employee')
        <a href="{{ route('department-employee.show', ['department_employee' => $employee->id]) }}" class="card-link">
            <i class="fa-solid fa-eye"></i>
        </a>
    @endcan
    @can('update-employee')
        <a href="{{ route('employee.edit', ['employee' => $employee->id]) }}" class="card-link">
            <i class="fa-regular fa-pen-to-square"></i>
        </a>
    @endcan
@endif