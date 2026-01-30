@extends('layout.master')

@section('content')

<!-- SEARCH -->
<form method="GET" class="mb-6">
    <input
        type="text"
        name="search"
        placeholder="Cari transaksi..."
        value="{{ request('search') }}"
        class="border rounded-lg px-4 py-2 w-72 focus:outline-none focus:ring focus:border-blue-300"
    >
</form>

<!-- RINGKASAN SALDO -->
<div class="grid grid-cols-3 gap-6 mb-8">

    <div class="bg-blue-50 border-l-4 border-blue-500 p-5 rounded-lg shadow">
        <p class="text-sm text-gray-500">Saldo</p>
        <p class="text-2xl font-bold">
            Rp {{ number_format($saldo) }}
        </p>
    </div>

    <div class="bg-green-50 border-l-4 border-green-500 p-5 rounded-lg shadow">
        <p class="text-sm text-gray-500">Pemasukan</p>
        <p class="text-2xl font-bold text-green-600">
            Rp {{ number_format($pemasukan) }}
        </p>
    </div>

    <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-lg shadow">
        <p class="text-sm text-gray-500">Pengeluaran</p>
        <p class="text-2xl font-bold text-red-600">
            Rp {{ number_format($pengeluaran) }}
        </p>
    </div>

</div>

<!-- TABEL TRANSAKSI -->
<div class="bg-white rounded-lg shadow overflow-hidden">

    <table class="w-full">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
            <tr>
                <th class="p-4 text-left">Tanggal</th>
                <th class="p-4 text-left">Keterangan</th>
                <th class="p-4 text-left">Kategori</th>
                <th class="p-4 text-right">Nominal</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">

            @foreach ($dataTransaksi as $item)
            <tr class="hover:bg-gray-50">

                <!-- TANGGAL -->
                <td class="p-4 text-gray-500">
                    {{ $item->tanggal }}
                </td>

                <!-- KETERANGAN -->
                <td class="p-4 font-medium">
                    {{ $item->keterangan }}
                </td>

                <!-- KATEGORI -->
                <td class="p-4">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700">
                        {{ $item->kategori->nama_kategori }}
                    </span>
                </td>

                <!-- NOMINAL -->
                <td class="p-4 text-right font-semibold">
                    Rp {{ number_format($item->nominal) }}
                </td>

                <!-- AKSI -->
                <td class="p-4">
                    <div class="flex justify-center gap-4">
                        <!-- EDIT -->
                        <a
                            href="/transaksi/{{ $item->id }}/edit"
                            class="text-blue-600 hover:text-blue-800 text-lg"
                            title="Edit Transaksi"
                        >
                            ✏️
                        </a>

                        <!-- DELETE -->
                        <form
                            method="POST"
                            action="/transaksi/{{ $item->id }}"
                            onsubmit="return confirm('Hapus transaksi?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="text-red-600 hover:text-red-800 text-lg"
                                title="Hapus Transaksi"
                            >
                                🗑️
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>

</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $dataTransaksi->links() }}
</div>

@endsection