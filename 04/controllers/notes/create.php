<?php

use App\Enums\FormAction;
use Core\FormNote;

$noteForm = new FormNote();
$form = $noteForm->make($_POST);

$heading = "Dodaj nową notatkę";

view("create.view", 'notes', [
    'heading' => $heading,
    'form' => $form,
    'action' => FormAction::ADD->value,
]);