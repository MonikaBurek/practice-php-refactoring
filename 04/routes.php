<?php

use Core\Middleware\AuthMiddleware;
use Core\Middleware\GuestMiddleware;
use Core\Middleware\LoggerMiddleware;

$router->addMiddleware('*', new LoggerMiddleware());
$router->addMiddleware('/note', new AuthMiddleware());
$router->addMiddleware('/user', new AuthMiddleware());
$router->addMiddleware('/register', new GuestMiddleware());
$router->addMiddleware('/login', new GuestMiddleware());

$router->get('/', 'controllers/index.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/users', 'controllers/users/index.php');
$router->delete('/user', 'controllers/users/destroy.php');

$router->get('/user/edit', 'controllers/users/edit.php');
$router->patch('/user', 'controllers/users/update.php');

$router->get('/notes', 'controllers/notes/index.php');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/destroy.php');

$router->get('/note/edit', 'controllers/notes/edit.php');
$router->patch('/note', 'controllers/notes/update.php');

$router->get('/note/create', 'controllers/notes/create.php');
$router->post('/note', 'controllers/notes/store.php');

$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');

$router->get('/login', 'controllers/session/create.php');
$router->post('/session', 'controllers/session/store.php');
$router->delete('/session', 'controllers/session/destroy.php');


