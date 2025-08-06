<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::where('user_id', Auth::id())->get();
        return view('toko.products.index', compact('products'));
    }

    public function create()
    {
        return view('toko.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',    
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('products', 'public');
                Log::info('Image uploaded successfully: ' . $imagePath);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                return back()->withErrors(['image' => 'Gagal mengupload gambar: ' . $e->getMessage()]);
            }
        }
        
        try {
            $product = \App\Models\Product::create([
                'user_id' => Auth::id(),
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'image' => $imagePath,
            ]);
            Log::info('Product created successfully with image: ' . $imagePath);
            return redirect('/toko/products')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Product creation failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal menyimpan produk: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $product = Product::with('user')->findOrFail($id);
        return response()->json($product);
    }

    public function edit($id)
    {
        $product = \App\Models\Product::where('user_id', Auth::id())->findOrFail($id);
        return view('toko.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::where('user_id', Auth::id())->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $data = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);
        return redirect('/toko/products')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::where('user_id', Auth::id())->findOrFail($id);
        $product->delete();
        return redirect('/toko/products')->with('success', 'Produk berhasil dihapus.');
    }

    public function salesHistory()
    {
        $transactions = \App\Models\Transaction::with(['buyer', 'product'])
            ->where('seller_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('toko.products.sales_history', compact('transactions'));
    }

    protected function authorizeToko()
    {
        if (Auth::user()->role !== 'toko') {
            abort(403, 'Only user with role \"toko\" can perform this action.');
        }
    }
}
