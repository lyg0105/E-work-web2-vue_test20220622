<?php
$this->table='chazu';
$this->column_prefix='';
$this->x_column_list_arr=
[
    // 'chazu_code'=>array('name'=>'차주코드','type'=>'varchar','length'=>'14','pri'=>'PRI','width'=>'100'),
    // 'link_code'=>array('name'=>'연결코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'chazu_gub'=>array('name'=>'차주구분','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'row_view_remain_money'=>array('name'=>'미수금','type'=>'varchar','length'=>'50','pri'=>'','width'=>'120'),
    'chazu_carno'=>array('name'=>'차량번호','type'=>'varchar','length'=>'12','pri'=>'','width'=>'110'),
    // 'chazu_simpleno'=>array('name'=>'약식차번','type'=>'varchar','length'=>'4','pri'=>'','width'=>'100'),
    'chazu_hp'=>array('name'=>'핸드폰','type'=>'varchar','length'=>'15','pri'=>'','width'=>'110'),
    'chazu_name'=>array('name'=>'차주성명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_cartype'=>array('name'=>'차종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_carton'=>array('name'=>'톤수','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    'chazu_jeokjaelen'=>array('name'=>'적재함길이','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    'chazu_tel'=>array('name'=>'전화번호','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'chazu_title'=>array('name'=>'상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_capname'=>array('name'=>'대표자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'chazu_saupno'=>array('name'=>'사업번호','type'=>'varchar','length'=>'12','pri'=>'','width'=>'100'),
    // 'chazu_upjungcode'=>array('name'=>'업종코드','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'chazu_upjung'=>array('name'=>'업종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'chazu_upte'=>array('name'=>'업태','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'chazu_addr'=>array('name'=>'주소','type'=>'varchar','length'=>'70','pri'=>'','width'=>'100'),
    // 'chazu_post'=>array('name'=>'우편번호','type'=>'varchar','length'=>'7','pri'=>'','width'=>'100'),
    // 'chazu_danpro'=>array('name'=>'운송료비율','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechadisdanga'=>array('name'=>'운송단가','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechaavrdanga'=>array('name'=>'건당운송','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechadantype'=>array('name'=>'운송단가타입','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'chazu_gigday'=>array('name'=>'월결제일','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_gigtermday'=>array('name'=>'결제기간','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_state'=>array('name'=>'상태','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'chazu_bechasdate'=>array('name'=>'배차일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_bechaedate'=>array('name'=>'완료일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_email'=>array('name'=>'이메일','type'=>'varchar','length'=>'320','pri'=>'','width'=>'100'),
    // 'chazu_bankname'=>array('name'=>'은행명칭','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'chazu_gejano'=>array('name'=>'계좌번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    // 'chazu_yegeumju'=>array('name'=>'예금주','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'chazu_id'=>array('name'=>'차주ID','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'chazu_pwd'=>array('name'=>'차주PWD','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'chazu_driver'=>array('name'=>'운전자명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'chazu_drivertel'=>array('name'=>'운전자번호','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    // 'chazu_rubae'=>array('name'=>'차량루베','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    // 'chazu_heoga'=>array('name'=>'허가종류','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'chazu_singoyn'=>array('name'=>'신고여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),

    'chazu_bigo01'=>array('name'=>'메모01','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
    'chazu_bigo02'=>array('name'=>'메모02','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
];
$this->x_pri_col_arr=['chazu_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=[];
$this->is_busin_col_arr=['chazu_saupno'];
$this->is_tel_col_arr=[
    'chazu_hp',
    'chazu_tel'
];
$this->is_number_col_arr=[
    'row_view_remain_money'
];
$this->select_col_arr=[
    'chazu_gub'=>[
        ['text'=>'선택없음','value'=>''],
        ['text'=>'자차','value'=>'자차'],
        ['text'=>'용차','value'=>'용차'],
        ['text'=>'장기용차','value'=>'장기용차'],
        ['text'=>'직영','value'=>'직영'],
        ['text'=>'지입','value'=>'지입']
    ]
];
