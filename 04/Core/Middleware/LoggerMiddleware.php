<?php

namespace Core\Middleware;

class LoggerMiddleware
{
    public function handle($uri, $method)
    {
        echo "Log: $method $uri<br>";
    }
}