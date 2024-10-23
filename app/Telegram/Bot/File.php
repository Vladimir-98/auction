<?php

namespace App\Telegram\Bot;

class File extends Bot
{
    public function audio(string $chat_id, string $audio, string $caption = ''): self
    {
        $this->method = 'sendAudio';

        $this->data = [
            'chat_id' => $chat_id,
            'audio' => $audio,
            'caption' => $caption,
        ];

        return $this;
    }
}
