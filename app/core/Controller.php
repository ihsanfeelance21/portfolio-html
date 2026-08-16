<?php

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        echo View::render($view, $data);
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit;
    }

    protected function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        header('Location: ' . $referer);
        exit;
    }

    protected function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }

    protected function input(string $key, ?string $default = ''): string
    {
        return trim((string) ($_POST[$key] ?? $default));
    }

    protected function int(string $key, int $default = 0): int
    {
        return (int) ($_POST[$key] ?? $default);
    }

    protected function verifyCsrf(): bool
    {
        return Csrf::verify();
    }
}
