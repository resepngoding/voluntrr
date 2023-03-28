<?php

namespace App\Http\Livewire\Accounts;

use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AccountsIndex extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $state = [];
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = false;
    public $showEditModal = false;
    public $account;
    public $accountIdBeingremoved;

    public function render()
    {
        $accounts = Account::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->simplePaginate($this->perPage);

        return view('livewire.accounts.accounts-index', [
            'accounts' => $accounts
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
    public function createAccount()
    {
        dd($this->state);
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'account_number' => 'sometimes',
            'description' => 'sometimes',
        ])->validate();


        Account::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Rekening created successfully']);
    }

    public function Edit(Account $account)
    {
        $this->reset();
        $this->state = $account->toArray();
        $this->showEditModal = true;
        $this->account = $account;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateAccount()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'account_number' => 'sometimes',
            'description' => 'sometimes',
        ])->validate();

        $this->account->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Rekening updated successfully']);
    }

    public function confirmAccountRemoval($accountId)
    {
        $this->accountIdBeingremoved = $accountId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteAccount()
    {
        $user = Account::findOrFail($this->accountIdBeingremoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Rekening deleted successfully']);
    }
}
