<?php

/**
 * Declares controllers as shared services
 */
$app['controller.frontend'] = $app->share(function () use ($app) {
    return new \Project\Controller\Frontend($app);
});

$app['controller.authentication'] = $app->share(function () use ($app) {
    return new \Project\Controller\Authentication($app);
});

$app['controller.registration'] = $app->share(function () use ($app) {
    return new \Project\Controller\Registration($app);
});

$app['controller.user'] = $app->share(function () use ($app) {
    return new \Project\Controller\User($app);
});