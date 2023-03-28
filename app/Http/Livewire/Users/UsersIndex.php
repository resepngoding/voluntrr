<?php

namespace App\Http\Livewire\Users;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $state = [];
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = false;
    public $showEditModal = false;
    public $user;
    public $photo;
    public $userIdBeingremoved;

    public function render()
    {
        $teams = Team::where('active', '=', 'Y')->get();
        $users = User::search($this->search)
            ->where('role', '<>', 'superadmin')
            ->where('role', '<>', 'donatur')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->simplePaginate($this->perPage);

        return view('livewire.users.users-index', [
            'users' => $users,
            'teams' => $teams,
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

        // if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'bendahara') {
        $this->state['role'] = 'dataentry';
        // } else {
        //     $this->state['role'] = 'donatur';
        // }

        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'group_relawan' => 'sometimes',
            'role' => 'sometimes',
            'image' => 'sometimes',
            'team_id' => 'sometimes'
        ])->validate();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['registered_from'] = 'offline';

        if ($this->photo) {
            $validatedData['image'] = $this->photo->store('/', 'avatars');
        }

        User::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User created successfully']);
    }

    public function Edit(User $user)
    {

        $this->reset();
        $this->state = $user->toArray();
        $this->showEditModal = true;
        $this->user = $user;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed',
            'team_id' => 'sometimes',
            'role' => 'sometimes',
            'image' => 'sometimes',
        ])->validate();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        if ($this->photo) {
            Storage::disk('avatars')->delete($this->user->image);
            $validatedData['image'] = $this->photo->store('/', 'avatars');
        }

        $this->user->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully']);
    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingremoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingremoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully']);
    }

    public function changeRole(User $user, $role)
    {

        $user->update(['role' => $role]);
    }

    public function changeTeam(User $user, $team_id)
    {
        $user->update(['team_id' => $team_id]);
    }
}
