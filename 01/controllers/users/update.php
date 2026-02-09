<?php

use App\Enums\FormAction;
use Core\App;
use Core\Database;
use Core\FormUser;

$db = App::resolve(Database::class);
$errors = [];

$user= $db->query(
    ' select * from users where id = :id',
    [
        'id' => $_POST['id']
    ]
)->findOrFail();

$formUser = new FormUser();
$form = $formUser->make($_POST, true);
$form->validate();
$errors = $form->errors();

$heading = 'Edycja użytkownika';
if (count($errors)) {
    return view("edit.view", 'users', [
        'heading' => $heading,
        'user' => $user,
        'form' => $form,
        'action' => FormAction::UPDATE->value,
    ]);
}

$db->query('update users set name = :name, email = :email where id = :id', [
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
]);

header('location: /users');
die();
