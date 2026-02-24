<?php

use Core\TableNote;

$tableNote = new TableNote();
$fields = require base_path('datasetNote.php');
$table = $tableNote->make($fields);

$html = $table->generate('note');

$heading = "Lista notatek";
view("index.view", 'notes', [
    'html' => $html,
    'heading' => $heading,
]);