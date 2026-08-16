<?php

declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));
define('APP_DIR', APP_ROOT . '/app');
define('CONFIG_DIR', APP_DIR . '/config');
define('VIEWS_DIR', APP_DIR . '/views');

require APP_DIR . '/helpers.php';

session_started();

date_default_timezone_set((string) (config('app.timezone') ?: 'Asia/Jakarta'));

spl_autoload_register(function (string $class): void {
    foreach (['core', 'controllers', 'models'] as $dir) {
        $file = APP_DIR . '/' . $dir . '/' . $class . '.php';
        if (is_file($file)) {
            require $file;
            return;
        }
    }
});

try {
    (new Router())->dispatch(
        $_SERVER['REQUEST_METHOD'] ?? 'GET',
        (string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH)
    );
} catch (Throwable $e) {
    if (config('app.debug')) {
        http_response_code(500);
        echo '<h1>Internal Server Error</h1><pre>' . e($e->getMessage()) . "\n" . e($e->getTraceAsString()) . '</pre>';
    } else {
        http_response_code(500);
        echo View::render('pages/500');
    }
}
