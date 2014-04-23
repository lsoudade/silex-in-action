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

/**
 * Declares managers as shared services
 */
$app['manager.user'] = $app->share(function ($app) {
    return new \Project\Manager\User($app);
});

$app['manager.passwordToken'] = $app->share(function ($app) {
    return new \Project\Manager\PasswordToken($app);
});

/**
 * Declares forms as services
 */
$app['form.signup'] = function ($app) {
    return new \Project\Form\SignupForm($app);
};

$app['form.lostPassword'] = function ($app) {
    return new \Project\Form\LostPasswordForm($app);
};

$app['form.newPassword'] = function ($app) {
    return new \Project\Form\NewPasswordForm($app);
};

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