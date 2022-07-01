<?php
namespace App\Controller\View\Common;

use App\Controller\BaseController;
use App\Lib\Common\View\ViewHtml;
use App\Config\Session\Session;
use App\Model\Base\BaseModel;
use App\Model\Base\Func\DBFunc;
use App\Model\Fix\StaticModel;

use App\Controller\View\Common\ViewUrl\ViewUrl;
use App\Controller\View\Common\Menu\MenuSet;

class ViewCommonController extends BaseController
{
    public function view($in_opt_arr=[])
    {
        $opt_arr=[
            'url'=>'',
            'urlArr'=>[],
            'requestData'=>[],
            'sessionArr'=>Session::$sessionArr,
            'menuArr'=>[],
            'now_menu'=>[],
            'viewSrc'=>''
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }

        $tmp_rs=ViewUrl::getCheckedViewUrl($opt_arr);
        foreach($tmp_rs as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $tmp_rs=MenuSet::getMenuByUrl($opt_arr);
        foreach($tmp_rs as $key=>$val){
            $opt_arr[$key]=$val;
        }

        //테이블정보 프린트
        // $baseModel=new BaseModel();
        // $baseModel=StaticModel::$db;
        // $x_column_arr=DBFunc::getXColumnArrByTableName(['table'=>'anote_tax','baseModel'=>$baseModel]);
        // DBFunc::printXColumnArr($x_column_arr);

        $viewDataArr=$opt_arr;
        ViewHtml::view([
            'viewSrc'=>$opt_arr['viewSrc'],
            'viewData'=>$viewDataArr
        ]);
    }
}
