<?php

namespace Core;

class TypeDefinition
{
     protected  array $typeDefinitions = [
        'string' => [
            'validator' => 'is_string',
            'input' => 'text',
        ],
        'numeric' => [
            'validator' => 'is_numeric',
            'input' => 'number',
        ],
    ];

    public function isTypeCorrect(string $type, $value): bool
    {
        return isset($this->typeDefinitions[$type])
            ? call_user_func($this->typeDefinitions[$type]['validator'], $value)
            : false;
    }

    public function getInputType(string $type): string|false
    {
        return $this->typeDefinitions[$type]['input'] ?? false;
    }
}