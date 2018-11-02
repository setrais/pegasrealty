<?php

class UserController extends FrontendController
{
    public $_class = 'Clients';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('*'),
                'actions' => array('auth', 'register', 'quickRegister', 'confirm', 'addressInfo'),
            ),
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionAuth()
    {
        $service = Yii::app()->request->getQuery('service');
        if (isset($service)) {
            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('/user/auth');

            if ($authIdentity->authenticate()) {
                $identity = new  FrontendUserIdentity($authIdentity);

                if ($identity->authenticateByService()) {
                    Yii::app()->user->login($identity);
                    $authIdentity->redirect();
                } else
                {
                    $authIdentity->cancel();
                }
            }

            $this->redirect(array('/user/auth'));
        }

        $this->SetPageTitle('Авторизация');

        if (Yii::app()->request->isAjaxRequest)
            $this->layout = null;

        $model = new FrontendLoginForm;
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['FrontendLoginForm'];
            $this->performAjaxValidation($model);
            $cart = ShoppingCart::model()->menu_cart;

            if ($model->validate() && $model->login()) {
                if (!$cart->IsEmpty()) {
                    //if cart not empty - delete old card and rely new on user_id
                    $user = Yii::app()->user->getModel();
                    MenuCart::model()->deleteAllByAttributes(array('user_id' => $user->id));
                    $cart->user_id = $user->id;
                    $cart->user_session = null;
                    $cart->save();
                }
                $user = Yii::app()->user->getModel();
                $result = array('first_name' => $user->first_name, 'success' => true, 'user_type' => $user->type);
                $user = Yii::app()->user->getModel();
                if (!empty($user->clientAddresses))
                    $result['addressFilter'] = true;
                echo CJSON::encode($result);
                Yii::app()->end();
            } else {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        $this->render('auth', array('model' => $model));
    }

    public function actionRegister($partner_code = null)
    {
        $this->SetPageTitle('Регистрация');

        if (Yii::app()->request->isAjaxRequest) {
            $this->layout = null;
        }

        $model = new RegisterForm();
		
		if(isset($partner_code)){
			$inviter = Clients::model()->find('`partner_code` = :p_code', array(':p_code'=>$partner_code));
			//print_r($inviter);
		}
        
		if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['RegisterForm'];
            $password = $model->password;

            $this->performAjaxValidation($model);
            if ($model->validate()) {
                $cart = ShoppingCart::model()->menu_cart;
                if ($cart->user !== null) {
                    $cart->user->attributes = $_POST['RegisterForm'];
                    $cart->user->password = $cart->user->generatePassword($password);
                    $cart->user->save();
                    $cart->user->password = $password;
                    $cart->user->token = HString::random(40);
                    $cart->user->authenticate();
                    KingMoney::CurrentUserRegistered();

                    if (!empty($cart->user->clientAddresses)) {
                        $current_address = $cart->user->GetActiveAddress();
                        $current_address->city_id = $model->city_id;
                        $current_address->street = $model->street;
                        $current_address->house = $model->house;
                        $current_address->housing = $model->housing;
                        $current_address->room = $model->room;
                        $current_address->entrance = $model->entrance;
                        $current_address->intercom = $model->intercom;
                        $current_address->floor = $model->floor;
                        $current_address->map_latitude = $model->lat;
                        $current_address->map_longitude = $model->long;
                        $current_address->comment = $model->comment;
                        $current_address->save();
                        $this->redirect($this->createUrl('site/index', array()));
                    } else {
                        $address = new ClientAddresses();
                        $address->attributes = $_POST['RegisterForm'];
                        $address->client_id = $cart->user_id;
                        $address->active = 1;
                        if (!$address->save())
							$model->addErrors ($address->getErrors());
                            //var_dump($address->getErrors());
                        $this->redirect($this->createUrl('site/index', array()));
                    }
                } else {

                    $client = new Clients();
                    $client->attributes = $_POST['RegisterForm'];
					$client->partner_code = md5($client->first_name.time());

					if($inviter){
						$client->inviter_id = $inviter->id;
					}
						
                    $client->type = Clients::TYPE_USER;
                    if ($client->save()) {
						if(ActivationCodes::model()->getActivationCode($client->id)){
							MyUserMailer::sendNewClientRegistration($client, $model->password);
						}
						
						SmsHelper::sendSms('+'.$client->country_code.$client->phone_code.$client->phone, 'Здравствуйте, '.$client->first_name.'. Вы успешно зарегистрировались на kingmenu.ru. На ваш счет зачислено 3000 бонусов!');
						
                        $client->password = $password;
                        $client->authenticate();
                        KingMoney::CurrentUserRegistered();
						if($inviter)
							KingMoney::FriendRegistered($inviter);

                        $address = new ClientAddresses();
                        $address->attributes = $_POST['RegisterForm'];
                        $address->client_id = $client->id;
                        $address->map_latitude = $model->lat;
                        $address->map_longitude = $model->long;
                        $address->active = 1;
                        if (!$address->save())
							$model->addErrors ($address->getErrors());
                            //var_dump($address->getErrors());
                        else {
							//MyUserMailer::sendNewOrderToSd($order);
                            $this->redirect($this->createUrl('site/index', array()));
                        }

                    } else
						$model->addErrors ($client->getErrors());
                        //var_dump($client->getErrors());
                }
            }
        }

        $this->render('register', array(
			'model' => $model,
			'inviter' => $inviter,
		));
    }

    public function actionQuickRegister()
    {
        $this->layout = null;
        $model = Yii::app()->user->getModel();
        if ($model === null) {
            $model = new Clients();
            $model->setScenario('quickRegister');

            if (Yii::app()->request->isPostRequest) {
                $model->attributes = $_POST['Clients'];
                $this->performAjaxValidation($model);
                $password = $model->password;

                if ($model->save()) {
					if(ActivationCodes::model()->getActivationCode($model->id)){
						MyUserMailer::sendNewClientRegistration($model, $password);
					}
					SmsHelper::sendSms('+'.$client->country_code.$client->phone_code.$client->phone, 'Здравствуйте, '.$model->client->first_name.'. вы успешно зарегистрировались на kingmenu.ru . На ваш счет зачислено 3000 бонусов!');
                    $model->password = $password;
                    $model->authenticate();
                    KingMoney::CurrentUserRegistered();
                    //MyUserMailer::sendQuickRegistration($model);
                    echo CJavaScript::jsonEncode(true);
                    Yii::app()->end();
                }
            }
        } else
        {
            $model->attributes = $_POST['Clients'];
            if ($model->save()) {
                $model->authenticate();
                //MyUserMailer::sendQuickRegistration($model);
                echo CJavaScript::jsonEncode(true);
                Yii::app()->end();
            }
        }

        $this->render('//cart/quickRegister', array(
            'model' => $model,
        ));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionConfirm($token)
    {
        $model = Clients::model()->findByAttributes(array('token' => $token));
        $model->token = null;
        $model->status = true;
        $model->save();

        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionProfile()
    {
        $this->SetPageTitle('Настройки');
        $this->layout = 'user_layout';

        $model = Yii::app()->user->getModel();

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['Clients'];
            $this->performAjaxValidation($model);
            if ($model->save()) {
                $this->refresh();
            }
        }

        $this->render('profile', array('model' => $model));
    }

    public function actionMessages()
    {
        $this->SetPageTitle('Сообщения');
        $this->layout = 'user_layout';
        $messages = Messages::model()->findAll('recipient_id = ' . Yii::app()->user->id . ' or author_id = ' . Yii::app()->user->id);

        $this->render('messages', array(
            'messages' => $messages,
        ));
    }

//  public function actionDeleteMessage($id)
//  {
//    Messages::model()->findByPk($id)->delete();
//    $this->redirect($this->createUrl('user/messages', array()));
//  }

    public function actionAjaxReadMessage($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $this->layout = null;
            $message = Messages::model()->findByPk($id);
            if ($message['read_at'] == null || $message['read_at'] == 0 && $message['recipient_id'] == Yii::app()->user->id) {
                $message['read_at'] = time();
                $message->save();
            }
        }
    }

    public function actionAjaxDeleteMessages($id = null)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $this->layout = null;

            if ($id)
                Messages::model()->findByPk($id)->delete();

            if (isset($_POST['del'])) {
                foreach ($_POST['del'] as $message_id => $val)
                    Messages::model()->findByPk($message_id)->delete();
            }
        }
    }

    public function actionMessageCreate()
    {
        $this->SetPageTitle('Написать на сообщение');

        $model = new Messages();

        if (isset($_POST['Messages'])) {
            $model->beforeSave();
            $model->attributes = $_POST['Messages'];
            $model->recipient_id = 0;
            if ($model->save()) {
				if(Yii::app()->request->isAjaxRequest){
					echo 'Сообщение успешно отправлено';
					Yii::app()->end();
				}
                $this->setFlash('default', 'Запись успешно добавлена');
            } else
            {
				if(Yii::app()->request->isAjaxRequest){
					echo $model->getErrors();
					Yii::app()->end();
				}
				
                echo '<pre>';
                print_r($model);
                echo '</pre>';
            }
        }

        $this->redirect($this->createUrl('user/messages', array()));
    }

    public function actionMessageReply($id)
    {
        $this->SetPageTitle('Ответить на сообщение');

        $message = Messages::model()->findByPk($id);
        $model = new Messages();

        if (isset($_POST['Messages'])) {
            $model->beforeSave();
            $model->attributes = $_POST['Messages'];
            $model->recipient_id = $message->author_id;
            if ($model->save()) {
                $this->setFlash('default', 'Запись успешно добавлена');
            }
        }

        $model = new Messages();
        $this->render('messageReply'
            , array(
                'model' => $model,
            )
        );
    }

    public function actionSettingsDeliveryAddresses()
    {
        $this->SetPageTitle('Адреса доставки');

        if (Yii::app()->request->isPostRequest) {
            ClientAddresses::model()->deleteAllByAttributes(array('client_id' => Yii::app()->user->id));
            for ($c = 0; $c < count($_POST['title']); $c++)
            {
                $clientAddress = new ClientAddresses;
                $clientAddress->client_id = Yii::app()->user->id;
                $clientAddress->title = $_POST['title'][$c];
                $clientAddress->city_id = $_POST['city_id'][$c];
                $clientAddress->street = $_POST['street'][$c];
                $clientAddress->house = $_POST['house'][$c];
                $clientAddress->housing = $_POST['housing'][$c];
                $clientAddress->room = $_POST['room'][$c];
                $clientAddress->room = $_POST['entrance'][$c];
                $clientAddress->room = $_POST['intercom'][$c];
                $clientAddress->room = $_POST['floor'][$c];
                $clientAddress->save();
            }
            $this->refresh();
        }

        $model = Yii::app()->user->getModel()->clientAddresses;
        $cleanModel = new ClientAddresses;

        $this->render('settingsDeliveryAddresses', array(
            'model' => $model,
            'cleanModel' => $cleanModel,
        ));
    }

    public function actionCheckMapLocation()
    {
        $pointLocation = new GoogleMapPointLocation();

        $result = array('result' => false);
        foreach (RestaurantZones::model()->findAll() as $restaurantZone)
        {
            $polygon = explode("\n", trim($restaurantZone->coords));
            if ($pointLocation->pointInPolygon($_POST['points'], $polygon) == true) {
                $result = array(
                    'result' => true,
                    'sum_min' => $restaurantZone->sum_min,
                    'sum_delivery' => $restaurantZone->sum_delivery
                );
            }
        }
        echo CJSON::encode($result);
        Yii::app()->end();
    }

    public function actionFavorites()
    {
        $this->SetPageTitle('Избранное');
        $this->layout = 'user_layout';

        $dataProvider = new CActiveDataProvider('ClientFavorites', array(
            'criteria' => array(
                'condition' => 'client_id=:client_id',
                'order' => 'product_id, restaurant_id',
                'with' => array('product', 'restaurant'),
                'params' => array(
                    ':client_id' => Yii::app()->user->id,
                ),
            ),
        ));

        $this->render('favourite/favorites', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddressInfo()
    {
        $json = array('result' => false);
        if (!empty($_POST['id'])) {
            $clientAddress = ClientAddresses::model()->findByPk($_POST['id']);
            if ($clientAddress !== null) {
                $json = array(
                    'result' => true,
                    'address' => array(
                        'id' => $clientAddress->id,
                        'title' => $clientAddress->title,
                        'street' => $clientAddress->street,
                        'house' => $clientAddress->house,
                        'housing' => $clientAddress->housing,
                        'room' => $clientAddress->room,
                        'entrance' => $clientAddress->entrance,
                        'intercom' => $clientAddress->intercom,
                        'floor' => $clientAddress->floor,
                        'city_id' => $clientAddress->city_id,
                        'lat' => $clientAddress->map_latitude,
                        'long' => $clientAddress->map_longitude,
                    ),
                );
            }
        }
        echo CJSON::encode($json);
        Yii::app()->end();
    }

    public function actionOrders()
    {
        $this->SetPageTitle('Заказы');
        $this->layout = 'user_layout';

        $ordersDataProvider = new CActiveDataProvider('Orders',
            array('criteria' => array('condition' => 'client_id = ' . Yii::app()->user->id, 'order' => 'created_at desc')));

        $this->render('orders', array(
            'ordersDataProvider' => $ordersDataProvider,
        ));
    }
	
	public function actionPartner(){
		$this->SetPageTitle('Партнерская ссылка');
		$this->layout = 'user_layout';
		
		$this->render('partner', array(
			'partner_code' => Yii::app()->user->getModel()->partner_code,
		));
	}

    public function actionBalance()
    {
        $this->SetPageTitle('Лицевой счет');
        $this->layout = 'user_layout';

        $user = Yii::app()->user->getModel();

        $this->render('balance', array(
            'user' => $user
        ));
    }

    public function actionStats()
    {
        $this->layout = 'user_layout';
        $this->SetPageTitle('Финансовая статистика');
        $stats = ClientsMoneyTransactions::CurrentClientTransactionsDataProvider();

        $this->render('stats', array(
            'stats' => $stats
        ));
    }

    public function actionUpdate()
    {
        $this->SetPageTitle('Изменить профиль');
        $this->layout = 'user_layout';

        $model = Yii::app()->user->getModel();

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['Clients'];
            $this->performAjaxValidation($model);
            $this->performUploads($model);
            if ($model->save()) {
                if (isset($model->picture) && isset($_POST['Clients']['picture'])){
                    $this->performUploadsSaveToDisk($model);
                    Yii::import('application.extensions.image.Image');
                    $image = new Image($model->uploadTo('picture'));
                    $image->resize(100, 100);
                    $image->save();
                }
                $this->setFlash('default', 'Профиль обновлен');
                $this->afterSave($model, 'update');
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionUpdatePassword()
    {
        $this->SetPageTitle('Изменить пароль');
        $this->layout = 'user_layout';

        $model = Yii::app()->user->getModel();

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['Clients'];
            $this->performAjaxValidation($model);
            if ($model->save()) {
                $this->setFlash('default', 'Пароль успешно изменен');
                $this->redirect($this->createUrl('user/profile'));
            }
        }

        $this->render('updatePassword', array('model' => $model));
    }

    public function actionCreateAddress()
    {
        $this->SetPageTitle('Добавить адрес доставки');
        $this->layout = 'user_layout';

        $model = new ClientAddresses;

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['ClientAddresses'];
            $model->client_id = Yii::app()->user->getModel()->id;
            $this->performAjaxValidation($model);
            if ($model->save()) {
                $this->setFlash('default', 'Адрес добавлен');
                $this->afterSave($model, 'createAddress');
            }
        }

        $this->render('userAddress/form', array('model' => $model));
    }

    public function actionUpdateAddress($id)
    {
        $this->SetPageTitle('Обновить адрес доставки');
        $this->layout = 'user_layout';

        $model = $this->loadAddress($id);

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['ClientAddresses'];
            $this->performAjaxValidation($model);
            if ($model->save()) {
                $this->setFlash('default', 'Адрес обновлен');
                $this->afterSave($model, 'updateAddress');
            }
        }

        $this->render('userAddress/form', array('model' => $model));
    }

    public function actionDeleteAddress($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadAddress($id);
            $model->delete();
            $this->renderPartial('userAddress/admin', array(
                'model' => Yii::app()->user->getModel()
            ));
        }
    }

    protected function afterSave($model, $action)
    {
        $redirect_to = 'profile';
        if (!empty($_POST['redirect_to'])) {
            if ($_POST['redirect_to'] == 'refresh') {
                $model->refresh();
                $this->redirect($this->createUrl($action, array('id' => $model->id)));
            } else
            {
                $redirect_to = $_POST['redirect_to'];
            }
        }
        $this->redirect(array($redirect_to));
    }

    /**
     * @throws CHttpException
     * @param int $id
     * @return ClientAddresses
     */
    protected function loadAddress($id)
    {
        $model = ClientAddresses::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        if ($model->client_id != Yii::app()->user->getModel()->id)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return $model;
    }

    public function actionToggleFavorites($id, $type)
    {
        if ($type == 'product')
            echo ClientFavorites::removeProductFromFavorites(Yii::app()->user->id, $id);
        if ($type == 'shop')
            echo ClientFavorites::removeRestaurantFromFavorites(Yii::app()->user->id, $id);
    }

    public function actionReOrder($id)
    {
        $cart = ShoppingCart::model()->menu_cart;
        echo $cart->ReOrder($id);
    }

}
