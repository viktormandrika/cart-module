<p align="center">
    <h1 align="center">Модуль корзины CG Framework</h1>

</p>
<p align="left">
<h2>Требования</h2>
PHP 7.3 или новее
<h2>Использование</h2>
1. Настроить конфигурационный файл /config/main_local.php

            'mode' => 'DEV', //режим использования DEV / empty
            'storage' => \src\storage\DBEloquent::class, //класс хранилища
            'lifeTime' => 60 * 60 * 36, // время хранения
            'db' => [   //настройка подключения к БД
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'cart',
                'username' => 'root',
                'password' => '',
           

2. В случае использования хранилища BDEloquent - указать название таблицы в БД для хранения корзин в модели src/models/CarsEloquent.php в свойство $table
3. В случае испольование в качестве хранилища базу данных - запустить удаление старых корзин через КРОН, метод deleteOldCarts класса CartEloquent
<h2>Хранилища</h2>
\src\storage\Cookie::class<br>
\src\storage\Session::class<br>
\src\storage\DBEloquent::class<br>


<h2>Методы</h2>

**Инициализация корзины**<br>
```php
$cart = \src\Cart::run($config, 2); 
```
**Добавление в корзину / изменение кол-ва продукта в корзине**<br>
```php
$cart->addToCart($product_id, $quantity, $user_id = null);
```
**Удаление из корзины**<br>
```php
$cart->removeFromCart($product_id, $user_id = null);
```
**Очистка корзины**<br>
```php
$cart->clearCart($user_id = null);
```
**Удаление просроченных корзин из БД**<br>
```php
\src\models\CartEloquent::deleteOldCarts();
```
<h2>Работа с БД</h2> 
В случае использование Eloquent ORM - настройка подключения к БД не нужна. 
По умолчанию модуль использует Eloquent ORM и работает в CG Framework и Laravel. Для использования в других фрейворках необходимо создать класс хранилища.

<h2>Добавление хранилищ</h2>
В случае необходимости добавление нового хранилища необходимо наследовать класс BaseStorage и реализовать абстрактные методы, а так же реализовать все методы интерфейса StorageInterface. 
