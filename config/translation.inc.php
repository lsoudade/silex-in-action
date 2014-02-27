<?php

use Symfony\Component\Translation\Loader\YamlFileLoader;

$app['locale'] = 'fr';

$app['locale_fallback'] = 'en';

$app['translator'] = $app->share(
    $app->extend(
        'translator',
        function ($translator, $app) {
            $translator->addLoader('yaml', new YamlFileLoader());
            return $translator;
        }
    )
);

$locale = $app['locale'];
if ($app['session']->get('current_locale')) {
    $locale = $app['session']->get('current_locale');
}

foreach (glob(__DIR__ . '/i18n/' . $locale . '/*.yml') as $file) {
    $app['translator']->addResource('yaml', $file, $locale);
}

/* sets current language */
$app['translator']->setLocale($locale);