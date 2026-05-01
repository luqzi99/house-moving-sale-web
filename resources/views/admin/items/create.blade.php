@extends('layouts.admin')

@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.items.index') }}" class="text-gray-500 hover:text-gray-900">← Balik</a>
    <h1 class="text-2xl font-bold">Tambah Barang</h1>
</div>

<form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data"
    class="bg-white rounded-xl shadow p-6 space-y-5 max-w-2xl">
    @csrf
    @include('admin.items._form', ['item' => null])
    <div class="pt-2">
        <button type="submit" class="bg-gray-900 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-700 transition">
            Simpan Barang
        </button>
    </div>
</form>
@endsection
