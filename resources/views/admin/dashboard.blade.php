@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<div class="text-center mb-4">
  <h2>Dashboard Admin</h2>
</div>
<div class="row g-4 justify-content-center">
  <div class="col-md-5 col-lg-4">
    <div class="card shadow-sm h-100">
      <div class="card-body text-center">
        <h5 class="card-title">Manajemen User</h5>
        <a href="/users" class="btn btn-outline-primary">Kelola</a>
      </div>
    </div>
  </div>
  <div class="col-md-5 col-lg-4">
    <div class="card shadow-sm h-100">
      <div class="card-body text-center">
        <h5 class="card-title">Laporan Transaksi</h5>
        <a href="/reports" class="btn btn-outline-primary">Lihat</a>
      </div>
    </div>
  </div>
</div>
@endsection
