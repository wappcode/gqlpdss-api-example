<?php

/**
 * Copy and rename file to doctrine.local.php
 */
return [
    "driver" => [
        'user'     =>   '',
        'password' =>   '',
        'dbname'   =>   '',
        'driver'   =>   'pdo_mysql',
        'host'   =>     '127.0.0.1',
        'charset' =>    'utf8mb4'
    ],
    "entities" => require __DIR__ . "/doctrine.entities.php"
];
