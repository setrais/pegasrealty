<?php

/**
 * This is the model class for table "farea_offers".
 *
 * The followings are the available columns in table 'farea_offers':
 * @property integer $id
 * @property integer $init_value
 * @property integer $final_value
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property string $desc
 */
class FareaOffers extends CActiveRecord
{
        public $title;
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return FareaOffers the static model class
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
		return 'farea_offers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('init_value, final_value, sort, act, del', 'numerical', 'integerOnly'=>true),
                        array('sid, uid', 'length', 'max'=>75),
			array('abbr, title', 'length', 'max'=>255),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile, description', 'length', 'max'=>6000), // (3000) 6000
			array('create_date, update_date, desc, grid, anons, detile, description, seo_keywords, seo_desc, seo_title, act, del', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('create_date, update_date, id,  init_value, final_value, uid, sid, title, sort, desc, anons, grid, detile, description, seo_keywords, seo_desc, seo_title, act, del', 'safe', 'on'=>'search'),                    		
		);
	}
        
        public function scopes()
        {
            return array(        
                    'sitemap' => array(   'select' => 't.id, t.grid, t.final_value, t.init_value',//CONCAT("Площадь от ",t.init_value," м2 до ",t.final_value, " м2") AS `title`,*/
                                       'condition' => 'EXISTS (SELECT * FROM realestates r WHERE r.area BETWEEN t.init_value AND t.final_value AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL)))',//'(create_date <= NOW())and'.'(in_stock=1)'*//*'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'*/
                                           'order' => 't.id ASC'),
                
           'sitemap_noexreal' => array(   'select' => 't.id, t.final_value, t.init_value', 
                                       'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                           'order' => 't.id ASC'),
                
                'titlelenmax' => array( 'select' => 'MAX(LENGTH(CONCAT(t.init_value,t.final_value))) AS maxname'), 
                     'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),
                 'lastcreate' => array( 'order'=>'t.id DESC' ),
                'firstcreate' => array( 'order'=>'t.id ASC' ),
                  'mapfields' => array( 'select' => 't.id, t.grid, t.final_value, t.init_value' ),
                'titlelenmin' => array( 'select' => 'MIN(LENGTH(CONCAT(t.init_value,t.final_value))) AS minname'),                    
            );
        }
        
        /* Exists vid for real in areaoffers 
         * @merge criteria
         */
        public function realex() {
            return $this->realexvid();
        }

        /* Exists vid for real in areaoffers 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) {
                $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          WHERE (r.realestate_vid_id=:vid) AND r.area BETWEEN t.init_value AND t.final_value 
                                                                           AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                          )',     
                    'params'=>array(':vid'=>$vid)
                ));
            }else{
               $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          WHERE r.area BETWEEN t.init_value AND t.final_value 
                                                       AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                          )',  
               ));    
            }
            return $this;
        }
        
        /* Area offers in real id
         * @merge criteria
         */
        public function realexin($in=null) {
            
            if (empty($in)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array(  'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          WHERE (r.id IN ('.$in.')) AND r.area BETWEEN t.init_value AND t.final_value 
                                                                           AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                          )',  
                     )
            );
            return $this;
        }        
        
        /* Area offers real id
         * @merge criteria
         */
        public function realexsel($exsel=null) {
            
            if (empty($exsel)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array(  'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          WHERE r.area BETWEEN t.init_value AND t.final_value 
                                                AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                                AND (r.id IN ('.$exsel.'))
                                          )' )
            );
            return $this;
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
			'id'           => Yii::t('label','ID'),
                    	'sid'          => Yii::t('label','Sid'),
                        'uid'          => Yii::t('label','UID'),
			'init_value'   => Yii::t('label','Init Value'),
			'final_value'  => Yii::t('label','Final Value'),
			'sort'         => Yii::t('label','Sort'),
			'act'          => Yii::t('label','Act'),
			'del'          => Yii::t('label','Del'),
			'desc'         => Yii::t('label','Desc'),
                        'title'        => Yii::t('label','Title'),
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
		$criteria->compare('init_value',$this->init_value);
		$criteria->compare('final_value',$this->final_value);
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
}