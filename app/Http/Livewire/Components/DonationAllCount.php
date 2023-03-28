<?php

namespace App\Http\Livewire\Components;

use App\Models\Donation;
use Livewire\Component;

class DonationAllCount extends Component
{

    public function render()
    {
        $donasiAllCount = Donation::count();
        return view('livewire.components.donation-all-count', [
            'donasiAllCount' => $donasiAllCount,
        ]);
    }
}
