<?php
// 设置时区
date_default_timezone_set('PRC');

// 设置路径
define("APP", str_replace('\\', '/', dirname(__DIR__)) . '/'); 
define("DB", APP . './lib/db.php' );

$host = 'localhost';
$user = 'root';
$pwd = 'root';
$db = 'bblog';
$pre = 'pre_';

// 引入库文件
include_once( DB );

// 链接数据库
$cn = connect($host, $user, $pwd, $db);

include_once( '../lib/helper.php' );
include_once( '../lib/pagination.php' );