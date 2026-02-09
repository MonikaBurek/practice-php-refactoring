<?php

$router->get('/users', 'controllers/users/index.php');

$router->delete('/user', 'controllers/users/destroy.php');

$router->get('/user/edit', 'controllers/users/edit.php');
$router->patch('/user', 'controllers/users/update.php');

$router->get('/user/create', 'controllers/users/create.php');
$router->post('/user', 'controllers/users/store.php');

