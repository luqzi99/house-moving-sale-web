@extends('layouts.public')

@section('content')
{{-- Hero --}}
<div class="bg-gradient-to-br from-[#2C2C2C] to-[#1a1a2e] px-5 py-12 text-center relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none"
        style="background: radial-gradient(circle at 20% 50%, rgba(212,165,116,0.15) 0%, transparent 50%), radial-gradient(circle at 80% 30%, rgba(74,111,165,0.1) 0%, transparent 50%)"></div>
    <div class="fade-up" style="animation-delay:0s">
        <div class="text-5xl mb-2">🏠</div>
        <h1 class="font-playfair text-3xl md:text-4xl font-extrabold text-[#F7F3EE] leading-tight mb-2">Moving Out Sale</h1>
        <p class="text-[#F7F3EE]/60 text-sm font-light uppercase tracking-widest mb-1">Nak Pindah — Letgo Everything!</p>
        <p class="text-[#F7F3EE]/40 text-xs mt-3">Tap kad untuk tengok lebih lanjut ✨</p>
    </div>
</div>

<div class="max-w-2xl mx-auto px-4">
    {{-- Search --}}
    <div class="mt-5 fade-up" style="animation-delay:0.1s">
        <form method="GET" action="{{ route('home') }}" class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-lg opacity-40">🔍</span>
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Cari barang..."
                class="w-full pl-11 pr-4 py-3.5 border-2 border-[#E8E2DA] rounded-2xl text-sm bg-white focus:outline-none focus:border-[#D4A574] transition-colors"
                onchange="this.form.submit()">
            @if($activeCategory !== 'Semua')
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
        </form>
    </div>

    {{-- Categories --}}
    <div class="mt-4 fade-up overflow-x-auto" style="animation-delay:0.15s">
        <div class="flex gap-2 pb-1" style="scrollbar-width:none">
            @foreach($categories as $cat)
            <a href="{{ route('home', array_filter(['category' => $cat === 'Semua' ? null : $cat, 'search' => $search ?: null])) }}"
                class="flex-shrink-0 px-5 py-2 rounded-full text-sm transition-all
                    {{ $activeCategory === $cat
                        ? 'bg-[#2C2C2C] text-[#F7F3EE] font-semibold'
                        : 'bg-black/5 text-gray-500 hover:bg-black/10' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Count --}}
    <p class="mt-4 text-xs text-gray-400">{{ $items->count() }} barang dijumpai</p>

    {{-- Items Grid --}}
    @if($items->isEmpty())
    <div class="text-center py-20 text-gray-400">
        <div class="text-5xl mb-4">🔍</div>
        <p class="text-sm">Takde barang dijumpai. Cuba cari lain?</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-3 pb-10">
        @foreach($items as $i => $item)
        @php
            $colors = ['#D4A574','#8B7355','#4A6FA5','#7B68AE','#E07A5F','#BC6C25','#606C38','#457B9D','#E63946','#CDB4DB'];
            $color = $colors[$i % count($colors)];
            $msg = urlencode("Hai! Saya berminat dengan *{$item->name}* ({$item->displayPrice()}) dari Moving Out Sale kamu. Masih available?");
            $itemData = json_encode([
                'name'      => $item->name,
                'desc'      => $item->description,
                'price'     => $item->displayPrice(),
                'category'  => $item->category,
                'condition' => $item->condition,
                'emoji'     => $item->emoji,
                'images'    => $item->images ?? [],
                'color'     => $color,
                'waLink'    => "https://wa.me/{$whatsappNumber}?text={$msg}",
            ]);
        @endphp

        {{-- Clickable card --}}
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-up cursor-pointer"
            style="animation-delay:{{ 0.2 + $i * 0.05 }}s"
            onclick="openModal({{ $itemData }})">

            {{-- Banner --}}
            <div class="relative h-36 flex items-center justify-center"
                style="background: linear-gradient(135deg, {{ $color }}22 0%, {{ $color }}11 100%); border-bottom: 3px solid {{ $color }}18">

                @if(!empty($item->images))
                    <img src="{{ $item->images[0] }}" alt="{{ $item->name }}"
                        class="w-full h-full object-cover absolute inset-0">
                    <div class="absolute inset-0 bg-black/10"></div>
                    @if(count($item->images) > 1)
                    <div class="absolute bottom-2 right-2 bg-black/50 text-white text-xs px-2 py-0.5 rounded-full">
                        +{{ count($item->images) - 1 }} foto
                    </div>
                    @endif
                @else
                    <span class="text-5xl">{{ $item->emoji }}</span>
                @endif

                <div class="absolute top-2.5 right-2.5 text-white text-xs font-semibold px-2.5 py-1 rounded-full"
                    style="background:{{ $color }}">{{ $item->condition }}</div>
                <div class="absolute top-2.5 left-2.5 bg-[#2C2C2C]/75 backdrop-blur text-[#F7F3EE] text-xs px-2.5 py-1 rounded-full">
                    {{ $item->category }}
                </div>
            </div>

            {{-- Content --}}
            <div class="p-4">
                <h3 class="font-playfair text-base font-bold leading-tight text-[#1a1a1a] mb-1">{{ $item->name }}</h3>
                <p class="text-xs text-gray-400 leading-relaxed mb-3 line-clamp-2">{{ $item->description }}</p>

                <div class="flex items-center justify-between gap-3">
                    <span class="font-playfair text-xl font-extrabold" style="color:{{ $color }}">
                        {{ $item->displayPrice() }}
                    </span>
                    <span class="text-xs text-gray-400 flex items-center gap-1">
                        Tap untuk lihat lagi →
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Footer --}}
    <div class="border-t border-[#E8E2DA] py-6 text-center space-y-1">
        <p class="text-xs text-gray-400">Self-pickup sahaja · COD area KL/Selangor · First come first serve</p>
        <p class="text-xs text-gray-500">Created by <a href="https://luqmanhakimrohaizi.my" target="_blank" class="font-semibold text-gray-700 hover:text-gray-900 transition-colors underline underline-offset-2">luqmanhakimrohaizi.my</a></p>
    </div>
