<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] === $value;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($fileName, $directoryName, $attributes = [])
{
    extract($attributes);
    if ($directoryName === '') {
        $path = base_path('views/' . $fileName . '.php');
    }
    $path = base_path('views/' . $directoryName . '/' . $fileName . '.php');
    if (!realpath($path)) {
        throw new Exception("This path is incorrect.");
    }

    require $path;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function login($user)
{
    // mark that user has logged in.
    $_SESSION['user'] = [
        'email' => $user['email'],
        'name' => $user['name'],
        'id' => $user['id'],
    ];
}

function logout()
{
    //log the user out
    $_SESSION = [];
    session_destroy();

//delete cookie
    $params = session_get_cookie_params();
    setcookie(
        'PHPSESSID',
        '',
        time() - 3600,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );

    session_regenerate_id(true);
}

function isLogin(): bool
{
    return isset($_SESSION['user']);
}
function redirect($path)
{
    header("location:{$path}");
    exit();
}

