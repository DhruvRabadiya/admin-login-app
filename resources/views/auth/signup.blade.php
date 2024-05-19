@extends('layout.auth' ,['title' => 'Signup'])
@section('mainContent')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            @if (session('success'))
                <div class="alert alert-success my-4">{{ session('success')}}</div>
            @endif
            <div class="card-header text-center">
                <a href="#" class="h1"><b>User</b>Signup</a>
            </div>
            <div class="card-body">

                <form action="{{Route('signup.post')}}" method="post" class="formGrid">
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
                        
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-0  ">
                    <a href="{{Route('login')}}" class="text-center">Already registered ? Login hear!</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
