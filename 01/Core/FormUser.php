<?php

namespace Core;

class FormUser
{
    protected string $autoIncrementColumn = 'id';

    protected array $data = [];

    public function make(array $data, bool $withValidation = false): Form
    {
        $fields = require base_path('datasetUser.php');
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


}