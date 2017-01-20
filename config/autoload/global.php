<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

/**
 *         'dsn'    => sprintf('sqlite:%s/data/zftutorial.db', realpath(getcwd())),
'dsn'    => 'mysql:dbname=dcc;host=localhost;charset=utf8',
 *
 * resources.db.adapter = "PDO_MYSQL"
resources.db.params.host = "localhost"
resources.db.params.username = "root"
resources.db.params.password = "Nitsche&21"
resources.db.params.dbname = "test_wd_dcc"
 */
return [
    'db' => [
        'driver' => 'Pdo_Mysql',
        'database' => 'currency',
        'username' => 'currency',
        'password' => 'VG2YhpN4;',
        'hostname' => 'localhost',
        'charset' => 'utf8',
        'port' => '3306',
    ],
];
