<?php

return [
    [
        'name' => 'id',
        'label' => 'ID',
        'type' => 'id'
    ],
    [
        'name' => 'name',
        'label' => 'Imię i nazwisko',
        'type' => 'string',
        'rules' => ['min' => ['value' => 3]]

    ],
    [
        'name' => 'email',
        'label' => 'Email',
        'type' => 'string',
        'rules' => ['min' => ['value' => 3]]
    ]
];

