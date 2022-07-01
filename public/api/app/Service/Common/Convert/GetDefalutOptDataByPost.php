<?php
namespace App\Service\Common\Convert;

use App\Model\Base\Func\DBFunc;
use App\Model\Fix\StaticModel;
use App\Values\Table\TableArr;
use App\Config\Request\Request;
use App\Service\Common\Convert\GetRequestDataByTable;
use App\Lib\Common\Web;

class GetDefalutOptDataByPost
{
    public static function action($in_opt_obj=[]){
        $opt_obj=[
            'is_transaction'=>true,
            'is_commit'=>true,
            'is_return'=>true,
            'is_return_convert'=>true,
            'is_update'=>'',
            'is_update_arr'=>[],
            'is_default_val'=>'',
            'is_debug'=>false,
            'prev_func'=>'',
            'after_func'=>'',
            'baseModel'=>null,
            'requestData'=>Request::$data,
            'input_table'=>'',//테이블 검사 중 우선검사
            'table'=>'',//이후검사
            'table_opt'=>'',

            's_dlit_code'=>'',

            'data_arr'=>[],
            'data_length'=>0,
            'input_row_num_arr'=>[],

            'x_column_arr'=>[],
            'pri_col_arr'=>[],
            'last_pri_col'=>[],
            'is_num_col_arr'=>[],
            'date_col_arr'=>[],
            'is_time_col_arr'=>[],
        ];

        foreach($in_opt_obj as $key=>$val){
            $opt_obj[$key]=$val;
        }
        if(empty($opt_obj['data_arr'])){
            $by_request_col_arr=[
                'input_table',
                'table',
                'is_update',
                'is_default_val',
                'is_update_arr'
            ];
            foreach($by_request_col_arr as $key){
                if(empty($opt_obj[$key])){
                    $opt_obj[$key]=Request::get($key);
                }
            }
            if(empty($opt_obj['input_table'])&&!empty($opt_obj['requestData']['table'])){
                $opt_obj['input_table']=$opt_obj['requestData']['table'];
            }
        }
        if(!empty($opt_obj['table'])&&empty($opt_obj['input_table'])){
            $opt_obj['input_table']=$opt_obj['table'];
        }

        $table_opt=TableArr::getTable($opt_obj['input_table']);
        if(empty($table_opt)){
            $result_arr=['result'=>'false','data'=>'','msg'=>'input 테이블 정보 없음.'];
            return $result_arr;
        }
        $opt_obj['input_table']=$table_opt['table_id'];
        $opt_obj['table']=$table_opt['table'];
        $opt_obj['table_opt']=$table_opt;

        $opt_obj['s_dlit_code']=!empty($opt_obj['s_dlit_code'])?$opt_obj['s_dlit_code']:'';
        if(empty($opt_obj['data_arr'])){
            if(empty($opt_obj['s_dlit_code'])&&!empty($opt_obj['requestData']['s_dlit_code'])){
                $opt_obj['s_dlit_code']=$opt_obj['requestData']['s_dlit_code'];
            }
        }
        if(!empty($opt_obj['s_dlit_code'])){
            $tmp_rs=DBfunc::getBaseModelBydlitId(['dlit_code'=>$opt_obj['s_dlit_code']]);
            if($tmp_rs['result']!='true'){
                $result_arr=['result'=>'false','data'=>'','msg'=>'보안코드접근 중오류.'.$tmp_rs['msg']];
                return $result_arr;
            }
            $opt_obj['baseModel']=$tmp_rs['data'];
        }


        if(empty($opt_obj['table'])){
            $result_arr=['result'=>'false','data'=>'','msg'=>'테이블 정보가 없습니다.','error'=>[]];
            return $result_arr;
        }

        if(empty($opt_obj['data_arr'])){
            $tmp_opt_obj=[
                'table'=>$opt_obj['table'],
                'requestData'=>$opt_obj['requestData'],
                'baseModel'=>$opt_obj['baseModel']
            ];
            $tmp_rs=GetRequestDataByTable::action($tmp_opt_obj);
            if($tmp_rs['result']!='true'){
                $result_arr=['result'=>'false','data'=>'','msg'=>'데이터 받는 중 오류. getRequestData '.$tmp_rs['msg']];
                return $result_arr;
            }
            $opt_obj['data_arr']=$tmp_rs['data']['data_arr'];
            $opt_obj['input_row_num_arr']=!empty($tmp_rs['data']['input_row_num_arr'])?$tmp_rs['data']['input_row_num_arr']:[];
            $opt_obj['x_column_arr']=$tmp_rs['data']['x_column_arr'];
            $opt_obj['pri_col_arr']=$tmp_rs['data']['pri_col_arr'];
            $opt_obj['last_pri_col']=$tmp_rs['data']['last_pri_col'];
            $opt_obj['is_num_col_arr']=$tmp_rs['data']['is_num_col_arr'];
            $opt_obj['date_col_arr']=$tmp_rs['data']['date_col_arr'];
            $opt_obj['is_time_col_arr']=$tmp_rs['data']['is_time_col_arr'];
            $opt_obj['data_length']=count($opt_obj['data_arr']);
        }else{
            $opt_obj['data_arr']=Web::getConvertedPrefixInfoArr($opt_obj['data_arr'],['prefix'=>'a','change_prefix'=>$table_opt['col_prefix']]);
            $opt_obj['data_arr']=$opt_obj['data_arr'];
            $opt_obj['input_row_num_arr']=[];
            $opt_obj['x_column_arr']=DBFunc::getXColumnArrByTableName(['table'=>$opt_obj['table'],'baseModel'=>$opt_obj['baseModel']]);
            $tmp_rs=DBFunc::getDetailByXColumnArr($opt_obj['x_column_arr']);
            $opt_obj['pri_col_arr']=$tmp_rs['pri_col_arr'];
            $opt_obj['last_pri_col']=$tmp_rs['last_pri_col'];
            $opt_obj['date_col_arr']=$tmp_rs['is_date_col_arr'];
            $opt_obj['is_num_col_arr']=$tmp_rs['is_number_col_arr'];
            $opt_obj['is_time_col_arr']=$tmp_rs['is_time_col_arr'];
            $opt_obj['data_length']=count($opt_obj['data_arr']);
        }

        //기본값 세팅 정보
        if(empty($opt_obj['is_update'])){
            if(!empty($opt_obj['is_default_val'])){
                $tmp_data_arr=[];
                foreach($opt_obj['data_arr'] as $data_row){
                    foreach($opt_obj['x_column_arr'] as $key=>$val){
                        if(!isset($data_row[$key])){
                            $data_row[$key]='';
                        }
                    }
                    $tmp_data_arr[]=$data_row;
                }
                $opt_obj['data_arr']=$tmp_data_arr;
            }
        }

        $result_arr=['result'=>'true','data'=>$opt_obj,'msg'=>'성공'];
        return $result_arr;
    }
}
