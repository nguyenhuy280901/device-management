<form class="d-inline" method="POST" action="{{ route('allocate.update', ['allocate' => $booking->id]) }}">
    @method('PUT')
    @csrf
    <button type="submit" class="btn btn-primary my-1" title="Allocate Device">
        <i class="fa-solid fa-building-circle-arrow-right"></i>
    </button>
</form>