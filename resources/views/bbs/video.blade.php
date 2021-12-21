@extends('layout.masterLayout')

@section('style')
    <script type="text/javascript" src="/js/modernizr.custom.media.query.js"></script>

    <!-- 게시판 css -->
    <link rel="stylesheet" type="text/css" href="/css/default_mobile.css" media="all">
    <link rel="stylesheet" type="text/css" href="/css/default_tablet.css" media="only all and (min-width:768px)">
    <link rel="stylesheet" type="text/css" href="/css/co-basic-simple.css" media="screen">
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/default_tablet.css" media="all"><![endif]-->
    <!--[if IE]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/ie.css" media="all"><![endif]-->
    <!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="/img_up/shop_pds/galaxygroup/design/ie7.css" media="all"><![endif]-->

    <style>
        /* 검색 */
        .bbs_search_wrap {width: 100%; margin:45px auto 20px;}
        .bbs_search_wrap:after {display:block; clear:both; content:'';}
        .bbs_search_wrap form {position:relative; float:right; padding: 0 50px 0 0;}
        .bbs_search_wrap input[type="text"] {height:50px; line-height:50px; box-sizing:border-box; width:350px; padding:.2em .5em; border:1px solid #dcdcdc;}
        .bbs_search_wrap button {position:absolute; right:0; bottom:0; border:0; background:url(/design/img/search_btn.png) center no-repeat; width:50px; height:50px; line-height:50px; color:#fff; border-radius:0; text-indent:-1000em; overflow:hidden;}
        
        /* 리스트 */
        .scbd .list_board {border-top:2px solid #646464;}
        .scbd .lst-board.lst-head li div {font-weight:400;}
        .scbd .lst-board.lst-body li {padding: 0;}
        .scbd .list_board .lst-board.lst-body li {display:table; width:100%;}
        .scbd .list_board .lst-board.lst-body li .td {padding:15px 10px; display:table-cell; vertical-align:middle;}
        .scbd .list_board .lst-board.lst-head li div {font-size:15px; color:#323232; background-color:#f8f8f8; padding:20px 10px;}

        .scbd .list_board .lst-board.lst-body li .col_no,
        .scbd .list_board .lst-board.lst-body li .col_subject a,
        .scbd .list_board .lst-board.lst-body li .inf {font-size:15px; color:#646464; font-weight:400;}
        .scbd .list_board .lst-board.lst-body li .col_subject a {text-align:left;}
        .scbd .list_board .lst-board.lst-body li .col_no {width: 8%; text-align:center;}
        .scbd .list_board .lst-board.lst-body li .col_hit {width: 7%;}
        .scbd .list_board .lst-board.lst-body li .col_date {width: 12%;}
        
        /* 페이지 */
        .scbd .paginate {text-align:left;}
        .scbd .paginate strong {background:#0197cf;color:#fff;border-color:#0197cf}
        
        /* 버튼 */
        .bbs_btn_wrap {text-align:right;margin-top:20px;}
        .bbs_btn_wrap a {display:inline-block; padding:15px 65px; color:#fff; background:#0197cf;border-radius:3px;font-size:18px;}
        .bbs_btn_wrap a.btn_cancel {background-color:#646464;}
        
        @media screen and (max-width:1020px){
            .bbs_search_wrap form {padding:0 35px 0 0;}
            .bbs_search_wrap input[type="text"],
            .bbs_search_wrap button {height:35px;line-height:35px;}
            .bbs_search_wrap button {width:35px; background-size:cover;}
            
            .scbd .list_board .lst-board.lst-head {display:none;}
            .scbd .list_board .lst-board.lst-body li {width:auto;}
            .scbd .list_board .lst-board.lst-body li .td {padding:10px;}
            .scbd .list_board .lst-board.lst-body li .inf,
            .scbd .list_board .lst-board.lst-body li .col_no,    
            .scbd .list_board .lst-board.lst-body li .col_subject a {font-size:13px;}
            .scbd .list_board .lst-board.lst-body li .inf {float:none; border-right:none;}
            .scbd .list_board .lst-board.lst-body li .col_hit {display: none;}
            .scbd .list_board .lst-board.lst-body li .col_date {font-size:11px;}
            
            .scbd .lst-board.lst-body.lay-notice li {background:#f8f8f8;}
            
            /* 버튼 */
            .bbs_btn_wrap a {font-size:14px; padding:10px 30px;}
        }
        
        @media screen and (max-width:767px){
            .bbs_search_wrap {width:auto;}
            .bbs_search_wrap input[type="text"] {width:200px;}
            
            .scbd .list_board .lst-board.lst-body li,
            .scbd .list_board .lst-board.lst-body li .td {display:block;}
            .scbd .list_board .lst-board.lst-body li {padding:10px;}
            .scbd .list_board .lst-board.lst-body li .td {padding:0;}
            .scbd .list_board .lst-board.lst-body li .col_hit,
            .scbd .list_board .lst-board.lst-body li .col_no {display:none;}
            .scbd .list_board .lst-board.lst-body li .col_date {width:auto;}
            .scbd .lst-board.lst-body.lay-notice li .col_subject a:before {display:inline;margin-right:5px;color:#ff5f00;font-weight:700; vertical-align:middle; content:'[공지]';}
            
            .scbd .paginate {text-align:center;}
            
            /* 버튼 */
            .bbs_btn_wrap {margin-top:10px;}
            .bbs_btn_wrap a {font-size:12px;}
        }
    </style>

<style>
  
  .sb_title_box { padding-bottom: 15px !important; margin-top:-80px !important;}
	.scbd .lst-photo {    text-align: center !important;}
	.video-popup.reveal {display: flex;position: fixed;top: 0;left: 0;right: 0;bottom: 0;justify-content: center;align-items: center;z-index:9}
	.video-popup .video-wrapper {position: relative;width: 80%;padding-bottom: 45%;z-index: 10}
	.video-popup .video-wrapper iframe {position: absolute;width: 100%;height: 100%;}
	.video-popup.reveal .video-popup-closer {position: fixed;top: 0;left: 0;right: 0;bottom: 0;background: rgba(0, 0, 0, .5);z-index: 9}
	/*
  .thum {margin:.5em 10px .5em 0;overflow:hidden;border:0px solid #ccc;}
	.thum img { margin:-5% -0px -11% 0px;}
	*/
  	.img {height:255px; position:relative}
    .img img { position: absolute;clip: rect( 36px, 480px, 305px, 0px );}
   
	#loading {width: 100%;  height: 100%;  top: 0px;left: 0px;position: fixed;  display: block;  opacity: 0.7;  background-color: #fff;  z-index: 99; text-align: center; } 
	#loading-image {  position: absolute;  top: 50%;  left: 50%; z-index: 100; }
	.ytimg { width: 390px; height:285px }
	li.ytimg { margin-top: -30px !important }
	.scbd .lst-photo { padding: 1em 0 8em 0 !important }
  .scbd .lst-photo li .thum{    margin-bottom: 1em;}
  
	@media all and (max-width:480px) {
       .sb_title_box { padding-bottom: 40px !important; margin:0 !important;}
		.img {height:315px; position:relative;margin-bottom:-45px}
		.img img { position: absolute;clip: rect( 50px, 420px, 260px, 0px );}
		.ytimg { width: 420px; height:315px }
	}
	@media all and (max-width:400px) {
		.img {height:255px; position:relative;margin-bottom:-45px}
		.img img { position: absolute;clip: rect( 50px, 340px, 215px, 0px );}
		.ytimg { width: 340px; height:255px }
	}
</style>
@endsection

@section('body')

<div id="scbd" class="scbd co-basic-simple">
	<!-- category and board list -->

	
	
	<!-- // category and board list -->



	<!-- Notice -->
	<ul class="lst-board lst-body lay-notice">
			</ul>
	<!-- // Notice -->

	<!-- List(photo) -->
	<ul id="lst-photo" class="lst-photo">
	</ul>
	<div class="video-popup">
        <div class="video-popup-closer"></div>
    </div>
    <div id="loading">
		<img src="/design/img/loading.gif" id="loading-image">
	 </div>
	

	<script>
	jQuery(function($){
		var
			heights = new Array()
			,li = $('#lst-photo>li')
		;

		function autoPhotoSize(){
			if(Modernizr.mq('only all and (max-width:140px)')==true){
				li.each(function(n){
					$(this).css('width','auto');
					$(this).css('height','auto');
					$(this).find('.img').css('height','auto');
				});
			}else{
				li.each(function(n){
					$(this).css('width',100);
					$(this).find('.img').css('height',100);
					heights.push($(this).height());
				});
				var maxHeight = Math.max.apply(0,heights);
				li.height(maxHeight);
			}
		}

		autoPhotoSize();

		$(window).resize(function(){
			autoPhotoSize();
		})
	});
	</script>
	<!-- // List(photo) -->
	<!--YOUTUBE START-->
   <script>
		var nextPageToken="";
		var timer;
       var id_Val="";
       var videoId ="";
		var page = 0;
 
		$(document).ready(function() {
			$('html, body').scrollTop(0);
			$("#lst-photo").empty();
			$("#loading").css("display","none");
			getVids();
			$(".video-popup-closer").click(function() {
				$(".video-popup .video-wrapper").remove(),
				$(".video-popup").removeClass("reveal")
			});
		});
     
     function paginator(items, current_page, per_page_items) {
			let page = current_page || 1,
			per_page = per_page_items || 10,
			offset = (page - 1) * per_page,

			paginatedItems = items.slice(offset).slice(0, per_page_items),
			total_pages = Math.ceil(items.length / per_page);

			return {
				page: page,
				per_page: per_page,
				pre_page: page - 1 ? page - 1 : null,
				next_page: (total_pages > page) ? page + 1 : null,
				total: items.length,
				total_pages: total_pages,
				data: paginatedItems
			};
		}
 		
		function getVids(PageToken){
			page ++;
			var admin_chk = "0";
          	id_Val = "{{ auth()->check()? 'ok' : '' }}";
			$.ajax({
				type:'POST',
				url:'https://yt.invest.kr/api/export_youtube.php',
				cache:false,
				anync:false,
				data:{BranchCode:'hq'},
				dataType:'JSON',
				success:function(data){
					var pageData = paginator(data, page, 12); 
					for(i=0; i < pageData.data.length; i++){
						if(id_Val ||  admin_chk == 1){
							var videoId = pageData.data[i].videoUrl;  
						}else { 
							var videoId = "Nomember_";  
							//var videoId = "Nomember";  로그인시 볼 수 있게 하려면 'Nomember' 로 교체
						}
						var new_li = "<li class='ytimg'><a href=javascript:show_modal("+"'"+videoId+"'"+"); id='myBtn'><div class='thum'><span class='img'><img src="+pageData.data[i].thumbnails+"></span></div><div class='title' style='font-size:1.2em;'><strong>"+pageData.data[i].title+"</strong></div><div class='name'></div></a></li>";
						$("#lst-photo").append(new_li);
					}
				}
			});   
		 }
	
		
		
		$(window).scroll(function() {
			var height = $(document).height();
			var height_win = $(window).height() + 250;
			var scrolltop = $(document).scrollTop();
			if (height <= (height_win + scrolltop)) {
                $("#loading").css("display","block");
				if ( timer ) clearTimeout(timer);
				timer = setTimeout(function(){
					getVids();	
					$("#loading").css("display","none");
				}, 800);
			}
			  
		});
		
		function show_modal(val_id){
          if(val_id == "Nomember"){
				alert("본 동영상은 로그인을 해야만 시청 가능합니다.");
				return;
			}
			$(".video-popup").addClass("reveal");
			$(".video-popup .video-wrapper").remove();
          /*
          var video_iframe = `
				<div class='video-wrapper'>
					<iframe width='560' height='315' src='https://youtube.com/embed/`+ val_id +`?rel=0&playsinline=1&autoplay=1' allow='autoplay; encrypted-media' allowfullscreen></iframe>
				</div>
			`;*/
          var video_iframe = "<div class='video-wrapper'><iframe width='560' height='315' src='https://youtube.com/embed/"+ val_id +"?rel=0&playsinline=1&autoplay=1' allow='autoplay; encrypted-media' allowfullscreen></iframe></div>";
			$(".video-popup").append(video_iframe);
		}
       
	</script>
   <!--YOUTUBE END-->


</div></div>    </div>

@endsection

@section('script')


<script type="text/javascript">
// var tmp_chk2=0;

// function div2_move_chk(){
// 	if(!tmp_chk2){
// 		tmp_div2.style.top = tmp_div2.offsetTop-230;
// 		tmp_chk2 = 1;
// 	}
// }


function writeArticle(){
			location.href="/bbs/review/write";
	}
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