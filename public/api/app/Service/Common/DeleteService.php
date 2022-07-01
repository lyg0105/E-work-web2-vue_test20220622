<?php
namespace App\Service\Common;

use App\Service\Common\ConvertRequest;
use App\Model\Base\Func\DBFunc;
use App\Lib\Common\Web;
use App\Service\BaseService;
use App\Values\Table\TableArr;
use App\Model\Fix\StaticModel;

class DeleteService extends BaseService
{
    public function action($in_opt_obj=[])
    {
        $result_arr=['result'=>'true','data'=>'','msg'=>'성공','error'=>[]];
        $tmp_rs=ConvertRequest::getDefalutOptDataByPost($in_opt_obj);
        if($tmp_rs['result']!='true'){
            $result_arr=array('result'=>'false','data'=>'','msg'=>'기본정보오류.'.$tmp_rs['msg'],'error'=>[]);
            return $result_arr;
        }
        $opt_obj=$tmp_rs['data'];
        extract($opt_obj);

        $attemp_cnt=0;
        $success_cnt=0;
        if(empty($baseModel)){
            $baseModel=StaticModel::$db;
        }
        if($opt_obj['is_transaction']){
            $baseModel->db->excute('begin');
        }
        for($i=0;$i<$data_length;$i++){
            $attemp_cnt++;
            $pri_where_arr=array();
            $col_val_arr=array();

            $data_col_val_arr=$data_arr[$i];
            $where_col_val_arr=array();
            foreach($data_col_val_arr as $key=>$val){
                if(!isset($x_column_arr[$key])){continue;}
                $val_str=Web::CheckHtmlStr($val);
                $key=Web::CheckHtmlStr($key);
                $where_col_val_arr[$key]=$val_str;
            }


            foreach($where_col_val_arr as $key=>$val){
                $pri_where_arr[]="AND ".$key."='".$val."'";
                $col_val_arr[$key]=$val;
            }

            if(empty($pri_where_arr)){
                if($opt_obj['is_transaction']){
                    $baseModel->db->excute('rollback');
                }
                $result_arr=['result'=>'false','data'=>'','msg'=>'키 정보가 없습니다..','error'=>[]];
                return $result_arr;
            }

            $table_tail_str=TableArr::getTableTailStr($table,$data_col_val_arr);

            $sql_opt=array('t'=>$table.$table_tail_str,'w'=>$pri_where_arr,'g'=>'*','o'=>1);
            $pre_info=$baseModel->db->get_info_arr($sql_opt, $debug = 0);

            $pri_val_arr=[];
            foreach($pri_col_arr as $key){
                $pri_val_arr[]=$pre_info[$key];
            }
            $pri_val_str=implode(',',$pri_val_arr);

            if(empty($pre_info)){
                if($opt_obj['is_transaction']){
                    $baseModel->db->excute('rollback');
                }
                $result_arr=['result'=>'false','data'=>'','msg'=>$i.'번째 정보가 없습니다.','error'=>[]];
                return $result_arr;
            }

            if(!empty($opt_obj['prev_func'])){
                // if(function_exists($opt_obj['prev_func'])){
                    $tmp_opt_arr=array(
                        'table'=>$table,
                        'table_opt'=>$table_opt,
                        'table_tail_str'=>$table_tail_str,
                        'pri_col_arr'=>$pri_col_arr,
                        'pri_val_str'=>$pri_val_str,//key1,key2..
                        'x_column_arr'=>$x_column_arr,
                        'pre_info'=>$pre_info,
                        'i'=>$i,
                        'col_val_arr'=>$col_val_arr,
                        'baseModel'=>$baseModel,
                        'requestData'=>$requestData,
                    );
                    $tmp_rs=call_user_func($opt_obj['prev_func'],$tmp_opt_arr);
                    if($tmp_rs['result']!='true'){
                        $result_arr=array('result'=>'false','data'=>'','msg'=>$i.'번째 삭제전처리 중 오류:'.$tmp_rs['msg']);
                        return $result_arr;
                    }
                // }
            }

            $sql_opt=['table'=>$table.$table_tail_str,'pri_col_val_arr'=>$col_val_arr];
            $result=$baseModel->db->delete($sql_opt,$debug=false);
            if($result){
                if(!empty($opt_obj['after_func'])){
                    // if(function_exists($opt_obj['after_func'])){
                        $tmp_opt_arr=array(
                            'table'=>$table,
                            'table_opt'=>$table_opt,
                            'table_tail_str'=>$table_tail_str,
                            'pri_col_arr'=>$pri_col_arr,
                            'x_column_arr'=>$x_column_arr,
                            'pre_info'=>$pre_info,
                            'i'=>$i,
                            'col_val_arr'=>$col_val_arr,
                            'baseModel'=>$baseModel,
                            'requestData'=>$requestData,
                        );
                        $tmp_rs=call_user_func($opt_obj['after_func'],$tmp_opt_arr);
                        if($tmp_rs['result']!='true'){
                            $result_arr=array('result'=>'false','data'=>'','msg'=>$i.'번째 삭제후처리 중 오류:'.$tmp_rs['msg']);
                            return $result_arr;
                        }
                    // }
                }
                $success_cnt++;
            }else{
                if($opt_obj['is_transaction']){
                    $baseModel->db->excute('rollback');
                }
                $result_arr=array('result'=>'false','data'=>'','msg'=>$attemp_cnt.' 번째 삭제 중 오류입니다.');
                return $result_arr;
            }
        }
        if($opt_obj['is_transaction']){
            if($opt_obj['is_commit']){
                $baseModel->db->excute('commit');
            }
        }
        $result_arr=array('result'=>'true','data'=>'','msg'=>$success_cnt.' 개 삭제되었습니다.');

        return $result_arr;
    }
}
