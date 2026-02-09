<?php

namespace Core;


class Form
{
    private FormValidator $validator;
    private TypeDefinition $typeDefinition;
    private TypeActions $typeActions;
    private array $fields = [];
    private array $data = [];
    private array $errors = [];

    public function __construct(array $dataInput = [])
    {
        $this->data = $dataInput;
        $this->typeDefinition = new TypeDefinition();
        $this->typeActions = new TypeActions();
    }

    public function setValidator(FormValidator $validator): void
    {
        $this->validator = $validator;
    }

    public function addField(string $name, string $label, string $type, array $rules = []): void
    {
        $this->fields[] = [
            'name' => $name,
            'label' => $label,
            'type' => $type,
            'rules' => $rules,
        ];
    }

    public function isSubmitted(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($this->data);
    }

    public function validate(): bool
    {
        $this->submitted = true;

        $isValid = $this->validator->validate($this->data, $this->fields);
        $this->errors = $this->validator->errors();


        return $isValid;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function get(string $name): string|bool
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return false;
    }

    public function render(string $action, array $user = []): string
    {
        $htmlForm = "<form method='POST' action='/user' >";
        if ($action === 'update') {
            $htmlForm .= $this->typeActions->updateFormHtml($user['id']);
        }

        $htmlForm .= "<div class='space-y-12'>";
        $htmlForm .= "<div class='border-b border-gray-900/10 pb-12'>";
        $htmlForm .= "<div class='col-span-full'>";

        foreach ($this->fields as $field) {
            $htmlForm .= "<label for='" . $field['name'] . "' class='block text-sm/6 font-medium text-gray-900'>" . $field['label'] . "</label>";
            $htmlForm .= "<div class='mt-2'>";

            $value = $this->typeActions->getValueInput($action, $field['name'], $user);
            $htmlForm .= "<input type='" . $this->typeDefinition->getInputType($field['type'])
                . "' id='" . $field['name'] . "' name='" . $field['name'] . "' value='" . $value . "'>";

            if ($this->isSubmitted()) {
                foreach ($this->errors as $err) {
                    if (isset($err['name']) && $err['name'] === $field['name']) {
                        $htmlForm .= "<p class='text-red-500 text-xs mt-2'>" . $err['err'] . "</p>";
                    }
                }
            }
            $htmlForm .= "</div>";
        }

        $htmlForm .= "</div></div>";
        $htmlForm .= "<div class='mt-6 flex items-center justify-end gap-x-6'>";
        if ($action === 'update') {
            $htmlForm .= $this->typeActions->cancelButtonHtml();
        }
        $htmlForm .= "<button type='submit' class='rounded-md bg-indigo-600 px-3 py-2 text-sm'>";
        $htmlForm .= "Zapisz</button></div></form>";

        return $htmlForm;
    }


    public function renderMessages(): string
    {
        if (empty($this->errors)) {
            return "<p class='font-bold text-blue-800'>Formularz poprawny</p>";
        }

        return "<p class='font-bold text-red-800'>Formularz zawiera błędy</p>";
    }
}