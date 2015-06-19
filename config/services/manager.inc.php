<?php

/**
 * Declares managers as shared services
 */
$app['manager.user'] = $app->share(function ($app) {
    return new \Project\Manager\User($app);
});

$app['manager.passwordToken'] = $app->share(function ($app) {
    return new \Project\Manager\PasswordToken($app);
});