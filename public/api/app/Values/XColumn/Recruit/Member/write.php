<?php
$this->table='recruit_member';
$this->column_prefix='';
$this->x_column_list_arr=
[
    // 'rm_code'=>array('name'=>'모집인코드','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'rm_rb_code'=>array('name'=>'지점코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'rm_type'=>array('name'=>'모집인구분','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'rm_is_ceo'=>array('name'=>'지점대표여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'rm_id'=>array('name'=>'아이디','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_pw'=>array('name'=>'비밀번호','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'rm_name'=>array('name'=>'모집인명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_phone'=>array('name'=>'핸드폰번호','type'=>'varchar','length'=>'20','pri'=>'','width'=>'120'),
    'rm_tel'=>array('name'=>'연락처','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'rm_email'=>array('name'=>'이메일','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'rm_memo'=>array('name'=>'메모','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'rm_comp_name'=>array('name'=>'상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_comp_ceo'=>array('name'=>'대표자','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_busin_num'=>array('name'=>'사업자번호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_busin_sort'=>array('name'=>'업종','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_busin_type'=>array('name'=>'업태','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_comp_addr'=>array('name'=>'사업장주소','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
    'rm_comp_addr_post'=>array('name'=>'사업장우편번호','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'rm_comp_mail'=>array('name'=>'사업자이메일','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'rm_comp_tel'=>array('name'=>'사업장연락처','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'rm_comp_fax'=>array('name'=>'팩스','type'=>'varchar','length'=>'20','pri'=>'','width'=>'100'),
    'rm_bank_name'=>array('name'=>'은행명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_bank_account'=>array('name'=>'계좌번호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'rm_bank_owner'=>array('name'=>'예금주','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'rm_last_login_date'=>array('name'=>'마지막로그인시간','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    // 'rm_login_cnt'=>array('name'=>'로그인수','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'rm_create_date'=>array('name'=>'작성일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
    // 'rm_update_date'=>array('name'=>'수정일','type'=>'datetime','length'=>'','pri'=>'','width'=>'100'),
];
$this->x_pri_col_arr=['rm_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=[];
$this->is_number_col_arr=[];
$this->is_tel_col_arr=[
    'rm_phone','rm_tel','rm_comp_tel','rm_comp_fax'
];
$this->is_busin_col_arr=[
    'rm_busin_num'
];
$is_password_col_arr=['rm_pw'];
$this->select_col_arr=[
    'rm_type'=>[
        ['value'=>'person','text'=>'개인'],
        ['value'=>'comp','text'=>'회사']
    ],
    "rm_is_ceo"=>[
        ['value'=>'','text'=>'아니오'],
        ['value'=>'1','text'=>'예']
    ]
];
