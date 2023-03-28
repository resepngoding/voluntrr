<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mx-2">
                     <div class="col-sm-6">
                         <h1 class="m-0">Riwayat Donasi</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">Riwayat Donasi</li>
                         </ol>
                     </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

        <!-- Main content -->
   <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-12 mx-4">
              <!-- small box  Donatur information-->
              <div class="small-box bg-info">
                <div class="inner">
                    <span>Donatur:</span>
                    <h4>{{ $user->name }}</h4>
                    <span>{{ $user->address }}</span>
                    <span>{{ $user->city }}</span>
                    <span>{{ $user->phone }}</span>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
            </div><!-- end of small box  Donatur information-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-2">
                    <div class="d-flex justify-content-end mb-2 mr-4">
                        <button wire:click.prevent="openDonationFormUang" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>Donasi Uang</button>
                    </div>
                    <div class="d-flex justify-content-end mb-2 mr-4">
                        <button wire:click.prevent="openDonationFormBarang" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>Donasi Barang</button>
                    </div>
                </div>
                    <div class="row mb-2 mx-3">
                        <div class="col">
                        <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search">
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
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Jenis Donasi</th>
                                <th>Cara Bayar</th>
                                <th>Nominal Uang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Keterangan</th>
                                <th>Bukti</th>
                                <th>Data Entry Name</th>
                                <th>Team</th>
                                <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $index => $donation )
                            <tr>
                                <th scope="row">{{ $donations->firstItem() + $index }}</th>
                                     <td>{{ $donation->date }}</td>
                                     <td>{{ $donation->donation_category }}</td>
                                     <td>{{ $donation->money ?? '0'}}</td>
                                     <td>{{ $donation->account ?? '-' }}</td>
                                     <td>{{ $donation->goods ?? '-' }}</td>
                                     <td>{{ $donation->goods_qty ?? '-' }}</td>
                                     <td> <img style="width:40px;max-width:300px" src="{{ asset('storage/transfer_images/' . $donation->image) }}" alt=""></td>
                                     <td>{{ $donation->description }}</td>
                                     <td>{{ $donation->dataentry_name }}</td>
                                     <td>{{ $donation->team ?? '' }}</td>
                                     <td>
                                        <a href="{{ $donation->is_money == true ? route('admin.donations.edit-uang', $donation->donation_id) : route('admin.donations.edit-barang', $donation->donation_id)  }}">
                                        <i class="fa fa-edit"></i></a>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin' )
                                        <a href="" wire:click.prevent="confirmDonationRemoval({{$donation->donation_id}})"><i class="fa fa-trash text-danger"></i></a>
                                        @endif
                                     </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {{ $donations->links() }}
                    </div>
                </div>
                {{-- card mx-4 --}}
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->


   <!-- Modal confirmUserRemoval -->
    <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5>Delete User</h5></div>
                <div class="modal-body mx-auto"><h4>Are you sure want to delete this user?</h4></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                    <button wire:click.prevent="deleteDonation" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash mr-1"></i>Delete  Donasi</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
@include('layouts.partials.crudscripts')
@endpush
