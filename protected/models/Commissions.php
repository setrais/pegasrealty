<?php

/**
 * This is the model class for table "commissions".
 *
 * The followings are the available columns in table 'commissions':
 * @property integer $id
 * @property string $abbr
 * @property string $title
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property string $desc
 *
 * The followings are the available model relations:
 * @property Realestates[] $realestates
 */
class Commissions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Commissions the static model class
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
		return 'commissions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, act, del', 'numerical', 'integerOnly'=>true),
			array('abbr, title', 'length', 'max'=>255),
			array('create_date, update_date, desc, grid', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, abbr, title, sort, act, del, create_date, update_date, desc', 'safe', 'on'=>'search'),
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
			'realestates' => array(self::HAS_MANY, 'Realestates', 'commission_id'),
		);
	}

        public function scopes()
        {
            return array(        
                'sitemap'=>array('select'=>'id, title, grid', 'condition'=>/*'(create_date <= NOW())and'.'(in_stock=1)'*/'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 'order'=>'id ASC'),
            );
        }
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'abbr' => 'Abbr',
			'title' => 'Title',
			'sort' => 'Sort',
			'act' => 'Act',
			'del' => 'Del',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'desc' => 'Desc',
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
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}