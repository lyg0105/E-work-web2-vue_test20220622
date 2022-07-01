<?php
$this->table='trade';
$this->column_prefix='trade_';
$this->x_column_list_arr=
[
    // 'trade_ymd'=>array('name'=>'년월일','type'=>'varchar','length'=>'8','pri'=>'PRI','width'=>'100'),
    // 'trade_code'=>array('name'=>'순번','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'trade_jasa_code'=>array('name'=>'자사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'trade_sawon_code'=>array('name'=>'사원코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'trade_date'=>array('name'=>'거래일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'trade_debit_credit'=>array('name'=>'차변대변','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'trade_subject_code'=>array('name'=>'계정과목코드','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'trade_subject_name'=>array('name'=>'계정과목','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'trade_cust_par_id'=>array('name'=>'거래처부모acust,achazu','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    // 'trade_cust_par_code'=>array('name'=>'거래처부모코드','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'row_view_cust_name'=>array('name'=>'거래처','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'trade_memo'=>array('name'=>'적요','type'=>'varchar','length'=>'100','pri'=>'','width'=>'160'),
    // 'trade_money'=>array('name'=>'금액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'row_view_debit_money'=>array('name'=>'차변','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'row_view_credit_money'=>array('name'=>'대변','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'trade_subject_detail'=>array('name'=>'분류명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'row_view_par_name'=>array('name'=>'부모','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'trade_inout'=>array('name'=>'증가감소','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'trade_par_code'=>array('name'=>'부모코드','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'trade_par_id'=>array('name'=>'부모구분anote_bill','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    // 'trade_create_id'=>array('name'=>'작성자','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'trade_update_id'=>array('name'=>'수정자','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'trade_create_date'=>array('name'=>'작성일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    'trade_update_date'=>array('name'=>'수정일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
];
$this->x_pri_col_arr=['trade_ymd','trade_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=['row_view_cust_name','row_view_debit_money','row_view_credit_money'];
$this->select_col_arr=[
    'trade_debit_credit'=>[
        ['text'=>'차변','value'=>'debit'],
        ['text'=>'대변','value'=>'credit']
    ],
    'trade_inout'=>[
        ['text'=>'증가','value'=>'in'],
        ['text'=>'감소','value'=>'out']
    ]
];
$this->is_number_col_arr=[
    'trade_money','row_view_debit_money','row_view_credit_money'
];
$this->is_tel_col_arr=[];
$this->is_date_col_arr=[
    'trade_date'
];
$this->search_select_col_arr=[
    's_date_type'=>[
        ['value'=>'a_date','text'=>'거래일'],
        ['value'=>'a_create_date','text'=>'작성일'],
        ['value'=>'a_update_date','text'=>'수정일']
    ]
];
