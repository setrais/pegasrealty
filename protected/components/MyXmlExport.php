<?php

class MyXmlExport extends CApplicationComponent {
    public static function restaurants() {
        $items = array();
        foreach(Restaurants::model()->findAll() as $item) {
            $items[] = array(
                'attributes' => array(
                    'id' => $item->id,
                ),
                'title' => $item->title,
                'address' => $item->address,
                'city' => $item->city->title,
            );
        }
        return $items;
    }

    public static function menu() {
        $items = array();
        foreach(MenuModel::model()->findAll() as $item) {
            $items[] = array(
                'attributes' => array(
                    'id' => $item->id,
                ),
                'title' => $item->title,
                'price' => $item->price,
                'description' => $item->body,
                'picture' => $item->picture,
            );
        }
        return $items;
    }

//    public static function clients($ids=null) {
//        $items = array();
//
//        if ($ids != null) {
//            $models = Clients::model()->findAll();
//        } else {
//            $models = Clients::model()->findAllByPk($ids);
//        }
//
//        foreach($models as $item) {
//            $items[] = array(
//                'attributes' => array(
//                    'id' => $item->id,
//                ),
//                'login' => $item->login,
//                'name' => $item->fullName,
//                'email' => $item->email,
//                'phone' => $item->phone,
//            );
//        }
//
//        return $items;
//    }

    public static function client($id) {
        $model = Clients::model()->findByPk($id);

        $item = array(
            'attributes' => array(
                'id' => $model->id,
            ),
            'login' => $model->login,
            'name' => $model->fullName,
            'email' => $model->email,
            'phone' => $model->phone,
        );

        return $item;
    }

//    public static function orders() {
//        $orders = array();
//        foreach(Orders::model()->findAll() as $order) {
//            $items = array();
//            foreach($order->products as $product) {
//                $items[] = array(
//                    'product_id' => $product->id,
//                    'product_parent_id' => null, // ID "базового" товара (если данный товар является модификатором к другому товару)
//                    'price' => $product->price,
//                    'quantity' => 1,
//                );
//            }
//
//            $client_address = $order->clientAddress;
//            $order_payment = $order->payment;
//            $orders[] = array(
//                'attributes' => array(
//                    'id' => $order->id,
//                ),
//                'order' => array(
//                    'client_id' => $order->client_id,
//                    'client_address' => array(
//                        'city' => $client_address->city,
//                        'street' => $client_address->street,
//                        'house' => $client_address->house,
//                        'room' => $client_address->room,
//                        'entrance' => $client_address->entrance,
//                        'intercom' => $client_address->intercom,
//                        'floor' => $client_address->floor,
//                        'comment' => $client_address->comment,
//                        'map_latitude' => $client_address->map_latitude,
//                        'map_longitude' => $client_address->map_longitude,
//                    ),
//                    'delivery_at' => empty($order->delivery_at) ? null : date('d.m.Y H:i:s', strtotime($order->delivery_at)),
//                    'phone' => $order->phone,
//                    'client_comment' => $order->client_comment,
//                    'operator_comment' => $order->operator_comment,
//                    'sum' => $order->sum,
//                ),
//                'payment' => array(
//                    'type_id' => $order_payment->id,
//                    'title' => $order_payment->title,
//                    'payment_sum' => 100,
//                    'change_sum' => 10,
//                ),
//                'items' => $items,
//            );
//        }
//        return $orders;
//    }

    public static function order($id) {
        $model = Orders::model()->findByPk($id);

        $items = array();
        foreach($model->orderItems as $menuItem) {
            $items[] = array(
                'product_id' => $menuItem->product->id,
                'product_parent_id' => null, // ID "базового" товара (если данный товар является модификатором к другому товару)
                'price' => $menuItem->product->price,
                'quantity' => $menuItem->product_qt,
            );
        }

        $client_address = $model->clientAddress;
        $order_payment = $model->payment;
        $order = array(
            'attributes' => array(
                'id' => $model->id,
            ),
            'order' => array(
                'client_id' => $model->client_id,
                'client_address' => array(
                    'city' => $client_address->city,
                    'street' => $client_address->street,
                    'house' => $client_address->house,
                    'room' => $client_address->room,
                    'entrance' => $client_address->entrance,
                    'intercom' => $client_address->intercom,
                    'floor' => $client_address->floor,
                    'comment' => $client_address->comment,
                    'map_latitude' => $client_address->map_latitude,
                    'map_longitude' => $client_address->map_longitude,
                ),
                'delivery_at' => empty($model->delivery_at) ? null : date('d.m.Y H:i:s', strtotime($model->delivery_at)),
                'phone' => $model->phone,
                'client_comment' => $model->client_comment,
                'operator_comment' => $model->operator_comment,
                'sum' => $model->sum,
            ),
            'payment' => array(
                'type_id' => $order_payment->id,
                'title' => $order_payment->title,
                'status' => $model->payment_status,
                'payment_sum' => 100,
                'change_sum' => 10,
            ),
            'items' => $items,
        );

        return $order;
    }

    public static function orderStatus($id) {
        $items = array();

        if (file_exists(dirname(__FILE__) . '/../../xml/FROM_SITE/ORDER_STATUSES.xml')) {
            $oldXml = MyXmlConvert::xml2array(file_get_contents(dirname(__FILE__) . '/../../xml/FROM_SITE/ORDER_STATUSES.xml'));
            foreach($oldXml->item as $item) {
                $items[] = array(
                    'attributes' => array(
                        'id' => (int)$item['id'],
                        'status' => (int)$item['status'],
                    ),
                );
            }
        }

        $model = Orders::model()->findByPk($id);
        $items[] = array(
            'attributes' => array(
                'id' => $model->id,
                'status' => $model->status,
            ),
        );

        return $items;
    }

    public static function generateXml($action, $name, $data, $appendFileName=true) {
        if ($appendFileName) {
            if (isset($data['attributes']['id'])) {
                $name .= '_' . $data['attributes']['id'];
            } else {
                $c = 0;
                do {
                    $c++;
                } while(file_exists(dirname(__FILE__) . '/../../xml/FROM_SITE/' . $name . '_' .$c . '.xml'));
                $name = $name . '_' . $c;
            }
        }

        $rootNodeName = 'service action="' . $action . '"';

        $fp = fopen(dirname(__FILE__) . '/../../xml/FROM_SITE/' . $name . '.xml', 'w');
        fputs($fp, MyXmlConvert::array2xml($data, $rootNodeName));
        fclose($fp);

        return $name;
    }
}
