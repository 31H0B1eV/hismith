<?php

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__ . '/../src/routes.php';
require __DIR__ . '/../database/database.php';

$app->run();