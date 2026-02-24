<?php

namespace  Core;

class Request
{
    private array $data;

    public function __construct(array $inputData)
    {
        $this->data = $inputData;
    }

    public function all(): array
    {
        return $this->data;
    }
}