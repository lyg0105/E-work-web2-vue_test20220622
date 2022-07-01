<?php
$this->table='nlo';
$this->column_prefix='nlo_';
$this->x_column_list_arr=
[
    // 'nlo_code'=>array('name'=>'nlo_seq','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    // 'nlo_user_id'=>array('name'=>'사원키','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'nlo_list_sort'=>array('name'=>'리스트id','type'=>'varchar','length'=>'50','pri'=>'','width'=>'100'),
    // 'nlo_list_type'=>array('name'=>'리스트타입','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'),
    // 'nlo_opt_json_data'=>array('name'=>'옵션데이터','type'=>'mediumtext','length'=>'16777215','pri'=>'','width'=>'100'),
    // 'nlo_create_id'=>array('name'=>'nlo_create_id','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'nlo_update_id'=>array('name'=>'nlo_update_id','type'=>'int','length'=>'','pri'=>'','width'=>'100'),
    // 'nlo_create_date'=>array('name'=>'nlo_create_date','type'=>'date','length'=>'','pri'=>'','width'=>'100'),
    // 'nlo_update_date'=>array('name'=>'nlo_update_date','type'=>'date','length'=>'','pri'=>'','width'=>'100')
    'num_per_page'=>array('name'=>'페이지최대','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'fix_left_num'=>array('name'=>'왼쪽고정수','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    's_date_type'=>array('name'=>'기간기준','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    's_date_start'=>array('name'=>'검색기간','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'order_id'=>array('name'=>'정렬기준','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'order_type'=>array('name'=>'역순여부','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'order_id2'=>array('name'=>'정렬기준2','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'order_type2'=>array('name'=>'역순여부2','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'order_id3'=>array('name'=>'정렬기준3','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'order_type3'=>array('name'=>'역순여부3','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
    'list_arr_num'=>array('name'=>'리스트타입','type'=>'int','length'=>'','pri'=>'PRI','width'=>'100'),
];
$this->x_pri_col_arr=['nlo_code'];
$this->x_basic_col_arr=[];
$this->x_view_col_arr=[''];
$this->select_col_arr=[
    "num_per_page"=>[
        ['value'=>'10','text'=>'10'],
        ['value'=>'20','text'=>'20'],
        ['value'=>'30','text'=>'30'],
        ['value'=>'50','text'=>'50'],
        ['value'=>'100','text'=>'100'],
        ['value'=>'200','text'=>'200'],
        ['value'=>'300','text'=>'300'],
        ['value'=>'300','text'=>'500'],
        ['value'=>'300','text'=>'700'],
        ['value'=>'300','text'=>'1000']
    ],
    "fix_left_num"=>[
        ['value'=>'0','text'=>'0'],
        ['value'=>'1','text'=>'1'],
        ['value'=>'2','text'=>'2'],
        ['value'=>'3','text'=>'3'],
        ['value'=>'4','text'=>'4'],
        ['value'=>'5','text'=>'5'],
        ['value'=>'6','text'=>'6'],
        ['value'=>'7','text'=>'7'],
        ['value'=>'8','text'=>'8'],
        ['value'=>'9','text'=>'9'],
        ['value'=>'10','text'=>'10']
    ],
    "s_date_start"=>[
        ['value'=>'month 1','text'=>'이번달'],
        ['value'=>'month 2','text'=>'지난달부터'],
        ['value'=>'day 1','text'=>'오늘'],
        ['value'=>'day 2','text'=>'어제'],
        ['value'=>'day 3','text'=>'3일'],
        ['value'=>'day 7','text'=>'7일']
    ],
    's_date_type'=>[
        ['value'=>'','text'=>'기본값']
    ],
    'order_type'=>[
        ['value'=>'DESC','text'=>'역순'],
        ['value'=>'','text'=>'기본']
    ],
    'order_type2'=>[
        ['value'=>'','text'=>'기본'],
        ['value'=>'DESC','text'=>'역순']
    ],
    'order_type3'=>[
        ['value'=>'','text'=>'기본'],
        ['value'=>'DESC','text'=>'역순']
    ],
    "list_arr_num"=>[
        ['value'=>'0','text'=>'지정1'],
        ['value'=>'1','text'=>'지정2'],
        ['value'=>'2','text'=>'지정3'],
        ['value'=>'3','text'=>'지정4'],
        ['value'=>'4','text'=>'지정5'],
        ['value'=>'5','text'=>'지정6'],
        ['value'=>'6','text'=>'지정7'],
        ['value'=>'7','text'=>'지정8'],
        ['value'=>'8','text'=>'지정9'],
        ['value'=>'9','text'=>'지정10'],
    ]
];
