<?php

class RouteCollection
{
    private array $routes = [];

    public function add(string $path, string $controller, string $method): void
    {
        $this->routes[$path] = new Route($path, $controller, $method);
    }

    public function match(string $uri): ?Route
    {
        return $this->routes[$uri] ?? null;
    }
}
