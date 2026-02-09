<?php

namespace Core;

class HtmlTableRender
{
    private TypeActions $typeActions;

    public function __construct()
    {
        $this->typeActions = new TypeActions();
    }

    public function renderHeader(Table $table): string
    {
        $htmlTr = '<thead><tr>';

        foreach ($table->getColumns() as $column) {
            $htmlTr .= "<th> {$column->label()}</th>";
        }

        $htmlTr .= $this->typeActions->actionsColumnHeader($table->getActions());
        $htmlTr .= '</tr></thead>';

        return $htmlTr;
    }

    public function renderBody(Table $table, array $rows): string
    {
        $htmlTableBody = '';

        foreach ($rows as $row) {

            $htmlTableBody .= '<tr>';

            foreach ($table->getColumns() as $column) {
                $htmlTableBody .= "<td>" . $row[$column->name()] . "</td>";
            }

            $htmlTableBody .= $this->typeActions->actionsColumnBody($table->getActions(), $row['id']);
            $htmlTableBody .= '</tr>';
        }

        return $htmlTableBody;
    }

    public function render(Table $table, array $rows): string
    {
        $tableHtml = '';
        if (in_array('add', $table->getActions(), true)) {
            $tableHtml = $this->typeActions->addButtonHtml();
        }
        $tableHtml .= "<table style='width:80%'>";
        $tableHtml .= $this->renderHeader($table,);
        $tableHtml .= $this->renderBody($table, $rows);
        $tableHtml .= "</table>";

        return $tableHtml;
    }
}