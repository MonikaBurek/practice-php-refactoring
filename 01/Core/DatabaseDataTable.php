<?php

namespace Core;

class DatabaseDataTable
{
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getRows(Table $table): array
    {
        $pageResolver = new PageResolver($this->db);
        return $pageResolver->initRows(
            $table,
            true
        );

    }
}