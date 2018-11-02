<?php

/**
 * This is the model class for table "client_realestates".
 *
 * The followings are the available columns in table 'client_realestates':
 * @property integer $id
 * @property integer $client_id
 * @property integer $realestate_id
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property Clients $client
 * @property Realestates $realestate
 */
class ClientRealestates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClientRealestates the static model class
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
		return 'client_realestates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, realestate_id, status_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, client_id, realestate_id, status_id', 'safe', 'on'=>'search'),
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
			'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
			'realestate' => array(self::BELONGS_TO, 'Realestates', 'realestate_id'),
                        'status' => array(self::BELONGS_TO, 'RealestateStatus', 'status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'client_id' => Yii::t('label','Client'),
			'realestate_id' => Yii::t('label','Realestate'),
                        'status_id' => Yii::t('label','Status'),
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
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('realestate_id',$this->realestate_id);
                $criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}