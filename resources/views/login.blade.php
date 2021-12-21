@extends('layout.masterLayout')

@section('style')

    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_mobile.css" />
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_tablet.css" media="only all and (min-width:768px)"/>
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_pc.css" media="only all and (min-width:1024px)"/>
@endsection

@section('body')
<div class="cont">
      


    <form method="POST" action="{{ route('login') }}" id="login">
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
                            <input type="text" name="id" id="input_id" placeholder="아이디" required class="glores-A-input-txt">
                        </li>
                        <li>
                            <label for="input_pw" class="glores-A-blind" >비밀번호</label>
                            <input type="password" name="pwd" id="input_pw" maxlength="16" placeholder="비밀번호" required class="glores-A-input-txt">
                        </li>
                    </ul>
                    <button type="submit" class="glores-A-btn-type1 glores-A-btn-login glores-A-highlight" >로그인</button>
                </div>
                <div class="login-btn-box">
                    <a href="javascript:pwd_search()" >아이디 · 비밀번호 찾기</a>
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

    <script defer>
        jQuery(function($){
            $('#input_id').focus();
        });
    </script>  
@endsection