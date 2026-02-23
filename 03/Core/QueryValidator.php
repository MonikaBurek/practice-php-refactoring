<?php

namespace Core;

use Core\Exceptions\MissingTableException;
use Core\Exceptions\MissingWhereException;

class QueryValidator
{

    public function validateTable(string $table) : void
    {
        if (empty($table)) {
            throw new MissingTableException("Nie wybrano tabeli dla zapytania.");
        }
    }

    public function validateWhere(array $wheres) : void {
        if (empty($wheres)) {
            throw new MissingWhereException("Brak WHERE w zapytaniu.");
        }
    }
}