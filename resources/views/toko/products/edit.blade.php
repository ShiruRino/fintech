@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
<div class="mb-4">
    <h2>Edit Produk</h2>
    <form action="{{ route('toko.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
            @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
            @error('stock')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk (opsional)</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Gambar Produk" style="max-width:120px;max-height:120px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('toko.products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 