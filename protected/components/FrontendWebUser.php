<?php

class FrontendWebUser extends CWebUser {

    public function getModel() {
        if ($this->isGuest){
            if (isset($_COOKIE['userId'])) {
                $menu_cart = MenuCart::model()->find('user_session="' . $_COOKIE['userId'] . '"');
                if (!empty($menu_cart->user_id))
                    return Clients::model()->findByAttributes(array('id' => $menu_cart->user_id));
            }
            return null;
        }else
            return Clients::model()->findByAttributes(array('id' => $this->getId()));
    }
}
