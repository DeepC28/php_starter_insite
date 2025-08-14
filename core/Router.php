<?php

class Router
{
    public function handleRequest()
    {
        $basePath = '/php_project_site';
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = str_replace('/index.php', '', $uri);
        $uri = '/' . trim($uri, '/');
        if ($uri === '/') {
            $uri = '/';
        }

        // โหลด route collection
        $routes = require_once __DIR__ . '/../routes/web.php';

        /** @var Route|null $route */
        $route = $routes->match($uri);

        if ($route) {
            $controllerName = $route->controller;
            $method = $route->method;
            $params = [];
        } else {
            // fallback แบบ segment
            $segments = explode('/', trim($uri, '/'));
            $controllerName = ucfirst($segments[0]) . 'Controller';
            $method = $segments[1] ?? 'index';
            $params = array_slice($segments, 2);
        }

        $controllerFile = 'app/Controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                if (method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], $params);
                    return;
                } else {
                    http_response_code(404);
                    echo "Method '$method' not found in controller '$controllerName'.";
                    return;
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
