<?php

class MyXmlImport extends CApplicationComponent
{
    const RESULT_OK = 1;
    const RESULT_BAD = 2;

//    public static function restaurant($array)
//    {
//        if (!Restaurants::model()->countByAttributes(array('id' => $array['id']))) {
//            $model = new Restaurants;
//            $model->title = (string)$array->title;
//            $model->address = (string)$array->address;
//            $model->city_id = Cities::model()->findOrCreateByAttributes(array('title' => (string)$array->city));
//            if ($model->save()) {
//                $ret = self::RESULT_OK;
//            } else {
//                CVarDumper::dump($model->getErrors());
//                $ret = self::RESULT_BAD;
//            }
//        } else {
//            $ret = self::RESULT_EXISTS;
//        }
//
//        return $ret;
//    }

    public static function menuCategories($array) {
        if ((int)$array['dropBeforeCreate'] == 1) {
            ProductGroups::model()->deleteAll();
        }

        $noParentIdItems = $haveParentIdItems = array();
        foreach($array->item as $arr) {
            if (empty($arr['parent_id'])) {
                $noParentIdItems[(int)$arr['id']] = $arr;
            } else {
                $haveParentIdItems[(int)$arr['id']] = $arr;
            }
        }
        $items = CMap::mergeArray($noParentIdItems, $haveParentIdItems);

        foreach($items as $id=>$item) {
            if (!$model = ProductGroups::model()->findByAttributes(array('id' => (int)$item['id']))) {
                $model = new ProductGroups;
                $model->id = (int)$item['id'];
            }

            $model->parent_id = (string)$item['parent_id'];
            $model->title = (string)$item['title'];
            if (!$model->save()) {
                CVarDumper::dump($model->getErrors());
            }
        }

        return true;
    }

    public static function menu($array) {
        if ((int)$array['dropBeforeCreate'] == 1) {
            Products::model()->deleteAll();
        }

        foreach($array->item as $array) {
            if (!empty($array['external_id'])) {
                $model = Products::model()->findByAttributes(array('id' => $array['external_id']));
            } else {
                $model = new Products;
            }

            switch ((int)$array['action']) {
                case 1:
                    $model->title = (string)$array->title;
                    $model->price = (string)$array->price;
                    $model->body = (string)$array->description;
                    $model->group_id = (int)$array->category;

                    $modelRestaurants = array();
                    foreach ($array->restaurants as $restaurant) {
                        $modelRestaurants[] = (int)$restaurant->item['id'];
                    }
                    $model->restaurants = $modelRestaurants;
                    break;

                case 2:
                    $model->status = false;
                    break;

                case 3:
                    $model->price = (string)$array->price;
                    break;
            }

            if ($model->save()) {
                $ret = self::RESULT_OK;
            } else {
                CVarDumper::dump($model->getErrors());
                $ret = self::RESULT_BAD;
            }
        }

        return $ret;
    }

    public static function client($array) {
        if (!empty($array['external_id'])) {
            $model = Clients::model()->findByAttributes(array('id' => $array['external_id']));
        } else {
            $model = new Clients;
        }

        $model->login = (string)$array->login;
        $model->name = (string)$array->name;
        $model->email = (string)$array->email;
        $model->phone = (string)$array->phone;
        if ($model->isNewRecord) {
            $model->password = HString::random(6);
        }

        if ($model->save()) {
            $ret = self::RESULT_OK;
        } else {
            CVarDumper::dump($model->getErrors());
            $ret = self::RESULT_BAD;
        }

        return $ret;
    }

    public static function order($array) {
        if (!empty($array['external_id'])) {
            $model = Orders::model()->findByAttributes(array('id' => $array['external_id']));
        } else {
            $model = new Orders;
        }

        $modelClientAddressAttributes = array(
            'client_id' => (int)$array->order->client_id,
            'city_id' => Cities::model()->findOrCreateByAttributes(
                array('title' => (string)$array->order->client_address->city)
            ),
            'street' => (string)$array->order->client_address->street,
            'house' => (string)$array->order->client_address->house,
            'room' => (string)$array->order->client_address->room,
        );

        if (!$modelClientAddress = ClientAddresses::model()->findByAttributes($modelClientAddressAttributes)) {
            $modelClientAddress = new ClientAddresses;
            $modelClientAddress->attributes = $modelClientAddressAttributes;
            $modelClientAddress->entrance = (string)$array->order->client_address->entrance;
            $modelClientAddress->intercom = (string)$array->order->client_address->intercom;
            $modelClientAddress->floor = (string)$array->order->client_address->floor;
            $modelClientAddress->comment = (string)$array->order->client_address->comment;
            $modelClientAddress->map_latitude = (string)$array->order->client_address->map_latitude;
            $modelClientAddress->map_longitude = (string)$array->order->client_address->map_longitude;
        }

        if (!$modelClientAddress->save()) {
            CVarDumper::dump($modelClientAddress->getErrors());
        }

        $model->client_id = (int)$array->order->client_id;
        $model->client_address_id = $modelClientAddress->id;
        $model->delivery_at = (string)$array->order->delivery_at;
        $model->phone = (string)$array->order->phone;
        $model->client_comment = (string)$array->order->client_comment;
        $model->operator_comment = (string)$array->order->operator_comment;
        $model->sum = (string)$array->order->sum;
        $model->status = Orders::STATUS_1;

        $model->payment_id = (int)$array->payment->type_id;
        $model->payment_sum = (float)$array->payment->payment_sum;
        $model->change_sum = (float)$array->payment->change_sum;
        $model->payment_status = (int)$array->payment->status;

//        Меню заказа
//        foreach($array->items as $item) {
        $model->products = array(1);
//        }

        if ($model->save()) {
            $ret = self::RESULT_OK;
        } else {
            CVarDumper::dump($model->getErrors());
            $ret = self::RESULT_BAD;
        }

        return $ret;
    }

    public static function orderStatus($array) {
        foreach($array as $item) {
            $model = Orders::model()->findByPk((int)$item['id']);
            $model->status = (int)$item['status'];

            if (!$model->save()) {
                CVarDumper::dump($model->getErrors());
            }
        }

        return true;
    }
}
