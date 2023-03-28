<?php

namespace App\Http\Livewire\Donations;

use App\Models\Donation;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DonationsIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $state = [];
    public $perPage = 5;
    public $search = '';
    public $orderBy = 'donations.created_at';
    public $orderAsc = false;
    public $showEditModal = false;
    public $donation;
    public $donationIdBeingremoved;
    public $donor_id;



    public function mount($id)
    {
        $this->donor_id = $id;
    }


    public function render()
    {
        $user = User::FindOrFail($this->donor_id);
        $donations = Donation::search($this->search)
            ->where('user_id', '=',  $this->donor_id)
            ->SelectData()
            ->join('users', 'users.id', '=', 'donations.user_id')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->simplePaginate($this->perPage);
        return view('livewire.donations.donations-index', [
            'donations' => $donations,
            'user' => $user
        ]);
    }

    public function openDonationFormUang()
    {
        return redirect()->route('admin.donations-form-uang', $this->donor_id);
    }

    public function openDonationFormBarang()
    {
        return redirect()->route('admin.donations-form-barang', $this->donor_id);
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
