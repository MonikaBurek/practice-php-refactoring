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

    public function initRows(Table $table, bool $usePagination)
    {
        $columnsQuery = $this->stringColumnsQuery($table);

        if (isset($_GET['page']) && $usePagination) {
            $this->page = $_GET['page'];

            $pagination = new Pagination(30, 10);
            $result = $pagination->prepare();
            $offset = $result[$this->page - 1];

            return $this->db->query('SELECT ' . $columnsQuery . ' FROM ' . $table->getName() . '  LIMIT 10 OFFSET ' . $offset)->get();
        }

        return $this->db->query('SELECT ' . $columnsQuery . ' FROM ' . $table->getName())->get();
    }

    public function stringColumnsQuery(Table $table): string
    {
       $columnsName  = [];

       foreach ($table->getColumns() as $column) {
           $columnsName[] = $column->name();
       }

       return  implode(', ', $columnsName);
    }

}