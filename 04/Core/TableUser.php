<?php

namespace Core;

class TableUser
{

    public function make($fields): Table
    {
        $table = new Table('users');
        $table->setValidator(new FormValidator());

        foreach ($fields as $field) {
            $table->addColumn($field);
        }

        return $table;
    }
}