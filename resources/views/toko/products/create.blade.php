@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
<div class="mb-4">
    <h2>Tambah Produk</h2>
    <form action="{{ route('toko.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required value="{{ old('price') }}">
            @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock') }}">
            @error('stock')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk (opsional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
            @error('error')<div class="text-danger small">{{ $message }}</div>@enderror
            <small class="form-text text-muted">Format: JPG, PNG, GIF, WEBP. Maksimal 2MB.</small>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('toko.products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 