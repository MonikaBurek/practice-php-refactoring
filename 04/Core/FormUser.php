<?php

namespace Core;

class FormUser extends AbstractForm
{
    protected function getFields(): array
    {
        return require base_path('datasetUser.php');
    }
}