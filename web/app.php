<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// Read environment
$env = getenv('SYMFONY_ENV') ?: 'dev';
$debug = (bool) getenv('SYMFONY_DEBUG');
$cache = (bool) getenv('SYMFONY_CACHE');

$loader = require_once __DIR__.'/../app/autoload.php';

if ($debug) {
    Debug::enable();
}

$kernel = new AppKernel($env, $debug);

if (!$debug) {
    $loader->unregister();

    $loader = new ApcClassLoader(sha1(__FILE__), $loader);
    $loader->register(true);

    $kernel->loadClassCache();
}

if ($cache) {
    $kernel = new AppCache($kernel);
    Request::enableHttpMethodParameterOverride();
}

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
