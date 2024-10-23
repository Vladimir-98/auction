<?php

namespace App\Telegram\Bot;

class Message extends Bot
{
    public function message(
        string $chat_id,
        string $text,
        $reply_id = null
    ): self
    {
        $this->method = 'sendMessage';

        $this->data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'html',
            'link_preview_options' => [
                'is_disabled' => true
            ],
        ];

        if ($reply_id) {
            $this->data['reply_parameters'] = [
                'message_id' => $reply_id
            ];
        }

        return $this;
    }

    public function buttons(
        string $chat_id,
        string $text,
        array $buttons,
        $reply_id = null): self
    {
        $this->method = 'sendMessage';

        $this->data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'html',
            'reply_markup' => json_encode($buttons),
        ];

        if ($reply_id) {
            $this->data['reply_parameters'] = [
                'message_id' => $reply_id
            ];
        }

        return $this;
    }
}
