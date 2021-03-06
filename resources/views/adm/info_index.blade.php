@extends('adm.layout.masterLayout')

@section('style')
    <!-- Tempusdominus Bootstrap 4 (datepicker) -->
    <link rel="stylesheet" href="/adm/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="/adm/plugins/toastr/toastr.min.css">
    
    <style>    
        .content {
            font-size:13px
        }
        .content input{
            font-size:13px
        }
        .content select {
            font-size:13px
        }
        .content textarea {
            font-size:13px
        }
        /* .chk_box_group {margin-top:-3px} */
        .chk_box_group input{
            display:none;
        }
        .content table {
            font-size:13px
        }
        .content table tbody tr td {
            vertical-align:middle;
        }
        .info_tab {cursor:pointer}
        .info_tab:hover {
            background-color:rgba(100, 104, 230, 0.8);
        }
    </style>
    <style>
        #footer_modify {
            border-top: 2px solid #26a1e0;
        }
        #footer_modify div{
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        #footer_modify .f_sc1 {
            background: #2f2f2f;
            padding: 55px 0;
        }
        #footer_modify .f_sc1 li {
            width: 33.3333%;
            float: left;
        }
        #footer_modify .f_sc1 li>div .fc_txt01 {
    font-size: 15px;
    color: #fff;
    letter-spacing: .1em;
    font-family: 'Open Sans',sans-serif;
    margin-bottom: 20px;
}
#footer_modify .f_sc1 li>div .fc_txt02 {
    font-size: 18px;
    color: #fff;
    letter-spacing: -.04em;
    margin-bottom: 15px;
}
#footer_modify .f_sc1 li>div .fc_txt03 {
    font-size: 13px;
    color: #b4b4b4;
    letter-spacing: -.04em;
    font-weight: 300;
}
        #footer_modify .cont {
            max-width: 1660px;
            margin: 0 auto;
        }
        #footer_modify ul, li { list-style:none }
        #footer_modify .f_sc1 li>div .fc_txt01 {
            font-size: 15px;
            color: #fff;
            letter-spacing: .1em;
            font-family: 'Open Sans',sans-serif;
            margin-bottom: 20px;
        }
        #footer_modify .f_sc1 li>div .fc_txt02 {
    font-size: 18px;
    color: #fff;
    letter-spacing: -.04em;
    margin-bottom: 15px;
}
#footer_modify .f_sc1 li>div .fc_txt03 {
    font-size: 13px;
    color: #b4b4b4;
    letter-spacing: -.04em;
    font-weight: 300;
}
        .f_before {
    padding-left: 40px;
    position: relative;
}
        
    </style>
    

@endsection

@section('title','???????????? ??????')

@section('body')


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->


