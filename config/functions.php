<?php

use App\Core\Router;
use App\Models\User;

function dd(mixed $v): never
{
    var_dump($v);
    die;
}

/**
 * @param array<int|string, mixed> $data
 */
function view(string $name, array $data = []): void
{
    extract($data);
    if (file_exists(__DIR__ . "/../views/$name.php")):
        require_once __DIR__ . "/../views/$name.php";
    else:
        echo "<h1 style='color: red;text-align: center'>View [$name] Not found</h1>";
        exit();
    endif;
}

/**
 * @param array<string, mixed> $data
 * @throws Exception
 */
function route(string $routeName, array $data = []): string
{
    return config('app.app_url') . (new Router)->GetRouteByName($routeName, $data);
}

/**
 * @param array<string, mixed> $data
 * @throws Exception
 */
function redirect(string $routeName, array $data = []): never
{
    header('Location: ' . route($routeName, $data));
    exit();
}

function public_dir(string $file): string
{
    $file = ltrim($file, '/');

    return config('app.public_url') . $file;
}

function abort(int $code = 404): never
{
    http_response_code($code);

    if (file_exists(__DIR__ . "/../views/errors/$code.php")) {
        view("errors/$code");
    } else {
        echo "Error $code";
    }

    exit();
}

/**
 * @phpstan-param 'success'|'warning'|'danger' $type
 */
function addFlash(string $message, string $type = 'success'): bool
{
    $_SESSION['flashMessages'][] = [
        'message' => $message,
        'type' => $type,
    ];

    return true;
}

/**
 * @phpstan-return list<array{message: string, type: 'success'|'warning'|'danger'}>
 */
function getFlashMessages(): array
{
    return $_SESSION['flashMessages'] ?? [];
}

function clearFlashMessages(): void
{
    unset($_SESSION['flashMessages']);
}

function login(User $user): void
{
    $_SESSION['user'] = $user;
}

function logout(): void
{
    session_destroy();
}
