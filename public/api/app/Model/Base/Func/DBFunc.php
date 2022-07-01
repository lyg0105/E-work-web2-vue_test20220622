<?php
namespace App\Model\Base\Func;

use App\Model\Base\BaseModel;
use App\Model\Fix\StaticModel;
use App\Config\Env\Env;

class DBFunc
{
    public static function getdlitInfo($opt_obj)
    {
        $baseModel=isset($opt_obj['baseModel'])?$opt_obj['baseModel']:StaticModel::$db_main;//cdisd접속한 db연결

        $dlit_code=isset($opt_obj['dlit_code'])?$opt_obj['dlit_code']:'';
        $api_key=isset($opt_obj['api_key'])?$opt_obj['api_key']:'';

        $tmp_w=["AND dlit_ingyn='Y'"];
        if(!empty($dlit_code)){
            $tmp_w[]="AND dlit_code='".$dlit_code."'";
        }else if(!empty($api_key)){
            $tmp_w[]="AND dlit_api_key='".$api_key."'";
        }else{
            $tmp_w[]="AND 1=0";
        }
        $sql_opt=array('t'=>'dlit','w'=>$tmp_w,'o'=>1);
        $dlit_info=$baseModel->db->get_info_arr($sql_opt, $debug = 0);

        return $dlit_info;
    }

    public static function getBaseModelBydlitInfo($opt_obj)
    {
        $dlit_info=$opt_obj['dlit_info'];
        $is_not_dbname_connect=false;
        if(!empty($opt_obj['is_not_dbname_connect'])){
            $is_not_dbname_connect=true;
        }

        $result_arr=array('result'=>'false','data'=>'','msg'=>'실패');

        if(empty($dlit_info)){
            $result_arr=array('result'=>'false','data'=>'','msg'=>'dlit_info 없음');
            return $result_arr;
        }

        $db_host=!empty($dlit_info['dlit_ip'])?$dlit_info['dlit_ip']:Env::get('DB_HOST', '');
        $db_user=!empty($dlit_info['dlit_id'])?$dlit_info['dlit_id']:Env::get('DB_USERNAME', '');
        $db_pass=!empty($dlit_info['dlit_pwd'])?$dlit_info['dlit_pwd']:Env::get('DB_PASSWORD', '');
        $db_name=!empty($dlit_info['dlit_dbname'])?$dlit_info['dlit_dbname']:Env::get('DB_DATABASE', '');
        $db_charset='utf-8';
        $db_port=!empty($dlit_info['dlit_port'])?$dlit_info['dlit_port']:Env::get('DB_PORT', '');
        $tmp_db=new BaseModel();
        $tmp_rs=$tmp_db->db->connect($db_host,$db_user,$db_pass,'',$db_charset,$db_port);
        if(!$tmp_rs){
            $result_arr=array('result'=>'false','data'=>'','msg'=>'접속오류:');
            return $result_arr;
        }

        if($is_not_dbname_connect==false){
            $tmp_w=["AND SCHEMA_NAME='".$dlit_info['dlit_dbname']."'"];
            $sql_opt=['t'=>'information_schema.SCHEMATA','w'=>$tmp_w,'g'=>'COUNT(*) AS tot','o'=>'1'];
            $dlit_table_tot_info=$tmp_db->db->get_info_arr($sql_opt,$debug=0);
            if(!empty($dlit_table_tot_info['tot'])){
                $tmp_rs=$tmp_db->db->excute("use ".$db_name);
                $tmp_db->db->conn_info['db_name']=$db_name;
                if(!$tmp_rs){
                    $result_arr=array('result'=>'false','data'=>'','msg'=>'DB접속오류:');
                    return $result_arr;
                }
            }else{
                $result_arr=array('result'=>'false','data'=>$tmp_db,'msg'=>'DB가 없습니다.');
                return $result_arr;
            }
        }

        $result_arr=array('result'=>'true','data'=>$tmp_db,'msg'=>'성공');
        return $result_arr;
    }

    /*
    $tmp_rs=DBfunc::getBaseModelBydlitId(['dlit_code'=>'']);
    $baseModel=$tmp_rs['data'];
    */
    public static function getBaseModelBydlitId($opt_obj)
    {
        $mainModel=StaticModel::$db_main;
        $opt_obj['baseModel']=$mainModel;
        $dlit_info=self::getdlitInfo($opt_obj);
        if(empty($dlit_info)){
            $result_arr=array('result'=>'false','data'=>'','msg'=>'보안코드정보 없음.');
            return $result_arr;
        }
        $result_arr=self::getBaseModelBydlitInfo(['dlit_info'=>$dlit_info]);
        return $result_arr;
    }

