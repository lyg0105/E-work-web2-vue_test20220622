<?php
namespace App\Service\Common;

use App\Service\BaseService;
use App\Service\Common\ConvertRequest;
use App\Model\Base\Func\DBFunc;
use App\Values\Table\TableArr;
use App\Model\Fix\StaticModel;
use App\Lib\Common\Web;

use App\Service\Common\Write\GetDetailPriData;

class WriteService extends BaseService
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

        $error_info_arr=array();//array(array('row_num'=>'','msg'=>''))
        $return_info_arr=array();

        $attempt_cnt=0;
        $success_cnt=0;
        $insert_cnt=0;
        $update_cnt=0;
        if(empty($baseModel)){
            $baseModel=StaticModel::$db;
        }
        if($opt_obj['is_transaction']){
            $baseModel->db->excute("begin");
        }
        for($i=0;$i<$data_length;$i++){
            $tmp_col_val_arr=$data_arr[$i];

            $tmp_is_update=$is_update;
            if(!empty($is_update_arr)){
                if(isset($is_update_arr[$i])){
                    $tmp_is_update=$is_update_arr[$i];
                }
            }

            $tmp_opt_arr=array(
                'is_num_col_arr'=>$is_num_col_arr,
                'date_col_arr'=>$date_col_arr,
                'is_time_col_arr'=>$is_time_col_arr,
                'pri_col_arr'=>$pri_col_arr,
                'last_pri_col'=>$last_pri_col,
                'x_column_arr'=>$x_column_arr,
                'col_val_arr'=>$tmp_col_val_arr
            );
            $tmp_rs=ConvertRequest::getDefaultRequestColValArr($tmp_opt_arr);
            if($tmp_rs['result']=='false'){
                return $tmp_rs;
            }
            $tmp_col_val_arr=$tmp_rs['data'];

            $table_tail_str=TableArr::getTableTailStr($table,$tmp_col_val_arr);

            //이미 있는지 확인하여 있으면 수정으로
            if(empty($tmp_is_update)){
                if(!empty($tmp_col_val_arr[$last_pri_col])){
                    $tmp_w=array();
                    foreach($pri_col_arr as $key){
                        $tmp_w[]="AND ".$key."='".$tmp_col_val_arr[$key]."'";
                    }
                    $tmp_get='COUNT(*) AS tot';
                    $sql_opt=array('t'=>$table.$table_tail_str,'w'=>$tmp_w,'g'=>$tmp_get,'o'=>1);
                    $tmp_info=$baseModel->db->get_info_arr($sql_opt, $debug = 0);
                    if(!empty($tmp_info['tot'])){
                        $tmp_is_update='1';
                    }
                }
            }

            $attempt_cnt++;
            $pre_info=null;
            $pri_col_val_arr=array();
            $data_col_val_arr=array();
            $result=null;

            $tmp_rs=GetDetailPriData::getDetailPriData([
                'baseModel'=>$baseModel,
                'table'=>$table,
                'table_opt'=>$table_opt,
                'table_tail_str'=>$table_tail_str,
                'tmp_is_update'=>$tmp_is_update,
                'data_col_val_arr'=>$tmp_col_val_arr,
                'pri_col_arr'=>$pri_col_arr,
                'last_pri_col'=>$last_pri_col,
                'i'=>$i
            ]);
            $pri_col_val_arr=$tmp_rs['data']['pri_col_val_arr'];
            $data_col_val_arr=$tmp_rs['data']['data_col_val_arr'];
            $pre_info=$tmp_rs['data']['pre_info'];
            if(!empty($opt_obj['prev_func'])){
               //if(function_exists($opt_obj['prev_func'])){
                    $opt_arr=array(
                        'data_col_val_arr'=>$data_col_val_arr,
                        'pri_col_val_arr'=>$pri_col_val_arr,
                        'i'=>$i,
                        'table'=>$table,
                        'table_opt'=>$table_opt,
                        'table_tail_str'=>$table_tail_str,
                        'is_update'=>$tmp_is_update,
                        'pri_col_arr'=>$pri_col_arr,
                        'x_column_arr'=>$x_column_arr,
                        'pre_info'=>$pre_info,
                        'baseModel'=>$baseModel,
                        'requestData'=>$requestData,
                        'orig_opt'=>$opt_obj
                    );
                    $tmp_rs=call_user_func($opt_obj['prev_func'],$opt_arr);
                    if($tmp_rs['result']!='true'){
                         $tmp_row_num=$i;
                         if(!empty($input_row_num_arr)){$tmp_row_num=$input_row_num_arr[$i];}
                         $error_info_arr[]=array('row_num'=>$tmp_row_num,'msg'=>$attempt_cnt.'번째 작업 중 에러입니다.'.$tmp_rs['msg']);
                         if($opt_obj['is_transaction']){
                              $baseModel->db->excute("rollback");
                              $baseModel->db->excute("begin");
                         }
                         continue;
                    }
                    $data_col_val_arr=$tmp_rs['data']['data_col_val_arr'];

                    if(isset($tmp_rs['data']['is_update'])){
                        $tmp_is_update=$tmp_rs['data']['is_update'];
                    }
                    if(isset($tmp_rs['data']['pri_col_val_arr'])){
                        $pri_col_val_arr=$tmp_rs['data']['pri_col_val_arr'];
                    }

                    $tmp_opt_arr=array(
                        'is_num_col_arr'=>$is_num_col_arr,
                        'date_col_arr'=>$date_col_arr,
                        'is_time_col_arr'=>$is_time_col_arr,
                        'pri_col_arr'=>$pri_col_arr,
                        'last_pri_col'=>$last_pri_col,
                        'x_column_arr'=>$x_column_arr,
                        'col_val_arr'=>$data_col_val_arr
                    );
                    $tmp_rs=ConvertRequest::getDefaultRequestColValArr($tmp_opt_arr);
                    $data_col_val_arr=$tmp_rs['data'];
                //}
            }

            $sql_opt=array(
               'table'=>$table.$table_tail_str,
               'col_val_arr'=>$data_col_val_arr,
               'pri_col_val_arr'=>$pri_col_val_arr
           );
           if(empty($tmp_is_update)){
               //auto_increment라면 컬럼 없애기
               if(!empty($x_column_arr[$last_pri_col]['auto'])){
                   if(isset($sql_opt['col_val_arr'][$last_pri_col])){
                       unset($sql_opt['col_val_arr'][$last_pri_col]);
                   }
               }
               $result=$baseModel->db->insert($sql_opt,$is_debug);//등록

               if(!empty($x_column_arr[$last_pri_col]['auto'])){
                   $data_col_val_arr[$last_pri_col]=$baseModel->db->mysqli->insert_id;
                   $pri_col_val_arr[$last_pri_col]=$data_col_val_arr[$last_pri_col];
               }
            }else{
                $result=$baseModel->db->update($sql_opt,$is_debug);//수정
            }

           if($result){
               $last_info=null;
              if(!empty($pri_col_val_arr)){
                   $tmp_w=array();
                   foreach($pri_col_val_arr as $key=>$val){
                        $tmp_w[]="AND {$key}='{$val}'";
                   }
                   $sql_opt=array('t'=>$table.$table_tail_str,'w'=>$tmp_w,'o'=>1);
                   $last_info=$baseModel->db->get_info_arr($sql_opt, $debug = 0);
              }

              if(!empty($opt_obj['after_func'])){
                   //if(function_exists($opt_obj['after_func'])){
                        $opt_arr=array(
                            'data_col_val_arr'=>$data_col_val_arr,
                            'pri_col_val_arr'=>$pri_col_val_arr,
                            'i'=>$i,
                             'table'=>$table,
                             'table_opt'=>$table_opt,
                             'table_tail_str'=>$table_tail_str,
                             'is_update'=>$tmp_is_update,
                             'pri_col_arr'=>$pri_col_arr,
                             'x_column_arr'=>$x_column_arr,
                             'pre_info'=>$pre_info,
                             'baseModel'=>$baseModel,
                             'last_info'=>$last_info,
                             'requestData'=>$requestData,
                             'orig_opt'=>$opt_obj
                        );
                        $tmp_rs=call_user_func($opt_obj['after_func'],$opt_arr);
                        if($tmp_rs['result']!='true'){
                             $tmp_row_num=$i;
                             if(!empty($input_row_num_arr)){$tmp_row_num=$input_row_num_arr[$i];}
                             $error_info_arr[]=array('row_num'=>$tmp_row_num,'msg'=>$attempt_cnt.'번째 후작업 중 에러입니다.'.$tmp_rs['msg']);
                             if($opt_obj['is_transaction']){
                                  $baseModel->db->excute("rollback");
                                  $baseModel->db->excute("begin");
                             }
                             continue;
                        }
                        $data_col_val_arr=$tmp_rs['data']['data_col_val_arr'];
                   //}
              }

              $success_cnt++;

              if(!empty($is_return)){
                   $return_col_val_arr=$data_col_val_arr;
                   if(!empty($input_row_num_arr)){
                        if(!isset($return_col_val_arr['input_row_num_arr'])){$return_col_val_arr['input_row_num_arr']=array();}
                        $return_col_val_arr['input_row_num_arr']=$input_row_num_arr[$i];
                   }
                   $return_info_arr[]=$return_col_val_arr;
              }

              if(!empty($tmp_is_update)){
                   $update_cnt++;
              }else{
                   $insert_cnt++;
              }
           }else{
               $tmp_row_num=$i;
               if(!empty($input_row_num_arr)){$tmp_row_num=$input_row_num_arr[$i];}
               $error_info_arr[]=array('row_num'=>$tmp_row_num,'msg'=>$attempt_cnt.'번째 작업 중 에러입니다.'.$baseModel->db->get_error());
           }
       }

       if($attempt_cnt==$success_cnt){
          if($opt_obj['is_transaction']){
               if($opt_obj['is_commit']){
                    $baseModel->db->excute("commit");
               }
          }
          $suc_msg=$insert_cnt."개 등록 ".$update_cnt."개 수정 되었습니다.";
          if(!empty($table_opt['col_prefix'])&&$is_return_convert){
              $return_info_arr=Web::getConvertedPrefixInfoArr($return_info_arr,['prefix'=>$table_opt['col_prefix'],'change_prefix'=>'a']);
          }
          $result_arr=array('result'=>'true','data'=>$return_info_arr,'msg'=>$suc_msg);
     }else{
          if($opt_obj['is_transaction']){
               $baseModel->db->excute("rollback");
          }
          $tmp_msg=$attempt_cnt.'개 중 '.($attempt_cnt-$success_cnt).'개 오류 입니다.';
          if($attempt_cnt==1&&count($error_info_arr)==1){
               $tmp_msg.="에러:".$error_info_arr[0]['msg'];
          }
          $result_arr=array('result'=>'false','data'=>'','msg'=>$tmp_msg,'error'=>$error_info_arr);
     }

        return $result_arr;
    }
}
