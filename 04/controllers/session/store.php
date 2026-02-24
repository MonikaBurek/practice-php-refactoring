<?php

use App\Enums\FormAction;
use Core\App;
use Core\Database;
use Core\FormLogin;

$db = App::resolve(Database::class);
$errors = [];

$loginForm = new FormLogin();
$form = $loginForm->make($_POST, true);
$form->validate();
$errors = $form->errors();

$heading = "Logowanie";

if (!empty($errors)) {
    return view('create.view', 'session', [
        'errors' => $errors,
        'heading' => $heading,
        'form' => $form,
        'action' => FormAction::ADD->value,
    ]);
}

//match the credentials
$user = $db->query('select * from users where email= :email', [
    'email' => $form->get('email')
])->find();

if ($user) {
    // we have a user, but we don't know if the password provided matches what in the database
    if (password_verify($form->get('password'), $user['password'])) {
        login([
            'email' => $form->get('email'),
            'name' => $user['name'],
            'id' => $user['id']
        ]);

        header('location:/');
        exit();
    }
}
$form->addError('email', 'No matching account found for that email address and password');
$errors = $form->errors();

return view('create.view', 'session', [
    'errors' => $errors,
    'heading' => $heading,
    'form' => $form,
    'action' => FormAction::ADD->value,
]);