<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = Report::with(['user', 'transaction']);

        if ($user->role !== 'administrator') {
            $query->where('user_id', $user->id);
        }

        $reports = $query->orderBy('created_at', 'desc')->get();
        return view('reports.index', compact('reports'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        if (Auth::user()->role !== 'administrator') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,success,failed',
        ]);

        if ($report->status === 'success') {
            return response()->json(['message' => 'Report already processed.'], 400);
        }

        DB::beginTransaction();
        try {
            $report->status = $request->status;
            $report->save();

            if ($request->status === 'success') {
                $this->processReport($report);
            }

            DB::commit();
            return response()->json(['message' => 'Report updated successfully', 'report' => $report]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update report.', 'error' => $e->getMessage()], 500);
        }
    }

    private function processReport(Report $report)
    {
        $wallet = Wallet::where('user_id', $report->user_id)->firstOrFail();

        switch ($report->type) {
            case 'topup':
                $wallet->balance += $report->amount;
                $wallet->save();
                break;

            case 'withdrawal':
                if ($wallet->balance < $report->amount) {
                    throw new \Exception('Insufficient balance for withdrawal.');
                }
                $wallet->balance -= $report->amount;
                $wallet->save();
                break;

            case 'transaction':
                $transaction = $report->transaction;

                $buyerWallet = Wallet::where('user_id', $transaction->buyer_id)->firstOrFail();
                if ($buyerWallet->balance < $transaction->total_price) {
                    throw new \Exception('Insufficient balance for transaction.');
                }

                $buyerWallet->balance -= $transaction->total_price;
                $buyerWallet->save();

                $sellerWallet = Wallet::where('user_id', $transaction->seller_id)->firstOrFail();
                $sellerWallet->balance += $transaction->total_price;
                $sellerWallet->save();

                $product = Product::findOrFail($transaction->product_id);
                if ($product->stock < $transaction->quantity) {
                    throw new \Exception('Insufficient stock.');
                }
                $product->stock -= $transaction->quantity;
                $product->save();
                break;

            default:
                throw new \Exception('Unsupported report type.');
        }
    }
}
