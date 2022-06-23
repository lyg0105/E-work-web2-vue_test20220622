<?php
// str_replace : 치환 함수 (1번째 인수 : 변경대상 문자, 2번째 인수 : 변경하려는 문자, 3번째 인수 : 변수, replace가 바꾸고자 하는 문자열(변수수))
$url=str_replace(['?'.$_SERVER['QUERY_STRING']],'',trim($_SERVER['REQUEST_URI']));
$url=str_replace(['/index.php'],'/',$url);

//안전하지 않은 url 값 필터링
// filter_var : 지정된 필터로 변수를 필터링함
$url=filter_var($url,FILTER_SANITIZE_URL);

//공백제거
// explode : 문자열을 분할하여 배열로 저장하는 함수, implode : 배열에 속한 문자열을 하나의 문자열로 만드는 함수
// array_filter : 배열에 존재하는 모든 값들에 대해 사용자정의함수로 필터링을 하여 통과한 값을 가지고 새로운 배열을 만드는 함수
$url_arr=explode('/',$url);
$url_arr=array_filter($url_arr);
$url=implode('/',$url_arr);

echo "URL:";
echo "<br />";
echo $url;