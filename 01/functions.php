<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($fileName, $directoryName, $attributes = [])
{
    extract($attributes);
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

function displayMessageAndRedirctHome(string $text) : void {
    echo '';
    header('location: /');
    exit();
}