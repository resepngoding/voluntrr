
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{-- setting('site_title') --}} | {{-- setting('site_name') --}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css')}}">

</head>
<body class="hold-transition login-page">
    <div class="register-box">
        <div class="register-logo">
          <b>Lengkapi Data Anda</b>
        </div>

        <div class="card">
          <div class="card-body register-card-body">

            <form action="{{ route('register-step2.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('Nama') }}</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"  placeholder="nama lengkap" value="{{ auth()->user()->name }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('Nama Display') }}</label>
                    <input name="display_name" type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" placeholder="nama yang akan dicantumkan di list donasi" value="{{ auth()->user()->display_name ?? '' }}">
                    <p>contoh: hamba Allah, anonim, dll. <br/> kosongkan bisa sesuai nama asli</p>
                    @error('display_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('Alamat') }}</label>
                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address"  placeholder="alamat" value="{{ auth()->user()->address ?? '' }}">
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('Kota') }}</label>
                    <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="kota" value="{{ auth()->user()->city ?? '' }}">
                    @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('Telepon') }}</label>
                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"  placeholder="telepon" value="{{ auth()->user()->phone ?? '' }}">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


              <div class="row">
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">{{ __('Simpan') }}</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            {{-- <div class="social-auth-links text-center">
              <p>Register with Google / Facebook Account :</p>
              <a href="/auth/facebook" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i>
                Sign up using Facebook
              </a>
              <a href="/auth/google" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i>
                Sign up using Google+
              </a>
            </div> --}}

            {{-- <a href="{{ '/login' }}" class="text-center">Login</a> --}}
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
      <!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
