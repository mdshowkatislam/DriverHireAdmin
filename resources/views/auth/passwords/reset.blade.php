<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/plugins/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-30">
        <div class="col-md-8 mt-30">
            <div class="card">
                <div class="card-header text-center">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="phone" value="{{ $phone }}">

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('OTP') }}</label>

                            <div class="col-md-6">
                                <input id="otp" placeholder="OTP" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus>

                                @if( \Illuminate\Support\Facades\Session::has('error') )
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ \Illuminate\Support\Facades\Session::get('error') }}</strong>
                                    </span>
                                    @php \Illuminate\Support\Facades\Session::forget('error') @endphp
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @if( \Illuminate\Support\Facades\Session::has('error_pass') )
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ \Illuminate\Support\Facades\Session::get('error_pass') }}</strong>
                                    </span>
                                    @php \Illuminate\Support\Facades\Session::forget('error_pass') @endphp
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
