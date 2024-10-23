<?php

namespace App\Telegram\Webhook;

use App\Telegram\Webhook\Commands\Auction;
use App\Telegram\Webhook\Commands\Start;
use Illuminate\Http\Request;

class Webhook
{
    protected const COMMANDS = [
        '/start' => Start::class,
        '/auction' => Auction::class
    ];

    private ?int $chat_id = null;
    private array $message = [];
    private array $callback_query = [];
    private array $pre_checkout_query = [];
    private array $successful_payment = [];
    private string $text = '';
    private string $type = '';

    public function __construct(Request $request)
    {
        $this->setMessage($request->get('message', []));
        $this->setCallbackQuery($request->get('callback_query', []));
        $this->setPreCheckoutQuery($request->get('pre_checkout_query', []));
        $this->setSuccessfulPayment($this->extractSuccessFulPayment());
        $this->setChatId($this->extractChatId());
        $this->setText($this->extractText());
        $this->setType($this->extractType());
    }

    /**
     * @return int|null
     */
    private function extractChatId(): ?int
    {
        if (!empty($this->message)) {
            return $this->message['from']['id'] ?? null;
        }

        if (!empty($this->callback_query)) {
            return $this->callback_query['from']['id'] ?? null;
        }

        return null;
    }

    /**
     * @return array
     */
    private function extractSuccessFulPayment(): array
    {
        return $this->message['successful_payment'] ?? [];
    }

    /**
     * @return string
     */
    private function extractText(): string
    {
        return $this->message['text'] ?? '';
    }

    /**
     * @return string
     */
    private function extractType(): string
    {
        return $this->message['entities'][0]['type'] ?? '';
    }

    /**
     * @return int|null
     */
    public function getChatId(): ?int
    {
        return $this->chat_id;
    }

    /**
     * @param int|null $chat_id
     * @return $this
     */
    public function setChatId(?int $chat_id): self
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }

    /**
     * @param array $message
     * @return $this
     */
    public function setMessage(array $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function getCallbackQuery(): array
    {
        return $this->callback_query;
    }

    /**
     * @param array $callback_query
     * @return $this
     */
    public function setCallbackQuery(array $callback_query): self
    {
        $this->callback_query = $callback_query;

        return $this;
    }

    /**
     * @return array
     */
    public function getPreCheckoutQuery(): array
    {
        return $this->pre_checkout_query;
    }

    /**
     * @param array $pre_checkout_query
     */
    public function setPreCheckoutQuery(array $pre_checkout_query): self
    {
        $this->pre_checkout_query = $pre_checkout_query;

        return $this;
    }

    /**
     * @return array
     */
    public function getSuccessfulPayment(): array
    {
        return $this->successful_payment;
    }

    /**
     * @param array $successful_payment
     */
    public function setSuccessfulPayment(array $successful_payment): self
    {
        $this->successful_payment = $successful_payment;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
