<?php
namespace App\Values\XColumn\XColmun;

use App\Lib\Common\Web;

class GetArrOfCoverPrefix
{
    public static function action($in_opt_arr=[]){
        $opt_arr=[
            'data'=>[],
            'prefix'=>'',
            'cover_str'=>'a_'
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }

        if(empty($opt_arr['prefix'])){
            return $opt_arr['data'];
        }

        $tmp_data_arr=[];
        foreach($opt_arr['data'] as $key=>$val){
            if(gettype($key)=='string'){
                if(substr($key,0,strlen($opt_arr['prefix']))==$opt_arr['prefix']){
                    $key=Web::strReplace($opt_arr['prefix'],$opt_arr['cover_str'],$key);
                }
                $tmp_data_arr[$key]=$val;
            }else if(gettype($val)=='string'){
                if(substr($val,0,strlen($opt_arr['prefix']))==$opt_arr['prefix']){
                    $val=Web::strReplace($opt_arr['prefix'],$opt_arr['cover_str'],$val);
                }
                $tmp_data_arr[$key]=$val;
            }
        }
        $opt_arr['data']=$tmp_data_arr;

        return $opt_arr['data'];
    }
}
