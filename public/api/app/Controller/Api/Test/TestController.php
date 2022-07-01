<?php
namespace App\Controller\Api\Test;

use App\Controller\BaseController;
use App\Model\Fix\StaticModel;
use App\Model\Base\Func\DBFunc;

class TestController extends BaseController
{
    public function test($result_arr=[]){
        $result_arr=['result'=>'true','data'=>'','msg'=>'성공'];
        return $result_arr;
    }
    public function list($result_arr=[]){
        $tmp_w=["AND dlit_type='A'"];
        $sql_opt=['t'=>'dlit','w'=>$tmp_w,'g'=>'*','o'=>'0'];
        $info_arr=StaticModel::$db_main->db->get_info_arr($sql_opt);

        $result_data_arr=['info_arr'=>$info_arr];
        $result_arr=['result'=>'true','data'=>$result_data_arr,'msg'=>'성공'];
        return $result_arr;
    }
    public function list2($result_arr=[]){
        $tmp_rs=DBFunc::getBaseModelBydlitId(['dlit_code'=>'call365']);
        $tmp_db=$tmp_rs['data'];

        $tmp_w=["AND cargo_dlitcode='call365'"];
        $tmp_w[]="ORDER BY cargo_code DESC LIMIT 1";
        $sql_opt=['t'=>'acargo','w'=>$tmp_w,'g'=>'cargo_code','o'=>'1'];
        $info_arr=$tmp_db->db->get_info_arr($sql_opt);

        $result_data_arr=['info_arr'=>$info_arr];
        $result_arr=['result'=>'true','data'=>$result_data_arr,'msg'=>'성공'];
        return $result_arr;
    }
}
