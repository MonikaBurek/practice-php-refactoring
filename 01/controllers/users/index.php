<?php

use Core\ActionValidator;
use Core\App;
use Core\Database;
use Core\DatabaseDataTable;
use Core\FormValidator;
use Core\HtmlTableRender;
use Core\TableConfigurator;
use Core\TableUser;

$tableUser = new TableUser();
$table = $tableUser->make(new FormValidator());
$configurator = new TableConfigurator(
    new ActionValidator()
);

$configurator->configureActions(
    $table,
    ['add','update','delete']
);
$dataForTable = new DatabaseDataTable(App::resolve(Database::class));
$rows = $dataForTable->getRows($table);

$html = (new HtmlTableRender())->render($table, $rows);

$heading = "Lista użytkowników";
view("index.view", 'users', [
    'html' => $html,
    'heading' => $heading,
]);