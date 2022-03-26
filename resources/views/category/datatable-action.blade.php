<x-button-link class="btn-warning btn-sm mr-2" href="{{ route('category.edit', $category->id) }}"><i class="fa fa-pencil-alt"></i></x-button-link>
<form method="POST" class="d-inline" action="{{ route('category.destroy', $category->id) }}">
    @csrf
    @method('delete')
    <x-button-link class="btn-danger btn-sm delete-row">
        <i class="fa fa-trash"></i>
    </x-button-link>
</form>