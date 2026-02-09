<?php

namespace Core;

class Column
{
    public function __construct(
        private string $nameInTable,
        private string $label,
        private string $type,
        private array $rules = []
    ) {
    }

    public function name(): string
    {
        return $this->nameInTable;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function rules(): array
    {
        return $this->rules;
    }
}