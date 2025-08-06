@extends('layouts.app')
@section('title', 'Riwayat Penjualan')
@section('content')
<div class="mb-4">
    <h2>Riwayat Penjualan</h2>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Pembeli</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transactions as $trx)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $trx->buyer->name ?? $trx->buyer->username }}</td>
            <td>{{ $trx->product->name }}</td>
            <td>{{ $trx->quantity }}</td>
            <td>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
            <td>{{ $trx->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada penjualan.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection 