<?php
namespace App\Model\Base;

use App\Model\Base\Model;
use App\Lib\Web\Web;
use App\Config\Env\Env;

class BaseModel
{
    public $db=null;

    function __construct($in_opt_arr=[]){
        $opt_arr=[
            'server_num'=>'MAIN'
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $this->db=new Model();
        if(!empty($opt_arr['server_num'])){
            $this->connectToServer($opt_arr['server_num']);
        }
    }

    public function connectToServer($server_num){
        $server_num=strtoupper($server_num);
        $db_host=Env::get('DB_HOST', '');
        $db_user=Env::get('DB_USERNAME', '');
        $db_pass=Env::get('DB_PASSWORD', '');
        $db_name=Env::get('DB_DATABASE', '');
        $db_charset='utf-8';
        $db_port=Env::get('DB_PORT', '');
    }
}
