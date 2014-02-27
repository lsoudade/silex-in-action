<?php

$app->register(new Silex\Provider\TwigServiceProvider());

$app['twig.path'] = __DIR__ . '/../views';
$app["twig"] = $app->share($app->extend('twig', function (\Twig_Environment $twig, Silex\Application $app) {
    $twig->addExtension(new \Project\Twig\Extension\PaginationTwigExtension($app));
    $twig->addExtension(new \Project\Twig\Extension\TimeTwigExtension($app));
    
    // Twig date filter format
    $twig->getExtension('core')->setDateFormat('d/m/Y', 'Europe/Paris');
    
    return $twig;
}));