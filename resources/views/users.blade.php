@extends('layout.app', ['title' => 'All User'])

@section('mainContent')
    <div class="wrapper">
        <div class="sidebar-mini">
            @include('includes.nav')
            @include('includes.aside')
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>All New User</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Users Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div align="right">
                        <button type="button" name="add_Users" id="add_Users" class="btn btn-success"> Add Users</button>
                    </div><!-- /.container-fluid -->
                </section>

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
                                                        <th>Full Name</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Mobile Number</th>
                                                        <th>Date of Birth</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New kkkkk </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="user_form">
                        {{-- @csrf --}}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />

                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                            <span id="full_name_error" class ='text-danger errors'></span>
                        </div>
                        <div class="form-group">
                            <label for="user_name">Username</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                            <span id="user_name_error" class ='text-danger errors'></span>

                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span id="email_error" class ='text-danger errors'></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span id="password_error" class ='text-danger errors'></span>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
                            <span id="mobile_number_error" class ='text-danger errors'></span>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            <span id="dob_error" class ='text-danger errors'></span>
                        </div>
                    </form>
                    <span id="form_result"></span>
                    <input type="hidden" name="action" id="action" value="Add">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-primary" name="action_btn" id="action_btn"
                        value="Add Users" />
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
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#tables_data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('allUsers') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
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

            $('#add_Users').click(function() {
                $('.modal-title').text('Add New User');
                $('#action_btn').val('Add User');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#staticBackdrop').modal('show');
            });

            var form = $('#user_form')[0];

            $('#action_btn').click(function() {
                $('.errors').html('');
                var formData = new FormData(form);

                $.ajax({
                    url: '{{ route('addUser') }}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        $('#staticBackdrop').modal('hide');
                        if (response) {
                            swal("Success!", response.success, "success");
                        }
                        $('#tables_data').DataTable().ajax.reload();
                    },
                    error: function(error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            var errors = error.responseJSON.errors;
                            $('#full_name_error').html(errors.full_name ? errors.full_name[0] :
                                '');
                            $('#user_name_error').html(errors.user_name ? errors.user_name[0] :
                                '');
                            $('#email_error').html(errors.email ? errors.email[0] : '');
                            $('#password_error').html(errors.password ? errors.password[0] :
                            '');
                            $('#mobile_number_error').html(errors.mobile_number ? errors
                                .mobile_number[0] : '');
                            $('#dob_error').html(errors.date_of_birth ? errors.date_of_birth[
                                0] : '');
                        }
                    }
                });
            });

            $('.btn-close, .btn-secondary').click(function() {
                $('#staticBackdrop').modal('hide');
            });
        });
    </script>
@endsection
