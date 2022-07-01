<?php
namespace App\Config;

use App\Config\Env\Env;
use App\Config\Session\Session;
use App\Model\Fix\StaticModel;
use App\Config\Request\Request;
/*
new App\Config\Config([
    'DIR_PUBLIC'=>__DIR__
]);
*/
class Config
{
    public $opt_arr=[
        'DIR_PUBLIC'=>''
    ];
    function __construct($in_opt_arr=[]){
        foreach($in_opt_arr as $key=>$val){
            $this->opt_arr[$key]=$val;
        }
        $this->setConstant();

        ini_set("session.cookie_lifetime", 0); //초
        ini_set("session.cache_expire", 1440); //분
        ini_set("session.gc_maxlifetime", 86400); //초
        session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]);
        session_name(Env::$envArr['APP_NAME']);
        session_start();

        $this->setErrorDisplay();
        Session::init();
        StaticModel::init();
        Request::init();
    }
    public function setConstant(){
        $now_dir=str_replace('\\','/',$this->opt_arr['DIR_PUBLIC']);
        //$now_dir=substr($now_dir,0,-6);
        $now_dir=$now_dir."/";

        define('ABS',$now_dir);
        define('ROOT_DIR','/');
        define('VIEW_DIR',$now_dir.'app/View/');
        Env::setEnvByFile(ABS.'.env');
        define('SCRIPT_VERSION',Env::get('SCRIPT_VERSION'));
    }
    public function setErrorDisplay(){
        if(!empty(Env::get('APP_DEBUG'))){
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        }else{
            ini_set("display_errors", 0);
        }
    }
}
