<?php

namespace App\Enums;

enum FormAction: string
{
    case ADD = 'add';
    case UPDATE = 'update';
    case DELETE = 'delete';
}