<?php
namespace App\Controller\Api\Common;

use App\Controller\BaseController;
use App\Controller\Api\Common\ClassParam\ClassParam;

class ApiCommonController extends BaseController
{
    public function api($in_opt_arr=[]){
        $opt_arr=[
            'url'=>'',
            'urlArr'=>[],
            'apiArr'=>[],
            'menuArr'=>[],
            'optArr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $tmpApiArr=['App','Controller'];
        foreach($opt_arr['urlArr'] as $val){
            $tmpApiArr[]=$val;
        }
        $classDataArr=ClassParam::getClassDataByRouteParamArr(['paramArr'=>$tmpApiArr]);
        if(class_exists($classDataArr['classNameStr'])){
            $classObj=new $classDataArr['classNameStr']();
            if(method_exists($classObj,$classDataArr['methodName'])){
                $tmp_methodName=$classDataArr['methodName'];
                $result_arr=$classObj->$tmp_methodName();
                return $result_arr;
            }else{
                $result_arr=['result'=>'false','msg'=>'해당서비스의 기능이 없습니다.'];
                return $this->response($result_arr);
            }
        }
        $result_arr=['result'=>'false','msg'=>'페이지없음'.$classDataArr['classNameStr']];
        return $this->response($result_arr);
    }
}
