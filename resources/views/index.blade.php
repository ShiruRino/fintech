@extends('layouts.app')
@section('title', 'Beranda')
@section('content')

@if(request('q'))
    <div class="alert alert-info">Hasil pencarian untuk: <strong>{{ request('q') }}</strong></div>
@endif

<div class="mb-4">
    <h2>Daftar Produk</h2>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse($products as $product)
    <div class="col">
        <div class="card h-100 shadow-sm">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="Gambar Produk" style="object-fit:cover;max-height:180px;">
            @else
                <img src="{{ asset('storage/placeholder/dark.png')}}" class="card-img-top" alt="No Image" style="object-fit:cover;max-height:180px;">
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text mb-1">Harga: <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                <p class="card-text mb-3">Stok: {{ $product->stock }}</p>
                <div class="mt-auto">
                    @if(auth()->check() && auth()->user()->role === 'siswa')
                        <!-- Tombol buka modal -->
                        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#beliModal{{ $product->id }}">
                            Beli
                        </button>
                    @else
                        <span class="text-muted small">Login sebagai siswa untuk membeli</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pembelian -->
    @if(auth()->check() && auth()->user()->role === 'siswa')
    <div class="modal fade" id="beliModal{{ $product->id }}" tabindex="-1" aria-labelledby="beliModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="seller_id" value="{{ $product->user_id }}">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="total_price" value="{{ $product->price }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="beliModalLabel{{ $product->id }}">Konfirmasi Pembelian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin membeli <strong>{{ $product->name }}</strong> seharga
                            <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>?</p>
                        <p class="text-muted mb-0">Produk ini dijual oleh <strong>{{ $product->user->name ?? 'Penjual Tidak Diketahui' }}</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Beli Sekarang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    @empty
    <div class="col-12">
        <div class="alert alert-warning text-center">Tidak ada produk tersedia.</div>
    </div>
    @endforelse
</div>
@endsection
