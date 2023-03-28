<?php

namespace App\Http\Livewire\Teams;

use App\Models\Team;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TeamIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $state = [];
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = false;
    public $showEditModal = false;
    public $team;
    public $teamIdBeingremoved;

    public function render()
    {
        $teams = Team::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->simplePaginate($this->perPage);

        return view('livewire.teams.team-index', [
            'teams' => $teams
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
    public function createTeam()
    {

        if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin') {
            $this->state['role'] = 'dataentry';
        } else {
            $this->state['role'] = 'donatur';
        }

        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'leader_name' => 'sometimes',
            'active' => 'required'
        ])->validate();


        Team::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User created successfully']);
    }

    public function Edit(Team $team)
    {
        $this->reset();
        $this->state = $team->toArray();
        $this->showEditModal = true;
        $this->team = $team;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateTeam()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'leader_name' => 'sometimes',
            'active' => 'required'
        ])->validate();

        $this->team->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Team updated successfully']);
    }

    public function confirmTeamRemoval($teamId)
    {
        $this->teamIdBeingremoved = $teamId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteTeam()
    {
        $user = Team::findOrFail($this->teamIdBeingremoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Team deleted successfully']);
    }
}
