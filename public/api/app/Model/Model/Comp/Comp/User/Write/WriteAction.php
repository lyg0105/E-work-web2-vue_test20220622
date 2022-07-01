<?php
namespace App\Model\Model\Comp\Comp\User\Write;

use App\Service\Common\WriteService;
use App\Model\Model\Comp\Comp\User\Write\Check\CheckInputData;
use App\Model\Model\Comp\Comp\User\Write\Sawon\WriteSawon;
use App\Lib\Common\Web;

class WriteAction extends WriteService
{
    public function write($opt_obj){
        if(!empty($opt_obj['table'])){
            $opt_obj['input_table']=$opt_obj['table'];
        }

        $opt_obj['prev_func']=function($opt_arr){

            $tmp_rs=CheckInputData::action($opt_arr);
            if($tmp_rs['result']!='true'){
                $result_arr=['result'=>'false','data'=>['data_col_val_arr'=>$opt_arr['data_col_val_arr']],'msg'=>'데이터 체크 중 오류. '.$tmp_rs['msg']];
                return $result_arr;
            }
            $opt_arr=$tmp_rs['data'];

            $tmp_rs=WriteSawon::action($opt_arr);
            if($tmp_rs['result']!='true'){
                $result_arr=['result'=>'false','data'=>['data_col_val_arr'=>$opt_arr['data_col_val_arr']],'msg'=>'사원등록 중 오류. '.$tmp_rs['msg']];
                return $result_arr;
            }
            $opt_arr=$tmp_rs['data'];


            $result_arr=['result'=>'true','data'=>['data_col_val_arr'=>$opt_arr['data_col_val_arr']],'msg'=>'성공'];
            return $result_arr;
        };

        $opt_obj['after_func']=function($opt_arr){

            //암호 암호화
            if(isset($opt_arr['data_col_val_arr']['userlist_pwd'])&&!empty($opt_arr['data_col_val_arr']['userlist_pwd'])){
                $opt_arr['baseModel']->db->excute("commit");
                $opt_arr['data_col_val_arr']['userlist_pwd']=Web::checkHtmlStr($opt_arr['data_col_val_arr']['userlist_pwd']);
                $up_sql="UPDATE auserlist SET userlist_pwd=hex(aes_encrypt('".$opt_arr['data_col_val_arr']['userlist_pwd']."', right(userlist_id,4))) WHERE userlist_id='".$opt_arr['data_col_val_arr']['userlist_id']."'";
                $tmp_rs=$opt_arr['baseModel']->db->excute($up_sql);
                if(!$tmp_rs){
                    $result_arr=['result'=>'false','data'=>'','msg'=>'암호화중오류'.$opt_arr['baseModel']->db->get_error()];
                    return $result_arr;
                }
            }

            $result_arr=['result'=>'true','data'=>['data_col_val_arr'=>$opt_arr['data_col_val_arr']],'msg'=>'성공'];
            return $result_arr;
        };

        $result_arr=$this->action($opt_obj);
        return $result_arr;
    }
}
