<?php

if ( ! function_exists('printImage'))
{
    /**
     * Generate image markup with correct width and
     * height set
     *
     * @param  string  $imageUrl  Path to the image relative to the assets folder
     * @param  string  $class
     * @return string
     */
    function printImage($imageUrl = '', $class = '') {
        global $app;

        $asset_path = $app->make('Config')->get('app.asset_path');
        $size = getimagesize($asset_path . '/' . $imageUrl);

        $width = $size[0];
        $height = $size[1];

        return "<img src='$imageUrl' width='$width' height='$height' class='$class' />";
    };
}