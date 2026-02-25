<?php

namespace Core;

class NoticerPrinter
{
    public function createHtmlForMessage($type, $text): string
    {
        return "<div class='{$type}'>{$text}</div>";
    }

    public function createEmptyMessageHtml(): string
    {
        return "<div>Brak wiadmości do wyświetlenia.</div>";
    }

    public function createHtmlForMessages(array $messages): string
    {
        $text = '';
        foreach ($messages as $msg) {
            $text .= $this->createHtmlForMessage($msg['type'], $msg['message']);
        }

        return $text;
    }
}