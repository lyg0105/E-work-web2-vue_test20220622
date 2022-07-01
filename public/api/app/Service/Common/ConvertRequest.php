<?php
namespace App\Service\Common;

use App\Service\BaseService;
use App\Service\Common\Convert\GetRequestDataByTable;
use App\Service\Common\Convert\GetDefalutOptDataByPost;
use App\Service\Common\Convert\GetDefaultRequestColValArr;

class ConvertRequest extends BaseService
{
    public static function getRequestDataByTable($opt_obj){
        $result_arr=GetRequestDataByTable::action($opt_obj);
        return $result_arr;
    }

    public static function getDefalutOptDataByPost($in_opt_obj=[]){
        $result_arr=GetDefalutOptDataByPost::action($in_opt_obj);
        return $result_arr;
    }

    public static function getDefaultRequestColValArr($in_opt_arr){
        $result_arr=GetDefaultRequestColValArr::action($in_opt_arr);
        return $result_arr;
    }
}
