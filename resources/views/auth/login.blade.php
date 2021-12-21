@extends('layout.masterLayout')

@section('style')

    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_mobile.css" />
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_tablet.css" media="only all and (min-width:768px)"/>
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_pc.css" media="only all and (min-width:1024px)"/>
    <style>
        .is-invalid {border:solid 1px red}
    </style>
@endsection

@section('body')
<div class="cont">
    <form method='post' action="{{ route('login') }}">
        @csrf
        <div class="glores-A-login">
            <h1>LOGIN</h1>
            <div class="glores-A-login-form" style="border-right-width:0">
                <div class="login-check-box">
                    <span>
                        <input type="checkbox" name="id_save" id="id_save" value="1">
                        <label for="id_save" >아이디 저장</label>
                    </span>
                    <span>
                        <input type="checkbox" name="auto_login_yn" id="auto_login_yn" value="1">
                        <label for="auto_login_yn" >자동 로그인</label>
                    </span>
                    <span>
                        <input type="checkbox" name="page_ssl_yn" id="page_ssl_yn" value="1" checked>
                        <label for="page_ssl_yn" >보안접속</label>
                    </span>
                </div>
                    <div class="login-input-box">
                        <ul>
                            <li>
                                <label for="input_id" class="glores-A-blind" >아이디</label>
                                <input type="text" name="account" value="{{ old('account') }}" id="input_id" placeholder="아이디" required class="glores-A-input-txt @error('account') is-invalid @enderror">
                                @error('account')
                                    <span class="invalid-feedback" style="color:red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            
                            <li>
                                <label for="input_pw" class="glores-A-blind" >비밀번호</label>
                                <input type="password" name="password" id="input_pw" maxlength="16" placeholder="비밀번호" required class="glores-A-input-txt @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" style="color:red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                        </ul>
                        <button type="submit" class="glores-A-btn-type1 glores-A-btn-login glores-A-highlight" >로그인</button>
                    </div>
                    <div class="login-btn-box">
                        <a href="/member-search">아이디 · 비밀번호 찾기</a>
                        
                        <a href="/join/agree" >회원가입</a>
                    </div>
                </div>
            </div>
        <!-- 앱 로그인 -->
        
    
    <!-- //앱 로그인 -->
    </form>
   
      
</div>
@endsection

@section('script')
@if(Session::has('message'))
<script>
    $(document).ready(function(){
        alert("{{session('message')}}");
    });
</script>
@endif

@endsection