    public static function countTable($opt_obj)
    {
        $baseModel=$opt_obj['baseModel'];
        $db_name=isset($opt_obj['db_name'])?$opt_obj['db_name']:$baseModel->db->conn_info['db_name'];
        $table_name=isset($opt_obj['table_name'])?$opt_obj['table_name']:"";

        //테이블 정보 얻기
        $tmp_w=array("AND TABLE_SCHEMA='$db_name'");
        if(!empty($table_name)){
            $tmp_w[]="AND LIKE '".$table_name."%'";
        }
        $sql_opt=array('t'=>'information_schema.tables','w'=>$tmp_w,'g'=>'COUNT(*) AS tot','o'=>1);
        $table_count_info=$baseModel->db->get_info_arr($sql_opt, $debug = null);

        return $table_count_info['tot'];
    }
    public static function hasTable($opt_obj)
    {
        $baseModel=$opt_obj['baseModel'];
        $db_name=isset($opt_obj['db_name'])?$opt_obj['db_name']:'';
        if(empty($db_name)){
            $db_name=$baseModel->db->getDatabaseName();
        }
        $table_name=$opt_obj['table_name'];
        $debug=isset($opt_obj['is_debug'])?$opt_obj['is_debug']:false;

        //테이블 정보 얻기
        $tmp_w=array("AND TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table_name' LIMIT 1");
        $sql_opt=array('t'=>'information_schema.tables','w'=>$tmp_w,'o'=>1);
        $table_info=$baseModel->db->get_info_arr($sql_opt,$debug);

        $is_exist_table=false;
        if(!empty($table_info)){
            $is_exist_table=true;
        }
        return $is_exist_table;
    }
    public static function getCreateSqlOfTable($opt_obj)
    {
        $baseModel=isset($opt_obj['baseModel'])?$opt_obj['baseModel']:StaticModel::$db_main;
        $db_name=isset($opt_obj['db_name'])?$opt_obj['db_name']:'';
        if(empty($db_name)){
            $db_name=$baseModel->db->getDatabaseName();
        }
        $from_table_name=isset($opt_obj['from_table_name'])?$opt_obj['from_table_name']:"";
        $table_name=isset($opt_obj['table_name'])?$opt_obj['table_name']:"";
        if(empty($baseModel)||empty($db_name)||empty($table_name)||empty($from_table_name)){
            $result_arr=array('result'=>'false','data'=>'','msg'=>'필수입력 정보가 없습니다.');
            return $result_arr;
        }

        //테이블 정보 얻기
        $tmp_w=array("AND TABLE_SCHEMA='$db_name' AND TABLE_NAME='$from_table_name' LIMIT 1");
        $sql_opt=array('t'=>'information_schema.tables','w'=>$tmp_w,'o'=>1);
        $table_info=$baseModel->db->get_info_arr($sql_opt, $debug =0);

        if(empty($table_info)){
            $result_arr=array('result'=>'false','data'=>'','msg'=>'테이블정보 없음.'.$baseModel->db->get_error());
            return $result_arr;
        }

        $tmp_col="COLUMN_NAME,COLUMN_TYPE,COLUMN_DEFAULT,COLUMN_KEY,EXTRA,COLUMN_COMMENT";
        $tmp_w=array("AND TABLE_SCHEMA='$db_name' AND TABLE_NAME='$from_table_name'");
        $sql_opt=array('t'=>'information_schema.columns','w'=>$tmp_w,'g'=>$tmp_col);
        $col_info_arr=$baseModel->db->get_info_arr($sql_opt, $debug = null);

        $pri_col_arr=array();
        $unique_col_arr=array();
        $create_opt_arr=array();
        foreach($col_info_arr as $col_val){
            if($col_val['COLUMN_KEY']=='PRI'){
                $col_val['COLUMN_DEFAULT']='NOT NULL';
                if(!empty($col_val['EXTRA'])){
                    $col_val['COLUMN_DEFAULT'].=' '.$col_val['EXTRA'];
                }
                $pri_col_arr[]=$col_val['COLUMN_NAME'];
            }else if($col_val['COLUMN_KEY']=='UNI'){
                $col_val['COLUMN_DEFAULT']='NOT NULL';
                $unique_col_arr[]=$col_val['COLUMN_NAME'];
            }else if(empty($col_val['COLUMN_DEFAULT'])||$col_val['COLUMN_DEFAULT']=='NULL'){
                $col_val['COLUMN_DEFAULT']='DEFAULT NULL';
            }else{
                $col_val['COLUMN_DEFAULT']="NOT NULL DEFAULT '".$col_val['COLUMN_DEFAULT']."'";
            }

            $create_opt_arr[]=$col_val['COLUMN_NAME']." ".$col_val['COLUMN_TYPE']." ".$col_val['COLUMN_DEFAULT']." COMMENT '".$col_val['COLUMN_COMMENT']."'";
        }

        if(!empty($pri_col_arr)){
            $pri_col_str=implode(",",$pri_col_arr);
            $create_opt_arr[]="PRIMARY KEY(".$pri_col_str.")";
        }
        if(!empty($unique_col_arr)){
            foreach($unique_col_arr as $uni_key){
                $create_opt_arr[]="UNIQUE INDEX ".$uni_key."_UNIQUE (".$uni_key.")";
            }
        }
        $create_opt_str=implode(",",$create_opt_arr);//배열을 다시 문자열로 변환해 쿼리에 적용시킬수 있는 상태로 만듬.


        $create_sql="CREATE TABLE ".$table_name."(".$create_opt_str.")";
        $create_sql.="ENGINE=".$table_info['ENGINE']." CHARSET=utf8 COMMENT='".$table_info['TABLE_COMMENT']."'";

        $result_arr=array('result'=>'true','data'=>$create_sql,'msg'=>'성공.');
        return $result_arr;
    }
    public static function getAutoIncrementNum($opt_obj)
    {
        $baseModel=$opt_obj['baseModel'];
        $table=$opt_obj['table'];
        $auto_key=$opt_obj['auto_key'];
        $pri_col_val=$opt_obj['pri_col_val'];
        $pri_pre_fix=isset($opt_obj['pri_pre_fix'])?$opt_obj['pri_pre_fix']:'';

        $auto_num=1;

        if($baseModel==null){
            return null;
        }

        $tmp_where=array();
        foreach($pri_col_val as $key=>$val){
            if($key==$auto_key){continue;}
            $tmp_where[]="AND ".$key."='".$val."'";
        }
        $order_col_str="CAST(".$auto_key." AS INT)";
        if(!empty($pri_pre_fix)){
            $order_col_str="CAST(REPLACE(".$auto_key.",'".$pri_pre_fix."','') AS INT)";
            $tmp_where[]="AND ".$auto_key." LIKE '".$pri_pre_fix."%'";
        }
        $tmp_where[]=" ORDER BY ".$order_col_str." DESC LIMIT 1";
        $sql_opt=array('t'=>$table,'w'=>$tmp_where,'g'=>$auto_key,'o'=>1);
        $last_info=$baseModel->db->get_info_arr($sql_opt, $debug =0);
        if(!empty($last_info)){
            $auto_key_val=str_replace($pri_pre_fix,'',$last_info[$auto_key]);
            if(is_numeric($auto_key_val)){
                $auto_num=$auto_key_val+1;
            }
        }

        return $auto_num;
    }
    //$x_column_arr=DBFunc::getXColumnArrByTableName(['table'=>$table,'baseModel'=>$baseModel]);
    public static function getXColumnArrByTableName($opt_obj){
        $table=$opt_obj['table'];
        $baseModel=$opt_obj['baseModel'];

        $db_name='';
        $table_name='';
        $tmp_tb_arr=explode(".",$table);
        if(count($tmp_tb_arr)==1){
            $table_name=$table;
        }else if(count($tmp_tb_arr)==2){
            $db_name=$tmp_tb_arr[0];
            $table_name=$tmp_tb_arr[1];
        }
        if(empty($db_name)){
            if(empty($db_name)){
                $db_name=$baseModel->db->getDatabaseName();
            }
        }
        //기본컬럼 불러오기
        $x_column_arr=array();
        $tmp_where=array("AND TABLE_NAME='".$table_name."'");
        if(!empty($db_name)){
            $tmp_where[]="AND TABLE_SCHEMA='".$db_name."'";
        }
        $tmp_col='COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,COLUMN_KEY,EXTRA,COLUMN_COMMENT';
        $sql_opt=array('t'=>'INFORMATION_SCHEMA.columns','w'=>$tmp_where,'g'=>$tmp_col);
        $col_name_arr=$baseModel->db->get_info_arr($sql_opt, $debug =0);
        foreach($col_name_arr as $col_info){
            $tmp_col_arr=array(
                'name'=>!empty($col_info['COLUMN_COMMENT'])?$col_info['COLUMN_COMMENT']:$col_info['COLUMN_NAME'],
                'type'=>strtolower($col_info['DATA_TYPE']),
                'length'=>$col_info['CHARACTER_MAXIMUM_LENGTH'],
                'pri'=>$col_info['COLUMN_KEY'],
                'width'=>'100'
            );
            if(strtolower($col_info['EXTRA'])=='auto_increment'){
                $tmp_col_arr['auto']='1';
            }
            $x_column_arr[$col_info['COLUMN_NAME']]=$tmp_col_arr;
        }

        return $x_column_arr;
    }

