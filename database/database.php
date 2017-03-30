<?php

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array (
        'mysql' => array(
            'driver'    => 'pdo_mysql',
            'host'      => 'mysql',
            'dbname'    => 'research',
            'user'      => 'homestead',
            'password'  => 'secret',
        ),
    ),
));