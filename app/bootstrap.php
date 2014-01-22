<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \Illuminate\Database\Capsule\Manager as Capsule;

// set up IoC
$app = new \Illuminate\Container\Container;

// set up Config loader
$configPath = __DIR__ . '/config';
$environment = preg_match('/localhost|10.0.1/',$_SERVER["HTTP_HOST"]) ? 'dev' : 'production';

$app->singleton('Config', function() use($configPath, $environment) {
    $file = new Illuminate\Filesystem\Filesystem;
    $loader = new Illuminate\Config\FileLoader($file, $configPath);
    $config = new Illuminate\Config\Repository($loader, $environment);

    return $config;
});

// bind router (klein)
$app->singleton('Router', function() {
    $klein = new \Klein\Klein();

    return $klein;
});

// bind database (Capsule)
$app->singleton('DB', function() use($app) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $config = $app->make('Config');

    $capsule->addConnection($config->get('database.connection'));

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
});

// include helpers
require_once __DIR__ . '/helpers.php';

