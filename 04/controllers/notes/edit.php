<?php

use App\Enums\FormAction;
use Core\App;
use Core\Database;
use Core\FormNote;
use Core\TableNote;

$db = App::resolve(Database::class);

$noteForm = new FormNote();
$form = $noteForm->make($_POST);

$noteTable = new TableNote();
$fields = require base_path('datasetNote.php');
$table = $noteTable->make($fields);

$note = $db->query(
    ' select * from notes where id = :id',
    [
        'id' => intval($_GET['id'])
    ]
)->findOrFail();

$heading = 'Edycja notatki';
view("edit.view", 'notes', [
    'heading' => $heading,
    'form' => $form,
    'note' => $note,
    'action' => FormAction::UPDATE->value,
]);