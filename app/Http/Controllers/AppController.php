<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Penjualan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  App\Models\Profile;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $produk = Product::all()->count();
        $transaksi_hari_ini = Order::whereDate('order_date', '=', Carbon::today()->toDateString());
        $stok_rendah = Product::where('stock','<','minimum_stock + 10')->get();
        //$pemasukan_hari_ini = $transaksi_hari_ini->select(DB::raw('SUM(amount) as pemasukan'))->first();



        $data_statistik = [
            'total_produk' => $produk,
            'transaksi_hari_ini' => $transaksi_hari_ini->count('order_id'),
            'stok_rendah' => count($stok_rendah),
            //'pemasukan' => $pemasukan_hari_ini['pemasukan']
            'pemasukan'=>'lorem'
        ];
      
        return response(view('beranda')
            ->with('title', 'Dashboard')
            ->with('profile', Profile::get()->first())->with('stok_rendah', $stok_rendah)
            ->with('data_statistik', $data_statistik));
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
