<?php
namespace App\Lib\Common\Response;


class Response
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /*
    [
        'result'=>'true/false',
        'data'=>[
            ['name'=>'1','title'=>'test'],
            ['name'=>'2','title'=>'test2'],
        ],
        'msg'=>'strMessage',
        'error'=>[
            ['row_num'=>'1','msg'=>''],
        ]
    ]
    */
    public function response($result_arr = [])
    {
        $response = [
            'result' => 'true',
            'data' => '',
            'msg' =>'',
            'error' =>[],
        ];
        if(!empty($result_arr)){
            foreach($result_arr as $key=>$val){
                $response[$key]=$val;
            }
        }
        return \json_encode($response,JSON_UNESCAPED_UNICODE);
    }
}
