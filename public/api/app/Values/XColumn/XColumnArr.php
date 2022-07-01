<?php
namespace App\Values\XColumn;

use App\Values\XColumn\XColmun\GetArrOfCoverPrefix;
use App\Values\XColumn\XColmun\GetListOptArr;
use App\Config\Session\Session;

class XColumnArr
{
    public $table='';
    public $column_prefix='';
    public $x_column_list_arr=[];//[ 'a_title'=>['name'=>'회사상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100','is_use'=>'1'], ]
                                 //데이터가 아닌 보여주기용이면 이름앞에 row_view_ 를 준다.
    public $x_column_list_orig_arr=[];
    public $x_pri_col_arr=[];
    public $x_basic_col_arr=[];// ['key1','key2']
    public $x_view_col_arr=[];// ['key1','key2']
    public $is_number_col_arr=[];// ['key1','key2']
    public $is_tel_col_arr=[];// ['key1','key2']
    public $is_busin_col_arr=[];// ['key1','key2']
    public $is_date_col_arr=[];// ['key1','key2']
    public $select_col_arr=[];//'key'=>[ ['value'=>'1','text'=>'Y'],['value'=>'0','text'=>'N'] ]
    public $is_password_col_arr=[];// ['key1','key2']
    public $x_detail_sort_key_arr=[];// ['key1'=>['a_seq'=>''],'key2'=>['a_seq'=>'']]
    public $search_select_col_arr=[];//'key'=>[ ['value'=>'create_date','text'=>'작성일'],['value'=>'0','text'=>'N'] ] 기간검색기준
    public $list_opt_arr=[
        'now_page'=>'1',
        'list_select_arr'=>[
            ['value'=>'0','text'=>'지정1'],
            ['value'=>'1','text'=>'지정2'],
            ['value'=>'2','text'=>'지정3'],
            ['value'=>'3','text'=>'지정4'],
            ['value'=>'4','text'=>'지정5'],
            ['value'=>'5','text'=>'지정6'],
            ['value'=>'6','text'=>'지정7'],
            ['value'=>'7','text'=>'지정8'],
            ['value'=>'8','text'=>'지정9'],
            ['value'=>'9','text'=>'지정10'],
        ]
    ];

    public $list_sort='';

    public function __construct($opt_obj)
    {
        $this->list_sort=isset($opt_obj['list_sort'])?$opt_obj['list_sort']:'';
        if(!empty($this->list_sort)){
            $now_path=ABS.'app/Values/XColumn/';
            $tmp_file_path=$now_path.$this->list_sort.'.php';
            if(file_exists($tmp_file_path)){
                include $tmp_file_path;
            }
        }
    }

    public function getData($in_opt_arr=[]){
        $opt_arr=[
            'is_cover_prefix'=>true,
            'user_id'=>Session::get('user_id')
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $this->x_column_list_orig_arr=$this->x_column_list_arr;

        $result_data=[
            'table'=>$this->table,
            'x_column_list_arr'=>$this->x_column_list_arr,
            'x_column_list_orig_arr'=>$this->x_column_list_orig_arr,
            'x_pri_col_arr'=>$this->x_pri_col_arr,
            'x_basic_col_arr'=>$this->x_basic_col_arr,
            'x_view_col_arr'=>$this->x_view_col_arr,
            'is_number_col_arr'=>$this->is_number_col_arr,
            'is_tel_col_arr'=>$this->is_tel_col_arr,
            'is_busin_col_arr'=>$this->is_busin_col_arr,
            'is_date_col_arr'=>$this->is_date_col_arr,
            'select_col_arr'=>$this->select_col_arr,
            'is_password_col_arr'=>$this->is_password_col_arr,
            'x_detail_sort_key_arr'=>$this->x_detail_sort_key_arr,
            'search_select_col_arr'=>$this->search_select_col_arr,
            'list_sort'=>$this->list_sort,
        ];

        if($opt_arr['is_cover_prefix']){
            foreach($result_data as $key=>$val){
                if(gettype($val)=='array'){
                    $result_data[$key]=GetArrOfCoverPrefix::action(['data'=>$val,'prefix'=>$this->column_prefix,'cover_str'=>'a_']);
                }
            }
        }

        $tmp_rs=GetListOptArr::getListOptArr([
            'list_sort'=>$this->list_sort,
            'x_column_list_orig_arr'=>$result_data['x_column_list_orig_arr'],
            'user_id'=>$opt_arr['user_id']
        ]);
        if(!empty($tmp_rs['list_opt_arr'])){
            $result_data['list_opt_arr']=$tmp_rs['list_opt_arr'];
            if(!empty($tmp_rs['list_opt_arr']['list_arr'])){
                if(empty($result_data['list_opt_arr']['list_arr_num'])){
                    $result_data['list_opt_arr']['list_arr_num']=0;
                }
                $list_arr_num=$result_data['list_opt_arr']['list_arr_num'];
                if(!empty($tmp_rs['list_opt_arr']['list_arr'][$list_arr_num])){
                    $result_data['x_column_list_arr']=$tmp_rs['list_opt_arr']['list_arr'][$list_arr_num];
                }
            }
        }

        return $result_data;
    }
}
