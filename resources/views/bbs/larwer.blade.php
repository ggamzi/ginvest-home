@extends('layout.masterLayout')

@section('style')

    <!-- 게시판 css -->
    <link rel="stylesheet" type="text/css" href="/css/default_mobile.css" media="all">
    <link rel="stylesheet" type="text/css" href="/css/default_tablet.css" media="only all and (min-width:768px)">
    <link rel="stylesheet" type="text/css" href="/css/co-basic-simple.css" media="screen">
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/default_tablet.css" media="all"><![endif]-->
    <!--[if IE]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/ie.css" media="all"><![endif]-->
    <!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/ie7.css" media="all"><![endif]-->

	<style>
		.lst-web dt {
			float: left;
			margin-right: .5em;
			margin-bottom: .3em;
			/*overflow: hidden;*/
		}
		.lst-web dt img{ border:1px solid #ccc}
		.press_list dl { /*margin:10px*/ }
		.press_list dt { width: 102px; margin:35px }

		.press_txt02 { display:none}

		.submit { cursor:pointer }

		#container01 .sb5 .press_list li>dl>dd>div a p {
			font-size: 25px;
			color: #323232;
			letter-spacing: -.04em;
			padding-bottom: 3px;
			font-weight: 500;
		}
		#container01 .sb5 .press_list li>dl>dd>div .press_txt02 {
			display: inline-block;
			font-size: 12px;
			color: #646464;
			letter-spacing: 0;
			font-weight: 300;
		}
		#container01 .sb5 .press_list li>dl>dd>div {
			padding: 42px 40px;
			position: relative;
			border-bottom: 1px solid #e5e5e5;
		}
		.serch_fom_box input[type="text"] {
			padding-left:5px;
		}
		.paginate{
			text-align: left;
			margin: 0;
    		padding: 1em 0;
			font: inherit;
    		vertical-align: baseline;
		}
		.paginate a {
			display: inline-block;
			width: 36px;
			height: 36px;
			line-height: 36px;
			vertical-align: middle;
			font-size: .875em;
			font-family: Arial,sans-serif;
			font-weight: normal;
			margin: 0 0.2em;
			text-align: center;
		}
		.paginate a:link { color:black }
		.paginate a:visited { color:black }
		.paginate strong {
			background:#0197cf;
			color:#fff;
			border-color:#0197cf;
			display: inline-block;
			width: 36px;
			height: 36px;
			line-height: 36px;
			vertical-align: middle;
			font-size: .875em;
			font-family: Arial,sans-serif;
			font-weight: normal;
			margin: 0 0.2em;
			text-align: center;
		}
		.noneLst .empty {
			display: block!important;
			padding: 2em 0!important;
			width: auto!important;
			float: none!important;
			font-size: .875em;
			text-align: center;
			border-bottom: 1px solid #ccc;
		}
		@media screen and (max-width: 1024px){
			#container01 .sb5 .press_list li>dl>dd>div a p {
					font-size: 20px;
			}
			#container01 .sb5 .press_list li>dl>dd>div {
					padding: 42px 20px;
			}
		}
		@media screen and (max-width: 768px){
			#container01 .sb5 .press_list li>dl>dd>div a p {
					font-size: 18px;
			}
			.press_list dt { width:102px; margin:15px }
			#container01 .sb5 .press_list li>dl>dd>div {
					padding: 30px;
			}
			.paginate {text-align:center;}
		}
		@media screen and (max-width: 680px){
			#container01 .sb5 .press_list li>dl>dd>div a p {
					font-size: 18px;
			}
			.press_list dt { width:150px; }
			#container01 .sb5 .press_list li>dl>dd>div {
					padding: 12px;
			}
			#container01 .sb5 .press_list .link_ad { display:none !important }
			.press_list dt {
					width:100px  !important;
					margin:5px
			}
		}
		@media screen and (max-width: 480px){
			#container01 .sb5 .press_list li>dl>dd>div a p {
					font-size: 15px;
					max-width: 400px;
					overflow: hidden;
					white-space: nowrap;
					text-overflow: ellipsis;
					display: block;
					/*width: 100%;*/
			}
			#container01 .sb5 .press_list li>dl>dd>div {
					padding: 20px 10px;
			}
			#container01 .sb5 .press_list .link_ad { display:none !important }
			.press_list dt {
					width:100px  !important;
			}
		}
	</style>

