<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemen Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-sky-600 text-white font-extrabold text-xl flex items-center justify-center mx-auto mb-3">
                L
            </div>
            <h1 class="text-2xl font-bold text-slate-900">LaundryKu</h1>
            <p class="text-sm text-slate-500 mt-1">Silakan masuk untuk mengelola operasional laundry</p>
        </div>

        @if ($errors->any())
            <div class="mb-5 p-3.5 rounded-lg bg-rose-50 border border-rose-200 text-rose-600 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', 'admin@laundry.com') }}" required autofocus
                       class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
            </div>

            <div class="flex items-center justify-between">
                <label class="inline-flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full py-2.5 px-4 bg-sky-600 hover:bg-sky-700 text-white font-medium text-sm rounded-lg transition cursor-pointer">
                Masuk ke Sistem
            </button>
        </form>
    </div>

</body>
</html>