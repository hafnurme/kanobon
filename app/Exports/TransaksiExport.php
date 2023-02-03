<?php

namespace App\Exports;

use App\Models\Penjualan;
use App\Models\TransaksiModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TransaksiModel::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal Penjualan',
            'Kode Penjualan',
            'Subtotal',
            'Uang Dibayar',
            'Kembalian'
        ];
    }
}
