@extends('layouts.app')
@section('title', 'Dashboard Siswa')
@section('content')
<div class="text-center mb-4">
  <h2>Dashboard Siswa</h2>
</div>
<div class="row g-4 justify-content-center">
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body text-center">
        <h5 class="card-title">Lakukan Transaksi</h5>
        <a href="/index.php" class="btn btn-outline-primary">Transaksi</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body text-center">
      <h5 class="card-title">Saldo Anda</h5>
      <h3 class="text-success">Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body text-center">
        <h5 class="card-title">Riwayat Transaksi</h5>
        <a href="/reports" class="btn btn-outline-info">Riwayat</a>
      </div>
    </div>
  </div>
</div>
@endsection
