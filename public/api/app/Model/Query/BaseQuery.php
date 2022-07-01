<?php
namespace App\Model\Query;

use App\Lib\Common\Web;
use App\Lib\Common\Paging\WebPaging;
use App\Model\Base\Func\DBFunc;
use App\Values\XColumn\XColumnArr;
use App\Values\Table\TableArr;

class BaseQuery
{
    public $table = '';
    public $table_id='';
    public $col_prefix='';
    public $table_opt=[];
    public $baseModel=null;
    public $x_column_arr=[];
    public $pri_col_arr=[];
    public $x_column_data=[];
    public $s_list_opt=[
        'now_page'=>1,
        'num_per_page'=>20,
        'order_id'=>'',
        'order_type'=>'',
        'group_id'=>'',
        's_date_type'=>'',
        's_start_date'=>'',
        's_end_date'=>'',
        'sc'=>[],
        's_pri_arr'=>[],

        'table'=>'',
        'debug'=>0,
        'get_col'=>'*',
        'get_col_after'=>'',
        'tot_col'=>'',

        'is_need_count'=>true,
        'is_need_info_arr'=>true,
        'is_excel_down'=>false,
        'xcolumn_list_sort'=>'',
        'is_convert_col'=>true,
        'max_limit_num'=>1000000
    ];

    function __construct($baseModel)
    {
        $this->baseModel=$baseModel;
    }

