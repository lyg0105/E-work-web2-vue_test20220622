<?php
namespace App\Config\Env;

//Env::$envArr['DB_CONNECTION'];
class Env
{
    public static $envArr=[];
    function __construct($in_opt_arr=[]){
        $opt_arr=[
            'envSrc'=>''
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        if(!empty($opt_arr['envSrc'])){
            $this->setEnvByFile($opt_arr['envSrc']);
        }
    }

    public static function setEnvByFile($envSrc){
        if(empty($envSrc)){return false;}
        if(!file_exists($envSrc)){return false;}

        self::$envArr=parse_ini_file($envSrc, true, INI_SCANNER_RAW);
        
        return true;
    }

    public static function get($key,$default_val=''){
        return isset(self::$envArr[$key])?self::$envArr[$key]:$default_val;
    }
}
