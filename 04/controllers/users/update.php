<?php

use App\Enums\FormAction;
use Core\App;
use Core\Auth;
use Core\Database;
use Core\FormUser;

$db = App::resolve(Database::class);
$errors = [];

$userId = $_SESSION['user']['id'];

$user= $db->query(
    ' select * from users where id = :id',
    [
        'id' => intval($_POST['id'])
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

$auth = new Auth('notes');
if ($auth->hasPermission($userId, FormAction::UPDATE->value)) {
    $db->query('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id', [
        'id' => intval($_POST['id']),
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => password_hash($form->get('password'), PASSWORD_BCRYPT),
    ]);
}

header('location: /users');
die();
