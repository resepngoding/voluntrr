<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mx-4">
                     <div class="col-sm-6">
                         <h1 class="m-0">List Donatur</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">List Donatur</li>
                         </ol>
                     </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

        <!-- Main content -->
   <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <div class="d-flex justify-content-end mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary mr-4"><i class="fa fa-plus-circle mr-1"></i>Donatur Baru</button>
                    </div>
                    <div class="row mb-2 mx-3">
                        <div class="col">
                        <input wire:model.debounce.300ms="search" type="text" class="form-control  mx-auto" placeholder="Search">
                        </div>
                        <div class="col-2">
                        <select wire:model="orderBy"  class="form-control">
                            <option value="name" >Nama</option>
                            <option value="username" >Alamat</option>
                            <option value="email" >Kota</option>
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
                                <th></th>
                            <th scope="col">Nama Donatur</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kota</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($donors as $index => $donor )
                            <tr>
                                {{-- <td scope="row">{{ $donors->firstItem() + $index }}</td> --}}
                                    <td class="text-left" style="width:50px;" >
                                        <a href="{{ route('admin.donations', $donor->id) }}">
                                            <span class="badge badge-primary"><i class="fa fa-arrow-right mr-2"></i> Riwayat & Input Donasi</span>
                                        </a></td>
                                         <img style="width:50px;" class="img img-circle mr-2" src="{{ asset('storage/avatars/' . $donor->image) }}" alt="">
                                     <td>{{ $donor->name }}</td>
                                     <td>{{ $donor->address }}</td>
                                     <td>{{ $donor->city }}</td>
                                     <td>{{ $donor->phone }}</td>
                                     <td>
                                         <a href="" wire:click.prevent="Edit({{ $donor->id }})"><i class="fa fa-edit"></i></a>
                                         @if(auth()->user()->role === 'admin' && auth()->user()->role === 'superadmin' )
                                         <a href="" wire:click.prevent="confirmDonorRemoval({{ $donor->id }})"><i class="fa fa-trash text-danger"></i></a>
                                         @endif
                                     </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {{-- {{ $donors->links() }} --}}
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
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input wire:model.defer="state.name" type="text" value="{{ old('name')}}" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter full name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input wire:model.defer="state.address" type="text" value="{{ old('address')}}"  class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="addressHelp" placeholder="Alamat">
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">Kota</label>
                            <input wire:model.defer="state.city" type="text" value="{{ old('city')}}"  class="form-control @error('city') is-invalid @enderror" id="city" aria-describedby="cityHelp" placeholder="Kota">
                            @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon / WA</label>
                            <input wire:model.defer="state.phone" type="text" value="{{ old('phone')}}" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="phoneHelp" placeholder="Telepon / WA">
                            @error('phone')
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


   <!-- Modal confirmUserRemoval -->
    <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5>Delete Donatur</h5></div>
                <div class="modal-body mx-auto"><h4>Anda yakin akan menghapus donatur ini?</h4></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                    <button wire:click.prevent="deleteDonor" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash mr-1"></i>Delete  Donatur</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
@include('layouts.partials.crudscripts')
@endpush
