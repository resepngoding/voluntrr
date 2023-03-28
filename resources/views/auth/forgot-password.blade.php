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
          <a href="../../index2.html"><b>Reset Password</a>
        </div>

        <div class="card">

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.request') }}">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold text-uppercase">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Masukkan Alamat Email">

                        @error('email')
                        <div class="alert alert-danger mt-2">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">SEND PASSWORD RESET LINK</button>
                </form>
            </div>
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
