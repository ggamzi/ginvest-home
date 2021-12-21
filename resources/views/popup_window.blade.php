<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
    <head>
        <title>갤럭시투자그룹</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="imagetoolbar" content="no">
        <script type="text/javascript" src="/js/all_default.js"></script> <!-- 스크립 호출 순서 주의 -->
        <script type="text/javascript">
            var ios_yn = false;
            var APP_CONN_YN = false;
            var app_version_code = 0;

            var isKitkat = window.navigator.userAgent.search( "AnybuildApp Android 4.4") > -1 ? true : false;
        </script>
        <script type="text/javascript">

            function setCookie( name, value, expiredays )
            {
                var todayDate = new Date();
                todayDate.setDate( todayDate.getDate() + expiredays );
                document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
            }

            function no_day1(){
                setCookie( "popup_{{$pop_info->id}}", "done" , 1);
                parent.popup_{{$pop_info->id}}.style.display='none';
            }
            function no_day(){
                location.href="/popup_window/{{$pop_info->id}}/set"
            }
            // 팝업 닫기
            function win_close(){
                parent.popup_{{$pop_info->id}}.style.display='none';
            }
        </script>
        <style type="text/css">html { overflow:hidden;  }</style>
    </head>

    <body style="margin:0;">
        <div style="display:none">
            <iframe src="" width="0" height="0" frameborder="0" name="ok_frame" id="ok_frame"></iframe>
        </div>
        <div class="popup_content">
            <a href="{{ $pop_info->link }}" target="_blank">
            <img align="top" alt="" border="0" src="/popup/{{ $pop_info->img }}" style="width:100%; display:block" title=""> </a>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                <tbody>
                    <tr>
                        <td bgcolor="#000000" style="padding:3px"><input type="checkbox" name="no_day_chk" id="win_pop_no_day_chk" onclick="no_day()" value="1"><font size="2" color="#eeeeee"><label for="win_pop_no_day_chk">오늘하루 열지 않기</label></font></td>
                        <td bgcolor="#000000" style="padding:3px" align="right"><a href="javascript:win_close()"><font size="2" color="#eeeeee">닫기</font></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>