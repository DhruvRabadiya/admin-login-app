@extends('layout.app', ['title' => 'Products'])
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
                            <h1>Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Add Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div align="right">
                    <button type="button" name="add_Product" id="add_Product" class="btn btn-success"> Add
                        Products</button>
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
                                                        <th>Image</th>
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
    <div class="modal fade" id="productModel" tabindex="-1" role="dialog" aria-labelledby="productLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <input type="hidden" name="product_id" id="product_id">

                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="parentCategory">Select Category</label>
                            <select name="category_id" class="form-control" id="category" required>
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parentCategory">Select subcategories</label>
                            <select name="subcategory_id" class="form-control" id="subCategory" required>
                                <option value="">Select Subcategory</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->category_name }}</option>
                                @endforeach
                            </select>
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
                ajax: "{{ route('products') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            var imageUrl = '{{ asset('storage/') }}/' + data;
                            return '<img src="' + imageUrl + '" alt="Product Image" width="100">';
                        }
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
            //Add Product
            $('#add_Product').click(function() {
                $('#productModel').modal('show');
                $('.modal-title').text('Add Product');
                $('#productForm').trigger("reset");


            });
            // Edit button handler
            $('body').on('click', '.editBtn', function() {
                var id = $(this).data('id');

                // Fetch product details via AJAX
                $.ajax({
                    url: "{{ route('editProduct', '') }}/" + id,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Populate form fields with product details
                            $('#product_id').val(response.data.id);
                            $('#product_name').val(response.data.product_name);
                            $('#category').val(response.data.category_id);
                            $('#subCategory').val(response.data.subcategory_id);
                            $('#status').val(response.data.status);
                        $('.modal-title').text('Edit Product');

                            // Show the edit product modal
                            $('#productModel').modal('show');
                        } else {
                            swal("Error!", response.error, "error");
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            // Handle image update
            $('#productForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('addProduct') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            swal("Success!", response.success, "success");
                            $('#productModel').modal('hide');
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

            // $('#productForm').submit(function(e) {
            //     e.preventDefault();

            //     var formData = new FormData(this);

            //     $.ajax({
            //         url: "{{ route('addProduct') }}",
            //         method: 'POST',
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(response) {
            //             if (response.success) {
            //                 swal("Success!", response.success, "success");
            //                 $('#productModel').modal('hide');
            //                 $('#tables_data').DataTable().ajax.reload(null, false);
            //             } else {
            //                 swal("Error!", response.error, "error");
            //             }
            //         },
            //         error: function(response) {
            //             console.log(response);
            //         }
            //     });
            // });
            // $('body').on('click', '.editBtn', function() {
            //     var id = $(this).data('id');

            //     // Fetch product details via AJAX
            //     $.ajax({
            //         url: "{{ route('editProduct', '') }}/" + id,
            //         method: 'GET',
            //         success: function(response) {
            //             if (response.success) {
            //                 // Populate form fields with product details
            //                 $('#product_id').val(response.data.id);
            //                 $('#product_name').val(response.data.product_name);
            //                 $('#category').val(response.data.category_id);
            //                 $('#subCategory').val(response.data.subcategory_id);
            //                 $('#status').val(response.data.status);

            //                 // Show the edit product modal
            //                 $('#productModel').modal('show');
            //             } else {
            //                 swal("Error!", response.error, "error");
            //             }
            //         },
            //         error: function(response) {
            //             console.log(response);
            //         }
            //     });
            // });

            // Delete button handler
            $('body').on('click', '.deleteBtn', function() {
                var id = $(this).data('id');


                swal({
                        title: "Are you sure ?",
                        text: "Want To Delete This Product!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('deleteProduct', '') }}/" + id,
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
