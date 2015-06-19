<?php

require_once __DIR__ . '/services/controller.inc.php';
require_once __DIR__ . '/services/form.inc.php';
require_once __DIR__ . '/services/manager.inc.php';

/**
 * Other services
 */
$app['constant.parser'] = $app->share(function () {
    return new \Project\Lib\ConstantParser();
});

$app['flashbag'] = $app->share(function ($app) {
    return new \Project\Session\FlashBag($app);
});

$app['password'] = $app->share(function ($app) {
    return new \Project\Security\Password($app);
});

$app['mailer'] = $app->share(function ($app) {
    return new \Project\Lib\Mailer($app);
});