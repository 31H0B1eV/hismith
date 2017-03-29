<?php

require __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app = require __DIR__.'/../src/app.php';
//controller routers
require __DIR__ . '/../src/routes.php';

$app->run();