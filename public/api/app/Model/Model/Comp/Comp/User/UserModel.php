<?php
namespace App\Model\Model\Comp\Comp\User;

use App\Model\Base\BaseModel;
use App\Model\Fix\StaticModel;
use App\Model\Query\Comp\Comp\User\UserQuery;
use App\Model\Model\Comp\Comp\User\Write\WriteAction;
use App\Model\Model\Comp\Comp\User\Delete\DeleteAction;

class UserModel extends BaseModel
{
    public $table='auserlist';
    function __construct($in_opt_arr=[]){
        $opt_arr=[
            'baseModel'=>StaticModel::$db
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $this->db=$opt_arr['baseModel']->db;
    }

    function list($in_opt_arr=[]){
        $opt_arr=[
            'baseModel'=>$this,
            'table'=>$this->table,
            'sc'=>[],
            'now_page'=>'1',
            'num_per_page'=>'20',
            's_pri_arr'=>[],
            's_user_id'=>'',
            's_jasa_code'=>'',
            's_is_return_pw'=>'',
            'is_convert_col'=>false
            // 'debug'=>'',
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $customQuery=new UserQuery($opt_arr['baseModel']);
        $customQuery->set_list_opt($opt_arr);
        $tmp_rs=$customQuery->getList();
        $result_arr=['result'=>'true','data'=>$tmp_rs,'msg'=>'성공'];
        return $result_arr;
    }

    public function write($in_opt_obj=[]){
        $opt_obj=[
            'table'=>$this->table,
            'baseModel'=>$this,
            'request'=>null
        ];
        foreach($in_opt_obj as $key=>$val){
            $opt_obj[$key]=$val;
        }

        $writeAction=new WriteAction();
        $result_arr=$writeAction->write($opt_obj);
        return $result_arr;
    }

    public function delete($in_opt_obj=[]){
        $opt_obj=[
            'table'=>$this->table,
            'baseModel'=>$this,
            'request'=>null
        ];
        foreach($in_opt_obj as $key=>$val){
            $opt_obj[$key]=$val;
        }

        $deleteAction=new DeleteAction();
        $result_arr=$deleteAction->delete($opt_obj);
        return $result_arr;
    }
}
