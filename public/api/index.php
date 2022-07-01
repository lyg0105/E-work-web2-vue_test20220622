<?php
include "./vendor/autoload.php";

new App\Config\Config([
    'DIR_PUBLIC'=>__DIR__
]);

$route=new App\Route\Route();
$route->route();
