<?php 
    return [
        'merchant_id' => env('G241820128'),
        'server_key' => env('SB-Mid-server-CnJxn_ehQltuNunsQNfJRl3m'),
        'client_key' => env('SB-Mid-client-VlcG7DV3_odk4Alv'),
        'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
        'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
        'is_3ds' => env('MIDTRANS_IS_3DS', true),
    ];
?>
