<?php

namespace App\Http\Controllers;

use App\Exports\LaporanPenjualanExport;
use App\Models\DetailPenjualan;
use App\Models\DetailOrder;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPenjualan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_laporan = DetailOrder::join('produk', 'detail_transaksi.id_produk', '=', 'produk.id')
            ->select(
                'produk.id',
                'produk.nama_produk',
                DB::raw('SUM(jumlah) as jumlah_terjual'),
                DB::raw('produk.harga_satuan * SUM(jumlah) as pendapatan')
            )
            ->groupBy('id', 'nama_produk', 'harga_satuan')->get();

        return response(view('laporan_penjualan')->with('title', 'Laporan Penjualan')->with('data_laporan', $data_laporan));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print($export)
    {
        $laporan = DetailOrder::join('produk', 'detail_transaksi.id_produk', '=', 'produk.id')
            ->select(
                'produk.id',
                'produk.nama_produk',
                DB::raw('SUM(jumlah) as jumlah_terjual'),
                DB::raw('produk.harga_satuan * SUM(jumlah) as pendapatan')
            )
            ->groupBy('id', 'nama_produk', 'harga_satuan')->get();

        $data = [
            'title' => 'Laporan Penjualan',
            'heading_content' => 'Daftar Penjualan',
            'data' => $laporan,
            'head' => ['ID', 'Nama Produk', 'Jumlah Terjual', 'Pendapatan']
        ];

        $pdf = Pdf::loadView('pdf.penjualan_export', $data);

        if ($export == 'print') {
            return $pdf->stream();
        }
        if ($export == 'download_pdf') {
            return $pdf->download('laporan_penjualan.pdf');
        }
        if ($export == 'download_excel') {
            return Excel::download(new LaporanPenjualanExport, 'laporan_penjualan.xlsx');
        }
    }
}
