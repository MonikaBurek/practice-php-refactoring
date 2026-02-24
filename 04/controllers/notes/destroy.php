<?php

use App\Enums\FormAction;
use Core\App;
use Core\Auth;
use Core\Database;

$db = App::resolve(Database::class);
$userId = $_SESSION['user']['id'];

$note = $db->query(
    ' select * from notes where id = :id',
    [
        'id' => intval($_POST['id'])
    ]
)->findOrFail();

$auth = new Auth('notes');
if ($auth->hasPermission($userId, FormAction::DELETE->value)) {
    $db->query(
        'DELETE FROM notes WHERE id = :id', [
            'id' => intval($_POST['id'])
        ]
    );
}

header('location: /notes');
exit();