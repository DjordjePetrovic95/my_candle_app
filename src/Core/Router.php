<?php

namespace App\Core;

class Router
{
    private string $path;

    /**
     * @var array<string, string>
     */
    private array $parameters = [];

    private ?string $controller = null;

    private ?string $method = null;

    public function __construct()
    {
        /** @phpstan-ignore-next-line */
        $requestUri = (string) str_replace(config('app.subdirectory'), '', $_SERVER['REQUEST_URI']);
        $requestUri = str_replace('//', DIRECTORY_SEPARATOR, $requestUri);
        $requestUri = parse_url($requestUri, PHP_URL_PATH);

        if (! is_string($requestUri)) {
            throw new \Exception('Request URI could not be parsed.');
        }

        $this->path = $requestUri;
    }

    public function GetRoute(): void
    {
        $routes = routes();
        foreach ($routes as $route) {
            if ($this->ValidateRoute($route['url'])) {
                $this->controller = $route['controller'];
                $this->method = $route['method'];

                break;
            }
        }

        if ($this->controller && $this->method) {
            $Instance = new $this->controller();
            $method = $this->method;
            $Instance->{$method}(...$this->parameters);
        } else {
            abort();
        }
    }

    /**
     * @param array<string, mixed> $data
     */
    public function GetRouteByName(string $routeName, array $data): string
    {
        $routes = routes();
        $searchRoute = $routes[$routeName] ?? null;

        if (empty($searchRoute)) {
            return $routeName;
        }
        $extractUrlParams = array_values(array_filter(explode('/', $searchRoute['url'])));

        foreach ($extractUrlParams as $key => $param) {
            if (preg_match('/{(.*?)}/', $param)) {
                $variable = str_replace(['{', '}'], '', $param);

                if (in_array($variable, array_keys($data), true)) {
                    $extractUrlParams[$key] = $data[$variable];
                } else {
                    echo "<h2 style='direction: rtl;color:red;text-align:center'>value for {{$variable}} in {{$routeName}} Route is not defined.</h2>";

                    throw new \Exception("value for {{$variable}} in {{$routeName}} Route is not defined");
                }
            }
        }

        return implode('/', $extractUrlParams);
    }

    private function ValidateRoute(string $routeUrl): bool
    {
        // uri that programmer define
        $uri = array_values(array_filter(explode('/', $routeUrl)));

        // client url
        $url = array_values(array_filter(explode('/', $this->path)));

        if (count($uri) !== count($url)) {
            return false;
        }

        foreach ($uri as $key => $params) {
            // if url has {*} accept whatever in it
            if (preg_match('/{(.*?)}/', $params)) {
                $param = str_replace(['{', '}'], '', $params);
                $this->parameters[$param] = $url[$key];

                continue;
            }
            if ($params !== $url[$key]) {
                return false;
            }
        }

        // client url truly found
        return true;
    }
}
