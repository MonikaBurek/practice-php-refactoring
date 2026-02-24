<?php

use Core\TableUser;

$tableUser = new TableUser();
$fields = require base_path('datasetUser.php');
$table = $tableUser->make($fields);

$html = $table->generate('user');

$heading = "Lista użytkowników";
view("index.view", 'users', [
    'html' => $html,
    'heading' => $heading,
]);