<?php

namespace Core;

use App\Enums\QueryName;

class QueryBuilderSimple
{
    private QueryValidator $validator;
    private QueryExecutor $executor;
    private string $table;
    private array $columns = ['*'];
    private array $wheres = [];
    private array $bindings = [];
    private string $queryName;
    private ?int $limit = null;

    public function __construct(QueryValidator $validator, QueryExecutor $qEx)
    {
        $this->executor = $qEx;
        $this->validator = $validator;
    }

//Zapisanie informacji do tablic odpowiednich
    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(string ...$columns): self
    {
        $this->queryName = QueryName::SELECT->value;
        if (!empty($columns)) {
            $this->columns = $columns;
        }

        return $this;
    }

    public function where(string $column, string $operator, mixed $value): self
    {
        $this->wheres[] = "{$column} {$operator} :{$column}";
        $this->bindings[$column] = $value;

        return $this;
    }

    public function limit(int $value)
    {
        $this->limit = $value;
        return $this;
    }

    public function insert(array $attributes): self
    {
        $this->queryName = QueryName::INSERT->value;
        $this->columns = array_keys($attributes);
        $this->bindings = $attributes;
        return $this;
    }

    public function delete()
    {
        $this->queryName = QueryName::DELETE->value;

        return $this;
    }

    public function update(array $attributes)
    {
        $this->queryName = QueryName::UPDATE->value;
        $this->columns = array_keys($attributes);
        $this->bindings = $attributes;

        return $this;
    }

    public function getBindings(): array
    {
        return $this->bindings;
    }

    public function toSql(): string
    {
        return $this->createQuery();
    }

    public function get()
    {
        return $this->executor->execute($this->toSql(), $this->getBindings());
    }

    public function createQuery(): string
    {
        //  ZAPYTANIA
        // SELECT * FROM users;
        // INSERT INTO users (name, email, active) VALUES ('John Doe', 'john@example.com', 1);
        // UPDATE users SET name = 'Jane Doe' WHERE id = 5;
        // DELETE FROM users WHERE id = 5;
        $attributes = [
            'table' => $this->table,
            'columns' => $this->columns,
            'wheres' => $this->wheres,
            'limit' => $this->limit,
            'queryName' => $this->queryName
        ];

        $data = new QueryBuilderGenerator($attributes);

        return $data->createQuery();
    }

    public function reset(): void
    {
        $this->columns = ['*'];
        $this->table = '';
        $this->wheres = [];
        $this->bindings = [];
        $this->limit = null;
        $this->queryName = '';
    }
}