<?php
$this->table='cust';
$this->column_prefix='';
$this->x_column_list_arr=
[
    // 'cust_code'=>array('name'=>'거래처코드','type'=>'varchar','length'=>'14','pri'=>'PRI','width'=>'100'),
    // 'jasa_code'=>array('name'=>'자사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'cust_title'=>array('name'=>'상호','type'=>'varchar','length'=>'50','pri'=>'','width'=>'120'),
    'cust_capname'=>array('name'=>'대표자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'cust_gub'=>array('name'=>'GB거래처구분','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cust_custtype'=>array('name'=>'타입','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),

    'cust_saupno'=>array('name'=>'사업번호','type'=>'varchar','length'=>'12','pri'=>'','width'=>'120'),
    'cust_upjung'=>array('name'=>'업종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cust_upte'=>array('name'=>'업태','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cust_tel'=>array('name'=>'전화','type'=>'varchar','length'=>'15','pri'=>'','width'=>'120'),
    'cust_fax'=>array('name'=>'팩스','type'=>'varchar','length'=>'15','pri'=>'','width'=>'110'),

    'cust_bankname'=>array('name'=>'은행명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cust_gejano'=>array('name'=>'계좌번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'cust_yegeumju'=>array('name'=>'예금주','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),

    'cust_addr'=>array('name'=>'주소','type'=>'varchar','length'=>'70','pri'=>'','width'=>'130'),
    'cust_post'=>array('name'=>'우편번호','type'=>'varchar','length'=>'7','pri'=>'','width'=>'100'),
    'cust_lowno'=>array('name'=>'법인번호','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'cust_email'=>array('name'=>'메일','type'=>'varchar','length'=>'320','pri'=>'','width'=>'110'),
    'cust_homepage'=>array('name'=>'홈페이지','type'=>'varchar','length'=>'253','pri'=>'','width'=>'100'),

    'cust_hp'=>array('name'=>'휴대폰','type'=>'varchar','length'=>'15','pri'=>'','width'=>'110'),
    // 'cust_upjungcode'=>array('name'=>'업종코드','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),

    // 'cust_dlitcode'=>array('name'=>'보안코드','type'=>'varchar','length'=>'12','pri'=>'','width'=>'100'),
    // 'cust_danpro'=>array('name'=>'운송료비율','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_cargodisdanga'=>array('name'=>'청구단가','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_bechadisdanga'=>array('name'=>'운송단가','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_cargoavrdanga'=>array('name'=>'건당청구','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_bechaavrdanga'=>array('name'=>'건당운송','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_cargodantype'=>array('name'=>'청구단가타입','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'cust_bechadantype'=>array('name'=>'운송단가타입','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'cust_postaddr'=>array('name'=>'우편주소','type'=>'varchar','length'=>'70','pri'=>'','width'=>'130'),
    'cust_postpost'=>array('name'=>'우편물우편','type'=>'varchar','length'=>'7','pri'=>'','width'=>'100'),
    // 'cust_gigday'=>array('name'=>'월결제일','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_gigtermday'=>array('name'=>'결제기간','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_inpday'=>array('name'=>'월입금일','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_inptermday'=>array('name'=>'입금기간','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'cust_songsusinyn'=>array('name'=>'송수신여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'cust_id'=>array('name'=>'자사ID','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'cust_pwd'=>array('name'=>'자사PWD','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'cust_bechadamname'=>array('name'=>'배차담당','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cust_bechadamtel'=>array('name'=>'담당전화','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'cust_jsandamname'=>array('name'=>'정산담당','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cust_jsandamtel'=>array('name'=>'담당전화','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'cust_bigo01'=>array('name'=>'메모01','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
    'cust_bigo02'=>array('name'=>'메모02','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
];
$this->x_pri_col_arr=['cust_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=[];
$this->is_busin_col_arr=['cust_saupno'];
$this->is_tel_col_arr=[
    'cust_tel',
    'cust_fax',
    'cust_hp',
    'cust_bechadamtel',
    'cust_jsandamtel'
];
$this->select_col_arr=[
    'cust_custtype'=>[
        ['text'=>'운송사','value'=>'운송사'],
        ['text'=>'화주사','value'=>'화주사']
    ]
];
