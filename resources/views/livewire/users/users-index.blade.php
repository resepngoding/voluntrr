<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mx-4">
                     <div class="col-sm-6">
                         <h1 class="m-0">List Users</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">List Users</li>
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
                           <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>Add New User</button>
                       </div>
                       <div class="row mb-2 mx-4">
                           <div class="col-6">
                           <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search">
                           </div>
                           <div class="col-2">
                           <select wire:model="orderBy"  class="form-control">
                               <option value="id" >ID</option>
                               <option value="name" >Name</option>
                               <option value="username" >Username</option>
                               <option value="email" >Email</option>
                               <option value="role" >Role</option>
                               <option value="team" >Team</option>
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
                               <th scope="col">Name</th>
                               <th scope="col">Username</th>
                               <th scope="col">Email</th>
                               <th scope="col">Role</th>
                               <th scope="col">Team</th>
                               <th scope="col">Create at</th>
                               <th scope="col">Options</th>
                           </tr>
                           </thead>
                           <tbody>
                               @foreach ($users as $index => $user )
                                     @if($user->role !== 'superadmin')
                               <tr>
                                   <th scope="row">{{ $users->firstItem() + $index }}</th>
                                        <td>
                                            <img style="width:50px;" class="img img-circle mr-2" src="{{ asset('storage/avatars/' . $user->image) }}" alt="">
                                            {{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if($user->role !== 'user' && $user->role !== 'superadmin' )
                                            <select class="form-control" wire:change="changeRole({{ $user }}, $event.target.value)">
                                                <option value="admin" {{ ($user->role == 'admin') ? 'selected' : '' }}>Admin</option>
                                                <option value="dataentry" {{ ($user->role == 'dataentry') ? 'selected' : '' }}>Data Entry</option>
                                            </select>
                                            @else
                                            Donatur
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-control" wire:change="changeTeam({{ $user }}, $event.target.value)">
                                                <option value="">--Pilih Team--</option>
                                                @foreach ($teams as $value )
                                                @if (old('team', $user['team_id'] ) == $value->id)
                                                <option value="{{ $value->id }}" selected>{{Illuminate\Support\Str::title( $value->name) }}</option>
                                                @else
                                                <option value="{{ $value->id }}">{{ Illuminate\Support\Str::title($value->name) }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>{{ $user->created_at}}</td>
                                        <td>
                                            @if($user->role !== 'donatur' && $user->role !== 'superadmin' )
                                           <a href="" wire:click.prevent="Edit({{ $user }})"><i class="fa fa-edit"></i></a>
                                            @if (auth()->user()->id !== $user->id)
                                            <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})"><i class="fa fa-trash text-danger"></i></a>
                                            @endif
                                            @endif
                                        </td>
                                   </tr>
                                    @endif
                               @endforeach
                           </tbody>
                       </table>
                    </div>
                       <div class="card-footer d-flex justify-content-end">
                           {{ $users->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser'}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Edit User</span>
                            @else
                            <span>Add New User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter full name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input wire:model.defer="state.username" type="text" class="form-control @error('name') is-invalid @enderror" id="username" aria-describedby="usernameHelp" placeholder="Usernames">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input wire:model.defer="state.email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input wire:model.defer="state.password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirmation">Confirm Password</label>
                                <input type="password" wire:model.defer="state.password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Confirm Password">
                            </div>
                            {{-- Profile Photo --}}
                            <div class="form-group">
                                <label for="customFile">Profile Photo</label>
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" style="width:50px;" class="img img-circle d-block mb-2" alt="">
                                @else
                                    <img src="{{ $state['avatar_url'] ?? ''}}" style="width:50px;" class="img img-circle d-block mb-2" alt="">
                                @endif
                                <div class="custom-file">
                                    <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">
                                    @if($photo)
                                        {{ $photo->getClientOriginalname() }}
                                    @else
                                    Choose file
                                    @endif
                                    </label>
                                </div>
                                {{-- Profile Photo --}}
                            </div>
                            <div class="form-group">
                                <label for="team">Team</label>
                                <select wire:model.defer="state.team" name="team" class="form-control">
                                    <option value="">-- Team --</option>
                                    @foreach ($teams as $value )
                                        @if (old('team', $user['team'] ) == $value->name)
                                        <option value="{{ $value->name }}" selected>{{ Illuminate\Support\Str::title($value->name) }}</option>
                                        @else
                                        <option value="{{ $value->name }}">{{ Illuminate\Support\Str::title($value->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
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



   <!-- Modal confirmUserRemoval -->
        <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"><h5>Delete User</h5></div>
                        <div class="modal-body mx-auto"><h4>Are you sure want to delete this user?</h4></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                                <button wire:click.prevent="deleteUser" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash mr-1"></i>Delete  User</button>
                            </div>
                        </div>
                    </div>s
                </div>
            </div>
        </div>
</div>
@push('js')
@include('layouts.partials.crudscripts')
@endpush
