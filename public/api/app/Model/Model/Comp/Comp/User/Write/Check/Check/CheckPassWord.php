<?php
namespace App\Model\Model\Comp\Comp\User\Write\Check\Check;

class CheckPassWord
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

        if(!isset($opt_obj['data_col_val_arr']['userlist_pwd'])){
            if(empty($opt_obj['is_update'])){
                $result_arr=['result'=>'false','data'=>$opt_obj,'msg'=>'암호가 없습니다.'];
                return $result_arr;
            }else{
                $result_arr=['result'=>'true','data'=>$opt_obj,'msg'=>'수정할 암호 없음.'];
                return $result_arr;
            }
        }

        if(empty($opt_obj['data_col_val_arr']['userlist_pwd'])){
            if(empty($opt_obj['is_update'])){
                $result_arr=['result'=>'false','data'=>$opt_obj,'msg'=>'암호 입력이 없습니다.'];
                return $result_arr;
            }else{
                //pw 제외
                $tmp_col_val_arr=[];
                foreach($opt_obj['data_col_val_arr'] as $key=>$val){
                    if($key!='userlist_pwd'){
                        $tmp_col_val_arr[$key]=$val;
                    }
                }
                $opt_obj['data_col_val_arr']=$tmp_col_val_arr;
                $result_arr=['result'=>'true','data'=>$opt_obj,'msg'=>'수정할 암호 없음.'];
                return $result_arr;
            }
        }

        $result_arr=['result'=>'true','data'=>$opt_obj,'msg'=>'성공'];
        return $result_arr;
    }
}
