<?php

return [
    'enable' => env('REMOTE_IMAGE_ENABLE', false),
    'api_url' => env('REMOTE_IMAGE_API_URL', 'https://storage-online.ghanempharmacy.com/api/medicines/search'),
    'timeout' => env('REMOTE_IMAGE_TIMEOUT', 3),
    'cache_duration' => env('REMOTE_IMAGE_CACHE_DURATION', 3600),
];
