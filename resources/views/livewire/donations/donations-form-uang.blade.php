<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1 class="m-0">Form Donasi Uang</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">Form Donasi Uang</li>
                         </ol>
                     </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

        <!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="card mx-4 p-4">
                    <form wire:submit.prevent="createDonationUang">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">Tanggal Donasi</label>
                                <input  wire:model.lazy="state.date" name="date" type="text" class="form-control @error('date') is-invalid @enderror" id="datepicker" aria-describedby="dateHelp">
                                @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputState">Jenis Donasi (ZISWAF)</label>
                              <select  wire:model.defer="state.donation_category" id="inputState" class="form-control @error('donation_category') is-invalid @enderror">
                                <option value="" selected>-- Pilih ZISWAF --</option>
                                @foreach ($categories as $category )
                                <option value ="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                                @error('donation_category')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row" >
                            <div class="form-group col-md-6">
                              <label for="inputMoney">Jumlah Uang</label>
                              <input  wire:model.defer="state.money" type="text" class="form-control  @error('money') is-invalid @enderror" id="inputMoney">
                              @error('money')
                              <div class="invalid-feedback">
                              {{ $message }}
                              </div>
                              @enderror
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputState">Ke Rekening</label>
                              <select  wire:model.defer="state.account" id="inputState" class="form-control  @error('account') is-invalid @enderror">
                                <option selected>-- Rekening --</option>
                                @foreach ($accounts as $account )
                                <option value ="{{$account->name}} {{ $account->account_number ? ': ' . $account->account_number  : ''}} ">{{$account->name }} - Rek No. : {{$account->account_number }}</option>
                                @endforeach
                              </select>
                              @error('account')
                              <div class="invalid-feedback">
                              {{ $message }}
                              </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">Keterangan</label>
                                <input wire:model.defer="state.description" type="text" class="form-control  @error('description') is-invalid @enderror" id="inputCity">
                                @error('description')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
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
                           </div>

                     <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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
