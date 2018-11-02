<?php

/**
 * Класс модели для таблицы "auth_assignment".
 *
 * @property string $itemname
 * @property string $userid
 * @property string $bizrule
 * @property string $data
 *
 * Модель имеет следующие связи:
 * @property AuthItem $itemname0
 *
 * @package models
 * @author [author]
 */
class AuthAssignmentBase extends MyActiveRecord {
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('itemname, userid', 'required'),
            array('itemname, userid', 'length', 'max' => 64),
            array('bizrule, data', 'safe'),
            array('itemname, userid, bizrule, data', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'itemname0' => array(self::BELONGS_TO, 'AuthItem', 'itemname'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('itemname', $this->itemname, true);
        $criteria->compare('userid', $this->userid, true);
        $criteria->compare('bizrule', $this->bizrule, true);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
}
