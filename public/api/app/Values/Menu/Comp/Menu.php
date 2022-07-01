<?php
$this->menu=[
    'head'=>[
        'comp'=>['name'=>'기초자료','url'=>'','msg'=>''],
        'note'=>['name'=>'정산','url'=>'','msg'=>''],
        //'community'=>['name'=>'커뮤니티','url'=>'javascript:','msg'=>'']
    ],
    'sub'=>[
        'corp_list'=>['name'=>'자사','head'=>'comp','url'=>ROOT_DIR.'comp/comp/corp/list','msg'=>'','list_sort'=>'Comp/Comp/Corp/list'],
        'corp_write'=>['name'=>'자사등록','head'=>'','url'=>ROOT_DIR.'comp/comp/corp/popup/write','msg'=>'','list_sort'=>'Comp/Comp/Corp/write'],

        'user_list'=>['name'=>'사원','head'=>'comp','url'=>ROOT_DIR.'comp/comp/user/list','msg'=>'','list_sort'=>'Comp/Comp/User/list'],
        'user_write'=>['name'=>'사원등록','head'=>'','url'=>ROOT_DIR.'comp/comp/user/popup/write','msg'=>'','list_sort'=>'Comp/Comp/User/write'],

        'cust_list'=>['name'=>'거래처','head'=>'comp','url'=>ROOT_DIR.'comp/comp/cust/list','msg'=>'','list_sort'=>'Comp/Comp/Cust/list'],
        'cust_multy_pop'=>['name'=>'거래처다량','head'=>'','url'=>ROOT_DIR.'comp/comp/cust/popup/multy','msg'=>'','list_sort'=>'Comp/Comp/Cust/list'],
        'cust_find_pop'=>['name'=>'거래처찾기','head'=>'','url'=>ROOT_DIR.'comp/comp/cust/popup/find','msg'=>'','list_sort'=>'Comp/Comp/Cust/find'],

        'chazu_list'=>['name'=>'차주','head'=>'comp','url'=>ROOT_DIR.'comp/comp/chazu/list','msg'=>'','list_sort'=>'Comp/Comp/Chazu/list'],
        'chazu_multy_pop'=>['name'=>'차주다량','head'=>'','url'=>ROOT_DIR.'comp/comp/chazu/popup/multy','msg'=>'','list_sort'=>'Comp/Comp/Chazu/list'],
        'chazu_find_pop'=>['name'=>'차주찾기','head'=>'','url'=>ROOT_DIR.'comp/comp/chazu/popup/find','msg'=>'','list_sort'=>'Comp/Comp/Chazu/find'],

        'cargo_note_list'=>['name'=>'배차일보','head'=>'note','url'=>ROOT_DIR.'comp/note/cargo_note/list','msg'=>'','list_sort'=>'Comp/Note/CargoNote/list'],
        'cargo_note_multy_pop'=>['name'=>'배차일보다량','head'=>'','url'=>ROOT_DIR.'comp/note/cargo_note/popup/multy','msg'=>'','list_sort'=>'Comp/Note/CargoNote/list'],
        'cargo_find_for_note'=>['name'=>'배차일보가져오기','head'=>'','url'=>ROOT_DIR.'comp/cargo/cargo/popup/find_for_note','msg'=>'','list_sort'=>'Comp/Cargo/Cargo/find_for_note'],
        'cargo_note_add_multy_pop'=>['name'=>'배차일보추가금액p','head'=>'','url'=>ROOT_DIR.'comp/note/cargo_note_add/popup/multy_note_add','msg'=>'','list_sort'=>'Comp/Note/CargoNoteAdd/multy_note'],

        'cargo_note_sum'=>['name'=>'집계','head'=>'note','url'=>ROOT_DIR.'comp/note/stat/list','msg'=>'','list_sort'=>''],

        'bill_list'=>['name'=>'명세서(매입매출)','head'=>'note','url'=>ROOT_DIR.'comp/note/bill/list','msg'=>'','list_sort'=>'Comp/Note/Bill/list'],
        'tax_list'=>['name'=>'세금계산서','head'=>'note','url'=>ROOT_DIR.'comp/note/tax/list','msg'=>'','list_sort'=>'Comp/Note/Tax/list'],
        //'trade_list'=>['name'=>'입출금','head'=>'note','url'=>ROOT_DIR.'comp/note/trade/list','msg'=>'','list_sort'=>'Comp/Note/TradeRow/list'],
        'trade_multy'=>['name'=>'입출금다량','head'=>'','url'=>ROOT_DIR.'comp/note/trade/popup/multy','msg'=>'','list_sort'=>'Comp/Note/TradeRow/multy'],
        'trade_cust_frame'=>['name'=>'입출금거래처','head'=>'','url'=>ROOT_DIR.'comp/note/trade/frame/cust/list','msg'=>'','list_sort'=>'Comp/Note/TradeRow/Frame/cust_list'],
        'trade_chazu_frame'=>['name'=>'입출금차주','head'=>'','url'=>ROOT_DIR.'comp/note/trade/frame/chazu/list','msg'=>'','list_sort'=>'Comp/Note/TradeRow/Frame/chazu_list'],

        'popbill_main'=>['name'=>'팝빌메인','head'=>'note','url'=>ROOT_DIR.'comp/popbill/main','msg'=>'','list_sort'=>''],

        'subject_find'=>['name'=>'계정과목f','head'=>'','url'=>ROOT_DIR.'comp/note/subject/popup/find','msg'=>'','list_sort'=>'Comp/Note/Subject/list'],

        'list_opt_pop'=>['name'=>'리스트설정','head'=>'','url'=>ROOT_DIR.'x_templete/list_opt/popup','msg'=>'','list_sort'=>'Comp/Comp/ListOpt/write'],
    ]
];
