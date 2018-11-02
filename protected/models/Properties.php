<?php

/**
 * This is the model class for table "properties".
 *
 * The followings are the available columns in table 'properties':
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
 * @property RealestateProperties[] $realestateProperties
 */
class Properties extends CActiveRecord
{
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Properties the static model class
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
		return 'properties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, act, del, is_label, sort_main', 'numerical', 'integerOnly'=>true),
			array('abbr, title, if_label', 'length', 'max'=>255),
                        array('label','max'=>25),
                        array('sid, uid', 'length', 'max'=>75),
			array('abbr, title', 'length', 'max'=>255),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile, description', 'length', 'max'=>6000), // (3000) 6000                    
			array('create_date, update_date, desc, grid, anons, detile, description, seo_keywords, seo_desc, seo_title, act, del, is_label, if_label', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, uid, abbr, title, sort, sort_main, act, del, label, is_label, create_date, update_date,  desc, anons, grid, detile, description, seo_keywords, seo_desc, seo_title, act, del', 'safe', 'on'=>'search'),
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
			'realestateProperties' => array(self::HAS_MANY, 'RealestateProperties', 'property_id'),
		);
	}

        public function scopes()
        {
            return array(        
                'sitemap' => array( 'select' => 't.id, t.title, t.grid', 
                                    'with' => 'realestateProperties',
                               'condition' => 'realestateProperties.property_id IS NOT NULL',//.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                   'order' => 't.id ASC'),
         'realinproperty' => array( 'with' => 'realestateProperties',
                               'condition' => 'realestateProperties.property_id IS NOT NULL',//.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', '')
                             ), 
                 'active' => array( 'condition' =>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),  
            'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname'), 
            'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname'),                                    
             'lastcreate' => array(  'order' => 't.id DESC' ),
            'firstcreate' => array(  'order' => 't.id ASC' ),
              'mapfields' => array( 'select' => 't.id, t.title, t.grid' ),                
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
        
        /* Property exist realestate
         * @merge criteria
         */
        public function realex() {
            return $this->realexvid();
        }   
        
        /* Property exist realestate for vid 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) { 
                $this->getDbCriteria()->mergeWith( 
                    array( 'with' => 'realestateProperties',
                      'condition' => 'realestateProperties.property_id IS NOT NULL 
                                  AND EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.id = realestateProperties.realestate_id AND ((r.realestate_vid_id=:vid) AND (r.ACT IS NULL OR r.ACT=1) 
                                                                                                       AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                         'params' => array(':vid'=>$vid)
                    )
                );
            }else{
                $this->getDbCriteria()->mergeWith( 
                    array( 'with' => 'realestateProperties',
                      'condition' => 'realestateProperties.property_id IS NOT NULL 
                                  AND EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.id = realestateProperties.realestate_id AND ((r.ACT IS NULL OR r.ACT=1) 
                                                                                                       AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                    )
                );
            } 
            return $this;
        }
        
        /* Property in real id
         * @merge criteria
         */
        public function realexin($in=null) {
            
            if (empty($in)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array(  'with' => 'realestateProperties',
                   'condition' => 'realestateProperties.property_id IS NOT NULL 
                                  AND EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.id = realestateProperties.realestate_id 
                                                   AND ((r.ACT IS NULL OR r.ACT=1) AND (r.DEL IS NULL OR r.DEL=0)) AND (r.id IN ('.$in.'))
                                             )', 
                     )
            );
            return $this;
        }        
        
        /* Property real id
         * @merge criteria
         */
        public function realexsel($exsel=null) {
            
            if (empty($exsel)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array(   'with' => 'realestateProperties',
                      'condition' => 'realestateProperties.property_id IS NOT NULL 
                                  AND EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.id = realestateProperties.realestate_id 
                                                   AND ((r.ACT IS NULL OR r.ACT=1) AND (r.DEL IS NULL OR r.DEL=0)) AND (r.id IN ('.$exsel.'))
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
			'id'           => Yii::t('label','ID'),
			'sid'          => Yii::t('label','Sid'),
                        'uid'          => Yii::t('label','UID'),
                        'act'          => Yii::t('label','Act'),
                        'del'          => Yii::t('label','Del'),
			'abbr'         => Yii::t('label','Abbr'),
			'title'        => Yii::t('label','Title'),
                        'label'        => Yii::t('label','Label'),
                        'is_label'     => Yii::t('label','Is Label'),
                        'if_label'     => Yii::t('label','If Label'),
			'sort'         => Yii::t('label','Sort'),
                        'sort_main'    => Yii::t('label','Sort Main'),
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
                $criteria->compare('label',$this->label,true);
		$criteria->compare('sort',$this->sort);
                $criteria->compare('sort_main',$this->sort);
		$criteria->compare('t.desc',$this->desc,true);
                $criteria->compare('anons',$this->anons,true);
                $criteria->compare('detile',$this->detile,true);
                $criteria->compare('t.act', $this->act); 
                $criteria->compare('t.del', $this->del); 
                $criteria->compare('t.is_label', $this->del); 
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
            return 'Аренда коммерческой недвижимости в Москве cо свойством - '.mb_strtolower($this->title, 'UTF-8');
        }
        public function getLinkMapText() {
            //return 'Аренда коммерческой недвижимости в Москве cо свойством - '.mb_strtolower($this->title, 'UTF-8');
            return 'Коммерческая недвижимость cо свойством - '.mb_strtolower($this->title, 'UTF-8');
        }
        public function getLinkMapAlt() {
            return 'Аренда коммерческой недвижимости в Москве cо свойством - '.mb_strtolower($this->title, 'UTF-8');
        } 
}