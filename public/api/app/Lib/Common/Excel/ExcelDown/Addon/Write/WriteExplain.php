<?php
namespace App\Lib\Common\Excel\ExcelDown\Addon\Write;

class WriteExplain
{
    public static function action($in_opt_arr=[]){
        $opt_arr=[
            'objPHPExcel'=>null,
            'x_column_list_arr'=>[],//[ 'jasa_title'=>['name'=>'회사상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'], ]
            'select_col_arr'=>[],
            'is_date_col_arr'=>[],
            'i'=>1,
            'max_a'=>0,
            'abc_array'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $i=$opt_arr['i'];

        $data_type_json_data=array(
            'date'=>'날짜',
            'datetime'=>'날짜',
            'time'=>'시간',
            'varchar'=>'문자',
            'char'=>'문자',
            'mediumtext'=>'문자',
            'float'=>'숫자',
            'double'=>'숫자',
            'decimal'=>'숫자',
            'int'=>'숫자',
            'bigint'=>'숫자'
        );
        $lfcr=chr(10);//줄바꿈 단어

        $i=$opt_arr['i'];
        $a=0;
        foreach($opt_arr['x_column_list_arr'] as $key=>$val){
            $type_str=$val['type'];
            $tmp_title="";

            if(strstr($type_str,"(")!==false){
                $type_str=explode("(",$type_str)[0];
            }
            if(isset($data_type_json_data[$type_str])){
                $type_str=$data_type_json_data[$type_str];
            }
            if(!empty($val['length'])){
                if(strstr($type_str,"(")===false){
                    $type_str.="(".$val['length'].")";
                }
            }
            if(!empty($opt_arr['is_date_col_arr'])){
                if(in_array($key,$opt_arr['is_date_col_arr'])){
                    $type_str="날짜";
                }
            }
            if(strstr($type_str,"날짜")!==false){
                $tmp_title="년-월-일".$lfcr."(예:".date('Y-m-d').")";
            }
            if(!empty($opt_arr['select_col_arr'])){
                if(isset($opt_arr['select_col_arr'][$key])){
                    $type_str="선택";
                    $tmp_title="예시".$lfcr;
                    $tmp_title_row_arr=array();
                    foreach($opt_arr['select_col_arr'][$key] as $tmp_s_d){
                        $tmp_title_row_arr[]=$tmp_s_d['text']."=".$tmp_s_d['value'];
                    }
                    $tmp_title_row_str=implode($lfcr,$tmp_title_row_arr);
                    $tmp_title.=$tmp_title_row_str;
                }
            }
            $type_str.=$lfcr.$tmp_title;
            if($key=='pri_val'){
                $type_str='고유번호를 수정하거나 삭제하면 덮어쓰기 할 수 없습니다.';
            }

            $opt_arr['sheet']->getStyle($opt_arr['abc_array'][$a].$i)->getAlignment()->setWrapText(true);//줄바꿈세팅
            $opt_arr['sheet']->setCellValue($opt_arr['abc_array'][$a].$i,$type_str);
            $a++;
        }
        $i++;

        $result_data_arr=['i'=>$i];
        $result_arr=['result'=>'true','data'=>$result_data_arr,'msg'=>'성공'];
        return $result_arr;
    }
}
