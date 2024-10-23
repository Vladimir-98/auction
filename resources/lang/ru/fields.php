<?php

return [
    'client' => [
        'telegram_id' => 'Идентификатор в Telegram',
        'first_name' => 'Имя',
        'last_name' => 'Фамилия',
        'username' => 'Имя в Telegram',
        'language_code' => 'Локаль',
        'allows_write_to_pm' => 'Разрешает ли писать в личные сообщения',
        'type' => 'Тип',
        'balance' => 'Баланс',
        'status_id' => 'Статус',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата обновления',
    ],
    'card' => [
        'name' => 'Название',
        'desc' => 'Описание',
        'phone' => 'Телефон',
        'budget_min' => 'Мин. цена',
        'budget_max' => 'Макс. цена',
        'lead_price' => 'Цена лида',
        'record' => 'Запись разговоров',
        'city_id' => 'ID города',
        'status_id' => 'Статус',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата обновления',
        'crm_id' => 'CRM ID',
        'crm_url' => 'CRM URL',
        'created' => 'Дата создания карточки',
    ],
    'filter' => [
        'name' => 'Название',
        'title' => 'Заголовок',
        'type' => 'checkBox, rangeInput...',
        'dropDown' => 'Выпадающее меню',
        'active' => 'Видимость выпадающего',
        'items' => 'Сущность, или null',
        'categories' => 'Категории',
        'districts' => 'Районы',
        'paymentType' => 'Вид оплаты',
        'budget' => 'Бюджет',
        'leadPrice' => 'Цена за лид',
        'city' => 'Город',
    ],
    'replenishment' => [
        'client_id' => 'ID клиента',
        'amount' => 'Сумма пополнения',
        'payment_method' => 'Метод пополнения',
        'metadata' => 'Метаданные пополнения'
    ],
    'deduction' => [
        'client_id' => 'ID клиента',
        'card_id' => 'ID карточки',
        'amount' => 'Сумма списания'
    ],
    'status' => [
        'name' => 'Название',
        'visibility' => 'Видимость',
    ],
    'type' => [
        'name' => 'Название',
        'icon' => 'Иконка',
        'visibility' => 'Видимость',
    ],
    'district' => [
        'name' => 'Название'
    ],
    'payment_type' => [
        'name' => 'Название'
    ],
    'city' => [
        'name' => 'Название'
    ],
    'user' => [
        'name' => 'имя',
        'email' => 'email',
        'password' => 'пароль',
        'roles' => 'роли',
        'email_verified_at' => 'верификация email',
        'created_at' => 'дата создания',
        'updated_at' => 'дата обновления',
    ],
    'roles' => [
        'name' => 'название'
    ],
    'crm' => [
        'name' => 'Название',
        'token' => 'CRM токен'
    ]
];
