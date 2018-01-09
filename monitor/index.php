<?php

// WEB 根目录
define('ROOT_DIR', getcwd());
define('PHP_EXT', '.php');
define('BR', "<br>");
date_default_timezone_set('Asia/Shanghai');

include_once ROOT_DIR . '/libraries/function.php';
// 自动加载
spl_autoload_register( 'loadprint' );
define('ONLINE', !file_exists('.env'));

// 加载业务文件，需要处理的业务放在business.php 中
include_once ROOT_DIR . '/business.php';



