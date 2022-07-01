<?php
namespace App\Service\Common\Convert;

use App\Model\Base\Func\DBFunc;
use App\Model\Fix\StaticModel;
use App\Values\Table\TableArr;
use App\Config\Request\Request;
use App\Lib\Common\Web;

class GetRequestDataByTable
{
    public static function action($opt_obj){
        $requestData=Request::$data;
        $table=$opt_obj['table'];
        $table_opt=TableArr::getTable($table);
        $col_prefix=$table_opt['col_prefix'];
        $baseModel=isset($opt_obj['baseModel'])?$opt_obj['baseModel']:StaticModel::$db;

        $x_column_arr=DBFunc::getXColumnArrByTableName(['table'=>$table,'baseModel'=>$baseModel]);

        $result_arr=array('result'=>'false','data'=>'','msg'=>'키정보가 없습니다.');
        $tmp_rs=DBFunc::getDetailByXColumnArr($x_column_arr);
        $pri_col_arr=$tmp_rs['pri_col_arr'];
        $last_pri_col=$tmp_rs['last_pri_col'];
        $date_col_arr=$tmp_rs['is_date_col_arr'];
        $is_num_col_arr=$tmp_rs['is_number_col_arr'];
        $is_time_col_arr=$tmp_rs['is_time_col_arr'];

        $data_arr=array();
        $input_row_num=array();
        $data_length=0;
        if(isset($requestData['data_arr'])){
            foreach($requestData['data_arr'] as $idx=>$data_row){
                if(!isset($data_arr[$idx])){$data_arr[$idx]=array();}
                if(!isset($input_row_num[$idx])){$input_row_num[$idx]=array();}
                foreach($data_row as $key=>$val){
                    if(substr($key,0,2)=='a_'){
                        $key=Web::strReplace('a_',$col_prefix.'_',$key);
                    }else if(strstr($key,'_a_')!==false){
                        $key=Web::strReplace('_a_','_'.$col_prefix.'_',$key);
                    }
                    $data_arr[$idx][$key]=$val;
                }
                $input_row_num[$idx]=isset($data_row['input_row_num'])?$data_row['input_row_num']:$idx;
            }
            $data_length=count($data_arr);
        }

        //프라이머리키값만 있는 배열
        $w_arr=isset($requestData['w_arr'])?$requestData['w_arr']:array();

        $return_data_arr=array(
            'data_arr'=>$data_arr,
            'row_num_arr'=>$input_row_num,
            'x_column_arr'=>$x_column_arr,
            'pri_col_arr'=>$pri_col_arr,
            'last_pri_col'=>$last_pri_col,
            'is_num_col_arr'=>$is_num_col_arr,
            'date_col_arr'=>$date_col_arr,
            'is_time_col_arr'=>$is_time_col_arr,
            'data_length'=>$data_length,
            'w_arr'=>$w_arr
        );
        $result_arr=array('result'=>'true','data'=>$return_data_arr,'msg'=>'성공');
        return $result_arr;
    }
}
