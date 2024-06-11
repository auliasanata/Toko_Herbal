<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toko Herbal</title>

    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/css/vertical-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/skydash/images/bumdes.png') }}" />

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0" style="position: relative; height: 100vh; overflow: hidden;">
                <!-- <video autoplay loop muted playsinline style="position: absolute; top: 0; left: 0; width: 120%; height: 120%; object-fit: cover;">
                    <source src="{{ asset('assets/img/Cinematic Desa _ Desa Kecil _ Bletok.mp4') }}" type="video/mp4">
                </video> -->

                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-12 px-4 px-sm-12" style="background:#CBDFBA;">
                            <br>
                            <h3 class="font-weight-light" style="text-align: center; color:black; "><b>Login</b></h3>
                            <div class="brand-logo" style="text-align: center;">
                                <img src="{{ asset('assets/images/herbal.png') }}" alt="logo" style="margin: 0 auto;">
                            </div>

                            <form method="POST" action="{{ route('login') }}" style="margin-top : -40px;">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12 offset-md-12"> <!-- Center the entire form -->
                                        <label for="email" class="col-md-12 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email@example.com">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 offset-md-12">
                                        <label for="password" class="col-md-12 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="*******">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3" style="margin-left: -115px;">
                                    <div class="col-md-12 offset-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember" style="margin-left:-5px">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center mb-12"> <!-- Center the row -->
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary btn-block" style="background-color:#75AC34;"> <!-- Make the button full-width -->
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link btn-block" href="{{ route('password.request') }}"> <!-- Make the link full-width -->
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif

                                        @if (Route::has('register'))
                                        <a class="btn btn-link btn-block" href="{{ route('register') }}"> <!-- Make the link full-width -->
                                            {{ __('Don\'t have an account? Register') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('assets/skydash/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/template.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/settings.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/todolist.js') }}"></script>

</body>

</html>