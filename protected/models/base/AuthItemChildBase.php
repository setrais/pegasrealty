<?php

/**
 * Класс модели для таблицы "auth_item_child".
 *
 * @property string $parent
 * @property string $child
 *
 * Модель имеет следующие связи:
 * @property AuthItem $child0
 * @property AuthItem $parent0
 *
 * @package models
 * @author [author]
 */
class AuthItemChildBase extends MyActiveRecord {
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('parent, child', 'required'),
            array('parent, child', 'length', 'max' => 64),
            array('parent, child', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'child0' => array(self::BELONGS_TO, 'AuthItem', 'child'),
            'parent0' => array(self::BELONGS_TO, 'AuthItem', 'parent'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('parent', $this->parent, true);
        $criteria->compare('child', $this->child, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
}