</div>

{{-- ============================================================ --}}
{{-- Modal                                                         --}}
{{-- ============================================================ --}}
<div id="modal" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center p-0 sm:p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>

    {{-- Sheet --}}
    <div id="modal-sheet"
        class="relative bg-white w-full sm:max-w-md sm:rounded-3xl rounded-t-3xl shadow-2xl overflow-hidden
               translate-y-full sm:translate-y-0 sm:scale-95 sm:opacity-0
               transition-all duration-300 ease-out max-h-[92vh] flex flex-col">

        {{-- Close button --}}
        <button onclick="closeModal()"
            class="absolute top-3 right-3 z-10 bg-black/20 hover:bg-black/40 text-white rounded-full w-8 h-8 flex items-center justify-center transition-colors">
            ✕
        </button>

        {{-- Carousel --}}
        <div id="modal-carousel" class="relative bg-gray-100 flex-shrink-0" style="height: 260px">
            {{-- Slides will be injected here --}}
            <div id="modal-slides" class="flex h-full transition-transform duration-300 ease-out"></div>

            {{-- Prev/Next (shown only when >1 image) --}}
            <button id="carousel-prev" onclick="carouselPrev()"
                class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white rounded-full w-8 h-8 flex items-center justify-center hidden transition-colors">
                ‹
            </button>
            <button id="carousel-next" onclick="carouselNext()"
                class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white rounded-full w-8 h-8 flex items-center justify-center hidden transition-colors">
                ›
            </button>

            {{-- Dots --}}
            <div id="carousel-dots" class="absolute bottom-2.5 left-1/2 -translate-x-1/2 flex gap-1.5"></div>

            {{-- Badges on image --}}
            <div class="absolute top-3 left-3 flex gap-2">
                <span id="modal-category" class="bg-[#2C2C2C]/75 backdrop-blur text-white text-xs px-2.5 py-1 rounded-full"></span>
                <span id="modal-condition" class="text-white text-xs font-semibold px-2.5 py-1 rounded-full"></span>
            </div>
        </div>

        {{-- Scrollable content --}}
        <div class="overflow-y-auto flex-1 p-5 pb-6">
            <h2 id="modal-name" class="font-playfair text-2xl font-bold text-[#1a1a1a] mb-2 leading-tight"></h2>
            <p id="modal-desc" class="text-sm text-gray-500 leading-relaxed mb-5"></p>

            <div class="flex items-center justify-between gap-3">
                <span id="modal-price" class="font-playfair text-3xl font-extrabold"></span>
                <a id="modal-wa" href="#" target="_blank"
                    class="flex items-center gap-2 bg-[#25D366] hover:bg-[#1ebe5d] text-white font-semibold px-5 py-3 rounded-2xl transition-all shadow-md hover:shadow-lg text-sm flex-shrink-0">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<script>
