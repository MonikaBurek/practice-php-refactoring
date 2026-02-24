<?php

return [
    [
        'name' => 'id',
        'label' => 'ID',
        'type' => 'id'
    ],
    [
        'name' => 'body',
        'label' => 'Treść notatki',
        'type' => 'string',
        'rules' => ['min' => ['value' => 3],'max' => ['value' => 250]]
    ],
];

