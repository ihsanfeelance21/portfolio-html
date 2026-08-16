<?php

// ===== Helper global =====

if (!function_exists('e')) {
    function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('url')) {
    function url(string $path = ''): string
    {
        $base = rtrim((string) getenv('BASE_URL'), '/');
        return $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('slugify')) {
    function slugify(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        return Csrf::field();
    }
}

if (!function_exists('config')) {
    function config(?string $key = null)
    {
        static $config = null;
        if ($config === null) {
            $config = require CONFIG_DIR . '/config.php';
        }
        if ($key === null) {
            return $config;
        }
        $value = $config;
        foreach (explode('.', $key) as $part) {
            if (!is_array($value) || !array_key_exists($part, $value)) {
                return null;
            }
            $value = $value[$part];
        }
        return $value;
    }
}

// ===== Session & flash =====

if (!function_exists('session_started')) {
    function session_started(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            $lifetime = (int) config('session.lifetime');
            session_name((string) config('session.name'));
            session_set_cookie_params([
                'lifetime' => $lifetime,
                'path'     => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            session_start();
        }
    }
}

if (!function_exists('flash_set')) {
    function flash_set(string $key, $value): void
    {
        $_SESSION['flash'][$key] = $value;
    }
}

if (!function_exists('flash_get')) {
    function flash_get(string $key)
    {
        $value = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $value;
    }
}

if (!function_exists('flash_has')) {
    function flash_has(string $key): bool
    {
        return isset($_SESSION['flash'][$key]);
    }
}

if (!function_exists('old')) {
    function old(string $key, ?string $default = ''): string
    {
        return e($_SESSION['old'][$key] ?? $default);
    }
}

if (!function_exists('old_set')) {
    function old_set(array $data): void
    {
        $_SESSION['old'] = $data;
    }
}

if (!function_exists('old_clear')) {
    function old_clear(): void
    {
        unset($_SESSION['old']);
    }
}
