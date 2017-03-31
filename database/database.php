<?php

/**
 * By default used config for local docker environment
 */
// $DATABASE_HOST = getenv(APP_DATABASE_HOST, true) ?: 'mysql';
// $DATABASE_NAME = getenv(APP_DATABASE_NAME, true) ?: 'research';
// $DATABASE_USER = getenv(APP_DATABASE_USER, true) ?: 'homestead';
// $DATABASE_PASSWORD = getenv(APP_DATABASE_PASSWORD, true) ?: 'secret';

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array (
        'mysql' => array(
            'driver'    => 'pdo_mysql',
            'host'      => 'us-cdbr-iron-east-03.cleardb.net',
            'dbname'    => 'heroku_47b24447e49f376',
            'user'      => 'b0e35a2d4ecca0',
            'password'  => 'aea93765',
        ),
    ),
));