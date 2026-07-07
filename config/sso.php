<?php

return [
    'private_key_path' => storage_path('app/keys/hospital_private.pem'),
    'issuer' => 'hospital.test',
    'audience' => 'pharmacy.test',
    'ttl' => 60, // seconds - keep short, it's a one-time handoff ticket
    'pharmacy_callback_url' => env('PHARMACY_CALLBACK_URL', 'https://pharmacy.test/sso/callback'),
];
