@extends('layouts.app')
@section('title', 'Debug Upload')
@section('content')
<div class="mb-4">
    <h2>Debug Upload Foto</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Test Upload</h5>
            <form action="{{ route('debug.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="test_image" class="form-label">Pilih Gambar Test</label>
                    <input type="file" name="test_image" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Test</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Info Sistem</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Storage Path:</strong> {{ storage_path('app/public') }}
                </li>
                <li class="list-group-item">
                    <strong>Public Storage:</strong> {{ public_path('storage') }}
                </li>
                <li class="list-group-item">
                    <strong>Storage Link Exists:</strong> {{ is_link(public_path('storage')) ? 'Yes' : 'No' }}
                </li>
                <li class="list-group-item">
                    <strong>Products Folder:</strong> {{ storage_path('app/public/products') }}
                </li>
                <li class="list-group-item">
                    <strong>Products Folder Exists:</strong> {{ is_dir(storage_path('app/public/products')) ? 'Yes' : 'No' }}
                </li>
                <li class="list-group-item">
                    <strong>Products Folder Writable:</strong> {{ is_writable(storage_path('app/public/products')) ? 'Yes' : 'No' }}
                </li>
            </ul>
        </div>
    </div>

    @if(isset($uploaded_files))
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">File yang Sudah Diupload</h5>
            <ul class="list-group list-group-flush">
                @foreach($uploaded_files as $file)
                <li class="list-group-item">
                    <strong>{{ $file }}</strong>
                    <br>
                    <img src="{{ asset('storage/' . $file) }}" alt="Uploaded" style="max-width: 100px; max-height: 100px;" class="mt-2">
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection 