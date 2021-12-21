@extends('layout.masterLayout')

@section('style')

    <!-- 약관동의 -->
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_mobile.css" />
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_tablet.css" media="only all and (min-width:768px)"/>
    <link rel="stylesheet" type="text/css" href="/src_css/global_responsive_a_home_pc.css" media="only all and (min-width:1024px)"/>

    <style>
        .d-flex{
            display:flex;
        }
        .d-inline-flex{
            display:inline-flex;
        }
        .d-inline-block{
            display:inline-block;
        }
        .ml-10{
            margin-left:10px;
        }
        .is-invalid {border:solid 1px red !important}
        
        .glores-A-join-wrap .glores-A-value .dup_chk{ 
            color:red;
            position: relative;
            top: 0;
            right: 0;
            bottom: 0;
            width: 110px;
            padding: 0;
            float:right;
        }

        .cus-text{
            width: 100px;
            height: 40px;
            margin: 0;
            padding: 0 8px;
            border: 1px solid #ddd;
            background: #fafafa;
            font-size: 13px;
            color: #444;
        }
        
        .cus-button{
                padding:12px 13px;
                border: 1px solid #ddd;
                background-color: white;
                color: #444;
                cursor: pointer;
        }
        .cus-button:hover{
            background-color: #ddd;
        }
    </style>
@endsection

@section('body')

<div class="cont">
    <div class="glores-A-join-wrap kr">
        <form id='user_join_frm' method='POST' action='{{ route("join.create") }}'>
            @csrf
            <h4 class="glores-A-title">필수 입력 항목</h4>
            <ul class="glores-A-join">
                <li>
                    <label for="id"><span>아이디</span></label>
                    <div class="glores-A-value">
                        <div class='reg_memberID '>
                            <input type='text' name='account' value="{{ old('account') }}" id='account' class="@error('account') is-invalid @enderror" maxlength='12' onchange="dupChk('account')"/>
                        </div>
                    </div>
                    <div class="glores-A-info">아이디는 영문+숫자만 입력 가능합니다.</div>
                    <div class="dup_chk_account"></div>
                </li>
                <li>
                    <label for="nick"><span>별명</span></label>
                    <div class="glores-A-value">
                        <div class='reg_nickname'>
                            <input type='text' name='nickname' id='nickname' class="@error('nickname') is-invalid @enderror" size='6' maxlength='6' value="{{ old('nickname') }}" onchange='dupChk("nickname")'/>
                        </div>
                    </div>
                    <div class="glores-A-info">게시글 작성시 사용 할 닉네임을 입력해 주세요.</div>
                </li>
                <li>
                    <label for="pwd"><span>비밀번호</span></label>
                    <div class="glores-A-value">
                            <div class='reg_password'>
                                <input type='password' name='password' class="@error('password') is-invalid @enderror" id='password' size='12' maxlength='20' onchange="chkPW()" autocomplete='new-password' value="{{ old('password') }}" required/>
                                <label for='pwd_re'>확인</label>
                                <input type='password' id='password_chk' class="@error('password') is-invalid @enderror"  size='12' name='password_chk' value="{{ old('password_chk') }}" maxlength='20' required/>
                            </div>
                        </div>
                    <div class="glores-A-info">비밀번호는 영문+숫자+특수문자를 조합하여 8자 이상 입력해 주세요.</div>
                </li>
                <li>
                    <label for="name"><span>성명</span></label>
                    <div class="glores-A-value">
                        <div class='reg_name'>
                            <input type='text' class="@error('name') is-invalid @enderror" name='name' id='name' size='20' value="{{ old('name') }}" maxlength='4' required/>
                        </div>
                    </div>
                    <div class="glores-A-info"></div>
                </li>
                <li>
                    <label for="email"><span>e-mail</span></label>
                    <div class="glores-A-value">
                        <div class='reg_email'>
                            <input type='text' class="@error('email') is-invalid @enderror" name='email' id='email' value="{{ old('email') }}" required onchange="dupChk('email')" >
                        </div>
                    </div>
                    <div class="glores-A-info">비밀번호를 찾을 때 필요합니다. 정확히 입력해 주세요.</div>
                    <div class="dup_chk_email"></div>
                </li>
                <li>
                    <label for="hp"><span>휴대전화</span></label>
                    <div class="glores-A-value">
                        <div class='reg_mobileNumber'>
                            <select name='hp1' id='hp1' style='width:55px' title='휴대전화 첫번째'>
                                <option value=''>선택</option>
                                @foreach(['010','011','016','017','018','019'] as $row)
                                    <option value='{{$row}}' {{ old('hp1') && old('hp1')==$row ? 'selected' : '' }}>{{$row}}</option>
                                @endforeach
                            </select> - <input type='text' id="hp2" name='hp2' size=4 maxlength=4 value="{{ old('hp2') }}" title='휴대전화 두번째' /> - <input type='text' id="hp3" name='hp3' size=4 maxlength=4 value="{{ old('hp3') }}" title='휴대전화 세번째' />
                        </div>
                    </div>
                    <div class="glores-A-info"></div>
                </li>
            </ul>
                
            <h4 class="glores-A-title">자동 입력 방지</h4>
            <div class="d-flex glores-A-join">
                <div class="g-recaptcha" data-sitekey="6Leb3TUdAAAAAPnoepbg1g2j0EGtgz_XKceTJm0i"></div>
            </div>
            <div class="glores-A-btn-wrap" style="margin-bottom:30px">
                <span class="glores-A-half">
                    <a href="javascript:history.back()" class="glores-A-btn-type1 glores-A-big" >이전으로</a>
                    <a href="javascript:join_save()" class="glores-A-btn-type1 glores-A-big glores-A-highlight" >회원가입</a>
                </span>
            </div>
        </form>
    </div>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</div>

