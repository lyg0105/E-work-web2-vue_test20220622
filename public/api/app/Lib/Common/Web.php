<?php
namespace App\Lib\Common;

class Web
{
    public static function data($method_str,$name_str,$default_str,$in_opt_arr=array()){
        $method_str=strtolower($method_str);
        $opt_arr=array(
            'is_number'=>'',
        );
        foreach($in_opt_arr as $key=>$val){$opt_arr[$key]=$val;}

        //is_array
        $data_str='';
        if(strstr($method_str,'get')!==false){
            //get
            $data_str=isset($_GET[$name_str])?$_GET[$name_str]:$default_str;
        }else if(strstr($method_str,'post')!==false){
            //post
            $data_str=isset($_POST[$name_str])?$_POST[$name_str]:$default_str;
        }else if($method_str=='arr'){
            //post
            $data_str=isset($default_str[$name_str])?$default_str[$name_str]:'';
        }

        $check_method_str='checkHtml';
        if($method_str=='get'||$method_str=='post'||$method_str=='arr'){
            $check_method_str='checkHtmlStr';
        }

        if(is_array($data_str)){
            foreach($data_str as $key=>$val){
                if(is_array($val)){
                    $val=self::data('arr',$key,$data_str,$opt_arr);
                }else{
                    $val=Web::$check_method_str($val);
                }
                $data_str[$key]=$val;
            }
        }else{
            $data_str=Web::$check_method_str($data_str);
        }
        foreach ($opt_arr as $key=>$val){
            if($key=="is_number"){
                if(!empty($val)){
                    $data_str=str_replace(",","",$data_str);//,를 지우는 함수
                    if(empty($data_str)){
                        $data_str="0";
                    }else{
                        $data_str=number_format($data_str,0,".","");//오른쪽에서 0번째(끝에)를 소수점으로 넣는 함수
                    }
                }
            }
        }

        return $data_str;
    }

