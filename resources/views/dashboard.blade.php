@extends('layouts.app')

@section('title', 'Dashboard - Manajemen Laundry')
@section('header', 'Dashboard Ringkasan')

@section('content')
    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <!-- Total Pelanggan -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs">
            <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Total Pelanggan</p>
            <p class="text-2xl font-bold text-slate-900 mt-2">{{ $totalCustomers }}</p>
            <p class="text-xs text-slate-400 mt-1">Pelanggan terdaftar</p>
        </div>

        <!-- Total Transaksi -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs">
            <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Total Transaksi</p>
            <p class="text-2xl font-bold text-slate-900 mt-2">{{ $totalTransactions }}</p>
            <p class="text-xs text-slate-400 mt-1">Semua pesanan masuk</p>
        </div>

        <!-- Sedang Diproses -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs">
            <p class="text-xs font-medium uppercase tracking-wider text-amber-600">Sedang Diproses</p>
            <p class="text-2xl font-bold text-amber-600 mt-2">{{ $processingTransactions }}</p>
            <p class="text-xs text-slate-400 mt-1">Cucian dalam pengerjaan</p>
        </div>

        <!-- Sudah Selesai -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs">
            <p class="text-xs font-medium uppercase tracking-wider text-emerald-600">Transaksi Selesai</p>
            <p class="text-2xl font-bold text-emerald-600 mt-2">{{ $completedTransactions }}</p>
            <p class="text-xs text-slate-400 mt-1">Selesai & sudah diambil</p>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs sm:col-span-2 lg:col-span-1">
            <p class="text-xs font-medium uppercase tracking-wider text-sky-600">Total Pendapatan</p>
            <p class="text-xl font-bold text-sky-700 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">Dari transaksi lunas</p>
        </div>
    </div>

    <!-- Tabel Transaksi Terbaru -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Transaksi Terbaru</h2>
            <a href="{{ route('transactions.index') }}" class="text-sm font-medium text-sky-600 hover:text-sky-700">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-3.5">No. Invoice</th>
                        <th class="px-6 py-3.5">Pelanggan</th>
                        <th class="px-6 py-3.5">Layanan</th>
                        <th class="px-6 py-3.5">Total Harga</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse ($recentTransactions as $trx)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $trx->invoice_number }}</td>
                            <td class="px-6 py-4">{{ $trx->customer->name }}</td>
                            <td class="px-6 py-4">{{ $trx->service->name }} ({{ $trx->weight }} kg)</td>
                            <td class="px-6 py-4 font-medium">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'Menunggu' => 'bg-slate-100 text-slate-700',
                                        'Diproses' => 'bg-amber-100 text-amber-700',
                                        'Selesai' => 'bg-sky-100 text-sky-700',
                                        'Sudah Diambil' => 'bg-emerald-100 text-emerald-700',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$trx->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $trx->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($trx->payment && $trx->payment->payment_status === 'Lunas')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Lunas</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">Belum Dibayar</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                Belum ada data transaksi laundry.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection