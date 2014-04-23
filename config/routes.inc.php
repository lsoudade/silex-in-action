<?php

/*
 * General routing
 */
$app->get('/', 'controller.frontend:homepage')->bind('homepage');
$app->match('/signup', 'controller.registration:signup')->bind('signup')->method('GET|POST');
$app->get('/signin', 'controller.authentication:signin')->bind('signin');
$app->get('/signout', 'controller.authentication:signout')->bind('signout');

/*
 * Lost password
 */
$app->match('/lost-password', 'controller.authentication:lostPassword')->bind('lost_password')->method('GET|POST');
$app->match('/lost-password/reinitialize/{token}', 'controller.authentication:lostPasswordReinitialize')->bind('lost_password_reinitialize')->method('GET|POST');


/*
 * Custom routing
 */
//$app->match('/route/sample', 'controller.frontend:action')->bind('default_action')->method('GET|POST');
//$app->get('/route/sample/{page}', 'controller.frontend:action')->value('page', 1)->bind('default_action');