<?php

namespace Core;

class QueryExecutor
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * @throws \Exception
     */
    public function execute(string $sql, array $bindings): array
    {
        return $this->db->query($sql, $bindings)->get();
    }
}