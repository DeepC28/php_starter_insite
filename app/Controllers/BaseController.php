<?php

class BaseController
{
    public function __construct()
    {
        session_start();

        if (!defined('BASE_PATH')) {
            define('BASE_PATH', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
        }

        $this->checkLogin();
    }

    protected function checkLogin()
    {
        $path = strtok($_SERVER['REQUEST_URI'], '?');
        $relativePath = '/' . ltrim(str_replace(BASE_PATH, '', $path), '/');

        if (!isset($_SESSION['user']) && !preg_match('#^/(login|logout)$#', $relativePath)) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }
    }

    protected function render($view, $data = [])
    {
        extract($data);
        $layoutPath = __DIR__ . '/../views/layouts/main.php';
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($layoutPath)) {
            die("Layout file not found: $layoutPath");
        }

        if (!file_exists($viewPath)) {
            die("View file not found: $viewPath");
        }

        $GLOBALS['__VIEW_PATH__'] = $viewPath;

        require_once $layoutPath;
    }
}
