<?php
namespace App\Route;

use App\Lib\Common\Url\WebUrl;
use App\Lib\Common\Web;
use App\Controller\View\Common\ViewCommonController;
use App\Controller\Api\Common\ApiCommonController;
use App\Config\Request\Request;

class Route
{
    public $url='';
    public $urlArr=[];
    public $urlAction='';

    function route()
    {
        $this->splitUrl();

        //$tmp_arr=array_splice($urlArr,1);//첫번째 인자 제외한 배열 얻기
        if($this->urlAction=='api'){
            $urlArr=$this->urlArr;
            $tmp_arr=array_splice($this->urlArr,1);
            $tmp_opt_arr=[
                'url'=>$this->url,
                'urlArr'=>$urlArr,
                'apiArr'=>$tmp_arr
            ];
            $apiCommonController=new ApiCommonController();
            $result_json_str=$apiCommonController->api($tmp_opt_arr);
            if(is_array($result_json_str)){
                echo \json_encode($result_json_str,JSON_UNESCAPED_UNICODE);
            }else{
                echo $result_json_str;
            }
        }else{
            $tmp_opt_arr=[
                'url'=>$this->url,
                'urlArr'=>$this->urlArr
            ];
            $viewCommonController=new ViewCommonController();
            $viewCommonController->view($tmp_opt_arr);
        }
    }
    function splitUrl()
    {
        $this->url=WebUrl::getBaseUrl();
        $this->urlArr=explode('/',$this->url);

        if(count($this->urlArr)>0){
            $this->urlAction=$this->urlArr[0];
        }
    }
}
