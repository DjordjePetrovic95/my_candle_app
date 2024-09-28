<?php

use App\Core\Router;
use App\Models\User;

function dd(mixed $value, mixed ...$values): never
{
    var_dump(func_get_args());
    die;
}

/**
 * @param array<int|string, mixed> $data
 */
function view(string $name, array $data = []): void
{
    if (! file_exists(__DIR__ . "/../views/$name.php")) {
        abort(404);
    }

    extract($data);
    require_once __DIR__ . "/../views/$name.php";
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

function abort(int $code = 404, ?string $message = null): void
{
    $message ??= match($code) {
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        default => 'Internal Server Error',
    };

    http_response_code($code);
    view('errors/generic', compact('code', 'message'));
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
    $_SESSION['user'] = serialize($user);
}

function logout(): void
{
    session_destroy();
}

function currentUser(): ?User
{
    $user = unserialize($_SESSION['user'] ?? '');
    return $user instanceof User ? $user : null;
}
