<?php

namespace Core;

class ActionValidator
{
    private TypeActions $typeActions;

    public function __construct()
    {
        $this->typeActions = new TypeActions();
    }
    public function validate(string $action): void {
        if (!$this->typeActions->isActionAllowed($action)) {
            throw new \Exception("Akcja: {$action} jest niedozwolona.");
        }
    }

}