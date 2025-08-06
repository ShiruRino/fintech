@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="mb-4 text-center">Register</h4>
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>
          <div class="mb-3">
            <input type="hidden" name="role" class="form-control" value="siswa" required>
          </div>
          </div>
          <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        <div class="mt-3 text-center">
          <span>Sudah punya akun? <a href="/login">Login</a></span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 