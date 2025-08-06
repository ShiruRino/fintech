@extends('layouts.app')
@section('title', 'Dashboard Toko')
@section('content')
<div class="text-center mb-4">
  <h2>Dashboard Toko</h2>
</div>
<div class="row g-4 justify-content-center">
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
        <h5 class="card-title">Kelola Produk</h5>
        <a href="{{ route('toko.products.index') }}" class="btn btn-primary">Produk</a>
      </div>        
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body text-center">
        <h5 class="card-title">Riwayat Penjualan</h5>
        <a href="{{ route('toko.sales_history') }}" class="btn btn-info">Transaksi</a>
      </div>
    </div>
  </div>
</div>
@endsection
