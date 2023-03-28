<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardIndex extends Component
{
    public $tgl_donasi_begin;
    public $tgl_donasi_end;

    public function mount()
    {
        $this->tgl_donasi_end = Carbon::now()->format('Y-m-d');
        $this->tgl_donasi_begin = Carbon::now()->subMonth(1)->format('Y-m-d');
    }

    public function render()
    {
        $listdonasiPerJenis = $this->donationPerCategoryResultBetweenDate();
        $donationPerUserResultBetweenDate = $this->donationPerUserResultBetweenDate();
        $donationPerTeamResultBetweenDate = $this->donationPerTeamResultBetweenDate();
        $SumDonasiUang = $this->SumDonasiUang();
        $CountDonasiUang = $this->CountDonasiUang();
        $CountDonasiBarang = $this->CountDonasiBarang();
        $CountDataentry = $this->CountDataentry();


        return view('livewire.dashboard.dashboard-index', [
            'listdonasiPerJenis' => $listdonasiPerJenis,
            'donationPerUserResultBetweenDate' => $donationPerUserResultBetweenDate,
            'donationPerTeamResultBetweenDate' => $donationPerTeamResultBetweenDate,
            'SumDonasiUang' => $SumDonasiUang,
            'CountDonasiUang' => $CountDonasiUang,
            'CountDonasiBarang' => $CountDonasiBarang,
            'CountDataentry' => $CountDataentry,
        ]);
    }

    public function donationPerCategoryResultBetweenDate()
    {
        return Donation::select(
            "donation_category",
            DB::raw("(sum(money)) as money"),
        )
            ->whereBetween('donations.date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])
            ->where('is_money', '=', true)
            ->orderBy('money')
            ->groupBy('donation_category')
            ->get();
    }

    public function donationPerUserResultBetweenDate()
    {
        return Donation::select(
            "dataentry_name",
            DB::raw("(sum(money)) as money"),
        )
            ->whereBetween('donations.date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])
            ->where('is_money', '=', true)
            ->orderBy('money')
            ->groupBy('dataentry_name')
            ->paginate(10);
    }

    public function donationPerTeamResultBetweenDate()
    {
        return Donation::select(
            "team",
            DB::raw("(sum(money)) as money"),
        )
            ->whereBetween('donations.date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])
            ->where('is_money', '=', true)
            ->orderBy('money')
            ->groupBy('team')
            ->get();
    }
    public function CountDonasiBarang()
    {
        return DB::table('donations')
            ->where('is_money', '=', false)
            ->whereBetween('date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])->count('goods');
    }

    public function CountDonasiUang()
    {
        return DB::table('donations')
            ->where('is_money', '=', true)
            ->whereBetween('date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])->count('money');
    }



    public function SumDonasiUang()
    {
        return DB::table('donations')
            ->where('is_money', '=', true)
            ->whereBetween('date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])->sum('money');
    }

    public function CountDataentry()
    {
        return DB::table('donations')
            ->whereBetween('date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])->count('dataentry_id');
    }

    // public function CountDonatur()
    // {
    //     return DB::table('donations')
    //         ->groupBy('user_id')
    //         ->whereBetween('date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])->count('user_id');
    // }
}
