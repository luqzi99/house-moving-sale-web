@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-4 gap-3">
    <h1 class="text-xl sm:text-2xl font-bold">Senarai Barang</h1>
    <a href="{{ route('admin.items.create') }}"
        class="bg-gray-900 text-white px-3 py-2 sm:px-4 rounded-lg font-semibold hover:bg-gray-700 transition text-sm whitespace-nowrap">
        + Tambah
    </a>
</div>

@if($items->isEmpty())
    <p class="text-gray-500 text-sm">Belum ada barang. <a href="{{ route('admin.items.create') }}" class="text-blue-600 underline">Tambah sekarang</a>.</p>
@else

{{-- Mobile: card list --}}
<div class="sm:hidden space-y-3">
    @foreach($items as $item)
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="flex items-start gap-3">
            {{-- Thumbnail or emoji --}}
            @if(!empty($item->images))
                <img src="{{ $item->images[0] }}" class="w-14 h-14 object-cover rounded-lg flex-shrink-0">
            @else
                <div class="w-14 h-14 flex items-center justify-center text-3xl bg-gray-100 rounded-lg flex-shrink-0">{{ $item->emoji }}</div>
            @endif

            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <p class="font-semibold text-sm leading-tight truncate">{{ $item->name }}</p>
                    @if($item->status === 'available')
                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium flex-shrink-0">Available</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-medium flex-shrink-0">Sold</span>
                    @endif
                </div>
                <p class="text-xs text-gray-400 mt-0.5">{{ $item->category }} · {{ $item->condition }}</p>
                <div class="flex items-center justify-between mt-2">
                    <span class="font-bold text-sm text-gray-900">{{ $item->displayPrice() }}</span>
                    <span class="text-xs text-gray-400">{{ count($item->images ?? []) }} gambar</span>
                </div>
            </div>
        </div>
        <div class="flex gap-3 mt-3 pt-3 border-t border-gray-100">
            <a href="{{ route('admin.items.edit', $item) }}"
                class="flex-1 text-center text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 rounded-lg transition">
                ✏️ Edit
            </a>
            <form method="POST" action="{{ route('admin.items.destroy', $item) }}" class="flex-1"
                id="delete-form-{{ $item->id }}">
                @csrf
                @method('DELETE')
                <button type="button" class="w-full text-sm font-medium bg-red-50 hover:bg-red-100 text-red-600 py-2 rounded-lg transition"
                    onclick="confirmDeleteItem({{ $item->id }}, '{{ addslashes($item->name) }}')">
                    🗑️ Padam
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

{{-- Desktop: table --}}
<div class="hidden sm:block bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Barang</th>
                <th class="px-4 py-3 text-left">Kategori</th>
                <th class="px-4 py-3 text-left">Harga</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Imej</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($items as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">{{ $item->emoji }}</span>
                        <div>
                            <p class="font-medium">{{ $item->name }}</p>
                            <p class="text-gray-400 text-xs truncate max-w-[180px]">{{ $item->description }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-600">{{ $item->category }}</td>
                <td class="px-4 py-3 font-semibold">{{ $item->displayPrice() }}</td>
                <td class="px-4 py-3">
                    @if($item->status === 'available')
                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">Available</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-medium">Sold</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-gray-500 text-xs">{{ count($item->images ?? []) }} gambar</td>
                <td class="px-4 py-3 text-right whitespace-nowrap">
                    <a href="{{ route('admin.items.edit', $item) }}"
                        class="text-blue-600 hover:underline mr-3">Edit</a>
                    <form method="POST" action="{{ route('admin.items.destroy', $item) }}" class="inline"
                        id="delete-form-{{ $item->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="text-red-500 hover:underline"
                            onclick="confirmDeleteItem({{ $item->id }}, '{{ addslashes($item->name) }}')">
                            Padam
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif

<script>
function confirmDeleteItem(id, name) {
    Swal.fire({
        title: 'Padam item ini?',
        html: `<b>${name}</b> akan dipadam bersama semua gambarnya.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, padam',
        cancelButtonText: 'Batal',
    }).then(result => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection
