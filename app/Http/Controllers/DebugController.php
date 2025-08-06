<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DebugController extends Controller
{
    public function show()
    {
        $uploaded_files = [];
        if (Storage::disk('public')->exists('products')) {
            $files = Storage::disk('public')->files('products');
            $uploaded_files = $files;
        }
        
        return view('debug_upload', compact('uploaded_files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'test_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('test_image')) {
                $path = $request->file('test_image')->store('products', 'public');
                Log::info('Debug upload successful: ' . $path);
                
                return back()->with('success', 'Upload berhasil! File: ' . $path);
            }
        } catch (\Exception $e) {
            Log::error('Debug upload failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Upload gagal: ' . $e->getMessage()]);
        }

        return back()->withErrors(['error' => 'Tidak ada file yang diupload']);
    }
} 