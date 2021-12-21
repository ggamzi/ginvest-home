<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use App\Mail\AmazonSes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();



Route::middleware('vistor.cnt')->group(function(){  // 방문자수 count up
    /**
     *  메인페이지
     */
    Route::get('/',  [PageController::class, 'mainIndex']);
    Route::get('/popup_window/{id}',  [PageController::class, 'popupWindow']);  // 메인화면 팝업
    Route::get('/popup_window/{id}/set',  [PageController::class, 'popupWindowCookieSet']);  // 팝업 관련 cookie
    Route::get('/join_agree_pop',  function () { return view('join_agree_pop'); });

    // 마이페이지
    Route::get('/mypage', [PageController::class, 'mypageIndex'])->middleware('auth');
    Route::post('/mypage-update', [UserController::class, 'mypageUpdate'])->name('mypage.update');         // 마이페이지 -> 수정 쿼리
    Route::post('/mypage-delete', [UserController::class, 'delete'])->name('mypage.delete');         // 마이페이지 -> 수정 쿼리

    // 비밀번호 변경 메일보내기
    Route::get('/password-change', function () { return view('mails.pwd-change'); });

    /**
     *  아이디/비밀번호 찾기
     */
    Route::group(['prefix' => 'member-search'], function (){
        Route::get('/',  function () { return view('mem-serach'); });   // 팝업
        Route::get('/account', [UserController::class, 'searchAccount'])->name('search.account');   //아이디 찾기
        Route::get('/password', [UserController::class, 'searchPwd'])->name('search.pwd');   //아이디 찾기
    });

    /**
     *  회원가입
     */
    Route::group(['prefix' => 'join'], function (){
        Route::get('/',  [PageController::class, 'joinIndex'])->name('join');                   // 회원가입
        Route::get('/dup_chk', [UserController::class, 'dupChk']);                              // ID, 닉네임 중복 체크
        Route::post('/create', [UserController::class, 'create'])->name('join.create');         // 생성 쿼리
        Route::get('/agree', function () { return view('join_agree', ['s_title'=>'회원가입']); }); // 약관동의
    });

    /**
     *  VIP 무료체험신청
     */
    Route::post('/exper/create', [PageController::class, 'experCreate']);  // 체험회원 신청


    /**
     *  상단 메뉴 (회사소개, 투자철학, 서비스)
     */
    Route::group(['prefix' => 'page'], function (){
        // 회사소개
        Route::get('/sb1_1',  function () { return view('page/sb1_1',['m_title'=>'회사소개','s_title'=>'미션과 비전']); });
        Route::get('/sb1_2',  function () { return view('page/sb1_2',['m_title'=>'회사소개','s_title'=>'전문가 소개']); });

        // 투자철학
        Route::get('/sb2_1',  function () { return view('page/sb2_1',['m_title'=>'투자철학','s_title'=>'투자철학']); });
        Route::get('/sb2_2',  function () { return view('page/sb2_2',['m_title'=>'투자철학','s_title'=>'투자 프로세스']); });

        // 서비스
        Route::get('/sb3_1',  function () { return view('page/sb3_1',['m_title'=>'서비스','s_title'=>'갤럭시투자 A형']); });
        Route::get('/sb3_2',  function () { return view('page/sb3_2',['m_title'=>'서비스','s_title'=>'갤럭시투자 B형']); });
        Route::get('/sb3_3',  function () { return view('page/sb3_3',['m_title'=>'서비스','s_title'=>'갤럭시투자 C형']); });
        Route::get('/sb3_4',  function () { return view('page/sb3_4',['m_title'=>'서비스','s_title'=>'고액투자자형']); });
    });


    /**
     *  게시판
     */
    Route::group(['prefix' => 'bbs'], function (){
        Route::get('/{board}', [PageController::class, 'listIndex']);               // 게시글 리스트
        Route::get('/{board}/{id}/info', [PageController::class, 'boardView']);     // 게시글 보기

        Route::middleware('auth')->group(function(){    // 게시글 작성시 로그인 체크
            // 게시글 작성 관련
            Route::get('/{board}/write', [AdminController::class, 'bbsWirteForm']);            // 게시글 작성 페이지 (고객들이 작성하는 페이지임)
            Route::post('/create', [AdminController::class, 'boardCreate']);                   // 게시글 생성
        });
    });
});





  //////////////////////////
 //  관리자 페이지 START  //
