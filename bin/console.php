<?php

require __DIR__ . '/bootstrap.php';

$application = new \Symfony\Component\Console\Application();

// Add bin classes here
//$application->add(new \Project\Bin\MyCommand($app));

$application->run();