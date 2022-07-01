<?php
namespace App\Lib\Common\Image;

class WebImg
{
    public static function createBbsThumbnail($ori_file_path,$th_extension,$save_file,$height){
        @ini_set('gd.jpeg_ignore_warning', 1);
        $img_info = getImageSize($ori_file_path);//원본이미지의 정보를 얻어온다. $img_info 는 배열로 생성되며  0=가로 , 1=세로 길이 정보를 가지고 있다.
        $ori_file;
        $th_height=$height;
        if(empty($img_info[0])){
            $img_info=array($height,$height);
        }
        //생성할 썸네일 가로 길이. 비율에 맞게 구하기
        $th_width=($img_info[1]/$height);
        $th_width=$img_info[0]/$th_width;
        $th_width=(int)$th_width;

        $tmp_ext = strtolower($th_extension);

        //1. 파일 종류에 따라 원본파일을 불러온다.
        switch ($tmp_ext) {
            case 'gif':
                $ori_file = imagecreatefromgif($ori_file_path);
                break;

            case 'jpeg':
                $ori_file = @imagecreatefromjpeg($ori_file_path);
                break;

            case 'jpg':
                $ori_file = @imagecreatefromjpeg($ori_file_path);
                break;

            case 'png':
                $ori_file = imagecreatefrompng($ori_file_path);
                break;

            case 'bmp':
                $ori_file = imagecreatefrombmp($ori_file_path);
                break;
        }

        // 생성할 썸네일 틀을 만든다, 매개변수=가로,세로 길이
        $new_img = imagecreatetruecolor($th_width , $th_height);

        //원본이미지를 썸네일 틀에 붙혀넣는다.
        imagecopyresampled($new_img , $ori_file , 0,0,0,0,$th_width,$th_height,$img_info[0],$img_info[1]);

        //썸네일 저장
        switch ($tmp_ext) {
            case 'gif':
                imagegif($new_img , $save_file);
                break;

            case 'jpeg':
                imagejpeg($new_img , $save_file);
                break;

            case 'jpg':
                imagejpeg($new_img , $save_file);
                break;

            case 'png':
                imagepng($new_img , $save_file);
                break;

            case 'bmp':
                imagebmp($new_img , $save_file);
                break;

        }

    }

    //이미지 회전시키기
    public static function rotateImageFromFile($ori_file_path,$th_extension,$th_save_file_path,$rotate){

        $img_info = getImageSize($ori_file_path);//원본이미지의 정보를 얻어온다. $img_info 는 배열로 생성되며  0=가로 , 1=세로 길이 정보를 가지고 있다.
        $ori_file;

        //생성할 썸네일 가로 길이. 비율에 맞게 구하기
        $th_width=$img_info[0];
        $th_height=$img_info[1];

        $tmp_ext = strtolower($th_extension);

        //1. 파일 종류에 따라 원본파일을 불러온다.
        switch ($tmp_ext) {
            case 'gif':
                $ori_file = imagecreatefromgif($ori_file_path);
                break;

            case 'jpeg':
                $ori_file = @imagecreatefromjpeg($ori_file_path);
                break;

            case 'jpg':
                $ori_file = @imagecreatefromjpeg($ori_file_path);
                break;

            case 'png':
                $ori_file = imagecreatefrompng($ori_file_path);
                break;

            case 'bmp':
                $ori_file = imagecreatefrombmp($ori_file_path);
                break;

        }

        // 생성할 썸네일 틀을 만든다, 매개변수=가로,세로 길이

        //이미지 회전
        $new_img=imagerotate($ori_file,$rotate,0);

        $save_file = $th_save_file_path;

        //회전된 파일 저장
        switch ($tmp_ext) {
            case 'gif':
                imagegif($new_img , $save_file);
                break;

            case 'jpeg':
                imagejpeg($new_img , $save_file);
                break;

            case 'jpg':
                imagejpeg($new_img , $save_file);
                break;

            case 'png':
                imagepng($new_img , $save_file);
                break;

            case 'bmp':
                imagebmp($new_img , $save_file);
                break;

        }
    }

    public static function check_is_image($filename){
        $is_image=false;
        if(file_exists($filename)){
            $size = getimagesize($filename);
            if($size){
                $is_image=true;
            }
        }

        return $is_image;
    }

    public static function checkRemoteFile($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE){
            return true;
        }else{
            return false;
        }
    }

    public static function isImageFileByExt($ext){
        $ext_arr=array("bib","jpeg","png","bmp","gif","jpe","jpg","tif","tiff","jfif","bmp");
        $result=false;
        $ext=strtolower($ext);
        if(in_array($ext,$ext_arr)!==false){
            $result=true;
        }
        return $result;
    }
}
