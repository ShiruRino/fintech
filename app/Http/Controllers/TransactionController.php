<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Report;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function topup(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => $request->user_id],
            ['balance' => 0]
        );

        $wallet->balance += $request->amount;
        $wallet->save();

        Report::create([
            'user_id' => $request->user_id,
            'type' => 'topup',
            'amount' => $request->amount,
            'status' => 'success',
            'description' => 'Topup saldo',
        ]);

        return back()->with('success', 'Topup berhasil!');
    }

    public function withdrawal(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => $request->user_id],
            ['balance' => 0]
        );

        if ($wallet->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak mencukupi!');
        }

        $wallet->balance -= $request->amount;
        $wallet->save();

        Report::create([
            'user_id' => $request->user_id,
            'type' => 'withdrawal',
            'amount' => $request->amount,
            'status' => 'success',
            'description' => 'Withdrawal saldo',
        ]);

        return back()->with('success', 'Withdrawal berhasil!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();

        if ($user->role !== 'siswa') {
            return back()->with('error', 'Hanya siswa yang bisa membeli barang.');
        }

        $product = Product::findOrFail($request->product_id);
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0]
        );

        if ($product->stock <= 0) {
            return back()->with('error', 'Stok produk habis.');
        }

        if ($wallet->balance < $product->price) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }

        // Kurangi saldo siswa (buyer)
        $wallet->balance -= $product->price;
        $wallet->save();

        // Tambah saldo toko (seller)
        $sellerWallet = Wallet::firstOrCreate(
            ['user_id' => $product->user_id],
            ['balance' => 0]
        );
        $sellerWallet->balance += $product->price;
        $sellerWallet->save();

        // Kurangi stok produk
        $product->stock -= 1;
        $product->save();

        // Simpan transaksi sesuai struktur tabel
        $transaction = Transaction::create([
            'product_id'  => $product->id,
            'buyer_id'    => $user->id,
            'seller_id'   => $product->user_id,
            'quantity'    => 1,
            'total_price' => $product->price,
        ]);

        // Buat laporan untuk siswa (pembeli)
        Report::create([
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
            'status' => 'success',
            'type' => 'transaction',
            'amount' => $product->price,
            'description' => 'Pembelian produk ' . $product->name,
        ]);

        // Buat laporan untuk toko (penjual)
        Report::create([
            'user_id' => $product->user_id,
            'transaction_id' => $transaction->id,
            'status' => 'success',
            'type' => 'transaction',
            'amount' => $product->price,
            'description' => 'Penjualan produk ' . $product->name . ' kepada ' . $user->name,
        ]);

        return back()->with('success', 'Pembelian berhasil!');
    }

}
