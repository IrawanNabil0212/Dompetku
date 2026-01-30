<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        $pemasukan = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', 'Gaji');
        })->sum('nominal');
        $pengeluaran = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', '!=', 'Gaji');
        })->sum('nominal');
        $tabungan = $pemasukan - $pengeluaran;

        return view('laporan', compact('pemasukan', 'pengeluaran', 'tabungan'));
    }
}