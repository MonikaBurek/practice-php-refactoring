<?php

namespace Core;


class FormValidator
{
    private TypeDefinition $typeDefinition;
    public array $errors = [];

    public function __construct()
    {
        $this->typeDefinition = new TypeDefinition();
    }

    public function validate(array $inputData, array $validationRulesForFormFields): bool
    {
        foreach ($validationRulesForFormFields as $field) {
            if (array_key_exists($field['name'], $inputData)) {
                $name = $field['name'];
                $value = $inputData[$name];
            } else {
                $this->errors[] = [
                    'name' => 'Dane użytkownika',
                    'err' => "Brak danych dla pola  {$field['name']} w request",
                ];
                return false;
            }

            $type = $field['type'];
            $rules = $field['rules'];


            // ['name' => firstName, 'err' => 'Podano za mało znaków'],
            if (!$this->typeDefinition->isTypeCorrect($type, $value)) {
                $this->errors[] = [
                    'name' => $name,
                    'err' => "Pole {$name} musi być typu {$type}."
                ];
            }

            // $rule min lub max , $settings to array z elementami value and err
            foreach ($rules as $rule => $settings) {
                $method = 'valid_' . $rule;

                if (method_exists($this, $method)) {
                    $this->{$method}($name, $value, $settings);
                } else {
                    $this->errors[] = [
                        'rule' => $rule,
                        'err' => "Podano nie obsługiwaną nazwę reguły do walidacji. Obsługiwane to: min i max."
                    ];
                }
            }
        }

        return empty($this->errors);
    }

    // ['name' => firstName, 'err' => 'Podano za mało znaków'],
    public function valid_min(string $name, $value, array $setting): void
    {
        if (is_string($value) && $setting['value'] > mb_strlen($value)) {
            $this->errors[] = [
                'name' => $name,
                'err' => $setting['err'] ?? "Pole $name posiada za mało znaków."
            ];
        }

        if (is_numeric($value) && $setting['value'] > $value) {
            $this->errors[] = [
                'name' => $name,
                'err' => $setting['err'] ?? "Wartość $name jest za mała."
            ];
        }
    }

    // ['name' => firstName, 'err' => 'Podano za mało znaków'],
    public function valid_max(string $name, $value, array $setting): void
    {
        if (is_string($value) && $setting['value'] < mb_strlen($value)) {
            $this->errors[] = [
                'name' => $name,
                'err' => $setting['err'] ?? "Pole $name posiada za dużo znaków."
            ];
        }

        if (is_numeric($value) && $setting['value'] < $value) {
            $this->errors[] = [
                'name' => $name,
                'err' => $setting['err'] ?? "Wartość $name jest za duża."
            ];
        }
    }

    public function errors(): array
    {
        return $this->errors;
    }
}