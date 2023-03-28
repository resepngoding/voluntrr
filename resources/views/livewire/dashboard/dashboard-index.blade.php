<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <section class="content">
        <div class="container-fluid">
           <div class="row">
            <div class="col-md-2 col-sm-6">
                <div class="form-group">
                    <label for="start">Mulai Tanggal :</label>
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
                    <label for="end">Sampai Tanggal :</label>
                    <input wire:model.lazy="tgl_donasi_end" name="end" autocomplete="off" type="text" id="datepicker2" name="end" class="form-control" value="{{ date(now()) }}">
                    @error('end')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <p>Total Perolehan ZISWAF</p>
                  <h3>Rp{{ moneyFormat($SumDonasiUang) }}</h3>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <p>Jumlah Transaksi ZISWAF Uang</p>
                  <h3>{{ moneyFormat($CountDonasiUang) }}</h3>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>

            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <p>Jumlah Transaksi ZISWAF Barang</p>
                  <h3>{{ moneyFormat($CountDonasiBarang) }}</h3>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <p>Jumlah Relawan yang Input Data</p>
                  <h3>{{ $CountDataentry }}</h3>

                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="card card-info">
                <div class="card-header">
                <h3 class="card-title">Perolehan Total ZISWAF</h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped">
                  <thead>
                  <tr>
                  <th style="width: 10px">#</th>
                  <th>Jenis Donasi</th>
                  <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($listdonasiPerJenis as $item )
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                    <td>{{$item->donation_category }}</td>
                    <td>{{moneyFormat($item->money) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Perolehan ZISWAF Per Group Relawan</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Group Relawan</th>
                        <th>Perolehan Ziswaf</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($donationPerTeamResultBetweenDate as $item )
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                          <td>{{$item->team }}</td>
                          <td>{{moneyFormat($item->money) }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                        </table>
                  </div>

            </div>

            </div>

          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card card-warning">
                <div class="card-header">
                <h3 class="card-title">Perolehan Ziswaf Setiap Relawan</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Relawan</th>
                        <th>Perolehan Ziswaf</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($donationPerUserResultBetweenDate as $item )
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                          <td>{{$item->dataentry_name }}</td>
                          <td>{{moneyFormat($item->money) }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                        </table>

                </div>

              </div>
              <div>
                {{$donationPerUserResultBetweenDate->links()}}
            </div>
            </div>

            <div class="col-md-6">

            </div>

            </div>

          </div>



          <!-- /.row -->
         </div><!-- /.container-fluid -->
      </section>



</div>



@push('js')
@include('layouts.partials.crudscripts')
<script src="{{ asset('backend/plugins/pikaday/moment.js') }}"></script>
<script src="{{ asset('backend/plugins/pikaday/pikaday.js') }}"></script>
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



