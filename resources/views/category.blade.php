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
                    <button type="button" name="add_Category" id="add_Category" class="btn btn-success"> Add
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        <input type="hidden" name="category_id" id="category_id">

                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Status:</label><br>
                                <select for="status" class="form-control" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">In-active</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

            $('#add_Category').click(function() {
                $('#categoryForm').trigger("reset");
                $('#categoryModal').modal('show');
                $('#category_id').val('');
                $('.modal-title').text('Add Category');

            });

            // Handle form submission
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData($('#categoryForm')[0]);


                // Perform the AJAX request
                $.ajax({
                    url: "{{ route('addCategory') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            swal("Success!", response.success, "success");
                            $('#categoryModal').modal('hide');
                            $('#tables_data').DataTable().ajax.reload(null, false);
                        } else {
                            swal("Error!", response.error, "error");
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
            $('body').on('click', '.editBtn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('editCategory', '') }}/" + id,
                    method: 'GET',
                    success: function(response) {
                        console.log(response.status);
                        $('#category_name').val(response.category_name);
                        $('#status').val(response.status);
                        $('#category_id').val(response.id);
                        $('.modal-title').text('Edit Category');
                        $('#categoryModal').modal('show');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            $('#tables_data').on('click', '.viewSubcategories', function() {
                var categoryId = $(this).data('id');
                $.ajax({
                    url: "{{ route('subcategory', ':id') }}".replace(':id', categoryId),
                    method: 'GET',
                    success: function(response) {
                        if (response.length) {
                            var html = '';
                            $.each(response, function(index, value) {
                                html += '<tr>';
                                html += '<td>' + (index + 1) + '</td>';
                                html += '<td>' + value.category_name + '</td>';
                                html += '<td>' +
                                    '<i class="fa-duotone fa-toggle-on"></i>' +
                                    value.status + '</td>';
                                html += '</tr>';
                            });
                        } else {

                            html += '<tr>';
                            html += '<td colspan="3" class="text-center">' +
                                'No Subcategory of this category' + '</td>';
                            html +=
                                '</tr>';;
                        }
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

            $('body').on('click', '.statusBtn', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('toggleStatus', ':id') }}".replace(':id', id),
                    method: 'PUT',
                    success: function(response) {
                        if (response.success) {
                            swal("Success!", response.success, "success");
                            $('#tables_data').DataTable().ajax.reload(null,
                                false
                            ); // Reload the DataTable without resetting the pagination
                        } else {
                            swal("Error!", response.error, "error");
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
