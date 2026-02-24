<?php

use App\Enums\FormAction;
use Core\App;
use Core\Auth;
use Core\Database;
use Core\FormNote;
use Core\FormUser;

$db = App::resolve(Database::class);
$errors = [];
$userId = $_SESSION['user']['id'];

$note = $db->query(
    ' select * from notes where id = :id',
    [
        'id' => intval($_POST['id'])
    ]
)->findOrFail();

$formNote = new FormNote();
$form = $formNote->make($_POST, true);
$form->validate();
$errors = $form->errors();

$heading = 'Edycja notatki';
if (count($errors)) {
    return view("edit.view", 'notes', [
        'heading' => $heading,
        'note' => $note,
        'form' => $form,
        'action' => FormAction::UPDATE->value,
    ]);
}

$auth = new Auth('notes');
if ($auth->hasPermission($userId, FormAction::UPDATE->value)) {
    $db->query(
        'UPDATE notes SET body = :body, user_id = :user_id WHERE id = :id', [
            'id' => intval($_POST['id']),
            'body' => $_POST['body'],
            'user_id' => $userId
        ]
    );
}

header('location: /notes');
die();
