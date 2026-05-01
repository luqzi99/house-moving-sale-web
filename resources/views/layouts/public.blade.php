<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?? config('app.name', 'Moving Out Sale') }}</title>

    {{-- Primary --}}
    <meta name="description" content="{{ $metaDesc ?? 'Hi! 👋 Saya Luqman dari Blok C 14-12 — tengah kemas rumah sebelum berpindah. Ada banyak barang elok nak dilepaskan dengan harga berpatutan. Jom tengok, mana tahu ada yang berkenan!' }}">

    {{-- Open Graph (WhatsApp, Facebook, Telegram) --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ config('app.url') }}">
    <meta property="og:site_name"   content="Moving Out Sale">
    <meta property="og:title"       content="{{ $metaTitle ?? 'Moving Out Sale 🏠 — Clearance Barang Luqman, Blok C 14-12' }}">
    <meta property="og:description" content="{{ $metaDesc ?? 'Hi! 👋 Saya Luqman dari Blok C 14-12 — tengah kemas rumah sebelum berpindah. Ada banyak barang elok nak dilepaskan dengan harga berpatutan. Jom tengok, mana tahu ada yang berkenan!' }}">
    @isset($ogImage)
    <meta property="og:image"       content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height"content="630">
    @endisset

    {{-- Twitter / X --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $metaTitle ?? 'Moving Out Sale 🏠 — Clearance Barang Luqman, Blok C 14-12' }}">
    <meta name="twitter:description" content="{{ $metaDesc ?? 'Hi! 👋 Saya Luqman dari Blok C 14-12 — tengah kemas rumah sebelum berpindah. Ada banyak barang elok nak dilepaskan dengan harga berpatutan. Jom tengok, mana tahu ada yang berkenan!' }}">
    @isset($ogImage)
    <meta name="twitter:image"       content="{{ $ogImage }}">
    @endisset
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeSlideUp 0.5s cubic-bezier(0.16,1,0.3,1) both; }
    </style>
</head>
<body class="bg-[#F7F3EE] text-[#2C2C2C] overflow-x-hidden">
    @yield('content')
</body>
</html>
