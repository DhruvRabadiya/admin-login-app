@extends('layout.auth')
@section('mainContent')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            @if (session('success'))
                <div class="alert alert-success my-4">{{ session('success')}}</div>
            @endif
            <div class="card-header text-center">
                <a href="#" class="h1"><b>User</b>Login</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{url('/')}}/login" method="post" class="formGrid">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="fullName" class="form-control" placeholder="Full Name" value="{{old('fullName')}}">
                    </div>
                    @error('fullName')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="userName" value="{{old('userName')}}">
                    </div>
                    @error('userName')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                    </div>
                    @error('email')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
                    </div>
                    @error('password')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="tel" class="form-control" placeholder="Mobile Number" name="mobileNumber" value="{{old('mobileNumber')}}">
                    </div>
                    @error('mobileNumber')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" placeholder="Date Of Birth" name='DateOfBirth' value="{{old('DateOfBirth')}}">
                    </div>
                    @error('DateOfBirth')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
