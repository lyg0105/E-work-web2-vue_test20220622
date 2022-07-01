<?php
$this->table='nca';
$this->column_prefix='nca_';
$this->x_column_list_arr=
[
    // 'nca_ymd'=>array('name'=>'년월일','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'nca_code'=>array('name'=>'순번','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'nca_note_code'=>array('name'=>'부모코드','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'nca_supply_pay'=>array('name'=>'구분supply,pay','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'nca_subject_detail'=>array('name'=>'분류명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'nca_memo'=>array('name'=>'거래명','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'nca_money'=>array('name'=>'금액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'nca_create_id'=>array('name'=>'작성자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'nca_update_id'=>array('name'=>'수정자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'nca_create_date'=>array('name'=>'작성일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    // 'nca_update_date'=>array('name'=>'수정일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100')
];
$this->x_pri_col_arr=['nca_ymd','nca_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=[];
$this->select_col_arr=[

];
$this->is_number_col_arr=[
    'nca_money',
];
$this->is_tel_col_arr=[];
$this->is_date_col_arr=[];
