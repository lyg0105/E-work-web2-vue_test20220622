<?php
$this->table='tax';
$this->column_prefix='tax_';
$this->x_column_list_arr=
[
    'row_view_manage_btn'=>array('name'=>'관리','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'tax_ymd'=>array('name'=>'년월일','type'=>'varchar','length'=>'8','pri'=>'PRI','width'=>'100'),
    // 'tax_code'=>array('name'=>'순번','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'tax_jasa_code'=>array('name'=>'자사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'tax_sawon_code'=>array('name'=>'사원코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'tax_cust_par_id'=>array('name'=>'거래처부모구분acust,achazu','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    // 'tax_cust_par_code'=>array('name'=>'거래처부모코드','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'tax_par_id'=>array('name'=>'보모구분','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'tax_par_code'=>array('name'=>'부모코드','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_publish_sort'=>array('name'=>'발행구분 suppy청구,pay지급','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'tax_select_date'=>array('name'=>'거래일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),

    'tax_supply_company_name'=>array('name'=>'공급자 상호','type'=>'varchar','length'=>'70','pri'=>'','width'=>'100'),
    'tax_receive_company_name'=>array('name'=>'받는자 상호','type'=>'varchar','length'=>'70','pri'=>'','width'=>'140'),

    // 'tax_book_num'=>array('name'=>'책번호(권)','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'tax_ho_num'=>array('name'=>'책번호(호)','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),

    'tax_serial_num'=>array('name'=>'일련번호','type'=>'varchar','length'=>'30','pri'=>'UNI','width'=>'100'),

    'tax_supply_cost'=>array('name'=>'공급가액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_supply_tax_cost'=>array('name'=>'세액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),

    'tax_report_sort'=>array('name'=>'신고구분popbill,hometax','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'tax_is_report'=>array('name'=>'신고여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'tax_report_date'=>array('name'=>'신고일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'tax_report_serial_num'=>array('name'=>'신고번호','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),

    'tax_supply_reg_num'=>array('name'=>'공급자등록번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'tax_supply_ceo'=>array('name'=>'공급자 대표','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_supply_area_num'=>array('name'=>'공급자종사업장번호','type'=>'varchar','length'=>'4','pri'=>'','width'=>'100'),
    'tax_supply_adress'=>array('name'=>'공급자 사업장주소','type'=>'varchar','length'=>'150','pri'=>'','width'=>'100'),
    'tax_supply_busin_type'=>array('name'=>'공급자 업태','type'=>'varchar','length'=>'40','pri'=>'','width'=>'100'),
    'tax_supply_busin_sort'=>array('name'=>'공급자 업종','type'=>'varchar','length'=>'60','pri'=>'','width'=>'100'),
    'tax_supply_email'=>array('name'=>'공급자 이메일','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'tax_supply_responser'=>array('name'=>'공급자 담당자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_supply_tel'=>array('name'=>'공급자 전화','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_supply_hp'=>array('name'=>'공급자 핸드폰','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),

    'tax_receive_reg_num'=>array('name'=>'받는자등록번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'tax_receive_area_num'=>array('name'=>'받는자종사업장번호','type'=>'varchar','length'=>'4','pri'=>'','width'=>'100'),
    'tax_receive_ceo'=>array('name'=>'받는자 대표','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_receive_adress'=>array('name'=>'받는자 사업장주소','type'=>'varchar','length'=>'150','pri'=>'','width'=>'100'),
    'tax_receive_busin_type'=>array('name'=>'받는자 업태','type'=>'varchar','length'=>'40','pri'=>'','width'=>'100'),
    'tax_receive_busin_sort'=>array('name'=>'받는자 업종','type'=>'varchar','length'=>'60','pri'=>'','width'=>'100'),
    'tax_receive_email'=>array('name'=>'받는자 이메일','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'tax_receive_responser'=>array('name'=>'받는자 담당자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_receive_tel'=>array('name'=>'받는자 전화','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_receive_hp'=>array('name'=>'받는자 핸드폰','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),

    'tax_note'=>array('name'=>'비고','type'=>'varchar','length'=>'150','pri'=>'','width'=>'100'),
    'tax_row1_md'=>array('name'=>'월일','type'=>'varchar','length'=>'4','pri'=>'','width'=>'100'),
    'tax_row1_item'=>array('name'=>'품목','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    'tax_row1_standard'=>array('name'=>'규격','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_row1_amount'=>array('name'=>'수량','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_row1_unit_cost'=>array('name'=>'단가','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_row1_supply_cost'=>array('name'=>'공급가액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_row1_supply_tax_cost'=>array('name'=>'세액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_row1_note'=>array('name'=>'비고','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'tax_cash_cost'=>array('name'=>'현금','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_check_cost'=>array('name'=>'수표','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_promis_cost'=>array('name'=>'어음','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_credit_cost'=>array('name'=>'외상미수금','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'tax_charge_sort'=>array('name'=>'영수,청구(01,02)','type'=>'varchar','length'=>'2','pri'=>'','width'=>'100'),

    'tax_sort'=>array('name'=>'세금계산서종류(01:일반,02:영세율)','type'=>'varchar','length'=>'2','pri'=>'','width'=>'100'),

    'tax_is_report_success'=>array('name'=>'신고성공여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'tax_report_note'=>array('name'=>'신고비고','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),

    'tax_create_id'=>array('name'=>'작성자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_update_id'=>array('name'=>'수정자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'tax_create_date'=>array('name'=>'작성일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    'tax_update_date'=>array('name'=>'수정일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100')
];
$this->x_pri_col_arr=['tax_ymd','tax_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=['row_view_manage_btn'];
$this->select_col_arr=[
    'tax_publish_sort'=>[
        ['value'=>'supply','text'=>'청구서'],
        ['value'=>'pay','text'=>'지급서']
    ],
    'tax_sort'=>[
        ['text'=>'일반','value'=>'01'],
        ['text'=>'영세율','value'=>'02']
    ],
    'tax_charge_sort'=>[
        ['text'=>'영수','value'=>'01'],
        ['text'=>'청구','value'=>'02']
    ],
    'tax_is_report'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'tax_report_sort'=>[
        ['text'=>'홈텍스','value'=>'hometax'],
        ['text'=>'팝빌','value'=>'popbill']
    ],
    'tax_is_report_success'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ]
];
$this->is_number_col_arr=[
    'tax_supply_cost',
    'tax_supply_tax_cost',
    'tax_row1_amount',
    'tax_row1_unit_cost',
    'tax_row1_supply_cost',
    'tax_row1_supply_tax_cost',
    'tax_cash_cost',
    'tax_check_cost',
    'tax_promis_cost',
    'tax_credit_cost'
];
$this->is_tel_col_arr=[

];
$this->is_date_col_arr=[
    'tax_select_date',
    'tax_report_date'
];
$this->search_select_col_arr=[
    's_date_type'=>[
        ['value'=>'a_select_date','text'=>'거래일']
    ]
];
