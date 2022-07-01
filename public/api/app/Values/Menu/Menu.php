<?php
namespace App\Values\Menu;
//use App\Values\Menu\Menu;
class Menu
{
    public $menu=['head'=>[],'sub'=>[]];
    public $sort='Recruit/Menu';
    public function __construct($opt_obj)
    {
        $this->sort=isset($opt_obj['sort'])?$opt_obj['sort']:'Recruit/Menu';
        if(!empty($this->sort)){
            $now_path=ABS.'app/Values/Menu/';
            $tmp_file_path=$now_path.$this->sort.'.php';
            if(file_exists($tmp_file_path)){
                include $tmp_file_path;
            }
        }
    }
}
