@section('optional_css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('optional_js')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $('.delete-row').on('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.preventDefault();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                        this.closest('form').submit();
                    }
                })
            })
        });
    </script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Recipe') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <x-button-link class="float-right" href="{{ route('recipe.pagination') }}">{{ __('Paginate') }}</x-button>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </x-slot>
    @if(session('success'))
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    @endif
    @if(session('delete'))
        <x-alert-danger>
            {{ session('delete') }}
        </x-alert-danger>
    @endif
    <form class="form-horizontal" action="" method="GET">
        <x-card class="col-sm-12">
            <x-slot name="title">{{ __('Filter') }}</x-slot>
            <div class="form-group row">
                <div class="col-sm-5">
                    <select name="category_id" class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-5">
                    <select name="ingredient_id" class="form-control select2 {{ $errors->has('ingredient_id') ? 'is-invalid' : '' }}">
                        <option value="">Pilih Ingredient</option>
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="submit" value="{{ __('Cari') }}" class="form-control btn-success">
                    </div>
                </div>
            </div>
        </x-card>
    </form>
    <x-card-navbar>
        <x-slot name="header">
            <li class="pt-2 px-3"><h3 class="card-title">{{ __('Recipe') }}</h3></li>
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" href="{{ route('recipe.index') }}">{{ __('List') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-profile-tab" href="{{ route('recipe.create') }}">{{ __('Add') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-messages-tab" href="#">{{ __('Edit') }}</a>
            </li>
        </x-slot>
        <div class="col-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Ingredients') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recipes as $recipe)
                        <tr>
                            <td>{{ $recipe->id }}</td>
                            <td>{{ $recipe->name }}</td>
                            <td>{{ $recipe->category->name }}</td>
                            <td>
                                <ul>
                                    @foreach($recipe->details as $detail)
                                        <li>{{ $detail->ingredient->name }} {{ $detail->amount }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $recipe->description }}</td>
                            <td>
                                <x-button-link class="btn-warning btn-sm mr-2" href="{{ route('recipe.edit', $recipe->id) }}"><i class="fa fa-pencil-alt"></i></x-button-link>
                                <form method="POST" class="d-inline" action="{{ route('recipe.destroy', $recipe->id) }}">
                                    @csrf
                                    @method('delete')
                                    <x-button-link class="btn-danger btn-sm delete-row">
                                        <i class="fa fa-trash"></i>
                                    </x-button-link>
                                </form>
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
            {{ $recipes->links('pagination::bootstrap-4') }}
        </div>
    </x-card-navbar>
</x-app-layout>
