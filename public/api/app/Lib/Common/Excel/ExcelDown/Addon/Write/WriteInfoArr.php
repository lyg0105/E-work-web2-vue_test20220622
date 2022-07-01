<?php
namespace App\Lib\Common\Excel\ExcelDown\Addon\Write;

class WriteInfoArr
{
    public static function action($in_opt_arr=[]){
        $opt_arr=[
            'objPHPExcel'=>null,
            'x_column_list_arr'=>[],//[ 'jasa_title'=>['name'=>'회사상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'], ]
            'x_pri_col_arr'=>[],
            'info_arr'=>[],
            'is_date_col_arr'=>[],
            'i'=>1,
            'max_a'=>0,
            'abc_array'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $i=$opt_arr['i'];

        foreach($opt_arr['info_arr'] as $info){
            $a=0;
            foreach($opt_arr['x_column_list_arr'] as $key=>$val){
                $val_str='';
                if(isset($info[$key])){
                    $val_str=$info[$key];
                }else if($key=='pri_val'){
                    $tmp_pri_val_arr=[];
                    foreach($opt_arr['x_pri_col_arr'] as $pri_key){
                        $tmp_pri_val_arr[]=$info[$pri_key];
                    }
                    $val_str=implode(',',$tmp_pri_val_arr);
                }

                if(in_array($key,$opt_arr['is_date_col_arr'])){
                    $val_str=substr($val_str,0,10);
                }

                $opt_arr['sheet']->setCellValue($opt_arr['abc_array'][$a].$i,$val_str);
                $a++;
            }
            $i++;
        }

        $result_data_arr=['i'=>$i];
        $result_arr=['result'=>'true','data'=>$result_data_arr,'msg'=>'성공'];
        return $result_arr;
    }
}
