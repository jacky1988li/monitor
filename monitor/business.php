<?php

// nginx
// php-fpm
// df -h < 50G
// mysql-connect

$error='';
$cmd = "ps -ef|grep /sbin/nginx|grep -v 'grep'|wc -l";
$ngNum = shell_exec($cmd);
if ($ngNum==0) {
    $error .= 'Nginx 已经宕掉！' . BR;
}

$cmd = "ps -ef|grep etc/php-fpm.conf|grep -v 'grep'|wc -l";
$fpmNum = shell_exec($cmd);
if ($fpmNum==0) {
    $error .= 'Php-fpm 已经宕掉！' . BR;
}

if (ONLINE) {
    $cmd = "df | grep /dev/vdb1|awk '{print " . '$4' . "}'";
} else {
    $cmd = "df | grep /home|awk '{print " . '$3' . "}'";
}
$df = shell_exec($cmd);
if (intval($df/1024/1024) <= 50) {
    $error .= '磁盘可用空间已经不足50G！' . BR;
}

// 监测线上mysql - infoflow 是否可以连接
try {
    $db = new PDO(config('database.DB_DSN'), config('database.DB_USER'), config('database.DB_PASS'));
    $db = null;
} catch(PDOException $e) {
    $error .= 'Mysql infoflow 无法连接，原因：' . $e->getMessage() . '！';
}

// 监测线上mysql - ssp 是否可以连接
try {
    $db = new PDO(config('database.DB_DSN_SSP'), config('database.DB_USER_SSP'), config('database.DB_PASS_SSP'));
    $db = null;
} catch(PDOException $e) {
    $error .= 'Mysql ssp 无法连接，原因：' . $e->getMessage() . '！';
}

if ($error) {
    $params = [];
    $params['toAddress'] = ['52lichenglong@163.com'];
    $params['Subject'] = '服务器预警-' . date('YmdHis');
    $params['body'] = $error;
    OpEmail::sendEmail($params);
    echo '已经发送预警报告！' . PHP_EOL;
} else {
    echo '一切正常！' . PHP_EOL;
}

