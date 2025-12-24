<?php
declare(strict_types=1);
class Router
{
    private array $routes = [];

    public function add(string $method, string $path, $ControllerOrView)
    {
        $path = $this->normalizePath($path);

        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'handler' => $ControllerOrView,
        ];
    }
    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);
        return $path;
    }

    public function dispatch(string $path)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($_SERVER['REQUEST_METHOD']);

        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['path']}$#", $path) ||
                $route['method'] !== $method
            ) {
                continue;
            }

            $handler = $route['handler'];

            if (is_array($handler)) {
                [$class, $function] = $handler;
                $controllerInstance = new $class;
                return $controllerInstance->{$function}();
            }

            if (is_string($handler)) {
                return include $handler;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}