<?php
$this->menu=[
    'head'=>[
        'recruit'=>['name'=>'모집인','url'=>'','msg'=>''],
        'chazu'=>['name'=>'모집차주','url'=>'','msg'=>''],
        'trade'=>['name'=>'정산','url'=>'','msg'=>''],
        //'community'=>['name'=>'커뮤니티','url'=>'javascript:','msg'=>'']
    ],
    'sub'=>[
        'member_list'=>['name'=>'모집인관리','head'=>'recruit','url'=>ROOT_DIR.'recruit/recruit/member/list','msg'=>'','list_sort'=>'Recruit/Member/list'],
        'member_write'=>['name'=>'모집인등록','head'=>'','url'=>ROOT_DIR.'recruit/recruit/member/popup/write','msg'=>'','list_sort'=>'Recruit/Member/write'],

        'chazu_list'=>['name'=>'모집차주관리','head'=>'chazu','url'=>ROOT_DIR.'recruit/chazu/chazu/list','msg'=>'','list_sort'=>'Recruit/Chazu/list'],
    ]
];
