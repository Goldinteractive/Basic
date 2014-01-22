<?php

require_once __DIR__ . '/app/bootstrap.php';

$router = $app->make('Router');

// load all routes
require_once __DIR__ . '/app/routes.php';

// Because we're running the app from a subdirectory, we have
// to adjust the server request.
$request = \Klein\Request::createFromGlobals();

$base_path = $app->make('Config')->get('app.base_path');

if($base_path !== '')
{
    $path = strstr($request->server()->get('REQUEST_URI'), $base_path);
    $request->server()->set('REQUEST_URI', substr($path, strlen($base_path)));
}

$router->dispatch($request);