<div class="h_info" style="background:#27374d;">
            <div class="cont">
            <h1 class="h_logo">
                <a href="/"><img src="/design/img/h_logo.png"></a>
            </h1>
            <div class="nav">
                <ul class="dep1 clr">
                    @foreach(contain as $row)
                    <li class="contain_sub">
                        <a href="">{{ $row['title'] }}</a>
                        <div>
                            <ul class="dep2">
                                @foreach ($row['sub'] as $row_sub)
                                    <li>
                                        <a href="{{ $row_sub['url'] }}">{{ $row_sub['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="navi_btn">
                <span>
                    <div class="menu menu-3">
                        <span class="menu-item"></span>
                        <span class="menu-item"></span>
                        <span class="menu-item"></span>
                    </div>
                </span>
            </div>
            <div class="sns_btn">
                <div class="login">
                    <a href="/login" class="login">Login</a>
                    <a href="/join">Join</a>
                </div>
                <style>
                    /*sub*/
                    .h_info .sns_btn .sns_icon a{filter: invert(100%);}
                    .h_info .sns_btn .sns_icon a.facebook {
                        background: url('/design/img/facebook2.png') center no-repeat;
                        background-size: cover;
                    }
                    .h_info .sns_btn .sns_icon a.facebook:hover {
                        background: url('/design/img/facebook_hover2.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info .sns_btn .sns_icon a.insta {
                        background: url('/design/img/insta2.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info .sns_btn .sns_icon a.insta:hover {
                        background: url('/design/img/insta_hover2.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info .sns_btn .sns_icon a.blog {
                        background: url('/design/img/blog2.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info .sns_btn .sns_icon a.blog:hover {
                        background: url('/design/img/blog_hover2.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info .sns_btn .sns_icon a.ytubeico {
                        background: url('/design/img/youtube_ico.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info .sns_btn .sns_icon a.ytubeico:hover {
                        background: url('/design/img/youtube_ico_hover.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info .sns_btn .sns_icon a.kakaoico {
                        background: url('/design/img/sns_kakao.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info .sns_btn .sns_icon a.kakaoico:hover {
                        background: url('/design/img/sns_kakao_hover.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    /*main*/
                    .h_info2 .sns_btn .sns_icon a.facebook {
                        background: url('/design/img/facebook2.png') center no-repeat;
                        background-size: cover;
                    }
                    .h_info2 .sns_btn .sns_icon a.facebook:hover {
                        background: url('/design/img/facebook_hover2.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info2 .sns_btn .sns_icon a.insta {
                        background: url('/design/img/insta2.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info2 .sns_btn .sns_icon a.insta:hover {
                        background: url('/design/img/insta_hover2.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info2 .sns_btn .sns_icon a.blog {
                        background: url('/design/img/blog2.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info2 .sns_btn .sns_icon a.blog:hover {
                        background: url('/design/img/blog_hover2.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info2 .sns_btn .sns_icon a.ytubeico {
                        background: url('/design/img/youtube_ico.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info2 .sns_btn .sns_icon a.ytubeico:hover {
                        background: url('/design/img/youtube_ico_hover.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                    .h_info2 .sns_btn .sns_icon a.kakaoico {
                        background: url('/design/img/sns_kakao.png') center no-repeat;
                        background-size: cover
                    }
                    .h_info2 .sns_btn .sns_icon a.kakaoico:hover {
                        background: url('/design/img/sns_kakao_hover.png') center no-repeat;
                        background-size: cover;filter: invert(0%);
                    }
                </style>                    
                <div class="sns_icon">
                    <a class="facebook" href="https://www.facebook.com/NO.1ginvest" target="_blank"></a>
                    <a class="insta" href="https://www.instagram.com/ginvest.co.kr" target="_blank"></a>
                    <a class="blog" href="http://blog.naver.com/thefirstinvestment" target="_blank"></a>
                    <a class="ytubeico" href="https://www.youtube.com/channel/UC23yjWW1kxauMy-aYE-ZH5w" target="_blank"></a>
                    <a class="kakaoico" href="http://pf.kakao.com/_txaxoxaxb" target="_blank"></a>
                </div>
            </div>
        </div><!-- //h_info -->
        <div class="lnb_dep2" style="opacity: 0;"></div>
        </div>
        <div id="mobile_navi" class="boxScroll">
            <div>
                <div class="all_nav t_center">
                    <div class="m_navi">
                        <ul class="m_dep1">
                            <div class="j_box">
                                <a href="/join">회원가입</a>
                                <a href="/login">로그인</a>
                            </div>
                            @foreach(contain as $row)
                            <li>
                                <a href="">{{ $row['title'] }}</a>
                                <div>
                                    <ul class="m_dep2">
                                        @foreach ($row['sub'] as $row_sub)
                                        <li class="{{ $row_sub['url'] == '/'.Request::path() ? 'on':'' }}" >
                                            <a href="{{ $row_sub['url'] }}">{{ $row_sub['name'] }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            @endforeach   
                        </ul>
                    </div>
                </div>
                <div class="side_on_off">  
                    <div class="menu menu-3">
                        <span class="menu-item"></span>
                        <span class="menu-item"></span>
                        <span class="menu-item"></span>
                    </div>
                </div> 
            </div>
        </div>