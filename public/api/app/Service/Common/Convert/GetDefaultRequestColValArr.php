<?php
namespace App\Service\Common\Convert;

use App\Config\Session\Session;

class GetDefaultRequestColValArr
{
    public static function action($in_opt_arr){
        $pri_col_arr=$in_opt_arr['pri_col_arr'];
        $last_pri_col=$in_opt_arr['last_pri_col'];
        $col_val_arr=$in_opt_arr['col_val_arr'];
        $is_num_col_arr=$in_opt_arr['is_num_col_arr'];
        $date_col_arr=$in_opt_arr['date_col_arr'];
        $is_time_col_arr=$in_opt_arr['is_time_col_arr'];
        $x_column_arr=$in_opt_arr['x_column_arr'];

        $result_arr=array('result'=>'false','data'=>'','msg'=>'데이터 없음.');
        $result_col_val_arr=array();
        foreach($col_val_arr as $key=>$val){
            if(!isset($x_column_arr[$key])){continue;}
            $val_str=$val;

            //max_length 맞추기
            if(!empty($x_column_arr[$key]['length'])&&$x_column_arr[$key]['length']!=1){
                $val_str=mb_substr($val_str,0,$x_column_arr[$key]['length'],"UTF-8");
            }

            if(strstr($key,'_create_id')!==false||strstr($key,'_update_id')!==false){
                if(empty($val_str)){
                    $val_str=Session::get('user_id');
                }
            }else if(in_array($key,$is_num_col_arr)){
                if(empty($val_str)){$val_str='0';}
                $val_str= preg_replace("/[^0-9.-]*/s", "",$val_str);
                $val_str=str_replace(',','',$val_str);
                if(!is_numeric($val_str)){
                    $result_arr=array('result'=>'false','data'=>$col_val_arr,'msg'=>$x_column_arr[$key]['name'].' 은 숫자만 입력해 주세요.');
                    return $result_arr;
                }
            }else if(in_array($key,$date_col_arr)){
                if(empty($val_str)){
                    if(in_array($key,$pri_col_arr)){
                        $val_str=date('Y-m-d');
                    }else{
                        $val_str='0000-00-00';
                        if(strstr($key,'create_date')!==false){
                            $val_str=date('Y-m-d H:i:s');
                        }
                    }
                }else{
                    if(strstr($key,'update_date')!==false){
                        $val_str=date('Y-m-d H:i:s');
                    }
                }
            }else if(in_array($key,$is_time_col_arr)){
                if(in_array($key,$pri_col_arr)){
                    $val_str=date('H:i:s');
                }else{
                    $val_str='00:00:00';
                }
            }

            $result_col_val_arr[$key]=$val_str;
        }
        $col_val_arr=$result_col_val_arr;
        $result_arr=array('result'=>'true','data'=>$col_val_arr,'msg'=>'성공');
        return $result_arr;
    }
}
