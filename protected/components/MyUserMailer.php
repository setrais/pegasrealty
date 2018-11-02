<?php

class MyUserMailer extends CApplicationComponent
{
    public static function sendClientRegistration($client) {
        MyMailer::getInstance()
                ->setSubject('Регистрация')
                ->setTo($client->email)
                ->setView('user.registration')
                ->setData(array('client' => $client))
                ->send();
    }

    public static function sendQuickRegistration($client) {
        MyMailer::getInstance()
                ->setSubject('Регистрация')
                ->setTo($client->email)
                ->setView('user.quickRegistration')
                ->setData(array('client' => $client))
                ->send();
    }
	
	public static function sendNewClientRegistration($client, $password){
        MyMailer::getInstance()
                ->setSubject('Регистрация')
                ->setTo($client->email)
                ->setView('user.registration_new')
                ->setData(array('client' => $client, 'password'=>$password))
                ->send();
	}
	
	public static function sendNewOrderToSd($order){
		MyMailer::getInstance()
                ->setSubject('Поступил новый заказ')
                ->setTo($order->deliveryService->email)
                ->setView('order.sendNewOrder')
                ->setData(array('order' => $order))
                ->send();
	}
	
	public static function sendNewOrderToClient($order){
		MyMailer::getInstance()
                ->setSubject('Ваш заказ поступил в обработкту')
                ->setTo($order->client->email)
                ->setView('order.sendNewOrder')
                ->setData(array('order' => $order))
                ->send();
	}
}
