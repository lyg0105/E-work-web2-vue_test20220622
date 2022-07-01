<?php
namespace App\Values\XColumn\XColmun;

use App\Model\Fix\StaticModel;
use App\Config\Session\Session;

class GetListOptArr
{
    public static function getListOptArr($in_opt_arr=[]){
        $opt_arr=[
            'baseModel'=>StaticModel::$db,
            'list_sort'=>'',
            'user_id'=>Session::get('user_id'),
            'x_column_list_orig_arr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $list_opt_arr=[
            'num_per_page'=>'20',
            'fix_left_num'=>'3',
            's_date_type'=>'',
            's_date_start'=>'',
            'order_id'=>'',
            'order_type'=>'DESC'
        ];

        if(!empty($opt_arr['list_sort'])&&!empty($opt_arr['user_id'])){
            $tmp_w=["AND nlo_list_sort='".$opt_arr['list_sort']."'"];
            $tmp_w[]="AND nlo_user_id='".$opt_arr['user_id']."'";
            $tmp_w[]="AND IFNULL(nlo_list_type,'')=''";
            $sql_opt=['t'=>'anote_list_opt','w'=>$tmp_w,'o'=>1];
            $list_opt_info=$opt_arr['baseModel']->db->get_info_arr($sql_opt);
            if(!empty($list_opt_info)){
                $opt_json_data=$list_opt_info['nlo_opt_json_data'];
                if(!empty($opt_json_data)){
                    $opt_json_data=base64_decode($opt_json_data);
                    $opt_json_data=json_decode($opt_json_data,true);
                    $list_opt_arr=$opt_json_data;

                    //리스트컬럼에 없는배열 추가
                    if(!empty($list_opt_arr['list_arr'])){
                        $tmp_list_arr=[];
                        foreach($list_opt_arr['list_arr'] as $x_list){
                            if(empty($x_list)){continue;}
                            foreach($opt_arr['x_column_list_orig_arr'] as $key=>$val){
                                if(!isset($x_list[$key])){
                                    $val['is_use']='';
                                    $x_list[$key]=$val;
                                }
                            }
                            $tmp_list_arr[]=$x_list;
                        }
                        $list_opt_arr['list_arr']=$tmp_list_arr;
                    }
                }
            }
        }

        $result_data_arr=[
            'list_opt_arr'=>$list_opt_arr
        ];

        return $result_data_arr;
    }
}
