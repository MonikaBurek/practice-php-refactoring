<?php

namespace Core;

class QueryValidator
{

    public function validateTable(string $table) : void
    {
        if (empty($table)) {
            throw new \InvalidArgumentException("Nie wybrano tabeli dla zapytania.");
        }
    }

    public function validateWhere(array $wheres) : void {
        if (empty($wheres)) {
            throw new \InvalidArgumentException("Brak WHERE w zapytaniu.");
        }
    }
}