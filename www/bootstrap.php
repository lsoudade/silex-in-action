<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__ . '/../config/providers.inc.php';
require __DIR__ . '/../config/services.inc.php';
require __DIR__ . '/../config/persistence.inc.php';
require __DIR__ . '/../config/view.inc.php';
require __DIR__ . '/../config/log.inc.php';
require __DIR__ . '/../config/routes.inc.php';
require __DIR__ . '/../config/translation.inc.php';
require __DIR__ . '/../config/security.inc.php'; 
require __DIR__ . '/../config/errors.inc.php'; 
require __DIR__ . '/../config/hooks.inc.php';