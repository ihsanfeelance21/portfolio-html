<?php

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require CONFIG_DIR . '/routes.php';
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = '/' . ltrim(rtrim($uri, '/'), '/');
        if ($uri === '') {
            $uri = '/';
        }

        // Guard admin
        if ($this->isAdminPath($uri) && $uri !== '/admin/login' && !Auth::check()) {
            header('Location: ' . url('/admin/login'));
            exit;
        }

        $routes = $this->routes[$method] ?? [];

        // Exact match
        if (isset($routes[$uri])) {
            $this->call($routes[$uri], []);
            return;
        }

        // Regex match
        foreach ($routes as $pattern => $handler) {
            if (strpos($pattern, '(') === false) {
                continue;
            }
            if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                array_shift($matches);
                $this->call($handler, $matches);
                return;
            }
        }

        $this->notFound();
    }

    private function call(array $handler, array $params): void
    {
        [$class, $method] = $handler;
        if (!class_exists($class) || !method_exists($class, $method)) {
            $this->notFound();
            return;
        }
        $controller = new $class();
        $controller->{$method}(...$params);
    }

    private function isAdminPath(string $uri): bool
    {
        return strpos($uri, '/admin') === 0;
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo View::render('pages/404');
    }
}
