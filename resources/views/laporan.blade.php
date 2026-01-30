@extends('layout.master')

@section('title', 'Laporan Eksklusif')

@section('content')

<!-- HEADER -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Laporan Keuangan <span class="text-amber-500">VIP</span>
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Analisis mendalam kondisi finansial Anda bulan ini.
        </p>
    </div>
    <div class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow">
        Status: Member Premium
    </div>
</div>

<!-- GRAFIK -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

    <!-- DONUT -->
    <div class="bg-white p-6 rounded-xl shadow border">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">
            Proporsi Arus Kas
        </h3>

        <div class="h-64">
            <canvas id="cashflowChart"></canvas>
        </div>

        <p class="mt-4 text-center text-sm text-gray-500">
            *Data berdasarkan transaksi bulan berjalan
        </p>
    </div>

    <!-- BAR -->
    <div class="bg-white p-6 rounded-xl shadow border">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">
            Tren Pengeluaran Mingguan
        </h3>

        <div class="h-64">
            <canvas id="weeklyChart"></canvas>
        </div>
    </div>

</div>

<!-- INSIGHT -->
<div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl p-6 text-white shadow">
    <h3 class="text-xl font-bold mb-2">Insight Finansial AI</h3>
    <p class="leading-relaxed">
        Pengeluaran Anda bulan ini tergolong terkendali.
        Porsi terbesar pengeluaran berada pada kategori
        <b>Makanan & Minuman</b>.
        Disarankan untuk mengurangi pengeluaran kecil harian
        agar tabungan meningkat.
    </p>
</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // DONUT CHART
    new Chart(document.getElementById('cashflowChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pemasukan', 'Pengeluaran', 'Tabungan'],
            datasets: [{
                data: [
                    {{ $pemasukan }},
                    {{ $pengeluaran }},
                    {{ $tabungan }}
                ],
                backgroundColor: ['#10b981', '#ef4444', '#3b82f6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // BAR CHART
    new Chart(document.getElementById('weeklyChart'), {
        type: 'bar',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Pengeluaran (Rp)',
                data: [1200000, 900000, 850000, 1500000],
                backgroundColor: '#6366f1',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection