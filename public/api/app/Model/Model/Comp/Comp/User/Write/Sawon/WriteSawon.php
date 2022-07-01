<?php
namespace App\Model\Model\Comp\Comp\User\Write\Sawon;

use App\Model\Model\Comp\Comp\Sawon\SawonModel;

class WriteSawon
{
    public static function action($in_opt_arr){
        $opt_arr=[
            'baseModel'=>null,
            'data_col_val_arr'=>[],
            'i'=>'0',
            'orig_opt'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $row_idx=$opt_arr['i'];
        $row_data=$opt_arr['orig_opt']['data_arr'][$row_idx];

        $sawon_is_update='';
        if(!empty($opt_arr['pre_info'])){
            if(!empty($opt_arr['pre_info']['link_code'])){
                $row_data['sawon_code']=$opt_arr['pre_info']['link_code'];
                $sawon_is_update='1';
            }
        }

        $sawonModel=new SawonModel(['baseModel'=>$opt_arr['baseModel']]);
        $tmp_rs=$sawonModel->write([
            'data_arr'=>[$row_data],
            'is_update'=>$sawon_is_update
        ]);
        if($tmp_rs['result']!='true'){
            $result_arr=['result'=>'false','data'=>$opt_arr,'msg'=>'사원 등록,수정 중 오류.'.$tmp_rs['msg']];
            return $result_arr;
        }
        $sawon_info=$tmp_rs['data'][0];
        $opt_arr['data_col_val_arr']['link_code']=$sawon_info['sawon_code'];

        $result_arr=['result'=>'true','data'=>$opt_arr,'msg'=>'성공'];
        return $result_arr;
    }
}
