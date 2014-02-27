<?php

/**
 * Handle app errors
 */
$app->error(function (\Exception $e, $code) use ($app) {
    if ( $app['debug'] ) {
        return;
    }

    if ( $code == 404 ) {
        return new Symfony\Component\HttpFoundation\Response($app['twig']->render('Error/404.twig'), 404);
    }
    
    return new Symfony\Component\HttpFoundation\Response($app['twig']->render('Error/500.twig'), 500);
});