<?php

namespace Core;


class TableUser
{
    private FormValidator $validator;

    public function make(FormValidator $formValidator): Table
    {
        $fields = require base_path('datasetUser.php');

        $table = new Table('users');

        foreach ($fields as $field) {
            $table->addColumn(
                new Column(
                    $field['name'],
                    $field['label'],
                    $field['type'],
                    $field['rules'] ?? []
                )
            );
        }
// tak się zastanawiam czy do klasy która tworzy tabele potrzebuje walidatora akurat nie uzywam żadnej metody tutaj, ani w kalsach podrzędnych.
        $this->setValidator($formValidator);

        return $table;
    }

    public function setValidator(FormValidator $validator): void
    {
        $this->validator = $validator;
    }
}