<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

require __DIR__ . '/bootstrap.php';

$app->run();