<?php

/*
 * General routing
 */
$app->get('/', 'Controller\Default::home')->bind('home');

/*
 * Custom routing
 */
//$app->match('/route/sample', 'Controller\Default::action')->bind('default_action')->method('GET|POST');
//$app->get('/route/sample/{page}', 'Controller\Default::action')->value('page', 1)->bind('default_action');