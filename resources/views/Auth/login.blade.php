@extends('_layouts.main')
@section('content')
    <div class="card card-register">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('Process-login') }}">
                @csrf
                <div class="form-group mb-3">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group mb-3">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
@endsection
