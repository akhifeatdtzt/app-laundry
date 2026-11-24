<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Laundry')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="min-h-screen flex">
        <!-- Overlay Mobile Sidebar -->
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-20 hidden lg:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-white transform -translate-x-full transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-auto flex flex-col">
            <!-- Brand Logo -->
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 font-bold text-lg tracking-wide">
                    <span class="w-8 h-8 rounded-lg bg-sky-500 flex items-center justify-center text-white font-extrabold">L</span>
                    <span>Laundry<span class="text-sky-400">Ku</span></span>
                </a>
                <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white">
                    ✕
                </button>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <p class="px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Menu Utama</p>

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-sky-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('customers.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('customers.*') ? 'bg-sky-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Data Pelanggan</span>
                </a>

                <a href="{{ route('services.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('services.*') ? 'bg-sky-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span>Data Layanan</span>
                </a>

                <a href="{{ route('transactions.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('transactions.*') ? 'bg-sky-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span>Data Transaksi</span>
                </a>
            </nav>

            <!-- Info User di Bawah Sidebar -->
            <div class="p-4 border-t border-slate-800 text-xs text-slate-400">
                Sistem Manajemen Laundry &copy; {{ date('Y') }}
            </div>
        </aside>

        <!-- Konten Utama -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Navbar Atas -->
            <header class="h-16 bg-white border-b border-slate-200 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-lg font-semibold text-slate-800">@yield('header', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-600 hidden sm:inline">Halo, <strong class="text-slate-900">{{ Auth::user()->name }}</strong></span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-sm font-medium text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition cursor-pointer">
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- Area Halaman Dinamis -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold">✕</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 rounded-lg bg-rose-50 border border-rose-200 text-rose-700 text-sm flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold">✕</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>