    /*
    $tmp_rs=DBFunc::getDetailByXColumnArr($x_column_arr);
    $pri_col_arr=$tmp_rs['pri_col_arr'];
    $is_date_col_arr=$tmp_rs['is_date_col_arr'];
    $is_number_col_arr=$tmp_rs['is_number_col_arr'];
    $is_time_col_arr=$tmp_rs['is_time_col_arr'];
     */
    public static function getDetailByXColumnArr($x_column_arr){
        $pri_col_arr=array();
        $last_pri_col='';
        $is_date_col_arr=array();
        $is_number_col_arr=array();
        $is_time_col_arr=array();
        foreach($x_column_arr as $key=>$val){
            if($val['pri']=='PRI'){
                $pri_col_arr[]=$key;
            }
            $val['type']=strtolower($val['type']);
            if(strstr($val['type'],'(')!==false){
                $val['type']=explode($val['type'],'(')[0];
            }
            if(in_array($val['type'],array('date','datetime'))){
                $is_date_col_arr[]=$key;
            }
            if(in_array($val['type'],array('double','float','int','decimal','bigint'))){
                $is_number_col_arr[]=$key;
            }
            if($val['type']=='time'){
                $is_time_col_arr[]=$key;
            }
        }
        if(!empty($pri_col_arr)){
            $last_pri_col=end($pri_col_arr);
        }

        $result_data=array(
            'pri_col_arr'=>$pri_col_arr,
            'last_pri_col'=>$last_pri_col,
            'is_date_col_arr'=>$is_date_col_arr,
            'is_number_col_arr'=>$is_number_col_arr,
            'is_time_col_arr'=>$is_time_col_arr
        );

        return $result_data;
    }

