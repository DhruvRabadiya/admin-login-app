@extends('layout.app', ['title' => 'Category'])
@section('mainContent')
    <div class="wrapper">
        <!-- Navbar -->
        @include('.includes.nav')
        <!-- /.navbar -->

        @include('includes.aside')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Main Categories</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Add Category</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div align="right">
                    <button type="button" name="add_Users" id="add_Users" class="btn btn-success"> Add
                        Category</button>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <section class="content">
                                            <table class="table table-bordered" id="tables_data">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>URL</th>
                                                        <th>Description</th>
                                                        <th>Sub-category</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </section>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('includes.footer')

    </div>
    <!-- ./wrapper -->

    <!-- Subcategory Modal -->
    <div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="subcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subcategoryModalLabel">Subcategories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="subcategory_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Description</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('js/adminlte.min.js') }}"></script> --}}
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#tables_data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'subcategory',
                        name: 'subcategory',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    searchable: false,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return meta.row + 1;
                    }
                }]
            });

            $('#tables_data').on('click', '.viewSubcategories', function() {
                var categoryId = $(this).data('id');
                $.ajax({
                    url: "{{ route('subcategory', ':id') }}".replace(':id', categoryId),
                    method: 'GET',
                    success: function(response) {
                        var html = '';
                        $.each(response, function(index, value) {
                            html += '<tr>';
                            html += '<td>' + (index + 1) + '</td>';
                            html += '<td>' + value.category_name + '</td>';
                            html += '<td>' + value.url + '</td>';
                            html += '<td>' + value.description + '</td>';
                            html += '<td>' + '<i class="fa-duotone fa-toggle-on"></i>' +value.status + '</td>';
                            html += '</tr>';
                        });
                        $('#subcategory_table tbody').html(html);
                        $('#subcategoryModal').modal('show');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

                // Delete button handler
                $('body').on('click', '.deleteBtn', function() {
                    var id = $(this).data('id');

                    if (confirm('Are You Sure Want To Delete This Category?')) {
                        $.ajax({
                            url: "{{ route('deleteCategory', '') }}/" + id,
                            method: 'DELETE',
                            success: function(response) {
                                if (response.success) {
                                    swal("Success!", response.success, "success");
                                    table.ajax.reload(null,
                                        false
                                    ); // Reload the DataTable without resetting the pagination
                                }
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                    }
                });


        });
    </script>
@endsection
