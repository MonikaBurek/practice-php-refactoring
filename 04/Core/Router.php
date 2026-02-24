<?php

namespace Core;


class Router
{
    protected $routes = [];
    protected $middleware = [];

    public function add($method, $uri, $controller, )
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller, );
    }

    public function post($uri, $controller )
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }


    public function addMiddleware(string $pattern, $middleware): void
    {
        $this->middleware[] = [
            'pattern' => $pattern,
            'middleware' => $middleware
        ];
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                foreach ($this->middleware as $middleware){
                    if($middleware['pattern'] === '*' || str_starts_with($uri, $middleware['pattern'])){
                        $middleware['middleware']->handle($uri, $method);
                    }
                }

                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}


