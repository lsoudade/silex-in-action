<?php

$app->register(new Silex\Provider\SecurityServiceProvider());

$app['security.firewalls'] = array(
    'website' => array(
        'anonymous' => true,
        'pattern' => '^/',
        'form' => array('login_path' => '/signin', 'check_path' => '/login_check'),
        'users' => $app->share(
            function () use ($app) {
                return new \Project\Provider\UserProvider($app);
            }
        ),
        'logout' => array('logout_path' => '/logout')
    )
);

$app['security.access_rules'] = array(
    array('^/private', 'ROLE_USER'),
    array('^/admin', 'ROLE_ADMIN'),
);