//////////////////////////
Route::middleware('accessip.chk')->group(function(){    // 관리자 페이지 허용 ip 체크, 로그인 되어 있는 경우 관리자 계정인지 체크
    Route::get('/admin/login',  [AdminController::class, 'loginIndex']);              // 로그인 페이지
    Route::post('/login-start', [AdminController::class, 'login'])->name('admin.login');        // 로그인 시도

    Route::middleware('admin.chk')->group(function(){   // 로그인 되어있지 않는 경우 로그인 페이지로 redirect
        Route::group(['prefix' => 'admin'], function (){
            Route::get('/',  [AdminController::class, 'adminIndex']);                               // 관리자페이지 메인
            Route::post('/logout',  [AdminController::class, 'logout'])->name('admin.logout');      // 관리자페이지 로그아웃
            Route::get('/get-info',  [AdminController::class, 'adminGetInfo']);                     // 메인페이지의 필요한 정보 수집
            Route::post('/get-info/post-agree',  [AdminController::class, 'adminPostAgree']);       // 메인페이지의 필요한 정보 수집
            Route::get('/get-new-event',  [AdminController::class, 'getNewEvent'])->name('new.event');          // 메뉴 상단에 이벤트 알림창
            
            /**
             *  회원관리 (회원관리, 체험회원 관리)
             *  ※ UserController 사용
             */
            Route::group(['prefix' => 'user'], function (){
                // 회원 관리
                Route::get('/', [UserController::class, 'userIndex']);         
                Route::get('/get-log', [UserController::class, 'getLog'])->name('user.log');      // 회원별 LOG(ajax & datatable)
                Route::get('/get-info', [UserController::class, 'getUserInfo'])->name('user.info'); // 회원 정보 modal (ajax)
                Route::post('/get-update', [UserController::class, 'userUpdate'])->name('user.update'); // 회원 정보 수정 (ajax)
                Route::get('/user-delete', [UserController::class, 'userDelete'])->name('user.del'); // 회원 탈퇴
                
                // 체험회원 관리
                Route::get('/experience', [UserController::class, 'experienceIndex']);         // 체험회원 관리 메인
                Route::get('/experience-delete', [UserController::class, 'experienceDelete'])->name('exper.delete');         // 체험회원 삭제
            });
            
            /**
             *  게시판 관리 (게시글 관리, 게시판 관리)
             */
            Route::group(['prefix' => 'bbs_manage'], function (){ 
                //게시글 관리
                Route::get('/', [AdminController::class, 'bbsManage']);               // 게시글 리스트
                Route::get('/{id}/edit', [AdminController::class, 'postEdit']);      // 게시글 수정페이지
                Route::put('/update', [AdminController::class, 'postUpdate']);       // 게시글 수정 쿼리
                Route::get('/write', [AdminController::class, 'postwrite']);         // 게시글 작성 페이지
                Route::get('/delete', [AdminController::class, 'postDelete'])->name('post.delete');         // 게시글 삭제
                Route::get('/thumb-delete', [AdminController::class, 'postThumbDelete'])->name('post.thumb.delete');         // 게시글 삭제

                //게시판 관리
                Route::group(['prefix' => 'board'], function (){
                    Route::get('/', [AdminController::class, 'boardIndex']);               // 게시판 리스트
                    Route::get('/info', [AdminController::class, 'boardInfo'])->name('board.info');     // 게시판 정보 모달 (ajax)
                    Route::post('/update', [AdminController::class, 'boardUpdate'])->name('board.update');     // 게시판 정보 수정
                });
            });

            /**
             *  기본 정보 관리 (기본정보 설정, 팝업설정, 로그)
             */
            Route::group(['prefix' => 'set'], function (){ 
                // 기본정보 설정
                Route::get('/', [AdminController::class, 'infoIndex']);             
                Route::post('/info-update', [AdminController::class, 'infoUpdate'])->name('info.update');   // 기본정보 모달 수정

                // 팝업관리
                Route::group(['prefix' => 'popup'], function (){ 
                    Route::get('/', [AdminController::class, 'popupIndex'])->name('popup');             // 팝업 설정
                    Route::post('/store', [AdminController::class, 'popupStore'])->name('popup.store'); // 팝업 생성 (store->create로 바꿀 것)
                    Route::get('/info', [AdminController::class, 'popupInfo'])->name('popup.info');     // 팝업 정보모달(ajax)
                    Route::put('/update', [AdminController::class, 'popupUpdate'])->name('popup.update');     // 팝업 정보 수정
                    Route::get('/delete', [AdminController::class, 'popupDelete'])->name('popup.delete');     // 팝업 삭제
                    Route::get('/order-update', [AdminController::class, 'popupOrderUpdate'])->name('popup.order.update');     // 팝업 정보 수정               
                });

                // 로그
                Route::get('/log', [AdminController::class, 'logIndex']);
            });

            /**
             *  관리자 페이지 관리
             */
            Route::group(['prefix' => 'adm-set'], function (){ 
                // 관리자페이지 접속 ip 관리페이지
                Route::get('/acl', function () { return view('adm/acl'); })->name('acl');             // 메인페이지
                Route::get('/acl-list', [AdminController::class, 'getAcl'])->name('acl.list');             // 리스트 (ajax)
                Route::post('/acl-create', [AdminController::class, 'aclCreate'])->name('acl.create');      // 생성 (ajax)
                Route::post('/acl-update', [AdminController::class, 'aclUpdate'])->name('acl.update');      // 수정 (ajax)
                Route::post('/acl-delete', [AdminController::class, 'aclDelete'])->name('acl.delete');      // 삭제 (ajax)

                // 관리자 계정 관리
                Route::get('/member', [UserController::class, 'memberIndex']);             // 관리자 계정 리스트 (정보 수정은 회원관리와 동일한 함수 사용)
            });
        });
    });
});

// 게시물 작성 (회원 작성시 사용)
Route::group(['prefix' => 'post'], function (){
    Route::post('/create', [AdminController::class, 'postCreate'])->name('post.create');            // 이용후기
});


Auth::routes();


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
