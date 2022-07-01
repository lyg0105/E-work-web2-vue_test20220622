<?php
namespace App\Model\Fix;

use App\Model\Base\BaseModel;
use App\Config\Session\Session;
use App\Model\Base\Func\DBFunc;

class StaticModel
{
    public static $db_main=null;//메인DB
    public static $db=null;//로그인DB
    public static $db_call=null;//콜센터DB
    public static $db_chazu=null;//콜센터DB

    public static function init(){
        if(empty(self::$db_main)){
            self::$db_main=new BaseModel(['server_num'=>'MAIN']);
        }
        if(empty(self::$db_call)){
            self::$db_call=new BaseModel(['server_num'=>'CALL']);
        }
        if(empty(self::$db_chazu)){
            //self::$db_chazu=new BaseModel(['server_num'=>'CHAZU']);
        }
        if(!empty(Session::get('user_type'))){//comp,mobile
            //로그인된 세션으로 db 연결
            $dlit_code=Session::get('dlit_code');
            $user_id=Session::get('user_id');
            if(empty($dlit_code)){
                self::$db=new BaseModel(['server_num'=>'MAIN']);
            }else{
                $tmp_rs=DBfunc::getBaseModelBydlitId(['dlit_code'=>$dlit_code]);
                self::$db=$tmp_rs['data'];
            }
        }else{
            self::$db=new BaseModel(['server_num'=>'MAIN']);
        }
    }
}
