<?php

return [
    'name' => env('ADMIN_NAME', 'A1 Legacy Labs Admin'),
    'email' => env('ADMIN_EMAIL', 'admin@neutron.test'),
    'password' => env('ADMIN_PASSWORD', 'ChangeMe123!'),
    'session_timeout' => (int) env('ADMIN_SESSION_TIMEOUT', 15),
];
