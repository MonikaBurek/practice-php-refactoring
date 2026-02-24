<?php

if (!isset($_SESSION)) {
    session_start();
}

view('index.view','', [
    'heading' => 'Strona główna',
]);