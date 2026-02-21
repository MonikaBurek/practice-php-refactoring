<?php

use Core\Noticer;
use Core\QueryBuilder;
use Core\Session;

session_start();
$qb = new QueryBuilder();

$query = $qb->table('users')
    ->select('id', 'email')
    ->where('active', '=', 1)
    ->where('role', '=', 'admin')
    ->limit(10)
    ->get();
