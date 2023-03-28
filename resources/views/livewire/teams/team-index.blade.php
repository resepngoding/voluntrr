<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mx-4">
                     <div class="col-sm-6">
                         <h1 class="m-0">List Team</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">List Team</li>
                         </ol>
                     </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

             <!-- /.content-header -->
     <!-- Main content -->
   <div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-lg-12">
                       <div class="d-flex justify-content-end mb-2">
                           <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>Add New Team</button>
                       </div>
                       <div class="row mb-2 mx-4">
                           <div class="col-6">
                           <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search">
                           </div>
                           <div class="col-2">
                           <select wire:model="orderBy"  class="form-control">
                               <option value="id" >ID</option>
                               <option value="name" >Nama Team</option>
                               <option value="leader_name" >Ketua Team</option>
                               <option value="created_at" >Created at</option>
                           </select>
                           </div>
                           <div class="col-2">
                               <select wire:model="orderAsc"  class="form-control">
                                   <option value="1" >Ascending</option>
                                   <option value="0" >Descending</option>

                               </select>
                           </div>
                           <div class="col-2">
                               <select wire:model="perPage"  class="form-control">
                                   <option>5</option>
                                   <option>10</option>
                                   <option>15</option>
                                   <option>25</option>
                               </select>
                           </div>
                       </div>

                   <div class="card mx-4">
                    <div class="table-responsive">
                       <table class="table table-hover">
                           <thead>
                               <tr>
                               <th scope="col">#</th>
                               <th scope="col">Nama Team</th>
                               <th scope="col">Ketua Team</th>
                               <th scope="col">Status</th>
                               <th scope="col">Options</th>
                           </tr>
                           </thead>
                           <tbody>
                               @foreach ($teams as $index => $team )
                                     {{-- @if($user->role !== 'superadmin') --}}
                               <tr>
                                   <th scope="row">{{ $teams->firstItem() + $index }}</th>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->leader_name}}</td>
                                        <td>{{ $team->active }}</td>
                                        <td>
                                           <a href="" wire:click.prevent="Edit({{ $team }})"><i class="fa fa-edit"></i></a>
                                            <a href="" wire:click.prevent="confirmTeamRemoval({{ $team->id }})"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                   </tr>
                                    {{-- @endif --}}
                               @endforeach
                           </tbody>
                       </table>
                    </div>
                       <div class="card-footer d-flex justify-content-end">
                           {{ $teams->links() }}
                       </div>
                   </div>
                   {{-- card mx-4 --}}
               </div>
               <!-- /.col-md-6 -->
           </div>
       </div><!-- /.container-fluid -->
   </div>
   <!-- /.content -->

   <!-- Modal Edit Update -->
   <div wire:ignore.self class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateTeam' : 'createTeam'}}">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if($showEditModal)
                    <span>Edit Team</span>
                    @else
                    <span>Add New Team</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Team</label>
                            <input wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="groupHelp" placeholder="Enter group name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Team</label>
                            <input wire:model.defer="state.leader_name" type="text" class="form-control @error('leader_name') is-invalid @enderror" id="leader_name" aria-describedby="groupHelp" placeholder="Enter group leader_name">
                            @error('leader_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="active">Active</label>
                            <select wire:model.defer="state.active" name="active" class="form-control">
                                <option value="" class="active">-- Activated --</option>
                                <option value="N">Not Active</option>
                                <option value="Y">Active</option>
                            </select>
                            @error('active')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                    @if($showEditModal)
                    <span>Save Changes</span>
                    @else
                    <span>Save</span>
                    @endif
                </button>
                </div>
            </div>
        </form>
    </div>
</div>
   <!-- Modal confirmGroupemoval -->
   <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header"><h5>Delete Team</h5></div>
               <div class="modal-body mx-auto"><h4>Anda yakin akan menghapus Team ini?</h4></div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                   <button wire:click.prevent="deleteTeam" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash mr-1"></i>Delete  Group</button>
               </div>
           </div>
       </div>
 </div>
</div>
@push('js')
@include('layouts.partials.crudscripts')
@endpush

