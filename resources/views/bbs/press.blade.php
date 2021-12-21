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
			overflow: hidden;
		}
		.press_list dl { margin:10px }
		.press_list dt { width:210px; }
		@media screen and (max-width: 480px){
			.press_list dt {
					width:100px !important;
			}
		}
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
			padding: 32px 40px;
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
			color:black;
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
			padding: 32px 20px;
	}
}
@media screen and (max-width: 768px){
	#container01 .sb5 .press_list li>dl>dd>div a p {
			font-size: 18px;
	}
	.press_list dt { width:150px; }
	#container01 .sb5 .press_list li>dl>dd>div {
			padding: 20px;
	}
}
@media screen and (max-width: 680px){
	#container01 .sb5 .press_list li>dl>dd>div a p {
			font-size: 18px;
	}
	.press_list dt { width:150px; }
	#container01 .sb5 .press_list li>dl>dd>div {
			padding: 2px;
	}
	#container01 .sb5 .press_list .link_ad { display:none !important }
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
			padding: 10px 10px;
	}
	#container01 .sb5 .press_list .link_ad { display:none !important }
}
	</style>
@endsection

@section('body')
<div class="cont">
	<div class="sb5 sb">
		<div class="sb_title_box">
			<h6 class="sb_title">Press</h6>
			<span>갤럭시투자그룹의 정보를 한 눈에 확인하세요.</span>
		</div>
		<div class="sc1">
			<div class="serch_fom_box">
				<form method='get' style='margin:0'>
					<select name="keyfield">
						<option value="s_v1">제목</option>
					</select>
					<input type="text" name="search_key" value="{{ isset($search_key) ? $search_key : '' }}">
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
							@php
								$option = explode('$$$',$row->option);
							@endphp
							<li>
								<dl class="clr">
									<dt>								
									<img src="/press/{{ $row->thumbnail }}">
									</dt>
									<dd>          
										<div>
											<a href="/bbs/press/{{ $row->id }}/info">
												<p class="press_txt01">{{ $row->title }}</p>
											</a>
											<span class="press_txt02">{{ $option[0] }}</span>
											<span class="press_txt02">{{ $option[1] }}</span>
											<span class="press_txt02 link_ad">{{ $option[2] }}</span>
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


</script>
@endsection