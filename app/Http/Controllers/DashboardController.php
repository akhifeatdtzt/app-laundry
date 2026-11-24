<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalTransactions = Transaction::count();
        $processingTransactions = Transaction::where('status', 'Diproses')->count();
        $completedTransactions = Transaction::whereIn('status', ['Selesai', 'Sudah Diambil'])->count();
        $totalRevenue = Payment::where('payment_status', 'Lunas')
            ->with('transaction')
            ->get()
            ->sum(fn ($payment) => $payment->transaction->total_price ?? 0);

        $recentTransactions = Transaction::with(['customer', 'service', 'payment'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'totalTransactions',
            'processingTransactions',
            'completedTransactions',
            'totalRevenue',
            'recentTransactions'
        ));
    }
}