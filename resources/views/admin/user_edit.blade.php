@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="mb-4">
    <h2>Edit User</h2>
    <form action="/users/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required value="{{ old('username', $user->username) }}">
            @error('username')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (isi jika ingin ganti)</label>
            <input type="password" name="password" class="form-control">
            @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="administrator" @if(old('role', $user->role)=='administrator') selected @endif>Administrator</option>
                <option value="bankmini" @if(old('role', $user->role)=='bankmini') selected @endif>Bank Mini</option>
                <option value="toko" @if(old('role', $user->role)=='toko') selected @endif>Toko</option>
                <option value="siswa" @if(old('role', $user->role)=='siswa') selected @endif>Siswa</option>
            </select>
            @error('role')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/users" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 