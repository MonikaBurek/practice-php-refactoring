<?php

namespace Core;

class Auth
{
    private string $name;
    private array $actions = [];
    private array $actionsDb = [];
    private TypeActions $typeActions;
    private $db;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->db = App::resolve(Database::class);
        $this->typeActions = new TypeActions();
    }

    public function setActionsForDb(int $userId): void
    {
        $actions = $this->actionsDb($userId);

        foreach ($actions as $action) {
            if (!$this->typeActions->isActionAllowed($action)) {
                new \Exception("Akcja:{$action} jest nie dozwolona.");
            }
            $this->actions[] = $action;
        }
    }

    public function actions(): array
    {
        return $this->actions;
    }

    public function actionsDb(int $userId): array
    {
        if ($userId === 0) {
            new \Exception("Brak zalogowanego użytkownika.");
        }

        $record = $this->db->query(
            'select action_types from auth where user_id = :user_id and table_name =:table_name',
            [
                'user_id' => $userId,
                'table_name' => $this->name
            ]
        )->find();


        if (!$record) {
            return [];
        }

        return json_decode($record['action_types'], true);
    }

    public function hasPermission(int $userId, string $checkedAction): bool
    {
        $allowedActions = $this->actionsDb($userId);

        if (in_array($checkedAction, $allowedActions)) {
            return true;
        }

        //W jaki sposób najlepiej wyświetlić komunikat o ewentualnym błedzie ?
        // "Nie posiadasz uprawnień do akcji. $checkedAction";
        return false;
    }


}