<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\DetailPenjualan;
use App\Models\DetailTransaksiModel;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatTransaksi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list_bulan = TransaksiModel::select(DB::raw('MONTH(tanggal_transaksi) as bulan'))
            ->groupBy(DB::raw('MONTH(tanggal_transaksi)'))->get();

        return view('riwayat_transaksi')
            ->with('title', 'Riwayat Transaksi')
            ->with('data_riwayat', TransaksiModel::paginate(8))
            ->with('list_bulan', $list_bulan);
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
        $validation = $request->validate([
            'cart' => 'required',
            'harus_dibayar' => 'required',
            'uang_dibayar' => 'required',
            'kembalian' => 'required'
        ]);

        if ($request->harus_dibayar > $request->uang_dibayar) {
            return response([
                'status' => 'gagal',
                'message' => 'Uang Kurang Rp.' . $request->harus_dibayar - $request->uang_dibayar,
            ], 402);
        }

        $date_now = Carbon::now()->toDateTimeString();
        $kode_transaksi = Str::uuid();

        $data_detail_penjualan = [];

        foreach ($request->cart as $item) {
            array_push($data_detail_penjualan, [
                'kode_transaksi' => $kode_transaksi,
                'id_produk' => $item['id'],
                'jumlah' => $item['count'],
            ]);
        }



        TransaksiModel::create([
            'tanggal_transaksi' => $date_now,
            'kode_transaksi' => $kode_transaksi,
            'harus_dibayar' => $request->harus_dibayar,
            'uang_dibayar' => $request->uang_dibayar,
            'kembalian' => $request->kembalian
        ]);

        DetailTransaksiModel::insert($data_detail_penjualan);

        return response()->json([
            'data' => $data_detail_penjualan,

        ]);
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
    public function export($export)
    {
        $laporan = TransaksiModel::all();

        $data = [
            'title' => 'Laporan Transaksi',
            'heading_content' => 'Daftar Transaksi',
            'data' => $laporan,
            'head' => ['ID', 'Tanggal Transaksi', 'Kode Transaksi', 'Subtotal', 'Dibayar', 'Kembali']
        ];

        $pdf = Pdf::loadView('pdf.transaksi_export', $data);

        if ($export == 'print') {
            return $pdf->stream();
        }
        if ($export == 'download_pdf') {
            return $pdf->download('laporan_transaksi.pdf');
        }
        if ($export == 'download_excel') {
            return Excel::download(new TransaksiExport, 'laporan_transaksi.xlsx');
        }
    }
}
