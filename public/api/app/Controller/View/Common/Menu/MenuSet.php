<?php
namespace App\Controller\View\Common\Menu;

use App\Config\Session\Session;
use App\Values\Menu\Menu;
use App\Values\XColumn\XColumnArr;

class MenuSet
{
    public static function getMenuByUrl($in_opt_arr=[])
    {
        $opt_arr=[
            'url'=>'',
            'urlArr'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        $menuArr=[];

        $menuSort='';
        if(!empty($opt_arr['urlArr'])){
            $menuSort='Comp/Menu';
        }
        $menu=new Menu(['sort'=>$menuSort]);
        $menuArr=$menu->menu;

        $now_menu=null;
        foreach($menuArr['sub'] as $key=>$val){
            //head기본url세팅
            if(isset($menuArr['head'][$val['head']])){
                if(empty($menuArr['head'][$val['head']]['url'])){
                    $menuArr['head'][$val['head']]['url']=$val['url'];
                }
            }
            //now page 세팅
            if($val['url']==ROOT_DIR.$opt_arr['url']){
                $now_menu=$val;
                $now_menu['sub']=$key;
            }
        }

        if(!empty($now_menu)){
            //xcolumn세팅
            if(!empty($now_menu['list_sort'])){
                $xColumnArr_obj=new XColumnArr(['list_sort'=>$now_menu['list_sort']]);
                $now_menu['xcolumn_obj']=$xColumnArr_obj->getData();
            }
            $opt_arr['now_menu']=$now_menu;
        }
        $opt_arr['menuArr']=$menuArr;

        return $opt_arr;
    }
}
