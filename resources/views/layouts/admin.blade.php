<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Moving Out Sale</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-gray-900 text-white px-4 py-3 flex items-center justify-between gap-2">
        <a href="{{ route('admin.items.index') }}" class="font-semibold text-base whitespace-nowrap">🏠 Sale Admin</a>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="text-xs text-gray-400 hover:text-white hidden sm:inline">Lihat Marketplace ↗</a>
            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                @csrf
                <button class="text-xs text-gray-400 hover:text-red-400 whitespace-nowrap">Log Keluar</button>
            </form>
        </div>
    </nav>
    <div class="max-w-5xl mx-auto px-3 sm:px-4 py-4 sm:py-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded text-sm">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
