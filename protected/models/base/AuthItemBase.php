<?php

/**
 * Класс модели для таблицы "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * Модель имеет следующие связи:
 * @property AuthAssignment[] $authAssignments
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren1
 *
 * @package models
 * @author [author]
 */
class AuthItemBase extends MyActiveRecord {
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('name, type', 'required'),
            array('type', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 64),
            array('description, bizrule, data', 'safe'),
            array('name, type, description, bizrule, data', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'authAssignments' => array(self::HAS_MANY, 'AuthAssignment', 'itemname'),
            'authItemChildren' => array(self::HAS_MANY, 'AuthItemChild', 'child'),
            'authItemChildren1' => array(self::HAS_MANY, 'AuthItemChild', 'parent'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('bizrule', $this->bizrule, true);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
}
