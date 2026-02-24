<?php

namespace Core\Middleware;

class AuthMiddleware
{
    public function handle($uri, $method)
    {
        if (!isLogin()) {
            redirect('/');
        }
    }
}