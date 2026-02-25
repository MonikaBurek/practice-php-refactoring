<?php

use Core\Noticer;
use Core\NoticerPrinter;

session_start();

$noticer = new Noticer();

$noticer->success('Dane zapisane poprawnie.');
$noticer->error('Wystąpił błąd podczas zapisu.');
$noticer->warning('Twój profil jest niekompletny. Uzupełnij brakujące dane.');
$printer = new NoticerPrinter();

$messages = $noticer->getAll();
if (!empty($messages)) {
    echo $printer->createHtmlForMessages($messages);
    $noticer->clear();
} else {
    echo $printer->createEmptyMessageHtml();
}
