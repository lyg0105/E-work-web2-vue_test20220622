<?php
$this->table='cargo_note';
$this->column_prefix='note_';
$this->x_column_list_arr=
[
    // 'note_ymd'=>array('name'=>'년월일','type'=>'varchar','length'=>'8','pri'=>'PRI','width'=>'100'),
    // 'note_code'=>array('name'=>'순번','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'note_jasa_code'=>array('name'=>'자사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'note_sawon_code'=>array('name'=>'사원코드','type'=>'varchar','length'=>'12','pri'=>'','width'=>'100'),
    // 'note_cargo_code'=>array('name'=>'부모화물코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'note_cust_title'=>array('name'=>'거래처명','type'=>'varchar','length'=>'50','pri'=>'','width'=>'120'),
    // 'note_cust_code'=>array('name'=>'거래처코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'note_start_date'=>array('name'=>'상차일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_start_name'=>array('name'=>'상차지명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_start_addr'=>array('name'=>'상차주소','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),

    'note_places'=>array('name'=>'경유지','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),

    'note_end_date'=>array('name'=>'하차일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_end_name'=>array('name'=>'하차지명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_end_addr'=>array('name'=>'하차주소','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),

    'note_buy_sort'=>array('name'=>'매입구분','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'note_alloc_cust_code'=>array('name'=>'운송사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'note_alloc_cust_name'=>array('name'=>'운송사명','type'=>'varchar','length'=>'50','pri'=>'','width'=>'120'),
    // 'note_alloc_chazu_code'=>array('name'=>'차주코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'note_alloc_car_user_name'=>array('name'=>'차주명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_alloc_car_num'=>array('name'=>'차량번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'140'),
    'note_alloc_car_user_hp'=>array('name'=>'차주핸드폰','type'=>'varchar','length'=>'20','pri'=>'','width'=>'120'),

    'note_cust_sort'=>array('name'=>'거래처구분','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'row_view_cust_type'=>array('name'=>'거래처구분2','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_cargo_name'=>array('name'=>'화물명','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),

    'note_is_pre_pay'=>array('name'=>'선착불여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_pay_type'=>array('name'=>'지불방법','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'note_supply_money'=>array('name'=>'청구금액','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'note_supply_money_add'=>array('name'=>'추가청구료','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'note_pay_money'=>array('name'=>'운송료','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'note_pay_money_add'=>array('name'=>'추가운송료','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'note_fee_money'=>array('name'=>'수수료','type'=>'int','length'=>'','pri'=>'','width'=>'100'),

    'note_is_receive_cert'=>array('name'=>'인수증받음체크','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_receive_cert_date'=>array('name'=>'인수증수령일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),

    'note_is_shuttle'=>array('name'=>'왕복여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_is_mix'=>array('name'=>'혼적여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_cargo_ton'=>array('name'=>'화물무게','type'=>'float','length'=>'','pri'=>'','width'=>'100'),
    'note_pallet'=>array('name'=>'빠레트수','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'note_req_car_type'=>array('name'=>'희망차종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_req_car_ton'=>array('name'=>'희망톤수','type'=>'float','length'=>'','pri'=>'','width'=>'100'),

    'note_st_end_distance'=>array('name'=>'상하차거리','type'=>'double','length'=>'','pri'=>'','width'=>'100'),

    'note_alloc_car_type'=>array('name'=>'차주차종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_alloc_car_ton'=>array('name'=>'차주톤수','type'=>'float','length'=>'','pri'=>'','width'=>'100'),
    'row_view_chazu_gub'=>array('name'=>'차주구분','type'=>'float','length'=>'','pri'=>'','width'=>'100'),
    'note_memo'=>array('name'=>'전달메모','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
    'note_memo2'=>array('name'=>'비고2','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
    'note_memo3'=>array('name'=>'비고1','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),

    'note_start_time'=>array('name'=>'상차시간','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'note_start_responser'=>array('name'=>'상차담당자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_start_tel'=>array('name'=>'상차연락처','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'note_start_method'=>array('name'=>'상차방법','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_start_memo'=>array('name'=>'상차메모','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),

    'note_end_time'=>array('name'=>'하차시간','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'note_end_responser'=>array('name'=>'하차담당자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_end_tel'=>array('name'=>'하차연락처','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'note_end_method'=>array('name'=>'하차방법','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_end_memo'=>array('name'=>'하차메모','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),

    'note_is_send_cert'=>array('name'=>'인수증보냄체크','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_send_cert_date'=>array('name'=>'인수증전송일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_is_fpis_target'=>array('name'=>'실적대상여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_is_fpis_report'=>array('name'=>'실적신고여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'note_fpis_report_date'=>array('name'=>'실적신고일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_supply_get_will_date'=>array('name'=>'입금예정일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_pay_will_date'=>array('name'=>'지급예정일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_is_supply_bill'=>array('name'=>'청구서작성여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'note_supply_bill_code'=>array('name'=>'청구서키','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_supply_bill_date'=>array('name'=>'청구서작성일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_is_pay_bill'=>array('name'=>'지급서작성여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'note_pay_bill_code'=>array('name'=>'지급서키','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_supply_end_date'=>array('name'=>'청구마감일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_pay_end_date'=>array('name'=>'지급마감일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_custom_memo1'=>array('name'=>'커스텀메모1','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo2'=>array('name'=>'커스텀메모2','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo3'=>array('name'=>'커스텀메모3','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo4'=>array('name'=>'커스텀메모4','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo5'=>array('name'=>'커스텀메모5','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo6'=>array('name'=>'커스텀메모6','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo7'=>array('name'=>'커스텀메모7','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo8'=>array('name'=>'커스텀메모8','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo9'=>array('name'=>'커스텀메모9','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_custom_memo10'=>array('name'=>'커스텀메모10','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'note_request_date'=>array('name'=>'등록일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'note_create_id'=>array('name'=>'작성자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_create_id'=>array('name'=>'작성자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_update_id'=>array('name'=>'수정자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'note_create_date'=>array('name'=>'작성일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    'note_update_date'=>array('name'=>'수정일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
];
if(App\Config\Session\Session::get('dlit_type')=='A'){
    unset($this->x_column_list_arr['note_cust_title']);
    unset($this->x_column_list_arr['note_cust_sort']);
    unset($this->x_column_list_arr['note_supply_money']);
    unset($this->x_column_list_arr['note_fee_money']);
    unset($this->x_column_list_arr['note_supply_money_add']);
    unset($this->x_column_list_arr['note_is_send_cert']);
    unset($this->x_column_list_arr['note_send_cert_date']);
    unset($this->x_column_list_arr['note_is_fpis_target']);
    unset($this->x_column_list_arr['note_is_fpis_report']);
    unset($this->x_column_list_arr['note_fpis_report_date']);
    unset($this->x_column_list_arr['note_supply_get_will_date']);
    unset($this->x_column_list_arr['note_is_supply_bill']);
    unset($this->x_column_list_arr['note_supply_bill_date']);
    unset($this->x_column_list_arr['note_supply_end_date']);
}
$this->x_pri_col_arr=['note_ymd','note_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=['note_supply_money_add','note_pay_money_add','row_view_chazu_gub','row_view_cust_type'];
$this->select_col_arr=[
    'note_cust_sort'=>[
        ['text'=>'화주사','value'=>'1'],
        ['text'=>'운송사','value'=>'2']
    ],
    'note_is_pre_pay'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_buy_sort'=>[
        ['text'=>'차주','value'=>'1'],
        ['text'=>'운송사','value'=>'2']
    ],
    'note_is_shuttle'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_is_mix'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_is_receive_cert'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_is_send_cert'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_is_fpis_target'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_is_fpis_report'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_is_supply_bill'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ],
    'note_is_pay_bill'=>[
        ['text'=>'아니오','value'=>''],
        ['text'=>'예','value'=>'1']
    ]
];
$this->is_number_col_arr=[
    'note_supply_money',
    'note_pay_money',
    'note_fee_money',
    'note_st_end_distance'
];
$this->is_tel_col_arr=[
    'note_alloc_car_user_hp'
];
$this->is_date_col_arr=[
    'note_request_date',
    'note_start_date',
    'note_end_date',
    'note_create_date',
    'note_update_date',
    'note_receive_cert_date',
    'note_send_cert_date',
    'note_fpis_report_date',
    'note_supply_get_will_date',
    'note_pay_will_date',
    'note_supply_bill_date',
    'note_is_pay_bill',
    'note_supply_end_date',
    'note_pay_end_date'
];
$this->search_select_col_arr=[
    's_date_type'=>[
        ['value'=>'a_request_date','text'=>'등록일'],
        ['value'=>'a_start_date','text'=>'상차일'],
        ['value'=>'a_end_date','text'=>'하차일'],
        ['value'=>'a_create_date','text'=>'작성일'],
        ['value'=>'a_update_date','text'=>'수정일'],
        ['value'=>'a_supply_get_will_date','text'=>'입금예정일'],
        ['value'=>'a_pay_will_date','text'=>'지급예정일'],
        ['value'=>'a_supply_end_date','text'=>'청구마감일'],
        ['value'=>'a_pay_end_date','text'=>'지급마감일']
    ]
];
