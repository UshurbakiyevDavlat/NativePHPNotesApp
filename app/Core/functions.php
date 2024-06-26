<?php

use App\Core\Session;
use App\Enums\ResponseEnum;
use JetBrains\PhpStorm\NoReturn;

/**
 * Die and dump function
 *
 * @param mixed $value
 * @return void
 */
#[NoReturn] function dd(mixed ...$value): void
{
    var_dump($value);
    die();
}

/**
 * Check url function
 *
 * @param string $uri
 * @return bool
 */
function urlIs(string $uri): bool
{
    return $uri === $_SERVER['REQUEST_URI'];
}

/**
 * Authorize function
 *
 * @param bool $condition
 * @param int $statusCode
 * @return void
 */
function authorize(bool $condition, int $statusCode = ResponseEnum::FORBIDDEN): void
{
    if ($condition) {
        abort($statusCode);
    }
}

/**
 * Abort operation function
 *
 * @param int $code
 * @return mixed
 */
function abort(int $code = ResponseEnum::NOT_FOUND): mixed
{
    http_response_code($code);
    return require view('errors/' . $code);
}

/**
 * Generate base path function
 *
 * @param string $path
 * @return string
 */
function base_path(string $path = ''): string
{
    return BASE_PATH . $path;
}

/**
 * View template function
 *
 * @param string $view
 * @param array $data
 * @return mixed
 */
function view(string $view, array $data = []): mixed
{
    extract($data, EXTR_SKIP);
    return require base_path("resources/views/{$view}.view.php");
}

/**
 * Get env variable helper function
 *
 * @param string $variable
 * @param string $default
 * @return array|string
 */
function env(string $variable, string $default): array|string
{
    $env = getenv($variable);
    return !empty($env) ? $env : $default;
}

/**
 * Redirect function
 *
 * @param string $path
 * @return void
 */
#[NoReturn] function redirect(string $path): void
{
    header("Location: {$path}");
    exit();
}

/**
 * Return old session value
 *
 * @param string $key
 * @param string $default
 * @return mixed|string
 */
function old(string $key, string $default = ''): mixed
{
    return Session::get('old')[$key] ?? $default;
}

/**
 * @return mixed
 */
function previousUrl(): mixed
{
    return $_SERVER['HTTP_REFERER'];
}