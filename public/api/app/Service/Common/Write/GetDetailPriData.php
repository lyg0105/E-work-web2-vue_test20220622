<?php
namespace App\Service\Common\Write;

use App\Model\Base\Func\DBFunc;

class GetDetailPriData
{
    public static function getDetailPriData($opt_obj){
        $baseModel=$opt_obj['baseModel'];
        $table=$opt_obj['table'];
        $table_opt=$opt_obj['table_opt'];
        $table_tail_str=$opt_obj['table_tail_str'];
        $tmp_is_update=$opt_obj['tmp_is_update'];
        $data_col_val_arr=$opt_obj['data_col_val_arr'];
        $pri_col_arr=$opt_obj['pri_col_arr'];
        $last_pri_col=$opt_obj['last_pri_col'];
        $i=$opt_obj['i'];
        $pre_pri_col_val=[];
        $pre_info=null;
        $pri_col_val_arr=[];

        if(empty($tmp_is_update)){
            //년별테이블 없으면 생성
            if(!DBFunc::hasTable(['baseModel'=>$baseModel,'table_name'=>$table.$table_tail_str])){
                $tmp_rs=DBFunc::getCreateSqlOfTable(['from_table_name'=>$table,'table_name'=>$table.$table_tail_str,'baseModel'=>$baseModel]);
                if($tmp_rs['result']!='true'){
                    $result_arr=['result'=>'false','data'=>'','msg'=>'테이블 생성 중 오류.1'];
                    return $result_arr;
                }
                $create_sql=$tmp_rs['data'];
                $tmp_rs=$baseModel->db->excute($create_sql);
                if(!$tmp_rs){
                    $result_arr=['result'=>'false','data'=>'','msg'=>'테이블 생성 중 오류.2'];
                    return $result_arr;
                }
            }
           //키값이 없으면 만들기
           $tmp_pri_col_val_arr=array();
           if(empty($data_col_val_arr[$last_pri_col])){
                $tmp_pre_val_arr=array();
                foreach($pri_col_arr as $key){
                     if($key!=$last_pri_col){
                          $tmp_pre_val_arr[]=$data_col_val_arr[$key];
                          $tmp_pri_col_val_arr[$key]=$data_col_val_arr[$key];
                     }
                }
                $tmp_pre_val_str=implode(",",$tmp_pre_val_arr);
                if(empty($tmp_pre_val_str)){$tmp_pre_val_str='empty_key';}
                if(isset($pre_pri_col_val[$tmp_pre_val_str])){
                     $pre_pri_col_val[$tmp_pre_val_str]++;
                }else{
                     $pre_pri_col_val[$tmp_pre_val_str]=DBfunc::getAutoIncrementNum([
                         'baseModel'=>$baseModel,
                         'table'=>$table.$table_tail_str,
                         'auto_key'=>$last_pri_col,
                         'pri_col_val'=>$tmp_pri_col_val_arr,
                         'pri_pre_fix'=>$table_opt['pri_prefix_str'],
                     ]);
                }
                $last_pri_val_str=$pre_pri_col_val[$tmp_pre_val_str];
                if(!empty($table_opt['pri_prefix_zero_size'])){
                    $last_pri_val_str=str_pad($last_pri_val_str,$table_opt['pri_prefix_zero_size'],'0',STR_PAD_LEFT);
                }
                if(!empty($table_opt['pri_prefix_str'])){
                    $last_pri_val_str=$table_opt['pri_prefix_str'].$last_pri_val_str;
                }
                $data_col_val_arr[$last_pri_col]=$last_pri_val_str;
           }
           foreach($pri_col_arr as $key){
                $pri_col_val_arr[$key]=$data_col_val_arr[$key];
           }
       }else{
           //수정 (키컬럼 제외)
           $pri_where_arr=array();
           foreach($pri_col_arr as $key){
                $pri_col_val_arr[$key]=$data_col_val_arr[$key];
           }

           if(!empty($w_key_arr)&&!empty($w_val_arr)){
                $pri_col_val_arr=array();
                $a=0;
                foreach($w_key_arr as $key){
                     $pri_col_val_arr[$key]=$w_val_arr[$i][$a];
                     $a++;
                }
           }

           if(!empty($pri_col_val_arr)){
                $tmp_w=array();
                foreach($pri_col_val_arr as $key=>$val){
                     $tmp_w[]="AND {$key}='{$val}'";
                }
                $sql_opt=array('t'=>$table.$table_tail_str,'w'=>$tmp_w,'o'=>1);
                $pre_info=$baseModel->db->get_info_arr($sql_opt, $debug = null);
           }
       }
       $result_data_arr=[
           'pri_col_val_arr'=>$pri_col_val_arr,
           'data_col_val_arr'=>$data_col_val_arr,
           'pre_info'=>$pre_info,
       ];

       $result_arr=['result'=>'true','data'=>$result_data_arr,'msg'=>'성공'];
       return $result_arr;
    }
}
