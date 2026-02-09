<?php

namespace Core;


class Table
{
    private string $name;
    /** @var Column[] */
    private array $columns = [];
    private array $actions = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addColumn(Column $column): void
    {
        $this->columns[] = $column;
    }

    public function setActions(array $actions): void
    {
        foreach ($actions as $action) {
            $this->actions[] = $action;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Column[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}