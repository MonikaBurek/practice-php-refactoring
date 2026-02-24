<?php

namespace Core;

class TableNote
{

    public function make($fields): Table
    {
        $table = new Table('notes');
        $table->setValidator(new FormValidator());

        foreach ($fields as $field) {
            $table->addColumn($field);
        }

        return $table;
    }
}