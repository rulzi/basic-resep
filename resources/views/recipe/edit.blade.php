@section('optional_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('optional_js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $('.select2category').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Category",
                allowClear: true,
                delay: 250,
                ajax: {
                    url: "{{ route('category.select2') }}",
                    data: function (params) {
                        var query = {
                            search: params.term,
                        }

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    }
                },
            });

            $('.select2ingredient').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Ingredient",
                allowClear: true,
                delay: 250,
                ajax: {
                    url: "{{ route('ingredient.select2') }}",
                    data: function (params) {
                        var query = {
                            search: params.term,
                        }

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    }
                },
            });

            $( document ).on( "click" , ".input-ingredient", function(e) {
                var html
                html += '<tr class="ingredient-list">';
                html += '<td><select name="ingredient_id[]" class="form-control select2ingredient"></select></td>';
                html += '<td><x-input class="amount" type="text" name="amount[]" /></td>';
                html += '<td><button type="button" class="btn btn-primary btn-sm input-ingredient"><i class="fas fa-plus"></i></button><button type="button" class="btn btn-danger btn-sm remove-ingredient"><i class="fas fa-trash"></i></button></td>';
                html += '</tr>';
                $("#datail-ingredients").append(html);
                
                $('.select2ingredient').select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Ingredient",
                    allowClear: true,
                    delay: 250,
                    ajax: {
                        url: "{{ route('ingredient.select2') }}",
                        data: function (params) {
                            var query = {
                                search: params.term,
                            }

                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id,
                                    }
                                })
                            };
                        }
                    },
                });
            });

            $( document ).on( "click" , ".remove-ingredient", function(e) {
                $( this ).closest( ".ingredient-list" ).remove();
            });
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
                
            </div><!-- /.col -->
        </div><!-- /.row -->
    </x-slot>
    @if(session('success'))
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    @endif
    <form class="form-horizontal" action="{{ route('recipe.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        <x-card-navbar>
            <x-slot name="header">
                <li class="pt-2 px-3"><h3 class="card-title">{{ __('Recipe') }}</h3></li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-home-tab" href="{{ route('recipe.index') }}">{{ __('List') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" href="{{ route('recipe.create') }}">{{ __('Add') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-messages-tab" href="#">{{ __('Edit') }}</a>
                </li>
            </x-slot>
            @csrf
            @method("PUT")
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Name') }}</x-label>
                <div class="col-sm-10">
                    <x-input id="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" :value="old('name', $recipe->name)"/>
                    @if ($errors->has('name'))
                        <small class="error invalid-feedback">{{ $errors->first('name') }}</small>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Pilih Kategori') }}</x-label>
                <div class="col-sm-10">
                    <select name="category_id" class="form-control select2category {{ $errors->has('category_id', $recipe->category_id) ? 'is-invalid' : '' }}">
                        @if(!empty($recipe->category_id))
                            <option value="{{ $recipe->category_id }}" selected="selected">{{ $recipe->category->name }}</option>
                        @endif
                    </select>
                    @if ($errors->has('category_id'))
                        <small class="error invalid-feedback">{{ $errors->first('category_id') }}</small>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Description') }}</x-label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description">{{ old('description', $recipe->description) }}</textarea>
                    @if ($errors->has('description'))
                        <small class="error invalid-feedback">{{ $errors->first('description') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('Ingredient') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th width="20%">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="datail-ingredients">
                        @forelse ($recipe->details as $detail)
                            <tr class="ingredient-list">
                                <td>
                                    <select name="ingredient_id[]" class="form-control select2ingredient">
                                        @if(!empty($detail->ingredient_id))
                                            <option value="{{ $detail->ingredient_id }}" selected="selected">{{ $detail->ingredient->name }}</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <x-input class="amount" type="text" name="amount[]" :value="$detail->amount" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm input-ingredient"><i class="fas fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm remove-ingredient"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <select name="ingredient_id[]" class="form-control select2ingredient"></select>
                                </td>
                                <td>
                                    <x-input class="amount" type="text" name="amount[]" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm input-ingredient"><i class="fas fa-plus"></i></button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <x-button class="float-right">{{ __('Save') }}</x-button>
            </x-slot>
        </x-card-navbar>
    </form>
</x-app-layout>