let carouselIndex = 0;
let carouselTotal = 0;

function openModal(item) {
    carouselIndex = 0;
    carouselTotal = item.images.length;

    // Populate text
    document.getElementById('modal-name').textContent      = item.name;
    document.getElementById('modal-desc').textContent      = item.desc;
    document.getElementById('modal-price').textContent     = item.price;
    document.getElementById('modal-price').style.color     = item.color;
    document.getElementById('modal-category').textContent  = item.category;
    document.getElementById('modal-wa').href               = item.waLink;

    const condEl = document.getElementById('modal-condition');
    condEl.textContent       = item.condition;
    condEl.style.background  = item.color;

    // Build carousel
    const slides = document.getElementById('modal-slides');
    const dots   = document.getElementById('carousel-dots');
    slides.innerHTML = '';
    dots.innerHTML   = '';

    if (carouselTotal > 0) {
        item.images.forEach((url, idx) => {
            const slide = document.createElement('div');
            slide.className = 'flex-shrink-0 w-full h-full';
            slide.innerHTML = `<img src="${url}" class="w-full h-full object-cover" alt="">`;
            slides.appendChild(slide);

            const dot = document.createElement('button');
            dot.className = `w-2 h-2 rounded-full transition-all ${idx === 0 ? 'bg-white scale-125' : 'bg-white/50'}`;
            dot.onclick = (e) => { e.stopPropagation(); goToSlide(idx); };
            dots.appendChild(dot);
        });
        document.getElementById('modal-carousel').style.background = '#111';
    } else {
        // Emoji fallback
        slides.innerHTML = `<div class="flex-shrink-0 w-full h-full flex items-center justify-center text-7xl" style="background:${item.color}22">${item.emoji}</div>`;
        document.getElementById('modal-carousel').style.background = item.color + '22';
    }

    // Show/hide arrows
    document.getElementById('carousel-prev').classList.toggle('hidden', carouselTotal <= 1);
    document.getElementById('carousel-next').classList.toggle('hidden', carouselTotal <= 1);
    dots.classList.toggle('hidden', carouselTotal <= 1);

    updateCarousel();

    // Show modal
    const modal  = document.getElementById('modal');
    const sheet  = document.getElementById('modal-sheet');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    requestAnimationFrame(() => {
        sheet.classList.remove('translate-y-full', 'sm:scale-95', 'sm:opacity-0');
    });

    // Touch swipe
    let touchStartX = 0;
    slides.ontouchstart = e => { touchStartX = e.touches[0].clientX; };
    slides.ontouchend   = e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) diff > 0 ? carouselNext() : carouselPrev();
    };
}

function closeModal() {
    const modal = document.getElementById('modal');
    const sheet = document.getElementById('modal-sheet');
    sheet.classList.add('translate-y-full', 'sm:scale-95', 'sm:opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }, 300);
}

function goToSlide(idx) {
    carouselIndex = (idx + carouselTotal) % carouselTotal;
    updateCarousel();
}

function carouselPrev() { goToSlide(carouselIndex - 1); }
function carouselNext() { goToSlide(carouselIndex + 1); }

function updateCarousel() {
    document.getElementById('modal-slides').style.transform = `translateX(-${carouselIndex * 100}%)`;
    document.querySelectorAll('#carousel-dots button').forEach((dot, i) => {
        dot.className = `w-2 h-2 rounded-full transition-all ${i === carouselIndex ? 'bg-white scale-125' : 'bg-white/50'}`;
    });
}

// Close on Escape key
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endsection
