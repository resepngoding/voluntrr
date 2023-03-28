<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mx-4">
                     <div class="col-sm-6">
                         <h1 class="m-0">List Rekening</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">List Rekening</li>
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
                               <option value="name" >Nama Rekening</option>
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
                               <th scope="col">Nama Rekening</th>
                               <th scope="col">Nomor Rekening</th>
                               <th scope="col">Active ?</th>
                               <th scope="col">Keterangan</th>
                               <th scope="col">Options</th>
                           </tr>
                           </thead>
                           <tbody>
                               @foreach ($accounts as $index => $account )
                                     {{-- @if($user->role !== 'superadmin') --}}
                               <tr>
                                   <th scope="row">{{ $accounts->firstItem() + $index }}</th>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->account_number}}</td>
                                        <td>{{ $account->is_active }}</td>
                                        <td>{{ $account->description }}</td>
                                        <td>
                                           <a href="" wire:click.prevent="Edit({{ $account }})"><i class="fa fa-edit"></i></a>
                                            <a href="" wire:click.prevent="confirmAccountRemoval({{ $account->id }})"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                   </tr>
                                    {{-- @endif --}}
                               @endforeach
                           </tbody>
                       </table>
                    </div>
                       <div class="card-footer d-flex justify-content-end">
                           {{ $accounts->links() }}
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
        <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateAccount' : 'createAccount'}}">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if($showEditModal)
                    <span>Edit Rekening</span>
                    @else
                    <span>Add New Rekening</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Rekening</label>
                            <input wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="groupHelp" placeholder="Enter group name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="account_number">Nomor Rekening</label>
                            <input wire:model.defer="state.account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" id="leader_name" aria-describedby="groupHelp" placeholder="Enter group leader_name">
                            @error('account_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="is_active">Active</label>
                            <select wire:model.defer="state.is_active" name="is_active" class="form-control">
                                <option value="" class="active">--Is Active ? --</option>
                                <option value="N">Not Active</option>
                                <option value="Y">Active</option>
                            </select>
                            @error('is_active')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <input wire:model.defer="state.description" type="text" class="form-control @error('description') is-invalid @enderror" id="leader_name" aria-describedby="groupHelp" placeholder="Enter group leader_name">
                            @error('description')
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
               <div class="modal-header"><h5>Delete Rekening</h5></div>
               <div class="modal-body mx-auto"><h4>Anda yakin akan menghapus Rekening ini?</h4></div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                   <button wire:click.prevent="deleteAccount" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash mr-1"></i>Delete  Account</button>
               </div>
           </div>
       </div>
 </div>
</div>
@push('js')
@include('layouts.partials.crudscripts')
@endpush

