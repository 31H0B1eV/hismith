<?php
/**
 * By default used config for local docker environment
 */
$DATABASE_HOST = getenv(APP_DATABASE_HOST, true) ?: 'mysql';
$DATABASE_NAME = getenv(APP_DATABASE_NAME, true) ?: 'research';
$DATABASE_USER = getenv(APP_DATABASE_USER, true) ?: 'homestead';
$DATABASE_PASSWORD = getenv(APP_DATABASE_PASSWORD, true) ?: 'secret';
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array (
        'mysql' => array(
            'driver'    => 'pdo_mysql',
            'host'      => $DATABASE_HOST,
            'dbname'    => $DATABASE_NAME,
            'user'      => $DATABASE_USER,
            'password'  => $DATABASE_PASSWORD,
        ),
    ),
));