<?php

namespace Core;

abstract class AbstractForm
{
    protected string $autoIncrementColumn = 'id';

    protected array $data = [];

    public function make(array $data, bool $withValidation = false): Form
    {
        $fields = $this->getFields();
        $request = new Request($data);

        $this->data = $request->all();

        $form = new Form($this->data);

        if ($withValidation) {
            $form->setValidator(new FormValidator());
        }

        foreach ($fields as $key => $field) {
            if ($field['name'] !== $this->autoIncrementColumn) {
                $form->addField($field['name'], $field['label'], $field['type'], $field['rules'] ?? []);
            }
        }

        return $form;
    }

    abstract protected function getFields(): array;
}