    public function getList()
    {
        $where_row=$this->getWhereArr();
        $table_str=$this->table;
        $get_col=$this->s_list_opt['get_col'];

        if(!empty($this->table_opt['split'])){
            $table_split_arr=$this->getTableSplitArr([
                'baseModel'=>$this->baseModel,
                's_start_date'=>$this->s_list_opt['s_start_date'],
                's_end_date'=>$this->s_list_opt['s_end_date'],
                's_pri_arr'=>isset($this->s_list_opt['s_pri_arr'])?$this->s_list_opt['s_pri_arr']:[],
                'table_opt'=>$this->table_opt
            ]);

            if(!empty($table_split_arr)){
                $table_str=$this->getTableStrByTableSplitArr([
                    'table_split_arr'=>$table_split_arr
                ]);
                $where_row=[];
            }
        }

        if(!empty($this->s_list_opt['get_col_after'])){
            $get_col=$this->s_list_opt['get_col_after'];
        }

        $tot_col='COUNT(*) AS tot';
        if(!empty($this->s_list_opt['tot_col'])){
            $tot_col=$this->s_list_opt['tot_col'];
        }else if(!empty($this->s_list_opt['group_id'])){
            $tmp_rs=DBFunc::getDetailByXColumnArr($this->x_column_arr);
            $is_number_col_arr=$tmp_rs['is_number_col_arr'];
            $tmp_tot_col_arr=[];

            foreach($this->x_column_arr as $key=>$val){
                if(empty($val['pri'])){
                    if(in_array($key,$is_number_col_arr)){
                        if(strstr($key,'_seq')===false&&strstr($key,'_code')===false){
                            $col_str="SUM(".$key.") AS ".$key;
                            $tmp_tot_col_arr[]=$col_str;
                        }
                    }
                }
            }
            $tmp_tot_col_arr[]="COUNT(*) AS tot";
            $tot_col=implode(",",$tmp_tot_col_arr);
        }
        $count_info=null;
        $count_tot=0;
        $p_conf=[];
        $webPaging=null;
        if(!empty($this->s_list_opt['is_need_count'])){
            $sql_opt=array('t'=>$table_str,'w'=>$where_row,'g'=>$tot_col,'o'=>1);
            $count_info=$this->baseModel->db->get_info_arr($sql_opt, $this->s_list_opt['debug']);
            $count_tot=$count_info['tot'];

            if(!empty($this->s_list_opt['group_id'])){
                $tmp_w=[];
                $tmp_table_str="(SELECT ".$this->s_list_opt['group_id']." AS tot FROM ".$table_str." WHERE 1=1 GROUP BY ".$this->s_list_opt['group_id'].") AS G";

                $sql_opt=array('t'=>$tmp_table_str,'w'=>[],'g'=>'COUNT(*) AS tot','o'=>1);
                $tmp_count_info=$this->baseModel->db->get_info_arr($sql_opt, 0);
                $count_tot=$tmp_count_info['tot'];
            }

            $p_conf=[
                'now_page'=>$this->s_list_opt['now_page'],
                'num_per_page'=>$this->s_list_opt['num_per_page'],
                'tot'=>$count_tot
            ];
            $webPaging=new WebPaging($p_conf);
        }


        if(!empty($this->s_list_opt['group_id'])){
            $where_row[]='GROUP BY '.$this->s_list_opt['group_id'];

            if($get_col=="*"){
                $tmp_rs=DBFunc::getDetailByXColumnArr($this->x_column_arr);
                $is_number_col_arr=$tmp_rs['is_number_col_arr'];
                $get_col_arr=[];

                foreach($this->x_column_arr as $key=>$val){
                    $col_str=$key;
                    if(empty($val['pri'])){
                        if(in_array($key,$is_number_col_arr)){
                            if(strstr($key,'_seq')===false){
                                $col_str="SUM(".$key.") AS ".$key;
                            }
                        }
                    }
                    $get_col_arr[]=$col_str;
                }
                $get_col_arr[]="COUNT(*) AS row_tot";
                $get_col=implode(",",$get_col_arr);
            }
        }
        if(!empty($this->s_list_opt['order_id'])){
            $where_row[]='ORDER BY '.$this->s_list_opt['order_id'];
            if(!empty($this->s_list_opt['order_type'])){
                $where_row[]=' '.$this->s_list_opt['order_type'];
            }
        }
        if($this->s_list_opt['is_excel_down']){
            $where_row[]=' LIMIT '.$this->s_list_opt['max_limit_num'];
        }else{
            if(!empty($webPaging)){
                $where_row[]=' LIMIT '.$webPaging->st_limit.', '.$webPaging->num_per_page;
            }else{
                $where_row[]=' LIMIT '.$this->s_list_opt['max_limit_num'];
            }
        }

        $info_arr=[];
        if($this->s_list_opt['is_need_info_arr']){
            $sql_opt=array('t'=>$table_str,'w'=>$where_row,'g'=>$get_col);
            $info_arr=$this->baseModel->db->get_info_arr($sql_opt, $this->s_list_opt['debug']);
        }

        $info_arr=$this->getInfoArrAddon(['baseModel'=>$this->baseModel,'info_arr'=>$info_arr]);

        $list_data_arr=[
            'info_arr'=>$info_arr,
            'tot'=>$count_tot,
            'count_info'=>$count_info
        ];
        if(!empty($webPaging)){
            $list_data_arr['start_index']=$webPaging->get_index_num(0);
        }
        if(!empty($this->x_column_data)){
            $list_data_arr['x_column_data']=$this->x_column_data;
        }

        $list_data_arr=$this->getListDataArrAddon(['baseModel'=>$this->baseModel,'list_data_arr'=>$list_data_arr]);

        if($this->s_list_opt['is_convert_col']){
            $list_data_arr['info_arr']=$this->getConvertedInfoArr($list_data_arr['info_arr']);
            if(!empty($list_data_arr['count_info'])){
                $list_data_arr['count_info']=$this->getConvertedInfoArr([$list_data_arr['count_info']])[0];
            }
        }

        return $list_data_arr;
    }
    public function getInfoArrAddon($in_opt_arr=[]){
        $opt_arr=[
            'baseModel'=>$this->baseModel,
            'table'=>$this->table,
            'info_arr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        return $opt_arr['info_arr'];
    }
    public function getListDataArrAddon($in_opt_arr=[]){
        $opt_arr=[
            'baseModel'=>$this->baseModel,
            'table'=>$this->table,
            'list_data_arr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        return $opt_arr['list_data_arr'];
    }
    public function getWhereArr($in_opt_arr=[])
    {
        $opt_arr=[
            'split_table'=>''
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $where_row=array();

        if(!empty($this->s_list_opt['sc'])){
            foreach($this->s_list_opt['sc'] as $k => $v){
                if($v=='0'){$v='empty';}
                if(!empty($v)){
                    $v=Web::CheckHtmlStr($v);
                    if(isset($this->x_column_arr[$k])){
                        if($v=='empty'){
                            $where_row[]=" AND IFNULL($k,'') IN ('','0')";
                        }else{
                            $where_row[]=" AND $k LIKE '%".$v."%'";
                        }
                    }
                }
            }
        }

        if(!empty($this->s_list_opt['s_pri_arr'])){
            $s_pri_val_str="'".implode("','",$this->s_list_opt['s_pri_arr'])."'";
            $pri_col_str=implode(",',',",$this->pri_col_arr);
            $where_row[]=" AND CONCAT(".$pri_col_str.") IN (".$s_pri_val_str.")";
        }

        return $where_row;
    }

    public function set_list_opt($s_list_opt=[])
    {
        foreach($s_list_opt as $key=>$val){
            if(is_string($val)){
                $val=trim($val);
            }
            $this->s_list_opt[$key]=$val;
        }
        $table_opt=TableArr::getTable($this->s_list_opt['table']);
        $this->table=$table_opt['table'];
        $this->table_id=$table_opt['table_id'];
        $this->col_prefix=$table_opt['col_prefix'];
        $this->table_opt=$table_opt;
        $this->x_column_arr=DBFunc::getXColumnArrByTableName(['table'=>$this->table,'baseModel'=>$this->baseModel]);
        $tmp_rs=DBFunc::getDetailByXColumnArr($this->x_column_arr);
        $this->pri_col_arr=$tmp_rs['pri_col_arr'];

        if(empty($this->s_list_opt['now_page'])){
            $this->s_list_opt['now_page']=1;
        }
        if(empty($this->s_list_opt['num_per_page'])){
            $this->s_list_opt['num_per_page']=10000;
        }
        if(!empty($this->table_opt['split'])){
            if(empty($this->s_list_opt['s_start_date'])){
                $this->s_list_opt['s_start_date']=(date('Y')-1).'-01-01';
            }
            if(empty($this->s_list_opt['s_end_date'])){
                $this->s_list_opt['s_end_date']=date('Y-12-31');
            }
        }
        if(!empty($this->s_list_opt['s_pri_arr'])){
            $this->s_list_opt['s_start_date']='';
            $this->s_list_opt['s_end_date']='';
        }

        if(!empty($this->s_list_opt['order_id'])){
            $tmp_str_arr=explode(',',$this->s_list_opt['order_id']);
            $tmp_str_arr2=[];
            foreach($tmp_str_arr as $val){
                if(!empty($val)){
                    $tmp_str_arr2[]=$val;
                }
            }
            $tmp_str_arr=$tmp_str_arr2;
            $this->s_list_opt['order_id']=implode(' , ',$tmp_str_arr);
        }
        $this->setUnConvertListOpt($s_list_opt,['prefix'=>'a','change_prefix'=>$this->col_prefix]);

        $this->setXColumnData();
        $this->initCustomOpt();
    }

    public function setXColumnData()
    {
        if(!empty($this->s_list_opt['xcolumn_list_sort'])){
            $xColumnArr_obj=new XColumnArr(['list_sort'=>$this->s_list_opt['xcolumn_list_sort']]);
            $this->x_column_data=$xColumnArr_obj->getData(['is_cover_prefix'=>false]);
        }
    }
    public function initCustomOpt(){

    }

    public function getTableSplitArr($in_opt_arr=[]){
        $opt_arr=[
            'baseModel'=>null,
            's_start_date'=>'',
            's_end_date'=>'',
            's_pri_arr'=>'',
            'table_opt'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        if(empty($opt_arr['s_start_date'])){
            $opt_arr['s_start_date']=date('Y-01-01');
        }
        if(empty($opt_arr['s_end_date'])){
            $opt_arr['s_end_date']=date('Y-12-31');
        }
        $st_time=strtotime($opt_arr['s_start_date']);
        $st_time=strtotime('-6 month',$st_time);
        $end_time=$st_time;
        if(!empty($opt_arr['s_end_date'])){
        	$end_time=strtotime($opt_arr['s_end_date']);
        }
        $end_time=strtotime('+6 month',$end_time);

        $ymd_date_key=$opt_arr['table_opt']['split'];
        if($ymd_date_key=='y'){
            $ymd_date_key='Y';
        }else if($ymd_date_key=='ym'){
            $ymd_date_key='Ym';
        }
        if(!empty($ymd_date_key)){
            if(!empty($opt_arr['s_pri_arr'])){
                foreach($opt_arr['s_pri_arr'] as $pri_val){
                    $tmp_pri_val_arr=explode(',',$pri_val);
                    $tmp_st_time=strtotime(substr($tmp_pri_val_arr[0],0,4).'-'.substr($tmp_pri_val_arr[0],4,2).'-01');
                    if($st_time>$tmp_st_time){
                        $st_time=$tmp_st_time;
                    }

                    $tmp_end_time=strtotime(substr($tmp_pri_val_arr[0],0,4).'-'.substr($tmp_pri_val_arr[0],4,2).'-31');
                    if($end_time<$tmp_end_time){
                        $end_time=$tmp_end_time;
                    }
                }
            }
        }

        $table_split_arr=[];
        $ymd_st=date($ymd_date_key,$st_time);
        $ymd_end=date($ymd_date_key,$end_time);
        $tmp_cnt=0;
        $max_cnt=12;
        for($i=$ymd_st;$i<=$ymd_end;$i++){
            if($opt_arr['table_opt']['split']=='ym'){
                if(substr($i,4,2)>=13){
            		$tmp_y=substr($i,0,4);
            		$tmp_y++;
            		$i=$tmp_y.'01';
            	}
            }
            $table_name=$opt_arr['table_opt']['table'].'_'.$opt_arr['table_opt']['split'].$i;
            //테이블 있는지 확인
            if(DBfunc::hasTable(['baseModel'=>$opt_arr['baseModel'],'table_name'=>$table_name])){
                $tmp_cnt++;
                $table_split_arr[]=$table_name;
                if($tmp_cnt>=$max_cnt){
            		$i=$ymd_end;
            		break;
            	}
            }
        }
        return $table_split_arr;
    }

    public function getTableStrByTableSplitArr($in_opt_arr=[]){
        $opt_arr=[
            'table_split_arr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }

        $table_str_arr=[];
        foreach($opt_arr['table_split_arr'] as $split_table){
            $tmp_sql="SELECT ".$this->s_list_opt['get_col']." FROM ".$split_table." WHERE 1=1 ";
            $where_row=$this->getWhereArr(['split_table'=>$split_table]);
            foreach($where_row as $w_str){
                $tmp_sql.=" ".$w_str." ";
            }
            if(!empty($this->s_list_opt['order_id'])){
                $tmp_sql.=' ORDER BY '.$this->s_list_opt['order_id'];
                if(!empty($this->s_list_opt['order_type'])){
                    $tmp_sql.=' '.$this->s_list_opt['order_type'];
                }
            }
            $tmp_sql.=' LIMIT '.$this->s_list_opt['max_limit_num'];

            $table_str_arr[]="(".$tmp_sql.")";
        }

        $table_str=implode(" UNION ",$table_str_arr);
        $table_str="(".$table_str.") AS A";
        return $table_str;
    }

    //$info_arr=$this->getConvertedInfoArr($info_arr,['prefix'=>$this->col_prefix,'change_prefix'=>'a']);
    public function getConvertedInfoArr($info_arr,$in_opt_arr=[]){
        $opt_arr=[
            'prefix'=>$this->col_prefix,
            'change_prefix'=>'a'
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $tmp_info_arr=[];
        foreach($info_arr as $info){
            $tmp_info=[];
            foreach($info as $key=>$val){
                $is_able_key=true;
                if(strstr($key,'_pw')!==false){
                    //$is_able_key=false;
                }
                if($is_able_key){
                    if(substr($key,0,strlen($opt_arr['prefix'].'_'))==$opt_arr['prefix'].'_'){
                        $key=$this->strReplace($opt_arr['prefix'].'_',$opt_arr['change_prefix'].'_',$key);
                    }
                    $tmp_info[$key]=$val;
                }
            }
            $tmp_info_arr[]=$tmp_info;
        }
        return $tmp_info_arr;
    }
    //setUnConvertListOpt($s_list_opt,['prefix'=>'a','change_prefix'=>$this->col_prefix]);
    public function setUnConvertListOpt($s_list_opt,$in_opt_arr=[]){
        $opt_arr=[
            'prefix'=>'a',
            'change_prefix'=>$this->col_prefix
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }

        $tmp_change_key_arr=['order_id','order_type','s_date_type','group_id','get_col'];
        foreach($this->s_list_opt as $key=>$val){
            if(!in_array($key,$tmp_change_key_arr)){continue;}
            if(!is_array($val)){
                if(substr($val,0,strlen($opt_arr['prefix'].'_'))==$opt_arr['prefix'].'_'){
                    $val=$this->strReplace($opt_arr['prefix'].'_',$opt_arr['change_prefix'].'_',$val,1);
                    $this->s_list_opt[$key]=$val;
                }
                $val=str_replace(' '.$opt_arr['prefix'].'_',' '.$opt_arr['change_prefix'].'_',$val);
            }
            $this->s_list_opt[$key]=$val;
        }
        foreach($this->s_list_opt['sc'] as $key=>$val){
            if(substr($key,0,strlen($opt_arr['prefix'].'_'))==$opt_arr['prefix'].'_'){
                $key=$this->strReplace($opt_arr['prefix'].'_',$opt_arr['change_prefix'].'_',$key,1);
                $this->s_list_opt['sc'][$key]=$val;
            }
        }
    }
    public function strReplace($search_str,$target_str,$str){
        if(($p=strpos($str,$search_str))!==false){
            $str=substr_replace($str,$target_str,$p,strlen($search_str));
        }
        return $str;
    }
}
