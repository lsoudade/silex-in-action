<?php

$monologFile = __DIR__ . '/../log/app.log';
$app['monolog.logfile'] = $monologFile;
$app['debug'] = true;

if ( $app['debug'] ) {
    $logger = new Doctrine\DBAL\Logging\DebugStack();
    $app['db.config']->setSQLLogger($logger);
    $app->error(function(\Exception $e, $code) use ($app, $logger) {
        if ( $e instanceof PDOException and count($logger->queries) ) {
            // We want to log the query as an ERROR for PDO exceptions!
            $query = array_pop($logger->queries);
            $app['monolog']->err($query['sql'], array(
                'params' => $query['params'],
                'types' => $query['types']
            ));
        }
    });
    $app->after(function(Symfony\Component\HttpFoundation\Request $request, Symfony\Component\HttpFoundation\Response $response) use ($app, $logger) {
        // Log all queries as DEBUG.
        foreach ( $logger->queries as $query ) {
            $app['monolog']->debug($query['sql'], array(
                'params' => $query['params'],
                'types' => $query['types']
            ));
        }
    });
}