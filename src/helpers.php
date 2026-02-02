<?php

use Ghanem\RemoteImage\RemoteImageService;

if (!function_exists('product_image')) {
    function product_image($productName, $defaultPath)
    {
        return app(RemoteImageService::class)->getImage($productName, $defaultPath);
    }
}
