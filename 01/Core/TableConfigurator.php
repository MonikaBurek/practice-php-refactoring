<?php

namespace Core;

class TableConfigurator
{
    public function __construct(
        private ActionValidator $actionValidator
    ) {}

    public function configureActions(Table $table, array $actions): void
    {
        foreach ($actions as $action) {
            $this->actionValidator->validate($action);
        }

        $table->setActions($actions);
    }
}