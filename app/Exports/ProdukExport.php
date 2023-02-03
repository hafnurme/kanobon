<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Produk::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Harga Satuan',
            'Stok',
            'Stok Minimal',
            'Satuan'
        ];
    }
}
