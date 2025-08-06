@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('content')
<div class="container">
  <h2 class="mb-4">Riwayat Transaksi</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Pengguna</th>
        <th>Tipe</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Keterangan</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      @forelse($reports as $report)
      <tr>
        <td>{{ $report->id }}</td>
        <td>{{ $report->user->name ?? 'Tidak Diketahui' }}</td>
        <td>{{ ucfirst($report->type) }}</td>
        <td>Rp {{ number_format($report->amount, 0, ',', '.') }}</td>
        <td>{{ ucfirst($report->status) }}</td>
        <td>{{ $report->description }}</td>
        <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center">Tidak ada transaksi.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
