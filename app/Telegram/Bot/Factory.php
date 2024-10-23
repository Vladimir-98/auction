<?php

namespace App\Telegram\Bot;

use App\Http\Responses\ApiResponse;
use App\Telegram\Verification\InitData;

class Factory
{
    private File $file;
    private Message $message;
    private Payment $invoice;
    private InitData $initData;
    private Connection $connection;

    public function __construct()
    {
        $this->file = new File();
        $this->message = new Message();
        $this->invoice = new Payment();
        $this->initData = new InitData();
        $this->connection = new Connection();
    }

    public function __call(string $name, array $arguments)
    {

        foreach ($this as $key => $prop) {
            if (method_exists($this->$key, $name)) {
                return call_user_func_array([$this->$key, $name], $arguments);
            }
        }
        return ApiResponse::error('Такого метода ' . $name . ' не нашлось', 200);
    }
}
