<?php
namespace App\Model\Model\Comp\Comp\User\Delete;

use App\Service\Common\DeleteService;
use App\Values\Table\TableArr;

class DeleteAction extends DeleteService
{
    public function delete($opt_obj){
        if(!empty($opt_obj['table'])){
            $opt_obj['input_table']=$opt_obj['table'];
        }

        $opt_obj['prev_func']=function($opt_arr){

            if(!empty($opt_arr['pre_info']['link_code'])&&$opt_arr['pre_info']['userlist_sugub']=='S'){
                $tmp_w=["AND sawon_code='".$opt_arr['pre_info']['link_code']."'"];
                $sql_opt=['table'=>TableArr::get('sawon')['table'],'w'=>$tmp_w];
                $tmp_rs=$opt_arr['baseModel']->db->delete($sql_opt);
                if(!$tmp_rs){
                    $result_arr=['result'=>'false','data'=>'','msg'=>'사원삭제 중 오류.'];
                    return $result_arr;
                }
            }

            $result_arr=['result'=>'true','data'=>['col_val_arr'=>$opt_arr['col_val_arr']],'msg'=>'성공'];
            return $result_arr;
        };

        $opt_obj['after_func']=function($opt_arr){
            $result_arr=['result'=>'true','data'=>['col_val_arr'=>$opt_arr['col_val_arr']],'msg'=>'성공'];
            return $result_arr;
        };

        $result_arr=$this->action($opt_obj);
        return $result_arr;
    }
}
