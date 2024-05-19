@extends('layout.auth', ['title' => 'Login'])

@section('mainContent')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            @if (session('success'))
                <div class="alert alert-success my-4">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger my-4">{{ session('error') }}</div>
            @endif
            <div class="card-header text-center">
                <a href="#" class="h1"><b>User</b>Login</a>
            </div>
            <div class="card-body">
                <form action="{{ route('login.post') }}" method="post" class="formGrid">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email"
                            value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            value="{{ old('password') }}">
                    </div>
                    @error('password')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{ route('signup') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
