@extends('layout.master')

@section('title', 'Edit Transaksi')

@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <!-- Header -->
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                ✏️ Edit Transaksi
            </h2>
            <p class="text-sm text-gray-500">
                Perbarui data transaksi Anda
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <!-- Keterangan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Keterangan
                </label>
                <input
                    type="text"
                    name="keterangan"
                    value="{{ $transaksi->keterangan }}"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tanggal
                </label>
                <input
                    type="date"
                    name="tanggal"
                    value="{{ $transaksi->tanggal }}"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
            </div>

            <!-- Nominal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nominal (Rp)
                </label>
                <input
                    type="number"
                    name="nominal"
                    value="{{ $transaksi->nominal }}"
                    min="1000"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kategori
                </label>
                <select
                    name="kategori_id"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $transaksi->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('transaksi.index') }}"
                   class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>

@endsection