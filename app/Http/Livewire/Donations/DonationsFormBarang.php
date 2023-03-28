<?php

namespace App\Http\Livewire\Donations;

use App\Models\Account;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonationsFormBarang extends Component
{
    use WithFileUploads;

    public $state = [];
    public $donor_id;
    public $photo;
    public function mount($id)
    {
        $this->donor_id = $id;
        $this->state['date'] = now()->format('Y-m-d');
    }

    public function render()
    {
        $categories = Category::all();
        $accounts = Account::all();
        return view(
            'livewire.donations.donations-form-barang',
            [
                'categories' => $categories,
                'accounts' => $accounts
            ]
        );
    }

    public function createDonationBarang()
    {
        Validator::make($this->state, [
            'date' => 'required',
            'donation_category' => 'required',
            'goods' => 'required',
            'goods_qty' => 'required',
        ])->validate();

        $this->state['user_id'] = $this->donor_id;
        $this->state['is_money'] = false;
        $this->state['money'] = null;
        $this->state['account'] = '1';
        $this->state['dataentry_id'] = auth()->user()->id;
        $this->state['dataentry_name'] = auth()->user()->name;
        $this->state['team'] = auth()->user()->team;

        if ($this->photo) {
            $this->state['image'] = $this->photo->store('/', 'transfer_images');
        }

        Donation::create($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Donation created successfully!']);

        return redirect()->route('admin.donations', $this->donor_id);
    }
}
