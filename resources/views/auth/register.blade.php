
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
          <b>Registrasi Sebagai Donatur</b>
        </div>

        <div class="card">
          <div class="card-body register-card-body">
            {{-- <p class="login-box-msg"> {{ __('Register') }}</p> --}}

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('Nama') }}</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter full name">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('Username') }}</label>
                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="usernameHelp" placeholder="Enter username">
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{ __('E-Mail') }}</label>
                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation">{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Confirm Password">
                    </div>
              <div class="row">
                <div class="col-8">
                  {{-- <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                     I agree to the <a href="#">terms</a>
                    </label>
                  </div> --}}
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
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

            <a href="{{ '/login' }}" class="text-center">Login</a>
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
