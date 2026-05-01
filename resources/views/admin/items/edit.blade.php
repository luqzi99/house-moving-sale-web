@extends('layouts.admin')

@section('content')
<div class="flex items-center gap-3 mb-4">
    <a href="{{ route('admin.items.index') }}" class="text-gray-500 hover:text-gray-900 text-sm">← Balik</a>
    <h1 class="text-xl sm:text-2xl font-bold truncate">Edit: {{ $item->name }}</h1>
</div>

<form method="POST" action="{{ route('admin.items.update', $item) }}" enctype="multipart/form-data"
    class="bg-white rounded-xl shadow p-4 sm:p-6 space-y-4 max-w-2xl">
    @csrf
    @method('PUT')
    @include('admin.items._form', ['item' => $item])
    <div class="pt-2">
        <button type="submit" class="w-full sm:w-auto bg-gray-900 text-white px-6 py-3 sm:py-2 rounded-lg font-semibold hover:bg-gray-700 transition text-sm">
            Kemaskini Barang
        </button>
    </div>
</form>
@endsection
