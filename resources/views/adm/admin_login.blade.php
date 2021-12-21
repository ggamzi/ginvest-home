<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adm/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adm/css/adminlte.min.css">
    
    <style>
        body input text{
            font-size:13px
        }
        ::placeholder {
            font-size:13px
        }
        .invalid-feedback { display:block }
    </style>
</head>

<body style="background-color:#cccccc">
    <div class="col-md-2" style="margin:0 auto; padding-top:200px">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="form-group row justify-content-center">
                        <strong>관리자 로그인</strong>
                    </div>

                    <div class="form-group row justify-content-center mt-3">
                        <div class="col-md-10">
                            <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="account" placeholder="아이디" autofocus>
                            @error('account')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-10">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="비밀번호" autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-info col-12" style="font-weight:bold">
                                {{ __('로그인') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- ./card-body END -->
        </div>
        <!-- ./card END -->
    </div>
    <!-- ./col END -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <!-- <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- AdminLTE App -->
    <script src="/adm/js/adminlte.min.js"></script>

</body>

</html>