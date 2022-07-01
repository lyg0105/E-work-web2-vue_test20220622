<?php
$this->table='bill';
$this->column_prefix='bill_';
$this->x_column_list_arr=
[
    'row_view_manage_btn'=>array('name'=>'관리','type'=>'date','length'=>'','pri'=>'','width'=>'200'),
    // 'bill_ymd'=>array('name'=>'년월일','type'=>'varchar','length'=>'8','pri'=>'PRI','width'=>'100'),
    // 'bill_code'=>array('name'=>'순번','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'bill_jasa_code'=>array('name'=>'자사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'bill_sawon_code'=>array('name'=>'사원코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'bill_date'=>array('name'=>'명세일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'bill_cust_par_id'=>array('name'=>'거래처부모','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    // 'bill_cust_par_code'=>array('name'=>'거래처부모키','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'bill_cust_title'=>array('name'=>'거래처명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'120'),
    // 'bill_doc_sort'=>array('name'=>'문서구분','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'bill_sort'=>array('name'=>'구분','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'bill_title'=>array('name'=>'제목','type'=>'varchar','length'=>'50','pri'=>'','width'=>'160'),
    // 'bill_message'=>array('name'=>'알림말','type'=>'varchar','length'=>'300','pri'=>'','width'=>'100'),

    'row_view_money_sum'=>array('name'=>'합계','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'bill_remain_money'=>array('name'=>'잔금','type'=>'int','length'=>'','pri'=>'','width'=>'100'),

    'bill_create_date'=>array('name'=>'작성일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),

    'bill_is_complete'=>array('name'=>'완료여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'bill_complete_date'=>array('name'=>'완료일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    'bill_is_tax_make'=>array('name'=>'세금작성여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'bill_is_tax_report'=>array('name'=>'세금발행여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'bill_tax_make_date'=>array('name'=>'세금작성일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    'bill_tax_report_date'=>array('name'=>'세금발행일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),

    'bill_serial_num'=>array('name'=>'관리번호','type'=>'varchar','length'=>'30','pri'=>'UNI','width'=>'110'),

    'bill_amount'=>array('name'=>'수량','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'bill_money'=>array('name'=>'과세금액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'bill_tax_money'=>array('name'=>'세금','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'bill_tax_ratio'=>array('name'=>'세금요율','type'=>'float','length'=>'','pri'=>'','width'=>'100'),

    'bill_base_period'=>array('name'=>'기간기준','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'bill_start_date'=>array('name'=>'거래기간시작','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'bill_end_date'=>array('name'=>'거래기간종료','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'bill_limit_date'=>array('name'=>'예정일(입금지급)','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'bill_send_date'=>array('name'=>'발송일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),

    'bill_responser'=>array('name'=>'담당자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'bill_responser_tel'=>array('name'=>'담당자연락처','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),

    'bill_create_id'=>array('name'=>'작성자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'bill_update_id'=>array('name'=>'수정자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'bill_update_date'=>array('name'=>'수정일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
];
$this->x_pri_col_arr=['bill_ymd','bill_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=['row_view_manage_btn','row_view_money_sum'];
$this->select_col_arr=[
    'bill_sort'=>[
        ['value'=>'supply','text'=>'청구서'],
        ['value'=>'pay','text'=>'지급서']
    ],
    'bill_is_complete'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'bill_is_tax_make'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'bill_is_tax_report'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ]
];
$this->is_number_col_arr=[
    'bill_amount',
    'bill_money',
    'bill_tax_money',
    'bill_tax_ratio',
    'row_view_money_sum',
    'bill_remain_money'
];
$this->is_tel_col_arr=[
    'note_alloc_car_user_hp'
];
$this->is_date_col_arr=[
    'bill_date',
    'bill_start_date',
    'bill_end_date',
    'bill_limit_date',
    'bill_send_date',
    'bill_complete_date',
    'bill_tax_make_date',
    'bill_tax_report_date'
];
$this->search_select_col_arr=[
    's_date_type'=>[
        ['value'=>'a_date','text'=>'거래일'],
        ['value'=>'a_start_date','text'=>'시작일'],
        ['value'=>'a_end_date','text'=>'종료일']
    ]
];