    public static function getRequestData($in_opt_arr=[]){
        $opt_arr=[
            'method'=>$_SERVER['REQUEST_METHOD']
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $method=$opt_arr['method'];
        $requestData=[];
        if($method=='GET'){
            $requestData=$_GET;
        }else if($method=='POST'){
            $requestData=$_POST;
        }else if($method=='PUT'){
            parse_str(file_get_contents("php://input"),$requestData);
        }else if($method=='DELETE'){
            parse_str(file_get_contents("php://input"),$requestData);
        }
        foreach($requestData as $key=>$val){
            $requestData[$key]=self::data($method,$key,'');
        }
        return $requestData;
    }

    public static function checkHtml($in_str){
        $replace_str_arr=array(
            '\\','\'','<script','<?','<meta',' 1=1 ','</script','?>'
        );
        $return_str=str_ireplace($replace_str_arr,'',$in_str);
        trim($return_str);
        return $return_str;
    }

    //사용자 입력값에대한 보안
    public static function checkHtmlStr($contents){
        $contents=self::checkHtml($contents);
        $contents=addslashes($contents);
        $contents=htmlspecialchars($contents);
        $contents=str_replace('&amp;','&',$contents);
        //$contents=htmlentities($contents);  //htmlentities 이것은 한글을 깨지개해서 뺀다.
        $contents=strip_tags($contents);
        return $contents;
    }
    //MySQL 접속을 열 때
    public static function checkMysqlStr($contents){
        $contents=mysql_real_escape_string($contents);
        $contents=Web::checkHtmlStr($contents);
        return $contents;
    }

    public static function alert($msg,$loc,$is_exit=true){
        if(!empty($msg)){
            echo "<script>alert('".$msg."');</script>";
        }
        if(!empty($loc)){
            echo "<script>location.href='".$loc."';</script>";
        }
        if($is_exit){
            exit(0);
        }
    }

    public static function split_tel_number($opt_obj){
        $tel_str=$opt_obj['tel_str'];
        $tel_str=str_replace('+82','0',$tel_str);
        $is_split=isset($opt_obj['is_split'])?$opt_obj['is_split']:true;

        $tel_arr=array("","","");
        $tel_str=preg_replace("/[^0-9]*/s","",$tel_str);//숫자만 추출
        if(strlen($tel_str)==11){
            $tel_arr[0]=substr($tel_str,0,3);
            $tel_arr[1]=substr($tel_str,3,4);
            $tel_arr[2]=substr($tel_str,7,4);
        }else if(strlen($tel_str)==10){
            $tel_arr[0]=substr($tel_str,0,3);
            $tel_arr[1]=substr($tel_str,3,3);
            $tel_arr[2]=substr($tel_str,6,4);
        }else if(strlen($tel_str)==9){
            $tel_arr[0]=substr($tel_str,0,2);
            $tel_arr[1]=substr($tel_str,2,3);
            $tel_arr[2]=substr($tel_str,5,4);
        }else if(strlen($tel_str)==7){
            $tel_arr[0]="043";
            $tel_arr[1]=substr($tel_str,0,3);
            $tel_arr[2]=substr($tel_str,3,4);
        }else{
            $tel_arr[0]=$tel_str;
        }

        $tel_result=$tel_arr;
        if($is_split==false){
            $tmp_tel_str='';
            for($i=0;$i<count($tel_arr);$i++){
                if(!empty($tel_arr[$i])){
                    if($i!=0){
                        $tmp_tel_str.='-';
                    }
                    $tmp_tel_str.=$tel_arr[$i];
                }
            }
            $tel_result=$tmp_tel_str;
        }

        return $tel_result;
    }

    //사업자번호 포맷
    public static function get_format_of_busin($busin_str){
        $busin_str=str_replace("-","",$busin_str);
        $busin_str=trim($busin_str);
        $busin_str=preg_replace("/[^0-9]*/s","",$busin_str);//숫자만 추출
        $result_str="";
        if(strlen($busin_str)>=10){
            $result_str=substr($busin_str,0,3)."-".substr($busin_str,3,2)."-".substr($busin_str,5,6);
        }

        return $result_str;
    }

    //date_foramt
    public static function date_form($date,$format="Y-m-d",$defalut=""){
        $date_str=$defalut;
        $is_val=true;
        if(!empty($date)&&$date!="0000-00-00 00:00:00"&&$date!="0000-00-00"&&$date!="false"&&$date!="FALSE"){

        }else{
            $is_val=false;
        }
        if(preg_match('/^(\d{4})-(\d{2})-(\d{2})$/',substr($date,0,10),$match) && checkdate($match[2],$match[3],$match[1])){

        }else{
            $is_val=false;
        }
        if($is_val){
            $date = date_create($date);
            $date_str=date_format($date,$format);
        }
        return $date_str;
    }

    //확장자체크
    public static function check_file_extension($ext){
        $DenyArr = Array('exe','html', 'htm', 'php','avi','dll');
        $ext = strtolower($ext);
        $is_val=true;
        if(in_array($ext,$DenyArr)){
            $is_val=false;
        }
        return $is_val;
    }

    public static function get_now_folder_src($now_path,$except_str){
        $now_folder_src=str_replace('\\','/',$now_path);
        $now_folder_src=str_replace($except_str,'',$now_folder_src);
        $now_folder_arr=explode('/',$now_folder_src);
        $now_folder_src=str_replace(end($now_folder_arr),'',$now_folder_src);

        return $now_folder_src;
    }
    public static function isImageFileByExt($ext){
        $ext_arr=array("bib","jpeg","png","bmp","gif","jpe","jpg","tif","tiff","jfif","bmp");
        $result=false;
        $ext=strtolower($ext);
        if(in_array($ext,$ext_arr)!==false){
            $result=true;
        }
        return $result;
    }
    public static function isSecure(){
        return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
    }

    public static function get_client_ip_address(){
        $ipaddress = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else if(!empty($_SERVER['HTTP_X_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }else if(!empty($_SERVER['HTTP_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }else if(!empty($_SERVER['HTTP_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }else if(!empty($_SERVER['REMOTE_ADDR'])){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

    public static function strReplace($search_str,$target_str,$str){
        if(($p=strpos($str,$search_str))!==false){
            $str=substr_replace($str,$target_str,$p,strlen($search_str));
        }
        return $str;
    }

    public static function iconvEncode(){
        $encode = array('ASCII','UTF-8','EUC-KR');
        foreach($RES_DATA as $key=>$val){
            if(mb_detect_encoding($val, $encode)=="EUC-KR"){
                $RES_DATA[$key]=iconv("EUC-KR", "UTF-8", $val);
            }
        }
    }

    //$info_arr=Web::getConvertedPrefixInfoArr($info_arr,['prefix'=>$this->col_prefix,'change_prefix'=>'a']);
    public static function getConvertedPrefixInfoArr($info_arr,$in_opt_arr=[]){
        $opt_arr=[
            'prefix'=>'',
            'change_prefix'=>'a',
            'except_str_arr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        if(empty($opt_arr['prefix'])){
            return $info_arr;
        }
        $tmp_info_arr=[];
        foreach($info_arr as $info){
            $tmp_info=[];
            foreach($info as $key=>$val){
                $is_able_key=true;
                foreach($opt_arr['except_str_arr'] as $except_str){
                    if(strstr($key,$except_str)!==false){
                        $is_able_key=false;
                    }
                }
                if($is_able_key){
                    if(substr($key,0,strlen($opt_arr['prefix'].'_'))==$opt_arr['prefix'].'_'){
                        $key=self::strReplace($opt_arr['prefix'].'_',$opt_arr['change_prefix'].'_',$key);
                    }
                    $tmp_info[$key]=$val;
                }
            }
            $tmp_info_arr[]=$tmp_info;
        }
        return $tmp_info_arr;
    }
}
?>
