<?php

namespace App\Exports;

use App\Models\DetailOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPenjualanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DetailOrder::join('produk', 'detail_transaksi.id_produk', '=', 'produk.id')
            ->select(
                'produk.nama_produk',
                DB::raw('SUM(jumlah) as jumlah_terjual'),
                DB::raw('tbl_produk.harga_satuan * SUM(jumlah) as pendapatan')
            )
            ->groupBy('nama_produk', 'harga_satuan')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Jumlah Terjual',
            'Pendapatan'
        ];
    }
}
