<?php

namespace App\Enums;

enum ChatAssistantMode: string
{
    case Customer   = 'cus';
    case Assistant  = 'ass';

    public function getLabel(): string
    {
        return match($this) {
            self::Customer => 'Customer',
            self::Assistant => 'Assistant',
        };
    }

    public function getBladeComponent(): string
    {
        return match($this) {
            self::Customer => 'customer-chat',
            self::Assistant => 'assistant-chat',
        };
    }
}