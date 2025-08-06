<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();
        return Wallet::with('user')->get();
    }

    public function show($id)
    {
        $wallet = Wallet::with('user')->findOrFail($id);

        if (Auth::id() !== $wallet->user_id && Auth::user()->role !== 'administrator') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($wallet);
    }

    public function topup(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1000',
        ]);

        $wallet = Wallet::where('user_id', $request->user_id)->firstOrFail();

        $report = Report::create([
            'user_id' => $request->user_id,
            'type' => 'topup',
            'amount' => $request->amount,
            'status' => 'pending',
            'description' => 'Topup request'
        ]);

        return response()->json([
            'message' => 'Topup request created. Please update report status to success to apply balance.',
            'report' => $report
        ]);
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $wallet = Auth::user()->wallet;

        $report = Report::create([
            'user_id' => Auth::id(),
            'type' => 'withdrawal',
            'amount' => $request->amount,
            'status' => 'pending',
            'description' => 'Withdrawal request'
        ]);

        return response()->json([
            'message' => 'Withdrawal request created. Please update report status to success to deduct balance.',
            'report' => $report
        ]);
    }

    protected function authorizeAdmin()
    {
        if (Auth::user()->role !== 'administrator') {
            abort(403, 'Only administrator can perform this action.');
        }
    }
}
