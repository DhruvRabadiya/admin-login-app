    @extends('layout.app', ['title' => 'All User'])

    @section('mainContent')
        <div class="wrapper">

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
                        <button type="button" name="add_Users" id="add_Users" class="btn btn-success"> Add
                            Users</button>
                    </div><!-- /.container-fluid -->
                </section>

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

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"> <i
                                class="fa-solid fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="user_form">
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                                <span id="full_name_error" class='text-danger errors'></span>
                            </div>
                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" required>
                                <span id="user_name_error" class='text-danger errors'></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <span id="email_error" class='text-danger errors'></span>
                            </div>
                            <div class="form-group pass">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span id="password_error" class='text-danger errors'></span>
                            </div>
                            <div class="form-group">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
                                <span id="mobile_number_error" class='text-danger errors'></span>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                <span id="dob_error" class='text-danger errors'></span>
                            </div>
                        </form>
                        <span id="form_result"></span>
                        <input type="hidden" name="action" id="action" value="Add">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" id="change_password" name="change_password"
                            style="margin-right: 68px;">Want to Change Your Password?</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="button" class="btn btn-primary" name="action_btn" id="action_btn"
                            value="Add Users" />
                    </div>
                </div>
            </div>
        </div>




        <!-- Change Password Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changePasswordForm">
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" id="change_password_user_id">
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    placeholder="Current Password">
                                <span id="oldPassword_error" class='text-danger errors'></span>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="New Password">
                                <span id="newPassword_error" class='text-danger errors'></span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" placeholder="Confirm Password">
                                <span id="confirmPassword_error" class='text-danger errors'></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="change_password_btn">Change Password</button>
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
                    $('#user_form')[0].reset();
                    $('.modal-title').text('Add New User');
                    $('#action_btn').val('Add User');
                    $('#action').val('Add');
                    $('#user_id').val('');
                    $('#form_result').html('');
                    $('#staticBackdrop').modal('show');
                    $('.pass').show();
                    $('#change_password').hide();
                });

                $('#action_btn').click(function() {
                    $('#action_btn').attr('disabled', true);
                    $('.errors').html('');
                    var formData = new FormData($('#user_form')[0]);
                    $.ajax({
                        url: '{{ route('addUser') }}',
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(response) {
                            $('#action_btn').attr('disabled', false);
                            $('#staticBackdrop').modal('hide');
                            if (response.success) {
                                swal("Success!", response.success, "success");
                                table.ajax.reload(null,
                                    false); // Reload the DataTable without resetting the pagination
                            }
                        },
                        error: function(error) {
                            $('#action_btn').attr('disabled', false);
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

                // Edit button handler
                $('body').on('click', '.editBtn', function() {
                    var id = $(this).data('id');
                    $('#change_password').show();
                    console.log(id);

                    $.ajax({
                        url: "{{ route('editUser', '') }}/" + id,
                        method: 'GET',
                        success: function(response) {
                            $('#full_name').val(response.full_name);
                            $('#user_name').val(response.user_name);
                            $('#email').val(response.email);
                            $('#mobile_number').val(response.mobile_number);
                            $('#date_of_birth').val(response.date_of_birth);
                            // $('#password').val(response.password)
                            $('#user_id').val(response.id);
                            $('.modal-title').text('Edit User');
                            $('#action_btn').val('Edit User');
                            $('#action').val('Edit');
                            $('.pass').hide();
                            $('#form_result').html('');
                            $('#staticBackdrop').modal('show');
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });

                // Delete button handler
                $('body').on('click', '.deleteBtn', function() {
                    var id = $(this).data('id');

                    if (confirm('Are You Sure Want To Delete This User?')) {
                        $.ajax({
                            url: "{{ route('deleteUser', '') }}/" + id,
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


                $('#change_password').click(function() {
                    var user_id = $('#user_id').val();
                    $('#change_password_user_id').val(user_id);
                    $('#staticBackdrop').modal('hide');
                    $('#exampleModal').modal('show');
                    clearPasswordErrors();
                });

                $('#change_password_btn').click(function() {
                    var formData = {
                        user_id: $('#change_password_user_id').val(),
                        old_password: $('#old_password').val(),
                        new_password: $('#new_password').val(),
                        new_password_confirmation: $('#confirm_password').val()
                    };

                    $.ajax({
                        url: "{{ route('changePassword') }}",
                        method: "POST",
                        data: formData,
                        dataType: "json",
                        success: function(data) {
                            if (data.errors) {
                                if (data.errors.old_password) {
                                    $('#oldPassword_error').html(data.errors.old_password[0]);
                                }
                                if (data.errors.new_password) {
                                    $('#newPassword_error').html(data.errors.new_password[0]);
                                }
                                if (data.errors.new_password_confirmation) {
                                    $('#confirmPassword_error').html(data.errors
                                        .new_password_confirmation[0]);
                                }
                            }
                            if (data.success) {
                                $('#changePasswordForm')[0].reset();
                                $('#exampleModal').modal('hide');
                                swal("Success!", data.success, "success");
                            }
                        },
                        error: function(xhr) {
                            var response = xhr.responseJSON;
                            if (response.errors) {
                                if (response.errors.old_password) {
                                    $('#oldPassword_error').html(response.errors.old_password[0]);
                                }
                                if (response.errors.new_password) {
                                    $('#newPassword_error').html(response.errors.new_password[0]);
                                }
                                if (response.errors.new_password_confirmation) {
                                    $('#confirmPassword_error').html(response.errors
                                        .new_password_confirmation[0]);
                                }
                            }
                        }
                    });
                });


                $('#exampleModal').on('hidden.bs.modal', function() {
                    clearPasswordErrors();
                });

                function clearPasswordErrors() {
                    $('#oldPassword_error').html('');
                    $('#newPassword_error').html('');
                    $('#confirmPassword_error').html('');
                }

                $('.btn-close, .btn-secondary').click(function() {
                    $('.errors').html('');
                    $('#staticBackdrop').modal('hide');
                    $('#exampleModal').modal('hide');

                });
            });
        </script>
    @endsection
