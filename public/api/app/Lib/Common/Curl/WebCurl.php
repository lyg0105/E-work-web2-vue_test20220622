<?php
namespace App\Lib\Common\Curl;
/*
$up_file_info=[
    'name'=>$upload_files['name'][$i],
    'type'=>$upload_files['type'][$i],
    'tmp_name'=>$upload_files['tmp_name'][$i],
    'size'=>$upload_files['size'][$i],
    'error'=>$upload_files['error'][$i],
];

$col_val_arr=[
    'data1'=>'1',
    'data2'=>'2',
    '_token'=>csrf_token()
];
$cookie_str='';
foreach($_COOKIE as $n=>$v){
    $cookie_str.=$n.'='.$v.'; ';
}
$file_send_opt=[
    'file_obj'=>$up_file_info,
    'file_key'=>'upload_file',
    'col_val_arr'=>$col_val_arr,
    'cookie_str'=>$cookie_str,
    'url'=>'http://a.localhost/file/receive',
];
$tmp_rs=WebCurl::sendPostToUrl($file_send_opt);
var_dump($tmp_rs);
*/
class WebCurl
{
    public static function sendPostToUrl($opt_arr){
        $file_obj=isset($opt_arr["file_obj"])?$opt_arr["file_obj"]:array();
        $url=$opt_arr["url"];
        $col_val_arr=$opt_arr["col_val_arr"];
        $cookie_str=isset($opt_arr["cookie_str"])?$opt_arr["cookie_str"]:'';
        $file_key=isset($opt_arr["file_key"])?$opt_arr["file_key"]:'input_file';

        $field_arr=$col_val_arr;
        $file_arr=array();
        if(!empty($file_obj)){
            $file_arr=array(
                $file_key=>array(
                    'fileName'=>$file_obj['name'],
                    'fileContent'=>file_get_contents($file_obj['tmp_name']),
                    'fileType'=>$file_obj['type']
                )
            );
        }
        $ch = curl_init($url);
        $ch = self::buildMultiPartRequest($ch,uniqid(),$field_arr,$file_arr);
        if(!empty($cookie_str)){
            curl_setopt($ch,CURLOPT_COOKIE,$cookie_str);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);//SSL 허용 처리
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);//SSL 허용 처리
        $result_str=curl_exec($ch);
        if($result_str === false){
            $result_str=['result'=>'false','data'=>'','msg'=>'전송실패'.curl_error($ch)];
            $result_str=json_encode($result_str);
        }
        curl_close($ch);

        return $result_str;
    }
    public static function buildMultiPartRequest($ch, $boundary, $fields, $files) {
        $delimiter = '-------------' . $boundary;
        $data = '';
        foreach ($fields as $name => $content) {
            $data .=self::getFieldsDataStr($name,$content,$delimiter);
            // $data .= "--" . $delimiter . "\r\n"
            // . 'Content-Disposition: form-data; name="' . $name . "\"\r\n\r\n"
            // . $content . "\r\n";
        }
        foreach ($files as $name => $content) {
            $data .= "--" . $delimiter . "\r\n";
            $data .='Content-Disposition: form-data;';
            $data .='name="' . $name . '";';
            $data .='filename="' . $content['fileName'] . '";';
            $data .='Content-Type='.$content['fileType'].';';
            $data .="\r\n\r\n";
            $data .= $content['fileContent'] . "\r\n";
        }
        $data .= "--" . $delimiter . "--\r\n";
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data; boundary=' . $delimiter,
                'Content-Length: ' . strlen($data)
            ],
            CURLOPT_POSTFIELDS => $data
        ]);
        return $ch;
    }

    public static function getFieldsDataStr($name,$content,$delimiter){
        $data_str='';
        if(is_array($content)){
            foreach($content as $key=>$val){
                $data_str .= "--" . $delimiter . "\r\n"
                . 'Content-Disposition: form-data; name="' . $name . "[]\"\r\n\r\n"
                . $val . "\r\n";
            }
        }else{
            $data_str .= "--" . $delimiter . "\r\n"
            . 'Content-Disposition: form-data; name="' . $name . "\"\r\n\r\n"
            . $content . "\r\n";
        }
        return $data_str;
    }

    public static function commonPost($in_opt_arr=[]){
        $opt_arr=[
            'url'=>'',
            'param'=>[]
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        // $url = 'https://example.com/api';
        // $param = array(
        //     'mid'   => $mid,
        //     'key'   => $key,
        //     'token' => $token
        // );
        $opt_arr['param']=http_build_query($opt_arr['param']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $opt_arr['url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$opt_arr['param']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);//SSL 허용 처리
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);//SSL 허용 처리
        $result_str = curl_exec($ch);
        curl_close($ch);

        if($result_str === false){
            $result_str=['result'=>'false','data'=>'','msg'=>'전송실패'.curl_error($ch)];
            $result_str=json_encode($result_str);
        }

        return $result_str;
    }
}
