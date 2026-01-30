<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('is_logged_in')) {
            return redirect('/login');
        }

        $query = Transaksi::with('kategori')->orderBy('tanggal', 'desc');

        // SEARCH
        if ($request->search) {
            $query->where('keterangan', 'like', '%'.$request->search.'%');
        }

        $dataTransaksi = $query->paginate(10);

        // LAPORAN
        $pemasukan = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', 'Gaji');
        })->sum('nominal');

        $pengeluaran = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', '!=', 'Gaji');
        })->sum('nominal');

        $saldo = $pemasukan - $pengeluaran;

        return view('transaksi.index', compact(
            'dataTransaksi',
            'pemasukan',
            'pengeluaran',
            'saldo'
        ));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('transaksi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan'  => 'required',
            'tanggal'     => 'required|date',
            'nominal'     => 'required|numeric|min:1000',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Transaksi::create($request->all());

        return redirect('/')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kategoris = Kategori::all();

        return view('transaksi.edit', compact('transaksi','kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan'  => 'required',
            'tanggal'     => 'required|date',
            'nominal'     => 'required|numeric|min:1000',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Transaksi::findOrFail($id)->update($request->all());

        return redirect('/')->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        Transaksi::findOrFail($id)->delete();
        return redirect('/')->with('success', 'Transaksi berhasil dihapus');
    }
}