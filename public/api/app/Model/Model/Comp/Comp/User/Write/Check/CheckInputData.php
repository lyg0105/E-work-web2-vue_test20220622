<?php
namespace App\Model\Model\Comp\Comp\User\Write\Check;

use App\Model\Model\Comp\Comp\User\Write\Check\Check\CheckId;
use App\Model\Model\Comp\Comp\User\Write\Check\Check\CheckPassWord;

class CheckInputData
{
    public static function action($in_opt_obj){
        $opt_obj=[
            'baseModel'=>null,
            'data_col_val_arr'=>[],
            'pre_info'=>null,
            'is_update'=>''
        ];
        foreach($in_opt_obj as $key=>$val){
            $opt_obj[$key]=$val;
        }

        //아이디체크
        $tmp_rs=CheckId::action($opt_obj);
        if($tmp_rs['result']!='true'){
            $result_arr=['result'=>'false','data'=>$opt_obj,'msg'=>'아이디 체크 중 오류. '.$tmp_rs['msg']];
            return $result_arr;
        }

        //비밀번호 체크
        $tmp_rs=CheckPassWord::action($opt_obj);
        if($tmp_rs['result']!='true'){
            $result_arr=['result'=>'false','data'=>$opt_obj,'msg'=>'암호 체크 중 오류. '.$tmp_rs['msg']];
            return $result_arr;
        }
        $opt_obj=$tmp_rs['data'];

        //이름체크


        $result_arr=['result'=>'true','data'=>$opt_obj,'msg'=>'성공'];
        return $result_arr;
    }
}
