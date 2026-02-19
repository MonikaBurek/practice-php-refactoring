<?php

use Core\Noticer;
use Core\Session;

session_start();

$noticer = new Noticer();

$noticer->success('Dane zapisane poprawnie.');
$noticer->error('Wystąpił błąd podczas zapisu.');
$noticer->warning('Twój profil jest niekompletny. Uzupełnij brakujące dane.');

$messages = $noticer->getAll();
if (!empty($messages)) {
    foreach ($messages as $msg) {
        echo "<div class='{$msg['type']}'>{$msg['message']}</div>";
    }
    Session::unflash();
} else {
    echo "<div>Brak wiadmości do wyświetlenia</div>";
}
