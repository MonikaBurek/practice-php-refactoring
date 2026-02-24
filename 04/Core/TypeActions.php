<?php

namespace Core;

use App\Enums\FormAction;

class TypeActions
{
    protected array $typeActions = ['add', 'update', 'delete'];

    public function isActionAllowed(string $actionName): bool
    {
        if (!in_array($actionName, $this->typeActions, true)) {
            return false;
        }
        return true;
    }

    public function addButtonHtml(string $elementName): string
    {
        return "<a class='button-add' href='/" . $elementName . "/create'>Dodaj</a>";
    }

    public function editButtonHtml(int $id, string $elementName): string
    {
        return "<a class='button-like' href='/" . $elementName . "/edit?id=" . $id . "'>Edytuj</a>";
    }


    public function deleteButtonHtml(int $id, string $elementName): string
    {
        return '<form method="POST" action="/' . $elementName . '">
                <input type="hidden" name ="_method" value="DELETE">
                <input type="hidden" name ="id" value="' . $id . '">
                <button class="btn-delete" >Usuń</button>
            </form>';
    }

    public function updateFormHtml(int $id): string
    {
        return ' <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="' . $id . '">';
    }

    public function cancelButtonHtml(): string
    {
        return '   <a href="/users"
                class="rounded-md bg-gray-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Anuluj
        </a>';
    }

    public function getValueInput(string $action, $filedName, array $user = []): string
    {
        if ($action === FormAction::UPDATE->value) {
            return $_POST[$filedName] ?? $user[$filedName] ?? '';
        }

        if ($action === FormAction::ADD->value) {
            return $_POST[$filedName] ?? '';
        }
        return '';
    }

    public function actionsColumnHeader(array $actions)
    {
        if (in_array(FormAction::UPDATE->value, $actions, true) || in_array(
                FormAction::DELETE->value,
                $actions,
                true
            )) {
            return '<th></th>';
        }
        return '';
    }

    public function actionsColumnBody(array $actions, int $id, string $elementName): string
    {
        $html = '';
        if (empty($actions)) {
            return $html;
        }

        if (in_array(FormAction::UPDATE->value, $actions, true) || in_array(
                FormAction::DELETE->value,
                $actions,
                true
            )) {
            $html .= '<td class="actions">';

            if (in_array(FormAction::UPDATE->value, $actions, true)) {
                $html .= $this->editButtonHtml($id, $elementName);
            }

            if (in_array(FormAction::DELETE->value, $actions, true)) {
                $html .= $this->deleteButtonHtml($id, $elementName);
            }

            $html .= '</td>';
        }

        return $html;
    }


}