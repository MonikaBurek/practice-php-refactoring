<?php

namespace Core\Middleware;

class GuestMiddleware
{
    public function handle($uri, $method)
    {
        if (isLogin()) {
            redirect('/');
        }
    }
}