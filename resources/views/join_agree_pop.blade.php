@extends('layout.masterLayout')

@section('style')

    <!-- 약관동의 -->
    <link rel="stylesheet" type="text/css" href="/src_css/farm_design_a_mobile.css" />
    <link rel="stylesheet" type="text/css" href="/src_css/farm_design_a_tablet.css" media="only all and (min-width:768px)"/>
    <link rel="stylesheet" type="text/css" href="/src_css/farm_design_a_pc.css" media="only all and (min-width:1024px)"/>
    <style>
        .h_info {display:none;}
        .header_bottom {display:none;}
        #footer {display:none;}

        .gray-box strong{ font-size: 16px; font-weight: 600; color: #222;}

        .farm-A-agree-box { height:auto }
            
    </style>
@endsection

@section('body')

<div class="cont">
	<div class="farm-A-agree-wrap sb">
		<div class="farm-A-agree">
			<h4 class="farm-A-title">이용약관</h4>
			<div class="farm-A-agree-box" style="height:400px">
				<div class="gray-box l" style="">
					@php $get_info = getInfo() @endphp
					@php echo $get_info['terms_use']['content'] @endphp
				</div>
			</div>
		</div>

		<div class="farm-A-agree">
			<h4 class="farm-A-title" >개인정보처리방침</h4>
			<div class="farm-A-agree-box" style="height:400px">
				<style>
					.pr_table th, td { border:1px solid #ccc; font-size:12px;text-align:center; padding:3px }
				</style>
				@php echo $get_info['privacy']['content'] @endphp
			</div>
		</div>
	</div>
</div>


@endsection

@section('script')

@endsection