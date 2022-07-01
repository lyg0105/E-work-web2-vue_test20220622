<?php
namespace App\Model\Model\Comp\Comp\User\Write\Check\Check;

use App\Values\Table\TableArr;

class CheckId
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

        if(!isset($opt_obj['data_col_val_arr']['userlist_id'])){
            if(empty($opt_obj['is_update'])){
                $result_arr=['result'=>'false','data'=>$opt_obj,'msg'=>'아이디가 없습니다.'];
                return $result_arr;
            }else{
                $result_arr=['result'=>'true','data'=>$opt_obj,'msg'=>'수정할 아이디 없음.'];
                return $result_arr;
            }
        }

        if(empty($opt_obj['data_col_val_arr']['userlist_id'])){
            $result_arr=['result'=>'false','data'=>$opt_obj,'msg'=>'아이디 입력이 없습니다.'];
            return $result_arr;
        }

        //중복검사
        $tmp_w=["AND userlist_id='".$opt_obj['data_col_val_arr']['userlist_id']."'"];
        if(!empty($opt_obj['pre_info'])){
            $tmp_w[]="AND userlist_id!='".$opt_obj['pre_info']['userlist_id']."'";
        }
        $sql_opt=['t'=>TableArr::get('userlist')['table'],'w'=>$tmp_w,'o'=>'1','g'=>'COUNT(*) AS tot'];
        $ceo_count_info=$opt_obj['baseModel']->db->get_info_arr($sql_opt);
        if(!empty($ceo_count_info['tot'])){
            $result_arr=['result'=>'false','data'=>$opt_obj,'msg'=>'중복아이디 있음.'.$opt_obj['data_col_val_arr']['userlist_id']];
            return $result_arr;
        }

        $result_arr=['result'=>'true','data'=>$opt_obj,'msg'=>'성공'];
        return $result_arr;
    }
}
