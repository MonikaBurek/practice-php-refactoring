<?php

use App\Enums\FormAction;
use Core\FormUser;

$userForm = new FormUser();
$form = $userForm->make($_POST);

$heading = "Rejestracja użytkownika";

view("create.view", 'registration', [
    'heading' => $heading,
    'form' => $form,
    'action' => FormAction::ADD->value,
]);