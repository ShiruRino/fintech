@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('content')
<h3 class="mb-4">Riwayat Topup & Withdrawal</h3>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Jenis</th>
      <th>Nominal</th>
      <th>Status</th>
      <th>Waktu</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reports as $report)
    <tr>
      <td>{{ $report->user->name }}</td>
      <td>{{ ucfirst($report->type) }}</td>
      <td>Rp {{ number_format($report->amount, 0, ',', '.') }}</td>
      <td>{{ ucfirst($report->status) }}</td>
      <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
