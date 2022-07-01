<?php
$this->table='achazu';
$this->x_column_list_arr=
[
    // 'chazu_code'=>array('name'=>'차주코드','type'=>'varchar','length'=>'14','pri'=>'PRI','width'=>'100'),
    // 'link_code'=>array('name'=>'연결코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'push_btn_col'=>array('name'=>'푸시','type'=>'varchar','length'=>'30','pri'=>'','width'=>'70'),
    // 'file_btn_col'=>array('name'=>'서류','type'=>'varchar','length'=>'30','pri'=>'','width'=>'70'),
    'chazu_name'=>array('name'=>'차주성명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_carno'=>array('name'=>'차량번호','type'=>'varchar','length'=>'12','pri'=>'','width'=>'120'),
    // 'chazu_simpleno'=>array('name'=>'약식차번','type'=>'varchar','length'=>'4','pri'=>'','width'=>'100'),
    'chazu_hp'=>array('name'=>'휴대전화','type'=>'varchar','length'=>'15','pri'=>'','width'=>'120'),
    'chazu_id'=>array('name'=>'차주ID','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'chazu_cartype'=>array('name'=>'차종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'80'),
    'chazu_carton'=>array('name'=>'톤수','type'=>'double','length'=>'','pri'=>'','width'=>'70'),

    'is_login_agree'=>array('name'=>'로그인허용','type'=>'varchar','length'=>'1','pri'=>'','width'=>'90'),
    'is_use_call'=>array('name'=>'짐쇼허용','type'=>'varchar','length'=>'1','pri'=>'','width'=>'80'),

    'chazu_a_create_date'=>array('name'=>'가입일','type'=>'datetime','length'=>'','pri'=>'','width'=>'160'),
    'chazu_tel'=>array('name'=>'전화번호','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),

    'chazu_gub'=>array('name'=>'구분','type'=>'varchar','length'=>'30','pri'=>'','width'=>'70'),
    'chazu_saupno'=>array('name'=>'사업번호','type'=>'varchar','length'=>'12','pri'=>'','width'=>'100'),
    'chazu_upjungcode'=>array('name'=>'업종코드','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'chazu_upjung'=>array('name'=>'업종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_upte'=>array('name'=>'업태','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_addr'=>array('name'=>'주소','type'=>'varchar','length'=>'70','pri'=>'','width'=>'100'),
    'chazu_post'=>array('name'=>'우편번호','type'=>'varchar','length'=>'7','pri'=>'','width'=>'100'),
    // 'chazu_danpro'=>array('name'=>'운송료비율','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechadisdanga'=>array('name'=>'운송단가','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechaavrdanga'=>array('name'=>'건당운송','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechadantype'=>array('name'=>'운송단가타입','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'chazu_gigday'=>array('name'=>'월결제일','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_gigtermday'=>array('name'=>'결제기간','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_state'=>array('name'=>'상태','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'chazu_bechasdate'=>array('name'=>'배차일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechaedate'=>array('name'=>'완료일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'chazu_bankname'=>array('name'=>'은행명칭','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_gejano'=>array('name'=>'계좌번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'chazu_email'=>array('name'=>'차주이메일','type'=>'varchar','length'=>'320','pri'=>'','width'=>'100'),
    // 'chazu_pwd'=>array('name'=>'차주PWD','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'chazu_a_update_date'=>array('name'=>'수정일','type'=>'datetime','length'=>'','pri'=>'','width'=>'160'),
];
$this->x_pri_col_arr=['chazu_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=['push_btn_col','file_btn_col','chazu_a_create_date','chazu_a_update_date'];
$this->select_col_arr=[
    'is_login_agree'=>[
        ['value'=>'','text'=>'전체'],
        ['value'=>'1','text'=>'허용'],
        ['value'=>'empty','text'=>'미허용']
    ],
    'is_use_call'=>[
        ['value'=>'','text'=>'전체'],
        ['value'=>'1','text'=>'허용'],
        ['value'=>'empty','text'=>'미허용']
    ]
];
