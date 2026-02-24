<?php

use App\Enums\FormAction;
use Core\FormLogin;

$loginForm = new FormLogin();
$form = $loginForm->make($_POST);

$heading = 'Logowanie';

view("create.view", 'session', [
    'heading' => $heading,
    'form' => $form,
    'action' => FormAction::ADD->value,
]);
