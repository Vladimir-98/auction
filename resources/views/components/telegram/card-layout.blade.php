@if(isset($card->name))
<b>{{ \Illuminate\Support\Str::ucfirst($card->name) }}</b>
@endif

@if(isset($card->phone))
<b>Телефон:</b> {{ $card->phone }}
@endif
@if(isset($card->budgetRange))
<b>Бюджет:</b> {{ $card->budgetRange }}
@endif
@if(isset($card->lead_price))
<b>Цена лида:</b> {{ $card->lead_price }}
@endif
@if(isset($card->stringTypes))
<b>Тип:</b> {{ $card->stringTypes }}
@endif
@if(isset($card->stringDistricts))
<b>Районы:</b> {{ $card->stringDistricts }}
@endif
@if(isset($card->stringPaymentType))
<b>Вид оплаты:</b> {{ $card->stringPaymentType }}
@endif
@if(isset($card->desc))
<b>Описание:</b> {{ $card->desc }}
@endif

