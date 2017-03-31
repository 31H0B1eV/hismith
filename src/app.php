<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Provider\FormServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new Silex\Provider\VarDumperServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app->register(new ConsoleServiceProvider(), array(
    'console.name'              => 'hismith',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/console'
));

$app['twig.path'] = array(__DIR__.'/../views');
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

/**
 * required by forms provider
 */
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
    'translator.domains' => array(),
));

/** ======== */
$app->register(new FormServiceProvider());

/** Remove it in production */

$app['debug'] = true;
$app->register(new Silex\Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../cache/profiler',
));
$app->register(new Sorien\Provider\DoctrineProfilerServiceProvider());

/** =========  */

return $app;