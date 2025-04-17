<?php

return [
    'base_url' => env('QLS_API_BASE_URL'),
    'user' => env('QLS_API_USER'),
    'pwd' => env('QLS_API_PWD'),
    'company_id' => env('QLS_API_COMPANY_ID'),
    'brand_id' => env('QLS_API_BRAND_ID'),
    'log_response' => env('QLS_API_LOG_RESPONSE', false),
    'cache_key' => env('QLS_API_CACHE_KEY', 'QLS_API_CLIENT_'),
    'storage' => [
        'labels' => env('QLS_API_STORAGE_SHIPMENTS', 'orders/labels/%s.pdf'),
        'labels_packages' => env('QLS_API_STORAGE_SHIPMENTS', 'orders/labels_packages/%s'),
        'packages' => env('QLS_API_STORAGE_SHIPMENTS', 'orders/labels_packages'),
    ]
];
