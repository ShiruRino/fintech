@extends('layouts.app')
@section('title', 'Dashboard Bank Mini')
@section('content')
<div class="text-center mb-4">
  <h2>Dashboard Bank Mini</h2>
</div>
<div class="row g-4 justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm h-100">
      <div class="card-body text-center">
        <h5 class="card-title">Riwayat Transaksi</h5>
        <a href="{{ route('bankmini.transactions.history') }}" class="btn btn-info">Riwayat</a>
      </div>
    </div>
  </div>
</div>

<div class="mt-5">
  <h4>Daftar Siswa dan Toko</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Role</th>
        <th>Saldo</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>Rp {{ number_format($user->wallet->balance ?? 0, 0, ',', '.') }}</td>
        <td>
          @if($user->role === 'siswa')
            <button class="btn btn-success btn-sm" onclick="showTopupModal({{ $user->id }})">Topup</button>
            <button class="btn btn-danger btn-sm" onclick="showWithdrawalModal({{ $user->id }})">Withdrawal</button>
          @elseif($user->role === 'toko')
            <button class="btn btn-danger btn-sm" onclick="showWithdrawalModal({{ $user->id }})">Withdrawal</button>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


<!-- Modal Template -->
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="transactionForm" method="POST" action="">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="transactionModalLabel">Transaksi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" id="modalUserId">
          <input type="hidden" name="type" id="modalTransactionType">
          <div class="mb-3">
            <label for="amount" class="form-label">Nominal</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function showTopupModal(userId) {
    document.getElementById('transactionForm').action = '/transactions/topup';
    document.getElementById('modalUserId').value = userId;
    document.getElementById('modalTransactionType').value = 'topup';
    document.getElementById('transactionModalLabel').innerText = 'Topup Saldo';
    new bootstrap.Modal(document.getElementById('transactionModal')).show();
  }

  function showWithdrawalModal(userId) {
    document.getElementById('transactionForm').action = '/transactions/withdrawal';
    document.getElementById('modalUserId').value = userId;
    document.getElementById('modalTransactionType').value = 'withdrawal';
    document.getElementById('transactionModalLabel').innerText = 'Withdrawal Saldo';
    new bootstrap.Modal(document.getElementById('transactionModal')).show();
  }
</script>
@endsection
