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
    return view("create.view", 'registration', [
        'heading' => $heading,
        'form' => $form,
        'action' => FormAction::ADD->value
    ]);
}

$user = $db->query(' select * from users where email = :email',
    [
        'email' => $form->get('email')
    ])->find();

if ($user){
    //then someone with that email already exists and has an account
    //If yes, redirect to a login page.
    header('location: /');
    exit();
} else {
    // If not, save one to the database, and then log the user in, and redirect.
    $db->query(
        'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)',
        [
            'name' => $form->get('name'),
            'email' => $form->get('email'),
            'password' => password_hash( $form->get('password'), PASSWORD_BCRYPT),
        ]
    );

    $user = $db->query(' select * from users where email = :email',
        [
            'email' => $form->get('email')
        ])->find();

    //add default permission for tables
    $db->query(
        'INSERT INTO auth (user_id, action_types, table_name) VALUES (:user_id, :action_types, :table_name)',
        [
            'user_id' => $user['id'],
            'action_types' => '["add","update","delete"]',
            'table_name' => 'notes',
        ]
    );

    $db->query(
        'INSERT INTO auth (user_id, action_types, table_name) VALUES (:user_id, :action_types, :table_name)',
        [
            'user_id' => $user['id'],
            'action_types' => '["update"]',
            'table_name' => 'users',
        ],
    );

    login(['email' => $form->get('email'),
        'name' => $form->get('name'),
        'id' => $user['id']
    ]);

    header('location:/');
    exit();
}








