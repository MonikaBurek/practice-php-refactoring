<?php

namespace Core;

class FormNote extends AbstractForm
{
    public function getFields(): array
    {
        return require base_path('datasetNote.php');
    }
}