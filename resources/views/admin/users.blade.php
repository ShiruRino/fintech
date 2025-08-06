@extends('layouts.app')
@section('title', 'Kelola User')
@section('content')
<div class="mb-4">
    <h2>Kelola User</h2>
    <a href="/users/create" class="btn btn-success mb-3">Tambah User</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role === 'bankmini' ? 'Bank Mini' : ucfirst($user->role)}}</td>
            <td>
                <a href="/users/{{ $user->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                <form action="/users/{{ $user->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada user.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
