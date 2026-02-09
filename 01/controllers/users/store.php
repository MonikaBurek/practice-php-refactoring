<?php

use Core\App;
use Core\Database;
use Core\FormUser;
use App\Enums\FormAction;

$db = App::resolve(Database::class);
$errors = [];

$userForm = new FormUser();
$form = $userForm->make($_POST, true);
$form->validate();
$errors = $form->errors();

$heading = "Rejestracja użytkownika";

if (!empty($errors)) {
    return view("create.view", 'users', [
        'heading' => $heading,
        'form' => $form,
        'action' => FormAction::ADD
    ]);
}

$db->query(
    'INSERT INTO users (name, email) VALUES (:name, :email)',
    [
        'name' => $form-> get('name'),
        'email' => $form ->get('email'),
    ]
);

header('location:/users');
die();
