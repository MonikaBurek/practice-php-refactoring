<?php

namespace Core;

use App\Enums\NoticeType;

class Noticer
{
    private string $sessionKey = 'notices';

    public function add(string $message, NoticeType $type)
    {
        $notices = Session::get($this->sessionKey, []);
        $notices[] = [
            'type' => $type->value,
            'message' => $message
        ];

        Session::flash($this->sessionKey, $notices);
    }

    public function success(string $message): void
    {
        $this->add($message, NoticeType::SUCCESS);
    }

    public function warning(string $message): void
    {
        $this->add($message, NoticeType::WARNING);
    }

    public function error(string $message): void
    {
        $this->add($message, NoticeType::ERROR);
    }

    public function getAll() : array
    {
        return Session::get($this->sessionKey);
    }

    public function clear() :void
    {
        Session::unflashForKey($this->sessionKey);
    }
}