<?php

use Ghanem\RemoteImage\RemoteImageService;

if (!function_exists('product_image')) {
    function product_image($productName)
    {
        return app(RemoteImageService::class)->getImage($productName);
    }
}
