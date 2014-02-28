<?php

/**
 * Declares controllers as shared services
 */
$app['controller.frontend'] = $app->share(function () use ($app) {
    return new \Project\Controller\Frontend($app);
});

/**
 * Declares managers as shared services
 */
$app['manager.user'] = $app->share(function ($app) {
    return new \Project\Manager\User($app);
});

/**
 * Declares some libs as shared services
 */
$app['constant.parser'] = $app->share(function () {
    return new \Project\Lib\ConstantParser();
});

/**
 * Declares forms as services
 */
$app['form.subscription'] = function ($app) {
    return new \Project\Form\SubscriptionForm($app);
};

$app['form.lostPassword'] = function ($app) {
    return new \Project\Form\LostPasswordForm($app);
};

$app['form.newPassword'] = function ($app) {
    return new \Project\Form\NewPasswordForm($app);
};
