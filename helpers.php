<?php

function sayHello() {
	return 'Hello, World!';
}

function getContain() {

}

/**
 *  메뉴 리스트
 *  title   : 상단 메뉴명
 *  sub     : 하위 메뉴
 */
const contain = [
    [
        "title"=>"회사소개",
        "sub"=>[
            ["name"=>"미션과 비젼", "url"=>"/page/sb1_1"],
            ["name"=>"전문가 소개", "url"=>"/page/sb1_2"]
        ]
    ],
    [
        "title"=>"투자철학",
        "sub"=>[
            ["name"=>"투자철학", "url"=>"/page/sb2_1"],
            ["name"=>"투자 프로세스", "url"=>"/page/sb2_2"]
        ]
    ],
    [
        "title"=>"서비스",
        "sub"=>[
            ["name"=>"갤럭시투자 A형","url"=>"/page/sb3_1"],
            ["name"=>"갤럭시투자 B형","url"=>"/page/sb3_2"],
            ["name"=>"갤럭시투자 C형","url"=>"/page/sb3_3"],
            ["name"=>"고액투자자형","url"=>"/page/sb3_4"]
        ]
    ],
    [
        "title"=>"이용후기",
        "sub"=>[
            ["name"=>"고객 감사 포토후기", "url"=>"/bbs/photo"],
            ["name"=>"고객 감사 후기", "url"=>"/bbs/review"],
            ["name"=>"프리미엄영상", "url"=>"/bbs/video"],
        ]
    ],
    [
        "title"=>"공증수익률",
        "sub"=>[
            ["name"=>"변호사공증수익률", "url"=>"/myboard/su"],
            ["name"=>"언론보도", "url"=>"/myboard/sb5"]
        ]
    ]
];
