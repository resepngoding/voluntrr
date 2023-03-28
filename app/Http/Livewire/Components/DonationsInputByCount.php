<?php

namespace App\Http\Livewire\Components;

use App\Models\Donation;
use Livewire\Component;

class DonationsInputByCount extends Component
{
    public function render()
    {
        $donasiByDataentryCount = Donation::where('dataentry_id', '=', auth()->user()->id)->count();
        return view('livewire.components.donations-input-by-count', compact('donasiByDataentryCount'));
    }
}
