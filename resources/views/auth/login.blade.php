<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ARSIP - Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('eatio/images/favicon.svg') }}">
    <link href="{{ asset('eatio/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">

                                <h2 class="text-center mb-4"><img class="img-fluid mr-3" style="margin-top:-12px" src="{{ asset('eatio/images/favicon.svg') }}" width=40px alt="">ARSIP - Login</h2>

                                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                        @csrf

                                        <div class="form-group text-center">
                                            
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror border border-light text-center" placeholder="username" name="username" value="{{ old('username') }}" autofocus>

                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group text-center">
                                            <!-- <label for="password" class="mb-1 text-center"><strong>{{ __('Password') }}</strong></label> -->
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror border border-light text-center" name="password" placeholder="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">{{ __('LOGIN') }}</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>