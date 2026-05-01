<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Tidak Dijumpai · Moving Out Sale</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(-2deg); }
            50%       { transform: translateY(-18px) rotate(2deg); }
        }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes stampIn {
            0%   { opacity: 0; transform: scale(1.6) rotate(-8deg); }
            60%  { transform: scale(0.92) rotate(2deg); }
            100% { opacity: 1; transform: scale(1) rotate(-3deg); }
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50%       { transform: rotate(3deg); }
        }
        @keyframes drift {
            0%   { transform: translate(0, 0) rotate(0deg); }
            33%  { transform: translate(12px, -8px) rotate(4deg); }
            66%  { transform: translate(-8px, 6px) rotate(-3deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        .box-float  { animation: float 3.8s ease-in-out infinite; }
        .fade-up-1  { animation: fadeSlideUp 0.55s 0.1s cubic-bezier(0.16,1,0.3,1) both; }
        .fade-up-2  { animation: fadeSlideUp 0.55s 0.25s cubic-bezier(0.16,1,0.3,1) both; }
        .fade-up-3  { animation: fadeSlideUp 0.55s 0.4s cubic-bezier(0.16,1,0.3,1) both; }
        .fade-up-4  { animation: fadeSlideUp 0.55s 0.55s cubic-bezier(0.16,1,0.3,1) both; }
        .stamp      { animation: stampIn 0.6s 0.7s cubic-bezier(0.16,1,0.3,1) both; }
        .deco-drift { animation: drift 9s ease-in-out infinite; }

        .btn-home {
            transition: all 0.2s cubic-bezier(0.16,1,0.3,1);
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(44,44,44,0.18);
        }
        .btn-home:active {
            transform: translateY(0px) scale(0.97);
        }

        .num-404 {
            background: linear-gradient(135deg, #2C2C2C 30%, #8B7355 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tape {
            background: repeating-linear-gradient(
                -45deg,
                #f0c040,
                #f0c040 12px,
                #e8b830 12px,
                #e8b830 24px
            );
        }
    </style>
</head>
<body class="bg-[#F7F3EE] text-[#2C2C2C] min-h-screen flex flex-col items-center justify-center overflow-x-hidden relative px-4">

    {{-- Floating deco blobs --}}
    <div class="pointer-events-none select-none absolute inset-0 overflow-hidden">
        <span class="absolute top-[8%] left-[6%] text-5xl opacity-10 deco-drift" style="animation-delay:0s">📦</span>
        <span class="absolute top-[14%] right-[8%] text-3xl opacity-10 deco-drift" style="animation-delay:2.5s">🏠</span>
        <span class="absolute bottom-[18%] left-[10%] text-4xl opacity-10 deco-drift" style="animation-delay:1.2s">🛋️</span>
        <span class="absolute bottom-[10%] right-[6%] text-4xl opacity-10 deco-drift" style="animation-delay:3.8s">📦</span>
        <span class="absolute top-[45%] left-[2%] text-2xl opacity-8 deco-drift" style="animation-delay:0.7s">✂️</span>
        <span class="absolute top-[38%] right-[3%] text-2xl opacity-8 deco-drift" style="animation-delay:4.2s">🔑</span>
    </div>

    {{-- Card --}}
    <div class="relative w-full max-w-md text-center">

        {{-- Moving box illustration --}}
        <div class="fade-up-1 flex justify-center mb-6">
            <div class="box-float relative inline-block">
                {{-- Box SVG --}}
                <svg width="120" height="110" viewBox="0 0 120 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                    {{-- Box body --}}
                    <rect x="10" y="38" width="100" height="62" rx="4" fill="#D4A574"/>
                    <rect x="10" y="38" width="100" height="62" rx="4" stroke="#BC6C25" stroke-width="2"/>
                    {{-- Flaps top --}}
                    <path d="M10 38 L10 12 L55 22 L55 38Z" fill="#C49060" stroke="#BC6C25" stroke-width="1.5"/>
                    <path d="M110 38 L110 12 L65 22 L65 38Z" fill="#C49060" stroke="#BC6C25" stroke-width="1.5"/>
                    {{-- Tape stripe --}}
                    <rect x="50" y="12" width="20" height="88" rx="2" fill="#F0C040" opacity="0.9"/>
                    <rect x="50" y="38" width="20" height="62" fill="#F0C040" opacity="0.9"/>
                    {{-- Question marks on box --}}
                    <text x="28" y="78" font-family="DM Sans, sans-serif" font-size="22" font-weight="700" fill="#BC6C25" opacity="0.5">?</text>
                    <text x="78" y="78" font-family="DM Sans, sans-serif" font-size="22" font-weight="700" fill="#BC6C25" opacity="0.5">?</text>
                </svg>
                {{-- FRAGILE stamp on box --}}
                <div class="stamp absolute -bottom-2 -right-4 bg-red-500 text-white text-[9px] font-black tracking-widest uppercase px-2 py-0.5 rounded rotate-[-5deg] shadow-sm border border-red-700">
                    FRAGILE
                </div>
            </div>
        </div>

        {{-- 404 number --}}
        <div class="fade-up-2">
            <span class="num-404 font-playfair text-[7rem] sm:text-[9rem] leading-none font-black select-none">
                404
            </span>
        </div>

        {{-- Tape divider --}}
        <div class="fade-up-2 flex items-center justify-center gap-0 my-1">
            <div class="tape h-4 w-28 rounded opacity-80 rotate-[-1deg]"></div>
        </div>

        {{-- Headline --}}
        <div class="fade-up-3 mt-5">
            <h1 class="font-playfair text-2xl sm:text-3xl font-bold text-[#1a1a1a] leading-snug">
                Halaman Ini Dah Pindah!
            </h1>
            <p class="mt-3 text-gray-500 text-sm sm:text-base leading-relaxed max-w-xs mx-auto">
                Habis dipacking agaknya. Laman yang kamu cari tak jumpa — mungkin dah diangkut atau tak wujud.
            </p>
        </div>

        {{-- CTA --}}
        <div class="fade-up-4 mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/"
                class="btn-home inline-flex items-center gap-2.5 bg-[#2C2C2C] text-[#F7F3EE] font-semibold text-sm px-6 py-3.5 rounded-2xl shadow-md">
                <span class="text-base">🏠</span>
                Balik ke Halaman Utama
            </a>
            <a href="javascript:history.back()"
                class="btn-home inline-flex items-center gap-2 text-gray-500 hover:text-[#2C2C2C] font-medium text-sm px-4 py-3.5 rounded-2xl border border-[#E8E2DA] bg-white hover:bg-[#F0EBE3] transition-colors">
                ← Pergi Balik
            </a>
        </div>

        {{-- Footer note --}}
        <p class="fade-up-4 mt-10 text-xs text-gray-400">
            Moving Out Sale · Blok C 14-12 ·
            <a href="https://luqmanhakimrohaizi.my" target="_blank" class="underline underline-offset-2 hover:text-gray-600 transition-colors">luqmanhakimrohaizi.my</a>
        </p>
    </div>

</body>
</html>
