<?php

/**
 * This is the model class for table "type_subscribe".
 *
 * The followings are the available columns in table 'type_subscribe':
 * @property integer $id
 * @property integer $grid
 * @property string $name
 * @property integer $sort
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property integer $del
 * @property string $icon
 * @property integer $act
 * @property string $template
 *
 * The followings are the available model relations:
 * @property Subscribe[] $subscribes
 */
class TypeSubscribe extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TypeSubscribe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'type_subscribe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grid, sort, del, act', 'numerical', 'integerOnly'=>true),
                        array('name, title','required'),
			array('name, title', 'length', 'max'=>75),
			array('icon', 'length', 'max'=>255),
			array('description, keywords, template', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, grid, name, sort, title, description, keywords, del, icon, act, template', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'subscribes' => array(self::HAS_MANY, 'Subscribe', 'typesubs_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'grid' => Yii::t('label','Grid'),
			'name' => Yii::t('label','Cимвольный Ид'/*'Name'*/),
			'sort' => Yii::t('label','Sort'),
			'title' => Yii::t('label','Title'),
			'description' => Yii::t('label','Description'),
			'keywords' => Yii::t('label','Keywords'),
			'del' => Yii::t('label','Del'),
			'icon' => Yii::t('label','Иконка'/*'Icon'*/),
			'act' => Yii::t('label','Act'),
			'template' => Yii::t('label','Шаблон'/*'Template'*/),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('grid',$this->grid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('del',$this->del);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('act',$this->act);
		$criteria->compare('template',$this->template,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}