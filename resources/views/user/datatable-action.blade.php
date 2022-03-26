@if($user->id != Auth::id())
<x-button-link class="btn btn-warning btn-sm mr-2" href="{{ route('user.edit', $user->id) }}">{{ __('Edit') }}</x-button-link>

<form method="POST" class="d-inline" action="{{ route('user.destroy', $user->id) }}">
    @csrf
    @method('delete')
    <x-button-link class="btn btn-danger btn-sm delete-row">
        {{ __('Delete') }}
    </x-button-link>
</form>
@endif