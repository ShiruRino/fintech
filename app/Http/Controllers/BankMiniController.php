<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;

class BankMiniController extends Controller
{
    public function dashboard()
    {
        // Ambil semua pengguna (siswa dan toko)
        $users = \App\Models\User::whereIn('role', ['siswa', 'toko'])->get();

        // Kirim data ke view
        return view('bankmini.dashboard', compact('users'));
        }

    public function history()
    {
        $reports = \App\Models\Report::whereIn('type', ['topup', 'withdrawal'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bankmini.history', compact('reports'));
    }
}
