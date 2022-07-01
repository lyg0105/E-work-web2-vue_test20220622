<?php
namespace App\Controller\Api\Common\ClassParam;

class ClassParam
{
    public static function getClassDataByRouteParamArr($opt_obj){
        $paramArr=$opt_obj['paramArr'];

        $max_length=count($paramArr);
        $classNameArr=[];
        $methodName='';
        //네임스페이스, 클래스명 앞글자는 대문자
        for($i=0;$i<$max_length;$i++){
            $val=$paramArr[$i];
            if($i==($max_length-1)){
                $methodName=$val;
            }else{
                $firstChar=strtoupper(substr($val,0,1));
                $val=$firstChar.substr($val,1);
                $classNameArr[]=$val;
            }
            $paramArr[$i]=$val;
        }

        //클래스명에 마지막 Controller 생략
        $classLastNameStr=end($classNameArr);
        $classLastNameStr.='Controller';
        $classNameArr[(count($classNameArr)-1)]=$classLastNameStr;

        $paramStr=implode('\\',$paramArr);
        $classNameStr=implode('\\',$classNameArr);

        return [
            'paramArr'=>$paramArr,
            'max_length'=>$max_length,
            'classNameArr'=>$classNameArr,
            'methodName'=>$methodName,
            'paramStr'=>$paramStr,
            'classNameStr'=>$classNameStr,
            'classLastNameStr'=>$classLastNameStr,
        ];
    }
}
