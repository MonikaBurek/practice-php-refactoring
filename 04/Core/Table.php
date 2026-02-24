<?php

namespace Core;


class Table
{
    private string $name;
    private FormValidator $validator;
    private array $columns = [];
    private array $actions = [];
    private TypeActions $typeActions;
    private Auth $auth;
    private $db;
    private int $userId;


    public function __construct(string $name)
    {
        $this->name = $name;
        $this->db = App::resolve(Database::class);
        $this->typeActions = new TypeActions();
        $this->auth = new Auth($name);
        $this->userId = $_SESSION['user']['id'] ?? 0;
    }

    public function setValidator(FormValidator $validator): void
    {
        $this->validator = $validator;
    }

    public function addColumn(array $info)
    {
        $this->columns [] = [
            'nameInTable' => $info['name'],
            'formFields' => [
                'labelName' => $info['label'],
                'type' => $info['type'],
                'rules' => $info['rules'] ?? [],
            ]
        ];
    }

    public function setActions(): void
    {
        $this->auth->setActionsForDb($this->userId);
        $actions = $this->auth->actions();

        foreach ($actions as $action) {
            $this->actions[] = $action;
        }
    }

    public function actions(): array
    {
        return $this->actions;
    }


    public function htmlTableHeader(): string
    {
        $htmlTr = '<thead><tr>';

        foreach ($this->columns as $column) {
            $htmlTr .= "<th> {$column['formFields']['labelName']}</th>";
        }

        $htmlTr .= $this->typeActions->actionsColumnHeader($this->actions());

        $htmlTr .= '</tr></thead>';

        return $htmlTr;
    }

    public function htmlTableBody(string $elementName): string
    {
        $htmlTableBody = '';
        $pageResolver = new PageResolver($this->db);
        $results = $pageResolver->initRows($this->name, $this->columns, true);

        foreach ($results as $result) {
            $htmlTableBody .= '<tr>';

            foreach ($this->columns as $column) {
                $htmlTableBody .= "<td>" . $result[$column['nameInTable']] . "</td>";
            }

            $htmlTableBody .= $this->typeActions->actionsColumnBody($this->actions(), $result['id'], $elementName);
            $htmlTableBody .= '</tr>';
        }

        return $htmlTableBody;
    }

    public function generate(string $elementName): string
    {
        $this->setActions();
        $tableHtml = '';
        if (in_array('add', $this->actions(), true)) {
            $tableHtml = $this->typeActions->addButtonHtml($elementName);
        }
        $tableHtml .= "<table style='width:80%'>";
        $tableHtml .= $this->htmlTableHeader();
        $tableHtml .= $this->htmlTableBody($elementName);
        $tableHtml .= "</table>";

        return $tableHtml;
    }
}