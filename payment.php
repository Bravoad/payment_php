<?php
require 'vendor/autoload.php';

use YooKassa\Client;

$client = new Client();
//аунтификация  магазина с оплатой
$client->setAuth('shopId', 'secretKey');
// создание оплаты
$payment = $client->createPayment(
    array(
        //стоимость
        'amount' => array(
            'value' => '1000.00',
            'currency' => 'RUB',
        ),
        //метод оплаты
        'payment_method_data' => array(
            'type' => 'bank_card',
        ),
        //редирект
        'confirmation' => array(
            'type' => 'redirect',
            'return_url' => 'https://example.com/return_page',
        ),
        //описание
        'description' => 'Оплата заказа №1',
    ),
    //Функция uniqid('', true) в PHP генерирует уникальный идентификатор (строку)
    uniqid('', true)
);
//  выполняет перенаправление пользователя на страницу оплаты, предоставляемую ЮKassa (или другим платежным провайдером).
header('Location: ' . $payment->getConfirmation()->getConfirmationUrl());
