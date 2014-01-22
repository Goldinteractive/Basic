<?php

return array(

    'asset_path' => __DIR__ . '/../..',

    'base_path' => '', // path where the project is located without the document root.

    'views_path' => __DIR__ . '/../../views',

    /*
    |--------------------------------------------------------------------------
    | List of all the normal sites
    |--------------------------------------------------------------------------
    |
    | this array gets looped and a route is automatically generated
    | for either a matching filename or the specificaly defined file.
    | This works only for GET requests.
    | file and is_index are both optional
    |
    */
    'sites' => array(

        array('slug' => 'home', 'file' => 'index', 'is_index' => true),

    ),
);
