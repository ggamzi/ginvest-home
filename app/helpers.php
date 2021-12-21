<?php

use App\Models\sidebarMain;
use App\Models\sidebarSub;

/**
 *  Datatable 옵션
 */
const datatable_lang = '{"emptyTable": "데이터가 없습니다.","lengthMenu": "페이지당 _MENU_ 개씩 보기","info": "현재 _START_ - _END_ / _TOTAL_건","infoEmpty": "데이터 없음","infoFiltered": "","search": "검색: ","zeroRecords": "일치하는 데이터가 없습니다.","loadingRecords": "로딩중...","processing": "잠시만 기다려 주세요...","paginate": {"next": "다음","previous": "이전"}}';

/**
 *  메뉴 리스트
 *  title   : 상단 메뉴명
 *  sub     : 하위 메뉴
 */
function getSidebar() {
    $data['sub'] = DB::table('sidebar_sub')->where('is_use','Y')->get();
    $data['main']  = DB::table('sidebar_main')->get();
    return $data;
}

function getMSidebar() {
    return DB::table('sidebar_main')->get();
}

/**
 *  $data[ip] ACL 목록
 */
function getAcl() {
    $res = DB::table('acl')->get();
    $black_res = DB::table('black_list')->get();
    $data = array();

    foreach ($res as $row) {
        $data[$row->ip] = $row->name;
    }
    foreach ($black_res as $row_black) {
        $data[$row_black->ip] = "블랙리스트";
    }
    return $data;
}

/**
 *  개인정보 처리방침/이용약관
 */
function getInfo() {
    $res = DB::table('company_info')->get();

    foreach ($res as $row) {
        $data[$row->title] = ['content'=>$row->content, 'name'=>$row->desc ];
    }

    return $data;
}
