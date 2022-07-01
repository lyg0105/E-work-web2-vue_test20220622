<?php
namespace App\Config\Request;

use App\Lib\Common\Web;

//Env::$envArr['DB_CONNECTION'];
class Request
{
    public static $data=[];
    public static $method='';
    public static function init(){
        self::$data=Web::getRequestData();
        self::$method=$_SERVER['REQUEST_METHOD'];
        if(!empty($_POST)){
            self::$method='POST';
        }
    }

    public static function get($key,$default_val=''){
        return isset(self::$data[$key])?self::$data[$key]:$default_val;
    }
}
