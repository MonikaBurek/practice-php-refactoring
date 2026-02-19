<?php

namespace App\Enums;

enum NoticeType: string
{
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case ERROR = 'error';

}