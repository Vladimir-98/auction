<?php

namespace App\Services;

use App\Facades\Telegram;
use App\Models\Card\Card;
use App\Models\Card\City;
use App\Models\Card\Type;
use App\Models\Client\Client;
use App\Models\Card\District;
use App\Models\Card\CallRecord;
use App\Models\Card\CardStatus;
use App\Jobs\SendCardsTelegram;
use App\Models\Client\Deduction;
use App\Models\Card\PaymentType;
use Illuminate\Support\Collection;
use App\Http\Requests\CardRequest;
use Illuminate\Support\Facades\Log;
use App\View\Components\Telegram\CardLayout;

class CardService
{

    public function create(CardRequest $request): ?Card
    {
        try {
            $data = $request->validated();

            $this->setCardStatus($data);

            $cardData = collect($data)->only([
                'name', 'desc', 'phone', 'budget_min', 'budget_max',
                'lead_price', 'status_id', 'crm_id', 'crm_url'
            ])->toArray();

            $card = Card::updateOrCreate(
                ['crm_id' => $cardData['crm_id'], 'crm_url' => $cardData['crm_url']],
                $cardData
            );

            if (isset($data['cities'])) {
                $this->attachCities($card, $data['cities']);
            }

            if (isset($data['types'])) {
                $this->attachTypes($card, $data['types']);
            }

            if (isset($data['districts'])) {
                $this->attachDistricts($card, $data['districts']);
            }

            if (isset($data['paymentTypes'])) {
                $this->attachPaymentTypes($card, $data['paymentTypes']);
            }

            if (isset($data['callRecords'])) {
                $this->attachCallRecords($card, $data['callRecords']);
            }
        } catch (\Exception $e) {
            Log::error('Error creating card: ' . $e->getMessage());

            return null;
        }

        return $card;
    }

    /**
     * @param array $data
     */
    private function setCardStatus(array &$data): void
    {
        $status = CardStatus::firstOrCreate(['name' => $data['card_status']]);

        $data['status_id'] = $status->id;
    }

    /**
     * @param Card $card
     * @param array $cities
     */
    private function attachCities(Card $card, array $cities = []): void
    {
        $cityIds = [];
        foreach ($cities as $cityData) {
            $city = City::firstOrCreate(['name' => $cityData]);
            $cityIds[] = $city->id;
        }
        $card->cities()->sync($cityIds);

    }

    /**
     * @param Card $card
     * @param array $types
     */
    private function attachTypes(Card $card, array $types): void
    {
        $typeIds = [];
        foreach ($types as $typeData) {

            $type = Type::firstOrCreate(['name' => $typeData]);
            $typeIds[] = $type->id;
        }
        $card->types()->sync($typeIds);
    }

    /**
     * @param Card $card
     * @param array $districts
     */
    private function attachDistricts(Card $card, array $districts): void
    {
        $districtIds = [];
        foreach ($districts as $districtData) {
            $district = District::firstOrCreate(['name' => $districtData]);
            $districtIds[] = $district->id;
        }

        $card->districts()->sync($districtIds);
    }

    /**
     * @param Card $card
     * @param array $paymentTypes
     */
    private function attachPaymentTypes(Card $card, array $paymentTypes): void
    {
        $paymentTypeIds = [];
        foreach ($paymentTypes as $paymentTypeData) {
            $paymentType = PaymentType::firstOrCreate(['name' => $paymentTypeData]);
            $paymentTypeIds[] = $paymentType->id;
        }
        $card->payment_types()->sync($paymentTypeIds);
    }

    /**
     * @param Card $card
     * @param array $callRecords
     */
    private function attachCallRecords(Card $card, array $callRecords): void
    {
        foreach ($callRecords as $recordData) {
            CallRecord::firstOrCreate(['record' => $recordData, 'card_id' => $card->id]);
        }
    }

    /**
     * @param array $cardIds
     * @param Client $client
     * @return Collection
     */
    public function processBuyCards(array $cardIds, Client $client): Collection
    {
        $orders = collect();

        $cards = Card::query()->whereIn('id', $cardIds)->get();
        $balance = $client->balance;

        $delay = 0;
        $delayInterval = 3;
        foreach ($cards as $card) {

            if ($card->status->visibility && $balance >= $card->lead_price) {
                $balance -= $card->lead_price;

                Deduction::query()->create([
                    'client_id' => $client->id,
                    'card_id' => $card->id,
                    'amount' => $card->lead_price
                ]);

                SendCardsTelegram::dispatch($client->id, $card->id)->delay(now()->addSeconds($delay));
                $card->status_id = 3;
                $card->save();
                $orders->push($card);

                $delay += $delayInterval;

                // Предупреждение себе, чтобы открыть заявку
                Telegram::message(529204894, 'Кто-то взял заявку!')->send();

            }
        }

        return $orders;
    }

    /**
     * @param $clientId
     * @param $cardId
     */
    public function sendCardsTelegram($clientId, $cardId)
    {
        $client = Client::find($clientId);
        $card = Card::find($cardId);

        if (!$client || !$card) return;

        $view = (new CardLayout($card))->render();
        Telegram::message($client->telegram_id, $view)->send();

        $records = $card->callRecords;
        foreach ($records as $record) {
            $caption = $card->name;
            Telegram::audio($client->telegram_id, $record->record, $caption)->send();
        }

    }
}

