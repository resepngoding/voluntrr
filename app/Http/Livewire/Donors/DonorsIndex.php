<?php

namespace App\Http\Livewire\Donors;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DonorsIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $state = [];
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = false;
    public $showEditModal = false;
    public $donor;
    public $donorIdBeingremoved;
    public $photo;

    public function render()
    {
        $donors = User::donatur_search($this->search)
            ->where('role', '=', 'donatur')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->simplePaginate($this->perPage);

        return view('livewire.donors.donors-index', [
            'donors' => $donors,
        ]);
    }

    // show modal form
    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create User Data
    public function createUser()
    {
        $this->state['role'] = 'donatur';

        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => Auth::check() ? 'sometimes|email|unique:users' : 'required|email|unique:users',
            'address' => 'sometimes',
            'city' => 'sometimes',
            'phone' => 'sometimes',

        ])->validate();
        User::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User created successfully']);
    }

    public function Edit(User $user)
    {

        $this->reset();
        $this->state = $user->toArray();
        $this->showEditModal = true;
        $this->donor = $user;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => Auth::check() ? 'sometimes|email|unique:users' : 'required|email|unique:users',
            'display_name' => 'sometimes',
            'address' => 'sometimes',
            'city' => 'sometimes',
            'phone' => 'sometimes',


        ])->validate();

        $this->donor->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully']);
    }

    public function confirmDonorRemoval($donorId)
    {
        $this->donorIdBeingremoved = $donorId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteDonor()
    {
        $donor = User::findOrFail($this->donorIdBeingremoved);
        $donor->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully']);
    }
}
