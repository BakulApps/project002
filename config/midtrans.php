<?php

return [
    'midtrans_payment_method' => env('MIDTRANS_PAYMENT_METHOD', ['credit_card','cimb_clicks','mandiri_clickpay','echannel']),

    'midtrans_server_key' => env('MIDTRANS_SERVER_KEY', ''),

    'midtrans_is_production' => env('MIDTRANS_IS_PRODUCTION', true),

    'midtrans_is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),

    'midtrans_is_3ds' => env('MIDTRANS_IS_3DS', true)
];
