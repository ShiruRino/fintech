@extends('layouts.app')
@section('title', 'Kelola Produk')
@section('content')
<div class="mb-4">
    <h2>Kelola Produk</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('toko.products.create') }}" class="btn btn-success mb-3">Tambah Produk</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Gambar Produk" style="max-width:60px;max-height:60px;object-fit:cover;" class="img-thumbnail">
                @else
                    <img src="https://via.placeholder.com/60x60?text=No+Image" alt="No Image" class="img-thumbnail">
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ route('toko.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('toko.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada produk.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection 