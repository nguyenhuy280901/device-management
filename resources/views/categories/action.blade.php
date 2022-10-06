@if (request()->route()->getName() != 'category.show')
    <a href="{{ route('category.show', ['category' => $category->id]) }}" class="btn btn-success mx-1">
        <i class="fa-regular fa-eye"></i>
    </a>
@endif

@can('update-category')
    <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-warning mx-1">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
@endcan

@can('delete-category')
    <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST" onsubmit="return confirm('Do you want to delete category \'{{ $category->name }}?\'')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mx-1">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
@endcan