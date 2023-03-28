<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mx-4">
                     <div class="col-sm-6">
                         <h1 class="m-0">List Donasi</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">List Donasi</li>
                         </ol>
                     </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-6  mx-4">
                    <div class="form-group">
                        <label for="start">Tanggal Mulai</label>
                        <input wire:model.lazy="tgl_donasi_begin" name="start" autocomplete="off" type="text" id="datepicker" name="start" class="form-control" value="{{ date(now()) }}">
                        @error('start')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label for="end">Tanggal Selesai</label>
                        <input wire:model.lazy="tgl_donasi_end" name="end" autocomplete="off" type="text" id="datepicker2" name="end" class="form-control" value="{{ date(now()) }}">
                        @error('end')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
          <div class="row">
                <div class="col-lg-12">
                  <div class="d-flex justify-content-between mx-4">
                    <div>
                        <a wire:click.prevent="exportDonasiList" class="btn btn-success">Export Excel</a>
                    </div>
                    <div class="row mb-2 d-flex justify-content-end">
                        <div class="btn-group mx-2 mb-2 bg-secondary">
                            <button wire:click="filterDetailDonasiByInputBy" type="button" class="btn {{ $dataentry_id == null ? 'btn-secondary' : 'btn-default'  }}">
                            <span class="mr-1">Semua</span>
                            <span class="badge badge-pill badge-info"><livewire:components.donation-all-count /></span>
                            </button>
                            <button wire:click="filterDetailDonasiByInputBy({{ auth()->user()->id }})" type="button" class="btn  {{ $dataentry_id !== null ? 'btn-secondary' : 'btn-default'  }}">
                                <span class="mr-1">Diinput oleh <strong>{{ auth()->user()->name }}</strong></span>
                                <span class="badge badge-pill badge-primary"><livewire:components.donations-input-by-count/></span>
                            </button>
                      </div>
                    </div>
                </div>

                <div class="mx-4 pb-2">
                    <input wire:model.debounce.300ms="search" type="text" class="form-control mx-auto" placeholder="Search">
                </div>
                <div class="card mx-4">
                    <div class="table-responsive">
                       <table class="table table-hover">
                           <thead>
                               <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nama Donatur</th>
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
                            @foreach ($donations as $key => $donation )
                            <tr>
                            <td>{{ $donations->firstItem() + $key }}</td>
                            <td style="width:100px;">{{$donation->date}}</td>
                            <td>{{$donation->name}}</td>
                            <td>{{$donation->donation_category}}</td>
                            <td>{{$donation->account ?? '-'}}</td><td>
                                {{$donation->money ?? '0'}}</td>
                            <td>{{$donation->goods ?? '-'}}</td>
                            <td>{{$donation->goods_qty ?? '-'}}</td>
                            <td>{{$donation->description}}</td>
                            <td class="grid">
                                <img  style="width:40px;max-width:300px" src="{{ asset('storage/transfer_images/' . $donation->image) }}" alt="" ></td>
                            <td>{{$donation->dataentry_name}}</td>
                            <td>{{$donation->team ?? ''}}</td>
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


              </div>
          </div>
         </div><!-- /.container-fluid -->
      </section>
      <!-- Delete Modal -->
        <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"><h5>Delete Donasi</h5></div>
                    <div class="modal-body mx-auto"><h4>Yakin akan menghapus donasi?</h4></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                        <button wire:click.prevent="deleteDonation" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash mr-1"></i>Delete Donasi</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



@push('js')
<script src="{{ asset('backend/plugins/pikaday/moment.js') }}"></script>
<script src="{{ asset('backend/plugins/pikaday/pikaday.js') }}"></script>
@include('layouts.partials.crudscripts')
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-DD',
    });
</script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker2'),
        format: 'YYYY-MM-DD',
    });
</script>
@endpush


