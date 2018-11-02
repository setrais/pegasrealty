<?php

/**
 * This is the model class for table "destinations".
 *
 * The followings are the available columns in table 'destinations':
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
 * @property RealestateDestinations[] $realestateDestinations
 */
class Destinations extends CActiveRecord
{
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Destinations the static model class
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
		return 'destinations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, act, del, weight', 'numerical', 'integerOnly'=>true),
			array('abbr, title, under, for', 'length', 'max'=>255),
                       	array('sid, uid', 'length', 'max'=>75),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile, description', 'length', 'max'=>6000), // (3000) 6000                    
			array('create_date, update_date, desc, grid, anons, detile, description, 
                               seo_keywords, seo_desc, seo_title, act, del', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, uid, abbr, title, under, for, sort, act, del, create_date, update_date, 
                               desc, grid, anons, detile, description, act, del, 
                               seo_keywords, seo_desc, seo_title', 'safe', 'on'=>'search'),
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
			'realestateDestinations' => array(self::HAS_MANY, 'RealestateDestinations', 'destination_id'),
		);
	}

        public function scopes()
        {
            return array(        
                'sitemap'=>array( 'select' => 't.id, t.title, t.grid, t.under', 
                                    'with' => 'realestateDestinations',
                               'condition' => 'realestateDestinations.destination_id IS NOT NULL', 
                                   'order' => 't.id ASC'),
         'realinproperty' => array( 'with' => 'realestateDestinations',
                               'condition' => 'realestateDestinations.destination_id IS NOT NULL',//.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', '')
                             ), 
                 'active' => array( 'condition' =>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),  
            'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname'), 
            'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname'),                                    
             'lastcreate' => array(  'order' => 't.id DESC' ),
            'firstcreate' => array(  'order' => 't.id ASC' ),
              'mapfields' => array( 'select' => 't.id, t.title, t.grid, t.under' ),                
            );
        }
        
        /* Property in list id
         * @merge criteria
         */
        public function idlistin($list=null) {
            
            if (empty($list)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array( 'condition' => 't.id IN (:list)',
                       'params'    => array(':list'=>$list) 
                     )
            );
            return $this;
        }
        
        /* Destination exist realestate
         * @merge criteria
         */
        public function realex() {
            return $this->realexvid();
        }   
        
        /* Destination exist realestate for vid 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) { 
                $this->getDbCriteria()->mergeWith( 
                    array(  'with' => 'realestateDestinations',
                       'сondition' => 'realestateDestinations.destination_id IS NOT NULL 
                                       AND EXISTS (SELECT * 
                                                   FROM realestates r 
                                                   WHERE r.id = realestateDestinations.realestate_id 
                                                         AND ((r.realestate_vid_id=:vid) 
                                                               AND (r.ACT IS NULL OR r.ACT=1) 
                                                               AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                         'params' => array(':vid'=>$vid)
                    )
                );
            }else{
                $this->getDbCriteria()->mergeWith( 
                    array( 'with' => 'realestateDestinations',
                      'condition' => 'realestateDestinations.destination_id IS NOT NULL 
                                  AND EXISTS (SELECT * 
                                              FROM realestates r 
                                              WHERE r.id = realestateDestinations.realestate_id 
                                                    AND ((r.ACT IS NULL OR r.ACT=1) 
                                                          AND (r.DEL IS NULL OR r.DEL=0))
                                              )', 
                    )
                );
            } 
            return $this;
        }
        
        /* Destination offers in real id
         * @merge criteria
         */
        public function realexin($in=null) {
            
            if (empty($in)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array(  'with' => 'realestateDestinations',
                   'condition' => 'realestateDestinations.destination_id IS NOT NULL 
                                   AND EXISTS (SELECT * 
                                               FROM realestates r 
                                               WHERE r.id = realestateDestinations.realestate_id 
                                                     AND ((r.ACT IS NULL OR r.ACT=1) 
                                                           AND (r.DEL IS NULL OR r.DEL=0)) 
                                                     AND (r.id IN ('.$in.'))
                                             )', 
                     )
            );
            return $this;
        }        
        
        /* Destination real id
         * @merge criteria
         */
        public function realexsel($exsel=null) {
            
            if (empty($exsel)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array(   'with' => 'realestateDestinations',
                    'condition' => 'realestateDestinations.destination_id IS NOT NULL 
                                    AND EXISTS (SELECT * 
                                                FROM realestates r 
                                                WHERE r.id = realestateDestinations.realestate_id 
                                                      AND ((r.ACT IS NULL OR r.ACT=1) 
                                                            AND (r.DEL IS NULL OR r.DEL=0)) 
                                                      AND (r.id IN ('.$exsel.'))
                                             )', 
                )
            );
            return $this;
        }
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sid'          => Yii::t('label','Sid'),
                        'uid'          => Yii::t('label','UID'),
                        'act'          => Yii::t('label','Act'),
                        'del'          => Yii::t('label','Del'),                    
			'abbr'         => Yii::t('label','Abbr'),
			'title'        => Yii::t('label','Title'),
                        'under'        => Yii::t('label','Under'),
                        'for'          => Yii::t('label','For'),
			'sort'         => Yii::t('label','Sort'),
			'desc'         => Yii::t('label','Desc'),
                    	'anons'        => Yii::t('label','Anons'),
			'detile'       => Yii::t('label','Detile'),
                        'description'  => Yii::t('label','Description'),                    
                        'seo_desc'     => Yii::t('label','Seo Desc'),
                        'seo_title'    => Yii::t('label','Seo Title'),
                        'seo_keywords' => Yii::t('label','Seo Keywords'),
			'create_date'  => Yii::t('label','Create Date'),
			'update_date'  => Yii::t('label','Update Date'),
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
                $criteria->compare('under',$this->under,true);
                $criteria->compare('for',$this->for,true);
		$criteria->compare('sort',$this->sort);
                $criteria->compare('t.desc',$this->desc,true);
                $criteria->compare('anons',$this->anons,true);
                $criteria->compare('detile',$this->detile,true);
                $criteria->compare('t.act', $this->act, true); 
                $criteria->compare('t.del', $this->del, true); 
                $criteria->compare('description',$this->description,true);
                $criteria->compare('seo_title',$this->seo_title,true);
                $criteria->compare('seo_desc',$this->seo_desc,true);
                $criteria->compare('seo_keywords',$this->seo_keywords,true);
                $criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function createTitle() {
            return $this->desc.', '.$this->title; 
        }
        
        public function createDescription() {
            return $this->anons;
        }
        
        public function createKeywords() {            
            $meta = HRu::create_meta($this->seo_title.' '.$this->anons.' '.$this->detile.' '.$this->detile, null, $this->anons);                                       
            return $meta['keywords'];
        }     
        
        public function getLinkMapTitle() {           
            return 'Аренда коммерческой недвижимости в Москве с назначением '.mb_strtolower($this->title, 'UTF-8');
        }
        public function getLinkMapText() {
            //return 'Аренда коммерческой недвижимости под '.mb_strtolower($this->under,'UTF-8');
            return 'Коммерческая недвижимость под '.mb_strtolower($this->under,'UTF-8');
        }
        public function getLinkMapAlt() {
            return 'Аренда коммерческой недвижимости под '.mb_strtolower($this->under,'UTF-8');
        } 
}