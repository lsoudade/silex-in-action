<?php

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

$app['form.account'] = function ($app) {
    return new \Project\Form\AccountForm($app);
};

$app['form.account.email'] = function ($app) {
    return new \Project\Form\AccountEmailForm($app);
};

$app['form.account.password'] = function ($app) {
    return new \Project\Form\AccountPasswordForm($app);
};