<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h4>???????????? ??????</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($title == 'terms_use') active @endif" href="/admin/set?title=terms_use">
                        ???????????? ??????
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($title == 'privacy') active @endif" href="/admin/set?title=privacy">
                        ???????????????????????? ??????
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($title == 'footer') active @endif" href="/admin/set?title=footer">
                        ?????? ???????????? ??????
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Settings</a>
                </li> -->
            </ul>
        </div>
        <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            @if($title != 'footer')
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style="height:auto">
                <form action="{{ route('info.update') }}" method="post" id="terms_use_frm" onsubmit="return checkIt()">
                    <input type="hidden" name="title" value="{{ $title }}">
                    @csrf
                    <!-- 1 -->
                    <div class="row">
                        <textarea name='content' id='content' STYLE='width:100%; height:550px'>
                            {{ $info->content }}
                        </textarea>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary col-auto" >??????</button>
                    </div>
                </form>
            </div>
            @else
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style="height:auto">
                {{-- ?????? ???????????? ?????? --}}
                <div id="footer_modify">
                    <div class="f_sc1">
                        <div class="cont">
                            <ul>
                                <li>
                                    <div style="height: 118px;">
                                        <p class="fc_txt01">CUSTOMER CENTER</p>
                                        <p class="fc_txt02">????????? ???????????? ????????????&nbsp;&nbsp;<span class="blue_txt">1644.1870 /
                                                1544.8959</span>
                                        </p>
                                        <p class="fc_txt03">???????????? &nbsp;&nbsp;&nbsp;09:00 - 18:00</p>
                                        <p class="fc_txt03">???????????? &nbsp;&nbsp;&nbsp;11:30 - 13:00</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="f_before" style="height: 118px;">
                                        <p class="fc_txt01">BANK INFO</p>
                                        <p class="fc_txt02">?????? ????????????<span class="blue_txt">&nbsp;&nbsp; 421701-04-216870</span>
                                        </p>
                                        <p class="fc_txt03">?????????<br>????????????????????????</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="f_before" style="height: 118px;">
                                        <p class="fc_txt01">COMPANY INFO</p>
                                        <p class="fc_txt02">
                                            <span class="blue_txt">????????????????????????</span>
                                        </p>
                                        <p class="fc_txt03" style="font-size:15px">
                                            <span>?????? ????????? ???????????????1??? 168,????????????????????????B??? 209, 210, 1211, 1212???</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="f_sc2">
                        <div class="cont clr">
                            <h1>
                                <img src="/design/img/f_logo.png">
                            </h1>
                            <div class="copy_box">
                                <p class="copy01">
                                    <span style="color:#fff;">????????????????????????</span>
                                </p>
                                <p class="copy01">????????? : ?????????</p>
                                <p class="copy01">????????????????????? : 831-81-01343</p>
                                <p class="copy01">????????????????????? : ?????????</p>
                                <p class="copy01">?????? : 1644.1870</p>
                                <p class="copy01">?????? : 1544.8959</p>
                                <p class="copy01">Fax : 02.6929.1743</p>
                                <p class="copy01">E-mail : thefirstinvestment@naver.com</p>
                                <p class="copy02">????????? : ??????????????? ????????? ????????? 174, 10??? / COPYRIGHT ??? ?????????????????????. All rights reserved</p>
                                <p class="copy02">??? ??????????????? ???????????? ?????? ????????? ??????????????? ??????????????????, ????????? ????????? ?????? ?????? ????????? ??????????????? ????????????.</p>
                            </div>
                            <div class="goTop">
                                <a href="#"><img src="/design/img/go_top.jpg"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./content END -->
            </div>
            @endif
        </div>
        <!-- /.card -->
    </div>

    <!-- ?????? ?????? Modal -->
    <div class="modal fade" id="footer_info" tabindex="-1" role="dialog" aria-hidden="true" onsubmit="return checkIt('create')">
        <form name="footer_info" action="{{ route('popup.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">?????? ??????</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                         
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm float-left">??????</button>
                        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">??????</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- ./Modal -->

</section>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

@endsection


@section('script')
<!-- toastr -->
<script src="/adm/plugins/toastr/toastr.min.js"></script>
<!-- SmartEditor ?????? -->
<script type="text/javascript" src="/se2/js/HuskyEZCreator.js" charset="utf-8"></script>

@if(Session::has('message'))
<script>
    $(document).ready(function(){
        toastr.success("{{session('message')}}");
    });
</script>
@endif

<script type="text/javascript">
    var oEditors = [];
    var sLang = "ko_KR";	// ?????? (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR

    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "content",
        sSkinURI: "/se2/SmartEditor2Skin.html",	
        htParams : {
            bUseToolbar : true,				// ?????? ?????? ?????? (true:??????/ false:???????????? ??????)
            bUseVerticalResizer : true,		// ????????? ?????? ????????? ?????? ?????? (true:??????/ false:???????????? ??????)
            bUseModeChanger : true,			// ?????? ???(Editor | HTML | TEXT) ?????? ?????? (true:??????/ false:???????????? ??????)
            //bSkipXssFilter : true,		// client-side xss filter ?????? ?????? (true:???????????? ?????? / ??????:??????)
            //aAdditionalFontList : aAdditionalFontSet,		// ?????? ?????? ??????
            fOnBeforeUnload : function(){
                //alert("??????!");
            },
            I18N_LOCALE : sLang
        }, //boolean
        fOnAppLoad : function(){
            //?????? ??????
            // oEditors.getById["privacy_content"].exec("PASTE_HTML", []);
        },
        fCreator: "createSEditor2"
    });

    function checkIt(){
        if (confirm('?????? ???????????????????') == false) return false;
        // editor ??????
        oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);        
    }
</script>



@endsection