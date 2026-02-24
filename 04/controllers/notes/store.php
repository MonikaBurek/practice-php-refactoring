<?php

use Core\App;
use Core\Auth;
use Core\Database;
use Core\FormNote;
use App\Enums\FormAction;

$db = App::resolve(Database::class);
$errors = [];

$noteForm = new FormNote();
$form = $noteForm->make($_POST, true);
$form->validate();
$errors = $form->errors();
$userId = $_SESSION['user']['id'];
$heading = "Dodawanie notatki";

if (!empty($errors)) {
    return view("create.view", 'notes', [
        'heading' => $heading,
        'form' => $form,
        'action' => FormAction::ADD
    ]);
}

$auth = new Auth('notes');

if ($auth->hasPermission($userId, FormAction::ADD->value)) {
    $db->query(
        'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)',
        [
            'body' => $form->get('body'),
            'user_id' => $userId
        ]
    );
}

header('location:/notes');
die();
