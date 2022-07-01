<?php
$this->table='userlist';
$this->column_prefix='';
$this->x_column_list_arr=
[
    'userlist_id'=>array('name'=>'아이디','type'=>'varchar','length'=>'14','pri'=>'PRI','width'=>'100'),
    // 'link_code'=>array('name'=>'연결코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'userlist_pwd'=>array('name'=>'패스워드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'userlist_grade'=>array('name'=>'사원등급','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'userlist_jtgub'=>array('name'=>'소속구분','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'userlist_sugub'=>array('name'=>'사원구분','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'userlist_yn'=>array('name'=>'허가여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'login_yn'=>array('name'=>'로그인여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'login_chksu'=>array('name'=>'실패횟수','type'=>'int','length'=>'','pri'=>'','width'=>'100'),

    // 'sawon_code'=>array('name'=>'사원코드','type'=>'varchar','length'=>'14','pri'=>'PRI','width'=>'100'),
    // 'jasa_code'=>array('name'=>'자사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'sawon_name'=>array('name'=>'사원성명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'sawon_hp'=>array('name'=>'사원전화','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'sawon_email'=>array('name'=>'사메일','type'=>'varchar','length'=>'320','pri'=>'','width'=>'100'),
    'sawon_addr'=>array('name'=>'사원주소','type'=>'varchar','length'=>'70','pri'=>'','width'=>'100'),
    'sawon_post'=>array('name'=>'사원우편','type'=>'varchar','length'=>'7','pri'=>'','width'=>'100'),
    'sawon_gig'=>array('name'=>'직책','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'sawon_bug'=>array('name'=>'부서','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'sawon_grade'=>array('name'=>'등급','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'sawon_jtgub'=>array('name'=>'소속구분','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'sawon_sugub'=>array('name'=>'GB사원구분','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'sawon_indate'=>array('name'=>'입사일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'sawon_enddate'=>array('name'=>'퇴사일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'sawon_gigday'=>array('name'=>'월결제일','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'sawon_gigtermday'=>array('name'=>'결제기간','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'sawon_id'=>array('name'=>'사원아이디','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'sawon_pwd'=>array('name'=>'사원패스워드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'sawon_bankname'=>array('name'=>'은행명칭','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'sawon_gejano'=>array('name'=>'계좌번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'sawon_yegumju'=>array('name'=>'예금주','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'sawon_bechadam'=>array('name'=>'배차담당자명','type'=>'varchar','length'=>'20','pri'=>'','width'=>'120'),
    'sawon_bechadamtel'=>array('name'=>'배차담당tel','type'=>'varchar','length'=>'20','pri'=>'','width'=>'120'),
];
$this->x_pri_col_arr=['userlist_id'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=[];
$this->is_tel_col_arr=['sawon_hp'];
$this->select_col_arr=[
    'userlist_grade'=>[
        ['text'=>'선택없음','value'=>''],
        ['text'=>'마스터','value'=>'M'],
        ['text'=>'일반','value'=>'A'],
        ['text'=>'일반2','value'=>'B']
    ],
    'userlist_yn'=>[
        ['text'=>'허용','value'=>'Y'],
        ['text'=>'미허용','value'=>'N'],
    ]
];