@endsection

@section('script')


@if ($errors->any())
    {{-- validator Error 메세지 출력--}}
    <script>    
        alert("{{ $errors->all()[0] }}");
    </script>
@endif


<script type="text/javascript">
    
    // ID, nickname, email 중복 체크
    function dupChk(type){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/join/dup_chk",
            type: "GET",
            data: {
                'type': type ,
                'val' : $("#"+type).val(),
                'method' : 'create'
            },
            dataType: 'json',
            success:function(data){  
                if(data.status == "error") {
                    $("#"+type).addClass("is-invalid");
                    $("#"+type).focus();
                    alert(data.msg);
                } else {
                    $("#"+type).removeClass("is-invalid");
                }
            }
        });
    }

    function chkPW(){
        var pw = $("#password").val();
        var num = pw.search(/[0-9]/g);
        var eng = pw.search(/[a-z]/ig);
        var spe = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
        var flag = "";

        if(pw.length < 8 || pw.length > 20){
            alert("비밀번호를 8자리 ~ 20자리 이내로 입력해주세요.");
            flag = "N";
        }else if(pw.search(/\s/) != -1){
            alert("비밀번호는 공백 없이 입력해주세요.");
            flag = "N";
        }else if(num < 0 || eng < 0 || spe < 0 ){
            alert("영문,숫자, 특수문자를 혼합하여 입력해주세요.");
            flag = "N";
        }
        if(flag == "N") {
            $("#password").val("");
            $("#password").focus();
            return false;
        }
    }

    // 1차 validation
    function join_save() {
        // 연락처 형식 체크 (두번째, 세번째 번호 입력시)
        var hp1 = $("#hp1").val();
        var hp2 = $("#hp2").val();
        var hp3 = $("#hp3").val();

        if(hp2.length > 0 || hp3.length > 0){
            if(hp1.length == 0 || hp2.length < 3 || hp3.length < 3){
                alert("연락처 형식을 확인해 주세요.");
                return false;
            }
        }

        // 비밀번호 중복 체크
        if($("#password").val() != $("#password_chk").val()){
            alert("비밀번호가 틀립니다.");
            $("#password_chk").focus();
            return false;
        }

        // 캡챠
        var v = grecaptcha.getResponse();
        if ( v.length == 0 ){
            alert('자동 입력 방지를 확인해 주세요.');
            return false;
        }

        $("#user_join_frm").submit();
    }
</script>
@endsection