@endsection

@section('body')
<div class="cont">
	<div class="sb5 sb">
		<div class="sb_title_box">
			<h6 class="sb_title">변호사공증수익률</h6>
			<span>갤럭시투자그룹의 수익률정보를 한 눈에 확인하세요.</span>
		</div>
		<div class="sc1">
			<div class="serch_fom_box">
				<form method='get' style='margin:0'>
					<select name="keyfield">
						<option value="s_v1">제목</option>
					</select>
					<input type="text" name="search_key" class="search_key" value="{{ isset($search_key) ? $search_key : '' }}">
					<input type="submit" class="submit" value="검색">
				</form>
			</div>
		
			<div class="press_list">
				<ul id="lst-web" class="lst-web lst-board lst-body">
					@if(!$board_list)
						<ul class="noneLst">
							<li class="empty">등록된 게시글이 없습니다.</li>
						</ul>
					@else
						@foreach($board_list as $row)
						<li>
							<dl class="clr">
								@if($row->thumbnail != NULL)
									<dt>
										<img src="/larwer/{{ $row->thumbnail }}">
									</dt>
								@endif
								<dd>     
									<div>
										<a href="/bbs/larwer/{{ $row->id }}/info">
											<p class="press_txt01">{{ $row->title }}</p>
										</a>
										<div class="writer_box"></div>
									</div>
								</dd>
							</dl>                
						</li>
						@endforeach
					@endif
				</ul>
			</div>

			{{ $board_list->links('vendor.pagination.default') }}
		</div>
	</div>
</div>


@endsection

@section('script')


<script type="text/javascript">


// function readArticle(idx){

// 			location.href="/bbs_shop/read.htm?me_popup=0&auto_frame=&cate_sub_idx=0&search_first_subject=&list_mode=board&board_code=review&search_key=&key=&page=1&y=&m=&idx="+idx;
// 	}
// function reply_readArticle(idx){
// 			alert("본 게시판은  회원만 답변글을 읽을수 있습니다.\n\n회원 등급문의는 운영자에게 문의하시기 바랍니다.");
// 	}

// function no_write(){
// 	alert("본 게시판은 회원 전용 게시판입니다.\n\n로그인하신후 다시 이용하시기 바랍니다.");
// }


//게시글 출력에 필요한 함수
function ToggleAll1(){

	var i =0;
	while(i < document.board_form.elements.length){
		if(document.board_form.elements[i].name=='idx_chk[]'){
			if(document.board_form.elements[i].checked == true){
				document.board_form.elements[i].checked = false;
			}else{
				document.board_form.elements[i].checked = true;
			}
		}
		i++;
	}
}

function mem_secret_no_read(){
			alert("본 게시글은 [비밀글]로 설정되어 있으므로 볼수 없습니다.\n\n비밀글은 작성자만 볼 수 있습니다.");
	}

function secret_no_read2(idx){
	secret_read2(idx);
	//alert("본 게시글은 [회원 전용 비밀글]로 설정되어 있습니다.\n\n [회원 전용 비밀글]은 관리자 또는 작성자만 볼수 있습니다.");
}

function secret_read2(idx){
			var secret_read2_win = window.open('/bbs_shop/popup/pwd_chk_form.htm?pwd_mode=board_secret&me_popup=0&auto_frame=&cate_sub_idx=0&search_first_subject=&list_mode=board&board_code=review&search_key=&key=&page=1&idx='+idx,'secret_read2_win','top=150,left=300,width=330,height=200,scrollbars=no');
		secret_read2_win.focus();
	}

function tmp_div2_close(){
	tmp_div2.style.display = 'none';
}
</script>
@endsection