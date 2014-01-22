<?php
// if there's an error in one of our routes. Redirect back with the error
// message. This is used for the POST contactrequest route
$router->respond(function ($request, $response, $service) use ($router, $app) {
    // Handle exceptions => flash the message and redirect to the referrer
    $router->onError(function ($router, $err_msg) {
        $router->service()->flash($error, 'error');
        $router->service()->back();
    });

    $service->request_url = $request->server()->get('REQUEST_URI');

    if($app->make('Config')->get('app.base_path') !== '')
    {
        $service->base_url = 'http://' . $request->server()->get('HTTP_HOST') . '/' . $app->make('Config')->get('app.base_path') . '/';
    }
    else
    {
        $service->base_url = 'http://' . $request->server()->get('HTTP_HOST') . '/';
    }
});

// loop all the defined slugs and create a get route for it
foreach($app->make('Config')->get('app.sites') as $site)
{
    $slugs = array($site['slug']);

    if(array_key_exists('is_index', $site) and $site['is_index'] === true)
    {
        $slugs[] = '';
    }

    foreach ($slugs as $key => $slug)
    {
        $router->respond('GET', '/'. $slug, function ($request, $response, $service) use ($app, $site) {
            $service->render($app->make('Config')->get('app.views_path') . '/' . array_get($site, 'file', $site['slug']) . '.php');
        });
    }

}