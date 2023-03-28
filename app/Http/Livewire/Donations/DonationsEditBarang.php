<?php

namespace App\Http\Livewire\Donations;

use App\Models\Account;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonationsEditBarang extends Component
{
    use WithFileUploads;

    public $state = [];
    public $donation;
    public $photo;
    public $donor_id;

    public function mount(Donation $donation)
    {
        $this->state = $donation->toArray();
        $this->donor_id = $this->state['user_id'];
        $this->donation = $donation;
    }

    public function updateDonation()
    {
        Validator::make($this->state, [
            'date' => 'required',
            'donation_category' => 'required',
            'goods' => 'required',
            'goods_qty' => 'required',
        ])->validate();

        if ($this->photo) {
            $this->state['image'] = $this->photo->store('/', 'transfer_images');
        }

        $this->donation->update($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Donasi updated successfully!']);

        return redirect()->route('admin.donations', $this->donor_id);
    }

    public function render()
    {
        $categories = Category::all();
        $accounts = Account::all();
        return view(
            'livewire.donations.donations-edit-barang',
            [
                'categories' => $categories,
                'accounts' => $accounts
            ]
        );
    }
}
