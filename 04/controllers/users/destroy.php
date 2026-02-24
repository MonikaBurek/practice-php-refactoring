<?php

use App\Enums\FormAction;
use Core\App;
use Core\Auth;
use Core\Database;

$db = App::resolve(Database::class);
$userId = $_SESSION['user']['id'];

$user = $db->query(
    ' select * from users where id = :id',
    [
        'id' => intval($_POST['id'])
    ]
)->findOrFail();

$auth = new Auth('users');
if ($auth->hasPermission($userId, FormAction::DELETE->value)) {
    $db->query(
        'DELETE FROM users WHERE id = :id', [
            'id' => intval($_POST['id'])
        ]
    );
}

header('location: /users');
exit();