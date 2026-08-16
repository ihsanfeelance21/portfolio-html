<?php

return [
    'db' => [
        'host'    => getenv('DB_HOST') ?: 'db',
        'port'    => getenv('DB_PORT') ?: '3306',
        'name'    => getenv('DB_NAME') ?: 'portfolio_db',
        'user'    => getenv('DB_USER') ?: 'portfolio',
        'pass'    => getenv('DB_PASS') ?: '',
        'charset' => 'utf8mb4',
    ],
    'app' => [
        'name'     => 'Portofolio',
        'base_url' => getenv('BASE_URL') ?: 'http://localhost:8080',
        'env'      => getenv('APP_ENV') ?: 'production',
        'debug'    => (getenv('APP_DEBUG') ?: 'false') === 'true',
        'timezone' => 'Asia/Jakarta',
    ],
    'session' => [
        'name'     => 'portfolio_session',
        'lifetime' => 7200,
    ],
    'upload' => [
        'dir'       => APP_ROOT . '/public/uploads',
        'max_size'  => 2 * 1024 * 1024, // 2 MB
        'allowed'   => ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
        'extensions'=> ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp', 'gif' => 'image/gif'],
    ],
];
