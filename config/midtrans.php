<?php

return [
    'payment_method' => env('MIDTRANS_PAYMENT_METHOD', ['credit_card','cimb_clicks','mandiri_clickpay','echannel']),

    'server_key' => env('MIDTRANS_SERVER_KEY', ''),

    'is_production' => env('MIDTRANS_IS_PRODUCTION', true),

    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),

    'is_3ds' => env('MIDTRANS_IS_3DS', true),

    'merchant' => env('MIDTRANS_MERCHANT', 'Yayasan Darul Hikmah Menganti'),

    'expire_unit' => env('MIDTRANS_EXPIRE_UNIT', 'hours'),

    'expire_duratin' => env('MIDTRANS_EXPIRE_DURATION', 1)
];
