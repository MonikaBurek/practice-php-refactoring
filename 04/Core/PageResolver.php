<?php

namespace Core;

class PageResolver
{
    protected int $page;
    protected $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function initRows(string $tableName, array $columnsInfo, bool $usePagination)
    {
        $columnsQuery = $this->stringColumnsQuery($columnsInfo);
        if (isset($_GET['page']) && $usePagination) {
            $this->page = $_GET['page'];

            $pagination = new Pagination(30, 10);
            $result = $pagination->prepare();
            $offset = $result[$this->page - 1];

            return $this->db->query(
                'SELECT ' . $columnsQuery . ' FROM ' . $tableName . ' ' . $this->buildQueryWhere(
                    $tableName
                ) . ' LIMIT 10 OFFSET ' . $offset
            )->get();
        }

        return $this->db->query(
            'SELECT ' . $columnsQuery . ' FROM ' . $tableName . ' ' . $this->buildQueryWhere($tableName)
        )->get();
    }

    public function stringColumnsQuery(array $columnsInfo): string
    {
        $columnsName = [];

        foreach ($columnsInfo as $column) {
            $columnsName[] = $column['nameInTable'];
        }

        return implode(', ', $columnsName);
    }

    public function buildQueryWhere(string $tableName): string
    {
        $userKeyMap = [
            'users' => 'id',
            'notes' => 'user_id'
        ];

        return 'WHERE ' . $userKeyMap[$tableName] . ' = ' . $_SESSION['user']['id'];
    }

}