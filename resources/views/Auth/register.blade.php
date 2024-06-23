@extends('_layouts.main')
@section('content')
    <div class="card card-register">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('Proses-register') }}">
                @csrf
                <div class="form-group mb-3">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                </div>
                <div class="form-group mb-3">
                    <i class="fas fa-briefcase"></i>
                    <input type="text" name="posisi" class="form-control" placeholder="Posisi" required>
                </div>
                <div class="form-group mb-3">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="nomer_hp" class="form-control" placeholder="Nomer HP" required>
                </div>
                <div class="form-group mb-3">
                    <i class="fas fa-clipboard-list"></i>
                    <input type="text" name="perusahaan" class="form-control" placeholder="Perusahaan">
                </div>
                <div class="form-group mb-3">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group mb-3">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="reenter_password" class="form-control" placeholder="Re-enter Password"
                        required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
@endsection
