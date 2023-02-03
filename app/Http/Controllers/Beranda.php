<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiModel;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  App\Models\Profile;
use App\Models\TransaksiModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Beranda extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $produk = Produk::all()->count('id');
        $transaksi_hari_ini = TransaksiModel::whereDate('tanggal_transaksi', '=', Carbon::today()->toDateString());
        $stok_rendah = Produk::whereRaw('stok < stok_min + 10')->get();
        $pemasukan_hari_ini = $transaksi_hari_ini->select(DB::raw('SUM(harus_dibayar) as pemasukan'))->first();



        $data_statistik = [
            'total_produk' => $produk,
            'transaksi_hari_ini' => $transaksi_hari_ini->count('id'),
            'stok_rendah' => count($stok_rendah),
            'pemasukan' => $pemasukan_hari_ini['pemasukan']
        ];

        return view('beranda')
            ->with('title', 'Dashboard')
            ->with('profile', Profile::find(1))->with('stok_rendah', $stok_rendah)
            ->with('data_statistik', $data_statistik);
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
}
