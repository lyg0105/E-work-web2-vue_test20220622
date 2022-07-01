<?php
$this->table='acargo';
$this->column_prefix='';
$this->x_column_list_arr=
[
    'row_view_is_note'=>array('name'=>'배차일보','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'cargo_code'=>array('name'=>'화물코드','type'=>'varchar','length'=>'14','pri'=>'PRI','width'=>'100'),
    // 'cargo_jasacode'=>array('name'=>'자사코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'cargo_dlitcode'=>array('name'=>'보안코드','type'=>'varchar','length'=>'12','pri'=>'','width'=>'100'),
    // 'cargo_sawoncode'=>array('name'=>'사원코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'cargo_inpdate'=>array('name'=>'입력일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'cargo_inptime'=>array('name'=>'입력시간','type'=>'time','length'=>'','pri'=>'','width'=>'100'),
    'cargo_state'=>array('name'=>'화물상태','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'cargo_statedate'=>array('name'=>'완료일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'cargo_statetime'=>array('name'=>'완료시간','type'=>'time','length'=>'','pri'=>'','width'=>'100'),
    'susin_yn'=>array('name'=>'수신여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'cargo_custcode'=>array('name'=>'업체코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'cargo_custtitle'=>array('name'=>'거래처명','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_custgub'=>array('name'=>'업체구분','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_bechadamname'=>array('name'=>'화주담당','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_custtel'=>array('name'=>'업체연락','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'cargo_name'=>array('name'=>'화물명칭','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    'cargo_ton'=>array('name'=>'화물무게','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    'cargo_tonchk'=>array('name'=>'이하체크','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    'cargo_size'=>array('name'=>'배처담당','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_baretsu'=>array('name'=>'빠레트','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'cargo_bechadamcode'=>array('name'=>'배차담당','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'cargo_orderdate'=>array('name'=>'배차담당tel','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    'cargo_cartype'=>array('name'=>'요구타입','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_carton'=>array('name'=>'요구톤수','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    // 'cargo_carsu'=>array('name'=>'메모','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    'cargo_splacedate'=>array('name'=>'상차일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'cargo_splacetime'=>array('name'=>'상차시간','type'=>'varchar','length'=>'8','pri'=>'','width'=>'100'),
    'cargo_scometime'=>array('name'=>'도착시간','type'=>'varchar','length'=>'8','pri'=>'','width'=>'100'),

    'cargo_splace'=>array('name'=>'상차지명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_splaceperson'=>array('name'=>'상차담당','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_splacetel'=>array('name'=>'담당전화','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'cargo_splacemethod'=>array('name'=>'상차방법','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_splaceaddr'=>array('name'=>'상차주소','type'=>'varchar','length'=>'70','pri'=>'','width'=>'100'),
    'cargo_splacememo'=>array('name'=>'상차메모','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'cargo_places'=>array('name'=>'경유지','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'cargo_eplacedate'=>array('name'=>'하차일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'cargo_eplacetime'=>array('name'=>'하차시간','type'=>'varchar','length'=>'8','pri'=>'','width'=>'100'),
    'cargo_ecometime'=>array('name'=>'도착시간','type'=>'varchar','length'=>'8','pri'=>'','width'=>'100'),

    'cargo_eplace'=>array('name'=>'하차지명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_eplaceperson'=>array('name'=>'하차담당','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_eplacetel'=>array('name'=>'담당전화','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'cargo_eplacemethod'=>array('name'=>'하차방법','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_eplaceaddr'=>array('name'=>'하차주소','type'=>'varchar','length'=>'70','pri'=>'','width'=>'100'),
    'cargo_eplacememo'=>array('name'=>'하차메모','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'cargo_splacearea'=>array('name'=>'메모','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    'cargo_eplacearea'=>array('name'=>'메모','type'=>'varchar','length'=>'100','pri'=>'','width'=>'100'),
    // 'cargo_billacceptyn'=>array('name'=>'신규화물','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    // 'cargo_billacceptdate'=>array('name'=>'증수령일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'cargo_billsendyn'=>array('name'=>'송신카고','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_billsenddate'=>array('name'=>'증송신일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'cargo_vatgub'=>array('name'=>'세액구분','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_gum'=>array('name'=>'청구금액','type'=>'bigint','length'=>'','pri'=>'','width'=>'100'),
    // 'cargo_jsancode'=>array('name'=>'정산코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'cargo_addgum'=>array('name'=>'청구금외','type'=>'bigint','length'=>'','pri'=>'','width'=>'100'),
    // 'cargo_gumyedate'=>array('name'=>'청마감일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'cargo_jasapro'=>array('name'=>'수수료비율','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    'cargo_jasagum'=>array('name'=>'수수료','type'=>'bigint','length'=>'','pri'=>'','width'=>'100'),
    'becha_gum'=>array('name'=>'운송료','type'=>'bigint','length'=>'','pri'=>'','width'=>'100'),

    // 'cargo_tranno'=>array('name'=>'이송횟수','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    'cargo_fpisyn'=>array('name'=>'실적대상','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'cargo_yyyymm'=>array('name'=>'메모','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_group'=>array('name'=>'그룹코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'cargo_groupgrade'=>array('name'=>'그룹등급','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    'cargo_class'=>array('name'=>'긴급,예약','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_gub'=>array('name'=>'단독,혼적','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_hang'=>array('name'=>'편도,왕복','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'cargo_bigo'=>array('name'=>'선착불','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),

    'becha_gub'=>array('name'=>'배차구분','type'=>'varchar','length'=>'2','pri'=>'','width'=>'100'),
    'becha_date'=>array('name'=>'배차일자','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    'becha_time'=>array('name'=>'배차시간','type'=>'time','length'=>'','pri'=>'','width'=>'100'),
    'becha_runyn'=>array('name'=>'실행여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'becha_autorunyn'=>array('name'=>'메모','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'becha_custcode'=>array('name'=>'업체차주','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    'becha_custtitle'=>array('name'=>'업체차주명','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    'becha_chazuname'=>array('name'=>'차주성명','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'becha_carno'=>array('name'=>'차량번호','type'=>'varchar','length'=>'12','pri'=>'','width'=>'100'),
    'becha_hpno'=>array('name'=>'차주핸드폰','type'=>'varchar','length'=>'15','pri'=>'','width'=>'100'),
    'becha_chazugub'=>array('name'=>'차주구분','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'becha_cartype'=>array('name'=>'차량타입','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    'becha_carton'=>array('name'=>'차량톤수','type'=>'double','length'=>'','pri'=>'','width'=>'100'),
    // 'becha_size'=>array('name'=>'차량길이','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'becha_pushyn'=>array('name'=>'푸시여부','type'=>'varchar','length'=>'1','pri'=>'','width'=>'100'),
    // 'songsin_dlitcode'=>array('name'=>'송신보안','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),

    // 'becha_jsancode'=>array('name'=>'정산코드','type'=>'varchar','length'=>'14','pri'=>'','width'=>'100'),
    // 'becha_addgum'=>array('name'=>'운송료외','type'=>'bigint','length'=>'','pri'=>'','width'=>'100'),
    // 'becha_gumyedate'=>array('name'=>'운마감일','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'cargo_chkmody'=>array('name'=>'수정이력','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'cargo_chkrerun'=>array('name'=>'재전송여부','type'=>'varchar','length'=>'10','pri'=>'','width'=>'100'),
    // 'cargo_chkgita'=>array('name'=>'메모','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    'cargo_chkyebi'=>array('name'=>'전달메모','type'=>'varchar','length'=>'500','pri'=>'','width'=>'100'),
    // 'cargo_custom1'=>array('name'=>'커스텀메모1','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_custom2'=>array('name'=>'커스텀메모2','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_custom3'=>array('name'=>'커스텀메모3','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_custom4'=>array('name'=>'커스텀메모4','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_custom5'=>array('name'=>'커스텀메모5','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'cargo_tongsin'=>array('name'=>'통신코드','type'=>'varchar','length'=>'200','pri'=>'','width'=>'100'),
];
$this->x_pri_col_arr=['cargo_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=['row_view_is_note'];
$this->is_number_col_arr=['cargo_gum','cargo_jasagum','becha_gum'];
$this->select_col_arr=[
    'cargo_state'=>[
        ['text'=>'선택없음','value'=>''],
        ['text'=>'화물등록','value'=>'A'],
        ['text'=>'배차확정','value'=>'B'],
        ['text'=>'배송중','value'=>'C'],
        ['text'=>'배송완료','value'=>'D'],
        ['text'=>'배차취소','value'=>'F']
    ]
];
$this->is_date_col_arr=[
    'cargo_inpdate',
    'cargo_splacedate',
    'cargo_eplacedate',
    'becha_date'
];
$this->search_select_col_arr=[
    's_date_type'=>[
        ['value'=>'cargo_inpdate','text'=>'입력일자'],
        ['value'=>'cargo_splacedate','text'=>'상차일'],
        ['value'=>'cargo_eplacedate','text'=>'하차일'],
        ['value'=>'becha_date','text'=>'배차일']
    ]
];
