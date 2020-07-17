<?php
/**
 * Возможны 2 параметра, место хранения - принимает название класса и время жизни кук,
 * Сюда же можно будет вынести настройки для ДБ, например название таблицы и название полей для хранения
 */

return [
    'mode' => 'DEV',
    'storage' => \src\storage\DBEloquent::class, /// Storage class (Cookie / Session / DBEloquent)
    'lifeTime' => 60 * 60 * 36, // Cart life time in seconds use in Cookie or DBEloquent,
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'cart',
        'username' => 'root',
        'password' => '',
    ]
];