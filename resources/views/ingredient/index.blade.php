@section('optional_css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('optional_js')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            var table = $('.table').DataTable({
                order: [ 0, "desc" ],
                responsive: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: '{!! route('ingredient.datatable') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action', 'orderable': false },
                ],
                drawCallback: function( settings ) {
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
                }
            });
        })
    </script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Ingredient') }}</h1>
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
    @if(session('delete'))
        <x-alert-danger>
            {{ session('delete') }}
        </x-alert-danger>
    @endif
    <x-card-navbar>
        <x-slot name="header">
            <li class="pt-2 px-3"><h3 class="card-title">{{ __('Ingredient') }}</h3></li>
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" href="{{ route('ingredient.index') }}">{{ __('List') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-profile-tab" href="{{ route('ingredient.create') }}">{{ __('Add') }}</a>
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
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </x-card-navbar>
</x-app-layout>
