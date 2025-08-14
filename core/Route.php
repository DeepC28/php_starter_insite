<?php

class Route
{
    public string $path;
    public string $controller;
    public string $method;

    public function __construct(string $path, string $controller, string $method)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->method = $method;
    }
}
