<?php

/**
 * This is the model class for table "objects".
 *
 * The followings are the available columns in table 'objects':
 * @property integer $id
 * @property string $sid
 * @property string $uid
 * @property string $abbr
 * @property string $title
 * @property string $anons
 * @property string $detile
 * @property string $description
 * @property integer $sort
 * @property integer $weight
 * @property integer $sort_main
 * @property string $desc
 * @property integer $act
 * @property integer $del
 * @property integer $grid
 * @property string $seo_keywords
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $create_date
 * @property string $update_date
 */
class Objects extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Objects the static model class
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
		return 'objects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('sort, weight, sort_main, act, del, grid', 'numerical', 'integerOnly'=>true),
			array('sid, abbr, title', 'length', 'max'=>255),
			array('uid', 'length', 'max'=>75),
			array('anons, detile, description, desc, seo_keywords, seo_title, seo_desc, create_date, update_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, uid, abbr, title, anons, detile, description, sort, weight, sort_main, desc, act, del, grid, seo_keywords, seo_title, seo_desc, create_date, update_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sid' => 'Sid',
			'uid' => 'Uid',
			'abbr' => 'Abbr',
			'title' => 'Title',
			'anons' => 'Anons',
			'detile' => 'Detile',
			'description' => 'Description',
			'sort' => 'Sort',
			'weight' => 'Weight',
			'sort_main' => 'Sort Main',
			'desc' => 'Desc',
			'act' => 'Act',
			'del' => 'Del',
			'grid' => 'Grid',
			'seo_keywords' => 'Seo Keywords',
			'seo_title' => 'Seo Title',
			'seo_desc' => 'Seo Desc',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
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
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('anons',$this->anons,true);
		$criteria->compare('detile',$this->detile,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('sort_main',$this->sort_main);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('grid',$this->grid);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_desc',$this->seo_desc,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}