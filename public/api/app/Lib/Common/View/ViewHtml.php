<?php
namespace App\Lib\Common\View;

class ViewHtml
{
    public static function view($in_opt_arr=[]){
        $opt_arr=[
            'viewSrc'=>'',
            'viewData'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }

        if(empty($opt_arr['viewSrc'])){
            echo '페이지가 없습니다.';
        }else if(file_exists($opt_arr['viewSrc'])){
            //extract($opt_arr['viewDataArr']);
            $viewData=$opt_arr['viewData'];
            if(is_dir($opt_arr['viewSrc'])){
                echo "페이지가 없습니다..";
            }else{
                include_once $opt_arr['viewSrc'];
            }
        }else{
            echo '페이지가 없습니다.';
        }
    }
}
