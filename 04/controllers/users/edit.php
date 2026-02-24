<?php

use App\Enums\FormAction;
use Core\App;
use Core\Database;
use Core\FormUser;
use Core\TableUser;

$db = App::resolve(Database::class);

$userForm = new FormUser();
$form = $userForm->make($_POST);

$userTable = new TableUser();
$fields = require base_path('datasetUser.php');
$table = $userTable->make($fields);

$user = $db->query(
    ' select * from users where id = :id',
    [
        'id' => intval($_GET['id'])
    ]
)->findOrFail();

$heading = 'Edycja użytkownika';
view("edit.view", 'users', [
    'heading' => $heading,
    'form' => $form,
    'user' => $user,
    'action' => FormAction::UPDATE->value,
]);