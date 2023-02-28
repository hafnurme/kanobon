<?php

namespace App\Http\Controllers;

use App\Exports\ProdukExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(view('produk')->with('title', 'Produk')->with('data_produk', Product::paginate(8)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return response(view('tambah_produk')->with('title', "Tambah Produk")->with('produk_terbaru', Product::orderBy('id', 'DESC')->limit(10)->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required',
            'harga_satuan' => 'required',
            'stok' => 'required',
            'stok_min' => 'required',
            'satuan' => 'required'
        ]);

        $product = Product::create([
            'name' => $request->nama_produk,
            'price_rec' => $request->harga_satuan,
            'stock' => $request->stok,
            'minimum_stock' => $request->stok_min,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('add-product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response 
     * */
    public function show(Request $request)
    {
        $validation = $request->validate([
            'item' => 'required'
        ]);

        $data_produk = Product::where('nama_produk', 'like', '%' . $request->item . '%')->paginate(8);

        if (!$validation) {
            return redirect('/');
        }

        return response(view('produk')->with('title', 'Kasir')->with('data_produk', $data_produk));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|null
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_produk' => 'required',
            'harga_satuan' => 'required',
            'stok' => 'required',
            'stok_min' => 'required',
            'satuan' => 'required'
        ]);

        Product::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'harga_satuan' => $request->harga_satuan,
            'stok' => $request->stok,
            'stok_min' => $request->stok_min,
            'satuan' => $request->satuan,
        ]);

        return redirect('/produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|null
     */
    public function destroy($id)
    {
        //
    }

    public function print($export)
    {
        $produk = Product::all();
        $data = [
            'title' => 'Laporan Produk',
            'heading_content' => 'Daftar Produk',
            'produk' => $produk,
            'head' => ['ID', 'Nama Produk', 'Harga Satuan', 'Stok', 'Satuan', 'Stok Minimal']
        ];
        $pdf = Pdf::loadView('pdf.daftar_produk', $data);

        if ($export == 'print') {
            return $pdf->stream();
        }
        if ($export == 'download_pdf') {
            return $pdf->download('laporan_produk.pdf');
        }
        if ($export == 'download_excel') {
            return Excel::download(new ProdukExport, 'produk.xlsx');
        }
    }
    /**
     * Sync product table to database
     *
     * @param  Request $response
     * @return \Illuminate\Http\Response|null
     */
    public function sync(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            return response('unauthorized');
        }
        $token = $request->session()->get('token');
        $prd = Http::withToken('token')->get(env('API_URL') . 'product');
        if ($prd->ok()) {
            $data = $prd->object();
            foreach ($data as $p) {
                Product::create([
                    'product_id' => $p->product_id,
                    'product_code' => $p->product_code,
                    'brand' => $p->brand,
                    'name' => $p->name,
                    'category_id' => $p->category_id,
                    'buy_price' => $p->buy_price,
                    'price_rec' => $p->price_rec,
                    'price_rec_from_sup' => $p->price_rec_from_sup,
                    'profit_margin' => $p->profit_margin,
                    'stock' => $p->stock,
                    'minimum_stock' => $p->minimum_stock,
                    'description' => $p->description,
                    'property' => $p->property,
                ]);
            }
            return response('ok');
        }
    }
}
