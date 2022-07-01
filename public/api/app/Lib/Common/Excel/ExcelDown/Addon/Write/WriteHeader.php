<?php
namespace App\Lib\Common\Excel\ExcelDown\Addon\Write;

class WriteHeader
{
    public static function action($in_opt_arr=[]){
        $opt_arr=[
            'objPHPExcel'=>null,
            'x_column_list_arr'=>[],//[ 'jasa_title'=>['name'=>'회사상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'], ]
            'i'=>1,
            'max_a'=>0,
            'abc_array'=>[],
            'is_header_key'=>true
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $i=$opt_arr['i'];

        if(!empty($opt_arr['is_header_key'])){
            $a=0;
            foreach($opt_arr['x_column_list_arr'] as $key=>$val){
                $opt_arr['sheet']->setCellValue($opt_arr['abc_array'][$a].$i,$key);
                $a++;
            }
            $i++;
        }

        $a=0;
        foreach($opt_arr['x_column_list_arr'] as $key=>$val){
            $opt_arr['sheet']->setCellValue($opt_arr['abc_array'][$a].$i,$val['name']);
            $a++;
        }
        $i++;

        $result_data_arr=['i'=>$i];
        $result_arr=['result'=>'true','data'=>$result_data_arr,'msg'=>'성공'];
        return $result_arr;
    }
}
