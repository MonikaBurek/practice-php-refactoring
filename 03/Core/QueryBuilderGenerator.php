<?php

namespace Core;

use App\Enums\QueryName;
use Core\Database;

class QueryBuilderGenerator
{
    private string $table;
    private array $columns;
    private array $wheres;
    private ?int $limit;
    private string $queryName;
    private QueryValidator $validator;

    public function __construct(array $attributes)
    {
        $this->table = $attributes['table'];
        $this->columns = $attributes['columns'];
        $this->wheres = $attributes['wheres'];
        $this->limit = $attributes['limit'];
        $this->queryName = $attributes['queryName'];
        $this->validator = new QueryValidator();
    }

    public function createQuery(): string
    {
        //  ZAPYTANIA
        // SELECT * FROM users;
        // INSERT INTO users (name, email, active) VALUES ('John Doe', 'john@example.com', 1);
        // UPDATE users SET name = 'Jane Doe' WHERE id = 5;
        // DELETE FROM users WHERE id = 5;
        $this->validator->validateTable($this->table);

        $methodMap = [
            QueryName::SELECT->value => 'createSelectSql',
            QueryName::INSERT->value => 'createInsertSql',
            QueryName::DELETE->value => 'createDeleteSql',
            QueryName::UPDATE->value => 'createUpdateSql',
        ];

        if (!isset($methodMap[$this->queryName])) {
            throw new \Exception("Nieobsługiwany typ zapytania: {$this->queryName}");
        }

        return $this->{$methodMap[$this->queryName]}();
    }

    private function createInsertSql(): string
    {
        // INSERT INTO users (name, email, active) VALUES ('John Doe', 'john@example.com', 1);
        // 'INSERT INTO users (name, email) VALUES (:name, :email)',

        $columns = implode(', ', $this->columns);
        $placeholders = implode(
            ', ',
            array_map(
                fn($field) => ':' . $field,
                $this->columns
            )
        );

        return "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
    }

    private function createSelectSql(): string
    {
        //SELECT id, name FROM users WHERE active = 1 LIMIT 5;

        $columns = implode(', ', $this->columns);
        $sql = "SELECT {$columns} FROM {$this->table}";

        if (!empty($this->wheres)) {
            $wheres = implode(' AND ', $this->wheres);
            $sql .= " WHERE {$wheres}";
        }

        if ($this->limit && $this->limit > 0) {
            $sql .= " LIMIT {$this->limit}";
        }

        return $sql;
    }

    private function createDeleteSql(): string
    {
        // DELETE FROM users WHERE id = 5;
        $this->validator->validateWhere($this->wheres);

        $sql = "DELETE FROM {$this->table}";

        $wheres = implode(' AND ', $this->wheres);
        $sql .= " WHERE {$wheres}";

        return $sql;
    }


    private function createUpdateSql(): string
    {
        // UPDATE users SET name = 'Jane Doe',email = 'jane@example.com',  active = 1 WHERE id = 5;
        $this->validator->validateWhere($this->wheres);

        $placeholders = implode(
            ', ',
            array_map(
                fn($field) => $field . ' = :' . $field,
                $this->columns
            )
        );

        $sql = "UPDATE {$this->table} SET {$placeholders}";

        $wheres = implode(' AND ', $this->wheres);
        $sql .= " WHERE {$wheres}";

        return $sql;
    }
}