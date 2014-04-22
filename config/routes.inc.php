<?php

/*
 * General routing
 */
$app->get('/', 'controller.frontend:homepage')->bind('homepage');
$app->get('/signup', 'controller.frontend:signup')->bind('signup');
$app->get('/signin', 'controller.frontend:signin')->bind('signin');
$app->get('/signout', 'controller.frontend:signout')->bind('signout');

/*
 * Custom routing
 */
//$app->match('/route/sample', 'controller.frontend:action')->bind('default_action')->method('GET|POST');
//$app->get('/route/sample/{page}', 'controller.frontend:action')->value('page', 1)->bind('default_action');