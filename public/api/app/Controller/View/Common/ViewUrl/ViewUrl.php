<?php
namespace App\Controller\View\Common\ViewUrl;

class ViewUrl
{
    public static function getCheckedViewUrl($in_opt_arr=[])
    {
        $opt_arr=[
            'url'=>'',
            'urlArr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }

        if(empty($opt_arr['url'])){
            $opt_arr['url']='comp/login/login';
        }
        $opt_arr['urlArr']=explode('/',$opt_arr['url']);
        $viewSrc=VIEW_DIR.$opt_arr['url'];

        if(is_dir($viewSrc)){
            $viewSrc=$viewSrc.'/index.php';
        }
        if(!file_exists($viewSrc)||empty($opt_arr['url'])){
            $opt_arr['url']='error/empty';
            $viewSrc='error/empty/index.php';
        }
        $opt_arr['viewSrc']=$viewSrc;

        return $opt_arr;
    }
}
