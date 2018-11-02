<?php
/**
 * Промежуточный класс между CActiveRecord и моделями
 *
 * @package models
 * @author Dmitriy Neshin
 */
class MyActiveRecord extends CActiveRecord
{

    public $pageSize;

    public function init() {
        foreach($this->attributeNames() as $column) {
            if ($column == 'created_at') {
                $this->$column = date('c');
            }
        }

        $pageSize = Yii::app()->user->getState('pageSizeGridView', Yii::app()->params['pageSizeGrid']['default']);
        $this->pageSize = (($pageSize == 0)?false:array('pageSize' => $pageSize));

        parent::init();
    }

    public function __set($name, $value) {
        // Если фотографию сменили - удаляем предыдущую
        if (!$this->isNewRecord && $value instanceof CUploadedFile && !empty($this->$name) && $this->$name != $value) {
            $file = $this->uploadTo($name);
            file_exists($file) && unlink($file);
        }
        parent::__set($name, $value);
    }

    public function afterDelete() {
        // Удаляем файлы по присутствии валидатора CFileValidator в аттрибутах
        foreach($this->getValidators() as $validator) {
            if ($validator instanceof CFileValidator) {
                foreach($validator->attributes as $_attribute) {
                    if (!empty($this->$_attribute)) {
                        $file = $this->uploadTo($_attribute);
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
            }
        }
        parent::afterDelete();
    }

    public function __toString() {
        foreach($this->attributeNames() as $column) {
            if (in_array($column, array('title', 'name'))) {
                return $this->$column;
            }
        }
        return sprintf('Запись %s', get_class($this));
    }

    public function getToString() {
        return $this->__toString();
    }

    public function uploadTo($attribute) {
        throw new CException('Метод "uploadTo" должен присутствовать в моделе "'.get_class($this).'"');
    }

    /**
     * Генерирует название таблицы из названия класса.
     *
     * Пример:
     * <code>
     * Table => table
     * TableBase => table
     * TablePictures => table_pictures
     * </code>
     *
     * Если модель берется из модуля - таблица должна находится в схеме, названная аналогично модулю:
     * <code>
     * application.modules/objects/models/ObjectsStreetRetail => objects.objects_street_retail
     * </code>
     *
     * @author Dmitriy Neshin
     */
    public function tableName() {
        return preg_replace('/_base$/', '', trim(strtolower(preg_replace('/(?<![A-Z])[A-Z]/', '_\0', get_class($this))), '_'));
    }

    /**
     * Указывает на файл перевода колонок моделей.
     * По дефолту - protected/messages/[lang]/models/[Model].php
     * Если модель - protected/modules/[module]/messages/[lang]/models/[Model].php
     *
     * @author Dmitriy Neshin
     */
    public function attributeLabels() {
        $t = array();

        $model_reflection = new ReflectionClass($this);
        $model_properties_unclean = $model_reflection->getProperties();
        $model_properties = array();
        foreach($model_properties_unclean as $model_property) {
            if ($model_property->class == get_class($this)) {
                $model_properties[] = $model_property->name;
            }
        }

        $attributes = CMap::mergeArray(
            CMap::mergeArray(array_keys($this->getMetaData()->columns), array_keys($this->getMetaData()->relations)),
            $model_properties
        );

        foreach($attributes as $attribute) {
            $attribute_name = ucfirst(str_replace('_', ' ',
                preg_replace('/_id$/', '', strtolower(preg_replace('/(?<![A-Z])[A-Z]/', '_\0', $attribute)))
            ));

            if (in_array($attribute, array('id', 'created_at', 'updated_at'))) {
                $t[$attribute] = Yii::t('models', $attribute_name);
            } else {
                if (get_class(Yii::app()) != 'CConsoleApplication' && Yii::app()->controller->module) {
                    $translate_path = Yii::app()->controller->module->id . 'Module.models';
                } else {
                    $translate_path = 'models';
                }
                $t[$attribute] = Yii::t($translate_path . '/' . get_class($this), $attribute_name);
                if (preg_match('/_id$/', $attribute)) {
                    $t[preg_replace('/_id$/', '', $attribute)] = $t[$attribute];
                }
            }
        }

        return $t;
    }

    /**
     * �?нициализирует связь модели (создается, если записи не существует).
     *
     * @author Dmitriy Neshin
     */
    public function findOrInitializeRelation($name)
    {
        $relation = $this->$name;

        if ($relation == null) {
            $class_name = $this->getActiveRelation($name)->className;
            $foreign_key = $this->getActiveRelation($name)->foreignKey;

            $model = new $class_name;
            $model->$foreign_key = $this->id;
            return $model;
        } else {
            return $relation;
        }
    }

    public function findOrCreateByAttributes($attributes) {
        if ($model = $this->findByAttributes($attributes)) {
            return $model->getPrimaryKey();
        } else {
            $model = new $this;
            $model->attributes = $attributes;
            $model->save();
            return $model->getPrimaryKey();
        }
    }

    /**
     * По дефолту сортируем по колонке title | name, если одна из них найдена в таблице
     *
     * @author Dmitriy Neshin
     */
    public function defaultScope() {
        foreach($this->attributeNames() as $column) {
            if (in_array($column, array('title', 'name'))) {
                return array(
                    'order' => $column,
                );
            }
        }
        return parent::defaultScope();
    }

    public function afterFind() {
        foreach($this->getMetaData()->columns as $column) {
            $column_name = $column->name;

            switch($column->dbType) {
                case 'date':
                    $this->setAttribute(
                        $column_name,
                        empty($this->$column_name) ? null : date('d.m.Y', strtotime($this->$column_name))
                    );
                break;

                case 'timestamp without time zone':
                    $this->setAttribute(
                        $column_name,
                        empty($this->$column_name) ? null : date('d.m.Y H:i:s', strtotime($this->$column_name))
                    );
                break;
            }
        }
        return parent::afterFind();
    }

    public function beforeValidate() {
        $check = $this->isNewRecord && $this->hasAttribute('created_by_user_id');
        $check = $check && !Yii::app() instanceof CConsoleApplication && Yii::app()->getEndName() == 'backend';

        if ($check) {
            $this->setAttribute('created_by_user_id', Yii::app()->user->model->id);
        }

        return parent::beforeValidate();
    }

    public function beforeSave() {
        if (!$this->isNewRecord && $this->hasAttribute('updated_at')) {
            $this->updated_at = date('c');
        }

        foreach($this->getMetaData()->columns as $column) {
            $column_name = $column->name;

            switch($column->dbType) {
                case 'date': break;
                case 'timestamp without time zone':
                    $this->setAttribute(
                        $column_name,
                        empty($this->$column_name) ? null : date('c', strtotime($this->$column_name))
                    );
                break;

                case 'time without time zone':
                    $this->setAttribute($column_name, empty($this->$column_name) ? null : $this->$column_name);
                break;
            }
        }

        return parent::beforeSave();
    }

    public function isAttributeEnumerable($attribute) {
        $ret = false;

        if (!isset($this->getMetaData()->relations[$attribute])) {
            $model_reflection = new ReflectionClass($this);
            foreach(array_keys($model_reflection->getConstants()) as $constant) {
                if (preg_match('/^'.strtoupper($attribute).'.+/', $constant)) {
                    $ret = true;
                }
            }
        }

        return $ret;
    }

    public function getAttributeEnums($attribute) {
        $return = array();

        $model_reflection = new ReflectionClass($this);
        foreach($model_reflection->getConstants() as $constant=>$value) {
            if (preg_match('/^'.strtoupper($attribute).'.+/', $constant)) {
                if (Yii::app()->controller->module) {
                    $translate_path = Yii::app()->controller->module->id . 'Module.models';
                } else {
                    $translate_path = 'models';
                }
                $return[$value] = Yii::t($translate_path . '/' . get_class($this), $constant);
            }
        }

        return $return;
    }

    public function getNivoPictureHtml() {
        return CHtml::image(
            Yii::app()->request->baseUrl . '/' . $this->uploadTo('picture')
        );
    }

    public function getLastMod() {
        $model = $this->find(array(
            'order' => 'created_at DESC',
            'condition' => 'created_at IS NOT NULL',
        ));

        if ($model !== null) {
            return strtotime($model->created_at);
        }

        return 0;
    }
}
