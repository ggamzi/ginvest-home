@extends('layout.masterLayout')

@section('style')

    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_mobile.css" />
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_tablet.css" media="only all and (min-width:768px)"/>
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_pc.css" media="only all and (min-width:1024px)"/>

    <style>
        .search_tab li{ border:solid 1px #e2e2e2; box-sizing: border-box; width:50%; float:left; height:40px; text-align:center; background-color:#e2e2e2;}
        .search_tab a { line-height:40px; text-decoration:none;  color:#aaaaaa; width:100%; display:block}
        .search_tab .select { border-bottom:none; background-color:white; color:black}

        .is-invalid {border:solid 1px red}
    </style>
@endsection

@section('body')
<div class="cont">
    <div class="glores-A-login">
        <ul class="search_tab">
            <li>
                <a id="id_tab" onclick="idTab()" href="#" class="{{ old('type') == 'account' || !old('type') ? 'select' : '' }}">아이디 찾기</a>
            </li>
            <li>
                <a id="pwd_tab" onclick="pwdTab()" href="#" class="{{ old('type') == 'pwd' ? 'select':'' }}">비밀번호 찾기</a>
            </li>
        </ul>
        <div class="glores-A-login-form" style="border-right-width:0; ">

            <div class="login-input-box" id="id_search">
                <form action="{{ route('search.account') }}" method="get">
                    @csrf
                    <ul>
                        @if(Session::has('account'))
                        <li>                            
                            <span>아이디는 "{{ session('account') }}" 입니다. </span>
                        </li>
                        @else
                        <li>
                            <input type="hidden" name="type" value="account">
                            <input type="email" name="email"  style="{{ $errors->any() && old('type') == 'account' ? 'border:1px solid red' : '' }}" placeholder="이메일을 입력해 주세요" value="{{ $errors->any() ? old('email') : '' }}" required class="glores-A-input-txt">
                            @if($errors->any() && old('type') == 'account')
                                <span style="color:red">존재하지 않는 이메일 입니다.</span>
                            @endif
                        </li>
                        @endif
                    </ul>
                    <br>
                    @if(Session::has('account'))
                        <a href="/login" class="glores-A-btn-type1 glores-A-btn-login glores-A-highlight">로그인</a>
                    @else
                        <input type="submit" class="glores-A-btn-type1 glores-A-btn-login glores-A-highlight" value="아이디 찾기">
                    @endif
                </form>
            </div>

            <div class="login-input-box" id="pwd_search" style="display:none">
                <form action="{{ route('search.pwd') }}" method="GET">
                    <input type="hidden" name="type" value="pwd">
                    @csrf
                    <ul>
                        @if(Session::has('pwd'))
                            <li style="width:100%;">
                                <span>입력하신 이메일로 임시 비밀번호를 발급해 드렸습니다.<br><br>이메일을 확인해 주세요.</span>
                            </li>
                        @else
                            <li>
                                <input type="email" name="email" placeholder="이메일을 입력해 주세요" value="{{ old('type') == 'pwd' && old('email') ? old('email') : '' }}" required class="glores-A-input-txt">
                            </li>
                            <br>
                            <li>
                                <input type="text" style="{{ $errors->any() && old('type') == 'pwd' ? 'border:1px solid red' : '' }}" name="account" placeholder="아이디를 입력해 주세요" value="{{ old('account') }}" required class="glores-A-input-txt">
                                @if($errors->any() && old('type') == 'pwd')
                                    <span style="color:red">조건에 맞는 아이디가 존재하지 않습니다.</span>
                                @endif
                            </li>
                        @endif
                    </ul>
                    <br>
                    @if(!Session::has('pwd'))
                        <input type="submit" class="glores-A-btn-type1 glores-A-btn-login glores-A-highlight" value="비밀번호 찾기" >
                    @else
                        <a href="/login" class="glores-A-btn-type1 glores-A-btn-login glores-A-highlight">로그인</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script>

        // 아이디찾기 탭
        function idTab(){
            $("#pwd_search").hide();
            $("#id_search").show();
            $("#id_tab").addClass('select');
            $("#pwd_tab").removeClass('select');
        };

        // 비밀번호찾기 탭
        function pwdTab(){
            $("#id_search").hide();
            $("#pwd_search").show();
            $("#pwd_tab").addClass('select');
            $("#id_tab").removeClass('select');
        };
        
    </script>  
{{-- 비밀번호 찾기일 경우 비밀번호찾기탭 활성화 --}}
@if(Session::has('pwd') || old('type') == 'pwd' )
    <script>
        pwdTab();
    </script>
@elseif(Session::has('account') || old('type') == 'account' )
    {{-- 아이디 찾기일 경우 아이디찾기탭 활성화 --}}
    <script>
        idTab();
    </script>
@endif

@endsection