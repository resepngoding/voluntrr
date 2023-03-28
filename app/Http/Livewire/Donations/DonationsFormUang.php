<?php

namespace App\Http\Livewire\Donations;

use App\Models\Account;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonationsFormUang extends Component
{
    use WithFileUploads;

    public $state = [];
    public $donor_id;
    public $photo;
    public $team;
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
            'livewire.donations.donations-form-uang',
            [
                'categories' => $categories,
                'accounts' => $accounts
            ]
        );
    }

    public function createDonationUang()
    {
        Validator::make($this->state, [
            'date' => 'required',
            'donation_category' => 'required',
            'money' => 'required',
            'account' => 'required',
        ])->validate();

        $this->state['user_id'] = $this->donor_id;
        $this->state['is_money'] = true;
        $this->state['goods'] = null;
        $this->state['goods_qty'] = null;
        $this->state['dataentry_id'] = auth()->user()->id;
        $this->state['dataentry_name'] = auth()->user()->name;

        $this->team = Team::where('id', auth()->user()->team_id)->first(['name'])->name;;
        $this->state['team'] = $this->team;

        // dd($this->state);
        if ($this->photo) {
            $this->state['image'] = $this->photo->store('/', 'transfer_images');
        }


        Donation::create($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Donasi uang berhasil disimpan!']);

        return redirect()->route('admin.donations', $this->donor_id);
    }
}
