<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

if (!isset($_POST['id'])) {
    $this->displayMessageAndRedirctHome('Akcja niemożliwa do wykonania.');
}

$user = $db->query(
    ' select * from users where id = :id',
    [
        'id' => $_POST['id']
    ]
)->findOrFail();


$db->query('delete from users where id = :id', [
    'id' => $_POST['id']
]);

header('location: /users');
exit();