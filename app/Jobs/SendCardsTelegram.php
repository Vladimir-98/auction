<?php

namespace App\Jobs;

use App\Services\CardService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCardsTelegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param int $clientId
     * @param int $cardId
     */
    public function __construct(
        protected int $clientId,
        protected int $cardId
    )
    {
    }

    /**
     * Execute the job.
     * @param CardService $cardService
     */
    public function handle(CardService $cardService): void
    {
        $cardService->sendCardsTelegram($this->clientId, $this->cardId);
    }
}
