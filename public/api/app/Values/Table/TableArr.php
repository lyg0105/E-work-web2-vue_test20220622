<?php
namespace App\Values\Table;

class TableArr
{
    //split : 년별,월별 등 불리 테이블. 년별:y, 월별:ym, 일별:ymd  (소문자로넣자)
    //type : 테이블 성격, basic, project
    //col_prefix : 없으면 table_id, 있으면 col_prefix,  컬럼의 접두어다.
    public static $tb=[
        'userlist'=>['table'=>'auserlist','name'=>'회원','split'=>'','type'=>'comp','col_prefix'=>''],
        'sawon'=>['table'=>'asawon','name'=>'사원','split'=>'','type'=>'comp','col_prefix'=>'','pri_prefix'=>'sa','pri_prefix_date'=>'Ym','pri_prefix_zero_size'=>6],
        'jasa'=>['table'=>'ajasa','name'=>'자사','split'=>'','type'=>'comp','col_prefix'=>'','pri_prefix'=>'ja','pri_prefix_date'=>'Ym','pri_prefix_zero_size'=>6],
        'cust'=>['table'=>'acust','name'=>'거래처','split'=>'','type'=>'comp','col_prefix'=>'','pri_prefix'=>'cu','pri_prefix_date'=>'Ym','pri_prefix_zero_size'=>6],
        'chazu'=>['table'=>'achazu','name'=>'차주','split'=>'','type'=>'comp','col_prefix'=>'','pri_prefix'=>'cz','pri_prefix_date'=>'Ym','pri_prefix_zero_size'=>6],

        'cargo'=>['table'=>'acargo','name'=>'화물','split'=>'','type'=>'comp','col_prefix'=>'','pri_prefix'=>'ca','pri_prefix_date'=>'Ym','pri_prefix_zero_size'=>6],
        'cargostring'=>['table'=>'acargostring','name'=>'화물문자','split'=>'','type'=>'comp','col_prefix'=>'','pri_prefix'=>'ca','pri_prefix_date'=>'Ym','pri_prefix_zero_size'=>6],
        'addplaces'=>['table'=>'aaddplaces','name'=>'경유지','split'=>'','type'=>'comp','col_prefix'=>''],
        'cargogum'=>['table'=>'acargogum','name'=>'추가청구료','split'=>'','type'=>'comp','col_prefix'=>''],
        'bechagum'=>['table'=>'abechagum','name'=>'추가운송료','split'=>'','type'=>'comp','col_prefix'=>''],


        'bill'=>['table'=>'anote_bill','name'=>'거래명세서','split'=>'y','type'=>'comp','col_prefix'=>'bill'],
        'cargo_note'=>['table'=>'anote_cargo','name'=>'배차일보','split'=>'y','type'=>'comp','col_prefix'=>'note'],
        'nca'=>['table'=>'anote_cargo_add','name'=>'배차일보추가금액','split'=>'y','type'=>'comp','col_prefix'=>'nca'],

        'subject'=>['table'=>'anote_subject','name'=>'계정과목','split'=>'','type'=>'comp','col_prefix'=>'subject'],
        'subject_detail'=>['table'=>'anote_subject_detail','name'=>'계정과목상세','split'=>'','type'=>'comp','col_prefix'=>'nsd'],
        'tax'=>['table'=>'anote_tax','name'=>'세금계산서','split'=>'y','type'=>'comp','col_prefix'=>'tax'],
        'trade'=>['table'=>'anote_trade_row','name'=>'입출금내역','split'=>'y','type'=>'comp','col_prefix'=>'trade'],
        'nlo'=>['table'=>'anote_list_opt','name'=>'리스트설정','split'=>'','type'=>'comp','col_prefix'=>'nlo'],

        'popbill_user'=>['table'=>'apopbill_user','name'=>'팝빌유저','split'=>'','type'=>'comp','col_prefix'=>''],
        'popbill_user'=>['table'=>'apopbill_corp','name'=>'팝빌회사정보','split'=>'','type'=>'comp','col_prefix'=>''],
    ];

    public static function getTable($table_str){
        $result_data=null;
        if(isset(self::$tb[$table_str])){
            $result_data=self::$tb[$table_str];
            $result_data['table_id']=$table_str;
        }else{
            foreach(self::$tb as $key=>$val){
                if($val['table']==$table_str){
                    $result_data=$val;
                    $result_data['table_id']=$key;
                }
            }
        }
        if(!empty($result_data)){
            if(empty($result_data['col_prefix'])){
                //$result_data['col_prefix']=$result_data['table_id'];
            }

            $result_data['split_length']=0;
            if($result_data['split']=='y'){
                $result_data['split_length']=4;
            }else if($result_data['split']=='ym'){
                $result_data['split_length']=6;
            }else if($result_data['split']=='ymd'){
                $result_data['split_length']=8;
            }

            $result_data['pri_prefix_str']=self::getPriPrefixByTable($result_data);
        }

        return $result_data;
    }
    public static function getTableTailStr($table_str,$data_col_val_arr){
        $table_opt=self::getTable($table_str);
        $table_tail_str='';
        if(!empty($table_opt['split_length'])){
            $key_ymd=$table_opt['col_prefix'].'_ymd';
            if(isset($data_col_val_arr[$key_ymd])&&!empty($data_col_val_arr[$key_ymd])){
                $table_tail_str='_'.$table_opt['split'].substr($data_col_val_arr[$key_ymd],0,$table_opt['split_length']);
            }
        }
        return $table_tail_str;
    }
    public static function get($table_str){
        return self::getTable($table_str);
    }

    public static function getPriPrefixByTable($tb_info){
        $prefix_str='';

        if(!empty($tb_info)){
            if(!empty($tb_info['pri_prefix'])){
                $prefix_str=$tb_info['pri_prefix'];
                if(!empty($tb_info['pri_prefix_date'])){
                    $prefix_str.=date($tb_info['pri_prefix_date']);
                }
            }
        }

        return $prefix_str;
    }
}
