@extends('layouts.public')

@section('content')
@php
    $colors = ['#D4A574','#8B7355','#4A6FA5','#7B68AE','#E07A5F','#BC6C25','#606C38','#457B9D','#E63946','#CDB4DB'];
    $color  = $colors[$item->id % count($colors)];
    $msg    = urlencode("Hai! Saya berminat dengan *{$item->name}* ({$item->displayPrice()}) dari Moving Out Sale kamu. Masih available?\n\n{$itemUrl}");
@endphp

{{-- Back nav --}}
<div class="bg-[#2C2C2C] px-4 py-3 flex items-center gap-3">
    <a href="{{ route('home') }}" class="text-[#F7F3EE]/60 hover:text-[#F7F3EE] text-sm transition-colors flex items-center gap-1.5">
        ← Balik ke senarai
    </a>
</div>

{{-- Image carousel --}}
<div class="relative bg-gray-900 overflow-hidden" style="height: 320px">
    @if(!empty($images))
        <div id="slides" class="flex h-full transition-transform duration-300 ease-out">
            @foreach($images as $url)
            <div class="flex-shrink-0 w-full h-full">
                <img src="{{ $url }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
            </div>
            @endforeach
        </div>

        @if(count($images) > 1)
        <button onclick="slidePrev()"
            class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white rounded-full w-10 h-10 flex items-center justify-center text-xl transition-colors">
            ‹
        </button>
        <button onclick="slideNext()"
            class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white rounded-full w-10 h-10 flex items-center justify-center text-xl transition-colors">
            ›
        </button>
        <div id="dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
            @foreach($images as $i => $url)
            <button onclick="goTo({{ $i }})"
                class="w-2 h-2 rounded-full transition-all {{ $i === 0 ? 'bg-white scale-125' : 'bg-white/50' }}"
                id="dot-{{ $i }}"></button>
            @endforeach
        </div>
        @endif

        {{-- Photo count badge --}}
        @if(count($images) > 1)
        <div class="absolute top-3 right-3 bg-black/50 text-white text-xs px-2.5 py-1 rounded-full">
            <span id="slide-counter">1</span>/{{ count($images) }}
        </div>
        @endif
    @else
        <div class="w-full h-full flex items-center justify-center text-8xl"
            style="background: linear-gradient(135deg, {{ $color }}33, {{ $color }}11)">
            {{ $item->emoji }}
        </div>
    @endif

    {{-- Badges --}}
    <div class="absolute top-3 left-3 flex gap-2">
        <span class="bg-[#2C2C2C]/80 backdrop-blur text-white text-xs px-2.5 py-1 rounded-full">
            {{ $item->category }}
        </span>
        <span class="text-white text-xs font-semibold px-2.5 py-1 rounded-full"
            style="background: {{ $color }}">
            {{ $item->condition }}
        </span>
    </div>
</div>

{{-- Content --}}
<div class="max-w-2xl mx-auto px-4 py-6">

    {{-- Name + price --}}
    <div class="flex items-start justify-between gap-4 mb-4">
        <h1 class="font-playfair text-2xl font-bold text-[#1a1a1a] leading-tight">{{ $item->name }}</h1>
        <div class="font-playfair text-2xl font-extrabold flex-shrink-0" style="color: {{ $color }}">
            {{ $item->displayPrice() }}
        </div>
    </div>

    {{-- Description --}}
    <p class="text-gray-500 text-sm leading-relaxed mb-6">{{ $item->description }}</p>

    {{-- Details --}}
    <div class="grid grid-cols-2 gap-3 mb-6">
        <div class="bg-white rounded-xl p-3 border border-gray-100">
            <p class="text-xs text-gray-400 mb-0.5">Kategori</p>
            <p class="text-sm font-medium text-gray-700">{{ $item->category }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-gray-100">
            <p class="text-xs text-gray-400 mb-0.5">Kondisi</p>
            <p class="text-sm font-medium text-gray-700">{{ $item->condition }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-gray-100 col-span-2">
            <p class="text-xs text-gray-400 mb-0.5">Cara bayar & ambil</p>
            <p class="text-sm font-medium text-gray-700">Self-pickup · COD area KL/Selangor</p>
        </div>
    </div>

    {{-- WhatsApp CTA --}}
    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $msg }}" target="_blank"
        class="flex items-center justify-center gap-3 w-full bg-[#25D366] hover:bg-[#1ebe5d] text-white font-bold text-base py-4 rounded-2xl transition-all shadow-lg hover:shadow-xl active:scale-95">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="white">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        Hubungi WhatsApp
    </a>

    <p class="text-center text-xs text-gray-400 mt-3">First come first serve · Balas WhatsApp untuk tempah</p>

    {{-- Footer --}}
    <div class="border-t border-[#E8E2DA] mt-8 pt-5 text-center space-y-1">
        <p class="text-xs text-gray-400">Self-pickup sahaja · COD area KL/Selangor · First come first serve</p>
        <p class="text-xs text-gray-500">Created by <a href="https://luqmanhakimrohaizi.my" target="_blank" class="font-semibold text-gray-700 hover:text-gray-900 transition-colors underline underline-offset-2">luqmanhakimrohaizi.my</a></p>
    </div>
</div>

@if(count($images) > 1)
<script>
let idx = 0;
const total = {{ count($images) }};

function goTo(i) {
    idx = (i + total) % total;
    document.getElementById('slides').style.transform = `translateX(-${idx * 100}%)`;
    document.getElementById('slide-counter').textContent = idx + 1;
    document.querySelectorAll('[id^="dot-"]').forEach((d, j) => {
        d.className = `w-2 h-2 rounded-full transition-all ${j === idx ? 'bg-white scale-125' : 'bg-white/50'}`;
    });
}
function slidePrev() { goTo(idx - 1); }
function slideNext() { goTo(idx + 1); }

// Touch swipe
const sl = document.getElementById('slides');
let tx = 0;
sl.ontouchstart = e => tx = e.touches[0].clientX;
sl.ontouchend   = e => { const d = tx - e.changedTouches[0].clientX; if (Math.abs(d) > 40) d > 0 ? slideNext() : slidePrev(); };
</script>
@endif
@endsection
