<?php

namespace App\Http\Livewire\Donations;

use App\Exports\ListDonasiExport;
use App\Models\Donation;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class DonationsList extends Component
{

    public $showEditModal;
    public $update_donasi;
    public $state = [];
    public $image;
    public $donatur_id;
    public $tgl_donasi;
    public $to_journal = true;
    public $donationIdBeingremoved;
    public $users;
    public $search = '';
    public $status = null;
    public $dataentry_id = null;
    public $tgl_donasi_begin;
    public $tgl_donasi_end;
    public $orderBy = 'donations.created_at';
    public $orderAsc = false;
    public $perPage = 8;


    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->tgl_donasi_end = Carbon::now()->format('Y-m-d');
        $this->tgl_donasi_begin = Carbon::now()->subMonth(1)->format('Y-m-d');
    }

    public function render()

    {
        if ($this->tgl_donasi_begin || $this->tgl_donasi_end) {
            $donations = Donation::search($this->search)
                ->SelectData()
                ->whereBetween('date', [$this->tgl_donasi_begin, $this->tgl_donasi_end])
                ->join('users', 'users.id', '=', 'donations.user_id')
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage);
        } else {
            $donations = Donation::search($this->search)
                ->SelectData()
                ->join('users', 'users.id', '=', 'donations.user_id')
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage);
        }



        $donationsAllCount = Donation::count();

        return view(
            'livewire.donations.donations-list',
            [
                'donations' => $donations,
                'donationsAllCount' => $donationsAllCount,
            ]
        );
    }

    public function filterDetailDonasiByInputBy($dataentry_id = null)
    {
        $this->resetPage();
        $this->dataentry_id = $dataentry_id;
    }

    public function exportDonasiList()
    {
        return (new ListDonasiExport($this->dataentry_id, $this->search, $this->tgl_donasi_begin, $this->tgl_donasi_end))->download('ListDonasi.xlsx');
    }

    public function confirmDonationRemoval($DonationId)
    {

        $this->donationIdBeingremoved = $DonationId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteDonation()
    {
        $donor = Donation::findOrFail($this->donationIdBeingremoved);
        $donor->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Donasi berhasil dihapus']);
    }
}
