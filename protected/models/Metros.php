<?php

/**
 * This is the model class for table "metros".
 *
 * The followings are the available columns in table 'metros':
 * @property integer $id
 * @property integer $city_id
 * @property string $title
 * @property string $map_latitude
 * @property string $map_longitude
 * @property string $street
 * @property string $house
 *
 * The followings are the available model relations:
 * @property Realestates[] $realestates
 */
class Metros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Metros the static model class
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
		return 'metros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id', 'required'),
			array('city_id', 'numerical', 'integerOnly'=>true),
			array('title, map_latitude, map_longitude', 'length', 'max'=>255),
                        array('sid, uid', 'length', 'max'=>75),  
			array('street', 'length', 'max'=>100),
			array('house', 'length', 'max'=>10),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile,description', 'length', 'max'=>6000), // (3000) 6000                             
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, sid, city_id, title, map_latitude, map_longitude, street, house, grid, anons, detile, description, seo_keywords, seo_desc, seo_title', 'safe', 'on'=>'search'),
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
			'realestates' => array(self::HAS_MANY, 'Realestates', 'metro_id'),
		);
	}

        public function scopes()
        {
            return array(        
                'sitemap'=>array('select'=>'t.id, t.title, t.grid', 'condition'=>' EXISTS (SELECT * FROM realestates r WHERE r.metro_id = t.id AND ( (r.ACT IS NULL OR r.ACT=1) AND (r.DEL IS NULL OR r.DEL=0) ))'/*'(create_date <= NOW())and'.'(in_stock=1)'*//*'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'*/, 'order'=>'t.id ASC'),
            );
        }
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'            => Yii::t('label','ID'),
                        'sid'           => Yii::t('label','Sid'),
                        'uid'           => Yii::t('label','UID'),
                    	'city_id'       => Yii::t('label','City'),
			'title'         => Yii::t('label','Title'),
			'map_latitude'  => Yii::t('label','Map Latitude'),
			'map_longitude' => Yii::t('label','Map Longitude'),
			'street'        => Yii::t('label','Street'),
			'house'         => Yii::t('label','House'),
                        'anons'         => Yii::t('label','Anons'),
			'detile'        => Yii::t('label','Detile'),
                        'description'   => Yii::t('label','Description'),                    
                        'seo_desc'      => Yii::t('label','Seo Desc'),
                        'seo_title'     => Yii::t('label','Seo Title'),
                        'seo_keywords'  => Yii::t('label','Seo Keywords'),    
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
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('map_latitude',$this->map_latitude,true);
		$criteria->compare('map_longitude',$this->map_longitude,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('house',$this->house,true);
                $criteria->compare('anons',$this->anons,true);
                $criteria->compare('detile',$this->detile,true);
                $criteria->compare('description',$this->description,true);
                $criteria->compare('seo_title',$this->seo_title,true);
                $criteria->compare('seo_desc',$this->seo_desc,true);
                $criteria->compare('seo_keywords',$this->seo_keywords,true);  

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function createTitle() {
            return 'метро '.$this->title; 
        }
        
        public function createDescription() {
            return $this->anons;
        }
        
        public function createKeywords() {            
            $meta = HRu::create_meta($this->seo_title.' '.$this->anons.' '.$this->detile.' '.$this->detile, null, $this->anons);                                       
            return $meta['keywords'];
        }
        
        public function getLinkMapTitle() {
            return 'Аренда коммерческой недвижимости в Москве, рядом со станцией метро '.($this->title);
        }
        public function getLinkMapText() {
            //return 'Аренда у метро '.($this->title);
            return 'Коммерческая недвижимость м.'.($this->title);
        }
        public function getLinkMapAlt() {
            return 'Аренда у метро '.($this->title);
        } 
}