<?php

use App\Core\Router;

function dd($v): never
{
    var_dump($v);
    die;
}

function view($name, $data = []): void
{
    extract($data);
    if (file_exists(__DIR__ . "/../Views/$name.php")):
        require_once __DIR__ . "/../Views/$name.php";
    else:
        echo "<h1 style='color: red;text-align: center'>View [$name] Not found</h1>";
        exit();
    endif;
}

function config($key): mixed
{
    $config = require __DIR__ . '/config.php';

    if (array_key_exists($key, $config)):
        return $config[$key];
    else:
        echo "<h1 style='color: red;text-align: center'>[$key] not found in config.php file</h1>";
        exit();
    endif;
}

function route($routeName, $data = []): string
{
    return config('app_url') . (new Router)->GetRouteByName($routeName, $data);
}

function redirect($routeName, $data = []): void
{
    header('Location: ' . route($routeName, $data));
    exit();
}

function public_dir(string $file): string
{
    if (strpos($file, '/') === 0):
        $file = substr($file, 1);
    endif;

    return config('public_url') . $file;
}

function abort($code = 404): void
{
    http_response_code($code);

    if (file_exists(__DIR__ . "/../Views/errors/$code.php")) {
        view("errors/$code");
    } else {
        echo "Error $code";
    }

    exit();
}

function addFlash(string $message, string $type = 'success'): bool
{
    $_SESSION['flashMessages'][] = [
        'message' => $message,
        'type' => $type,
    ];

    return true;
}

function getFlashMessages(): array
{
    return $_SESSION['flashMessages'] ?? [];
}

function clearFlashMessages(): void
{
    unset($_SESSION['flashMessages']);
}

function login(array $data): void
{
    $_SESSION['user'] = $data;
}

function logout(): void
{
    session_destroy();
}
