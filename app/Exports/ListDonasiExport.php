<?php

namespace App\Exports;

use App\Models\Detaildonasi;
use App\Models\Donasi;
use App\Models\Donation;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ListDonasiExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{

    use Exportable;
    public $dataentry_id;
    public $search;
    public $tgl_donasi_begin;
    public $tgl_donasi_end;

    public function __construct($dataentry_id =  null, $search = null, $tgl_donasi_begin = null, $tgl_donasi_end = null)
    {
        $this->dataentry_id = $dataentry_id;
        $this->search = $search;
        $this->tgl_donasi_begin = $tgl_donasi_begin;
        $this->tgl_donasi_end = $tgl_donasi_end;
    }

    public function map($donation): array
    {
        return [
            $donation->date,
            $donation->user_id,
            $donation->account_name,
            $donation->money,
            $donation->goods,
            $donation->goods_qty,
            AccountName($donation->account),
            $donation->description,
            $donation->dataentry_name,
            $donation->team,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Donatur',
            'Jenis Donasi',
            'Jumlah Uang',
            'Donasi Barang',
            'Cara Bayar',
            'Keterangan',
            'Diinput Oleh',
            'Grup Relawan',
        ];
    }

    public function query()
    {

        if ($this->tgl_donasi_begin || $this->tgl_donasi_end) {
            return  Donation::Search(trim($this->search))
                ->when($this->dataentry_id, function ($q, $dataentry_id) {
                    $q->where('dataentry_id', '=', $dataentry_id);
                })
                ->whereBetween('date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])
                ->orderBy('date', 'desc');
        } else {
            return Donation::Search(trim($this->search))
                ->when($this->dataentry_id, function ($q, $dataentry_id) {
                    $q->where('dataentry_id', '=', $dataentry_id);
                })
                ->orderBy('date', 'desc');
        }
    }
}
