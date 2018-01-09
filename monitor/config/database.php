<?php


if (ONLINE) {
    return [
        'DB_USER' => 'infoflow',
        'DB_PASS' => 'i8Te_!n8&xZ',
        'DB_DSN' => 'mysql:host=10.168.10.163;port=3306;dbname=infoflow',

        'DB_USER_SSP' => 'sspuser',
        'DB_PASS_SSP' => '5_!9Zn)$JnW2',
        'DB_DSN_SSP' => 'mysql:host=10.168.10.163;port=3306;dbname=ssp',
    ];
} else {
    return [
        'DB_USER' => 'root',
        'DB_PASS' => 'Wangxiang2016',
        'DB_DSN' => 'mysql:host=127.0.0.1;port=3306;dbname=infoflow',

        'DB_USER_SSP' => 'root',
        'DB_PASS_SSP' => 'Wangxiang2016',
        'DB_DSN_SSP' => 'mysql:host=127.0.0.1;port=3306;dbname=infoflow',
    ];
}


