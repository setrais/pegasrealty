<?php

class BackendWebUser extends CWebUser {
    public function getId() {
        return parent::getId();
    }

    public function getModel() {
        return Users::model()->findByAttributes(array('login' => $this->getId()));
    }
}
