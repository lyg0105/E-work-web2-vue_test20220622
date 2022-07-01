<?php
namespace App\Controller;

use App\Lib\Common\Response\Response;

class BaseController
{
    public function response($result_arr=[]){
        $response=new Response();
        $result_arr=$response->response($result_arr);
        return $result_arr;
    }
}
