<?php
namespace App\Config\Session;

//Env::$envArr['DB_CONNECTION'];
use App\Config\Env\Env;
use App\Lib\Common\Web;

class Session
{
    public static $sessionArr=[];
    public static function init(){
        self::$sessionArr=[];
        if(!empty($_SESSION)){
            $prefix=Env::get('APP_NAME').'_';
            foreach($_SESSION as $key=>$val){
                $key=Web::strReplace($prefix,'',$key);
                self::$sessionArr[$key]=$val;
            }
        }
    }
    public static function setSession($in_opt_arr=[]){
        $opt_arr=[
            'sessionArr'=>[
                'user_type'=>'',
                'dlit_code'=>'',
                'api_key'=>'',
                'dlit_type'=>'',
                'jasa_code'=>'',
                'jasa_title'=>'',
                'jasa_busin_num'=>'',
                'user_seq'=>'',
                'user_id'=>'',
                'user_name'=>'',
                'is_popbill_join'=>'',
                'popbill_member_id'=>'',
                'is_save_log'=>'1',
                'is_api_login'=>''
            ],
            'is_save'=>true
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $prefix=Env::get('APP_NAME').'_';
        foreach($opt_arr['sessionArr'] as $key=>$val){
            self::$sessionArr[$key]=$val;
            if($opt_arr['is_save']){
                $_SESSION[$prefix.$key]=$val;
            }
        }
    }
    public static function destroy(){
        self::$sessionArr=[];
        session_unset();
        session_destroy();
    }

    public static function get($key,$default_val=''){
        return isset(self::$sessionArr[$key])?self::$sessionArr[$key]:$default_val;
    }
}
