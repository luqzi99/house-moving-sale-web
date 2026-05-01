@php $isEdit = !is_null($item); @endphp

<div class="grid grid-cols-2 gap-5">
    <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
        <input type="text" name="name" value="{{ old('name', $item?->name) }}" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">
        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <textarea name="description" rows="3" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description', $item?->description) }}</textarea>
        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Harga (RM) — kosongkan jika percuma</label>
        <input type="number" name="price" value="{{ old('price', $item?->price) }}" min="0" step="0.01"
            placeholder="e.g. 150.00"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">
        @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
        <select name="category" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">
            @foreach($categories as $cat)
                <option value="{{ $cat }}" @selected(old('category', $item?->category) === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi (e.g. 8/10)</label>
        <input type="text" name="condition" value="{{ old('condition', $item?->condition) }}" required maxlength="20"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">
        @error('condition') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Emoji</label>
        <input type="text" name="emoji" value="{{ old('emoji', $item?->emoji) }}" required maxlength="10"
            placeholder="e.g. 🛋️"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">
        @error('emoji') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">
            <option value="available" @selected(old('status', $item?->status ?? 'available') === 'available')>Available</option>
            <option value="sold" @selected(old('status', $item?->status) === 'sold')>Sold</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order (0 = atas)</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900">
    </div>
</div>

{{-- Existing images (edit mode) --}}
@if($isEdit && !empty($item->images))
<div id="existing-images-section">
    <div class="flex items-center justify-between mb-2">
        <label class="block text-sm font-medium text-gray-700">
            Gambar Sedia Ada
            <span id="delete-count-badge" class="hidden ml-2 bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full"></span>
        </label>
        <button type="button" id="delete-all-btn"
            onclick="confirmDeleteAll()"
            class="text-xs text-red-500 hover:text-red-700 font-medium underline underline-offset-2 transition-colors">
            Padam semua
        </button>
    </div>

    <div class="flex flex-wrap gap-3" id="image-grid">
        @foreach($item->images as $idx => $url)
        <div class="relative group" id="img-wrapper-{{ $idx }}" data-idx="{{ $idx }}">
            {{-- Hidden checkbox submitted with form --}}
            <input type="checkbox" name="delete_images[]" value="{{ $url }}"
                id="del-cb-{{ $idx }}" class="hidden img-delete-cb">

            <img src="{{ $url }}"
                class="w-24 h-24 object-cover rounded-xl border-2 border-transparent transition-all duration-200"
                id="img-thumb-{{ $idx }}">

            {{-- Red overlay shown when marked --}}
            <div id="img-overlay-{{ $idx }}"
                class="absolute inset-0 rounded-xl bg-red-500/60 hidden items-center justify-center">
                <span class="text-white text-2xl font-bold">✕</span>
            </div>

            {{-- Delete button --}}
            <button type="button"
                onclick="toggleDeleteImage({{ $idx }}, '{{ addslashes($url) }}')"
                id="img-btn-{{ $idx }}"
                class="absolute -top-2 -right-2 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold shadow transition-all
                       bg-red-500 hover:bg-red-600 text-white">
                ✕
            </button>
        </div>
        @endforeach
    </div>
    <p class="text-xs text-gray-400 mt-2">Klik ✕ untuk tandakan gambar untuk dipadam. Gambar dipadam selepas simpan.</p>
</div>
@endif

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar Baru (boleh berbilang)</label>
    <input type="file" name="images[]" multiple accept="image/*"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
    <p class="text-xs text-gray-400 mt-1">Maksimum 20MB setiap gambar.</p>
</div>

<script>
function toggleDeleteImage(idx, url, skipConfirm = false) {
    const cb      = document.getElementById('del-cb-' + idx);
    const overlay = document.getElementById('img-overlay-' + idx);
    const thumb   = document.getElementById('img-thumb-' + idx);
    const btn     = document.getElementById('img-btn-' + idx);
    const isMarked = cb.checked;

    if (!isMarked && !skipConfirm) {
        Swal.fire({
            title: 'Padam gambar ini?',
            text: 'Gambar akan dipadam selepas anda klik Simpan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, padam',
            cancelButtonText: 'Batal',
        }).then(result => {
            if (result.isConfirmed) markForDelete(idx, true);
        });
    } else {
        markForDelete(idx, !isMarked);
    }
}

function markForDelete(idx, shouldDelete) {
    const cb      = document.getElementById('del-cb-' + idx);
    const overlay = document.getElementById('img-overlay-' + idx);
    const thumb   = document.getElementById('img-thumb-' + idx);
    const btn     = document.getElementById('img-btn-' + idx);

    cb.checked = shouldDelete;

    if (shouldDelete) {
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        thumb.classList.add('opacity-40', 'border-red-400');
        btn.textContent = '↩';
        btn.title = 'Batal padam';
    } else {
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        thumb.classList.remove('opacity-40', 'border-red-400');
        btn.textContent = '✕';
        btn.title = '';
    }

    updateDeleteBadge();
}

function updateDeleteBadge() {
    const all    = document.querySelectorAll('.img-delete-cb');
    const marked = [...all].filter(cb => cb.checked).length;
    const badge  = document.getElementById('delete-count-badge');
    if (marked > 0) {
        badge.textContent = marked + ' akan dipadam';
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }
}

function confirmDeleteAll() {
    const all = document.querySelectorAll('.img-delete-cb');
    if (all.length === 0) return;

    const alreadyAllMarked = [...all].every(cb => cb.checked);
    if (alreadyAllMarked) {
        // Unmark all
        all.forEach((_, i) => markForDelete(i, false));
        return;
    }

    Swal.fire({
        title: 'Padam semua gambar?',
        text: `${all.length} gambar akan dipadam selepas anda klik Simpan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, padam semua',
        cancelButtonText: 'Batal',
    }).then(result => {
        if (result.isConfirmed) {
            all.forEach((_, i) => markForDelete(i, true));
        }
    });
}
</script>