    public static function getColValArrOfCheckValid($opt_arr_obj){
        $opt_arr=[
            'col_val_arr'=>[],
            'is_number_col_arr'=>[],
            'is_date_col_arr'=>[],
            'is_time_col_arr'=>[]
        ];
        foreach($opt_arr_obj as $key=>$val){
            $opt_arr[$key]=$val;
        }
        foreach($opt_arr['col_val_arr'] as $key=>$val){
            $val_str=$val;
            if(in_array($key,$opt_arr['is_number_col_arr'])){
                $val_str=str_replace(',','',$val_str);
            }
            if(empty($val)){
                if(in_array($key,$opt_arr['is_date_col_arr'])){
                    $val_str='null';
                }else if(in_array($key,$opt_arr['is_number_col_arr'])){
                    $val_str='0';
                }else if(in_array($key,$opt_arr['is_time_col_arr'])){
                    $val_str='null';
                }
            }
            $opt_arr['col_val_arr'][$key]=$val_str;
        }
        return $opt_arr['col_val_arr'];
    }

    public static function getPriValStr($opt_arr){
        $pri_col_arr=$opt_arr['pri_col_arr'];
        $info=$opt_arr['info'];
        $pri_val_arr=array();
        foreach($pri_col_arr as $key){
            $pri_val_arr[]=$info[$key];
        }
        $pri_val_str=implode(",",$pri_val_arr);
        return $pri_val_str;
    }

    public static function printXColumnArr($x_column_arr){
        foreach($x_column_arr as $key=>$val){
            echo "'$key'=>array('name'=>'{$val['name']}','type'=>'{$val['type']}','length'=>'{$val['length']}','pri'=>'{$val['pri']}','width'=>'100'),";
            echo "<br />";
        }
    }
}
