<?php

/**
 * This is the model class for table "areas".
 *
 * The followings are the available columns in table 'areas':
 * @property integer $id
 * @property string $sid
 * @property string $uid
 * @property integer $district_id
 * @property string $abbr
 * @property string $title
 * @property string $anons
 * @property string $detile
 * @property string $description
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property string $desc
 * @property integer $grid
 * @property integer $weigth
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keywords
 *
 * The followings are the available model relations:
 * @property Districts $district
 */
class Areas extends CActiveRecord
{
        public $maxname;
        public $minname;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Areas the static model class
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
		return 'areas';
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
			array('sort, act, del', 'numerical', 'integerOnly'=>true),
                    	array('sid, uid', 'length', 'max'=>75),
			array('abbr, title, namewhat', 'length', 'max'=>255),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile, description', 'length', 'max'=>6000), // (3000) 6000
			array('create_date, update_date, desc, grid, anons, detile, namewhat, description, seo_keywords, seo_desc, seo_title, act, del', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('create_date, update_date, id, uid, sid, abbr, title, namewhat, sort, desc, anons, grid, detile, description, seo_keywords, seo_desc, seo_title, act, del', 'safe', 'on'=>'search'),
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
			'realestates' => array(self::HAS_MANY, 'Realestates', 'areas_id'),
                        'district' => array(self::BELONGS_TO, 'Districts', 'district_id'),
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
                        'act'          => Yii::t('label','Act'),
                        'del'          => Yii::t('label','Del'),
			'abbr'         => Yii::t('label','Abbr'),
			'title'        => Yii::t('label','Title'),
                        'namewhat'     => Yii::t('label','Name What'),
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
			'district_id'  => Yii::t('label','District'),
			'grid'         => Yii::t('label','Grid'),
			'weigth'       => Yii::t('label','Weigth'),
		);
	}

        public function scopes()
        {
            return array(        
                'sitemap' => array('select'=>'t.id, t.title, t.grid, t.abbr, t.namewhat', 'condition'=>'EXISTS (SELECT * FROM realestates r WHERE r.areas_id = t.id AND ( (r.ACT IS NULL OR r.ACT=1) AND (r.DEL IS NULL OR r.DEL=0) )) AND './*'(create_date <= NOW())and'.'(in_stock=1)'*/'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 'order'=>'t.id ASC'),
            'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname'), 
            'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname'),                                    
                 'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),
             'lastcreate' => array(  'order' => 't.id DESC' ),
            'firstcreate' => array(  'order' => 't.id ASC' ),
              'mapfields' => array( 'select' => 't.id, t.title, t.grid, t.abbr, t.namewhat' ),                  
            );
        }        

        /* Area exist realestate 
         * @merge criteria
         */
        public function realex() {
            return realexvid();
        }
        /* Area exist realestate for vid 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) {
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                                   FROM realestates r 
                                                   WHERE r.areas_id = t.id 
                                                         AND ((r.realestate_vid_id=:vid) AND (r.ACT IS NULL OR r.ACT=1) 
                                                                                         AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                            'params' => array(':vid'=>$vid)
                         )
                );
            } else {
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                                   FROM realestates r 
                                                   WHERE r.areas_id = t.id 
                                                         AND ((r.ACT IS NULL OR r.ACT=1) 
                                                         AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                         )
                );                
            }
            return $this;
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
		$criteria->compare('t.district_id',$this->district_id);
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('title',$this->title,true);
                $criteria->compare('namewhat',$this->namewhat,true);
		$criteria->compare('anons',$this->anons,true);
		$criteria->compare('detile',$this->detile,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('grid',$this->grid);
		$criteria->compare('weigth',$this->weigth);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_desc',$this->seo_desc,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function createTitle() {
            return /*$this->desc.',*/'район '.$this->title ; 
        }
        
        public function createDescription() {
            return $this->anons;
        }
        
        public function createKeywords() {            
            $meta = HRu::create_meta($this->seo_title.' '.$this->anons.' '.$this->detile.' '.$this->detile, null, $this->anons);                                       
            return $meta['keywords'];
        }
        
        public function afterValidate() {
            if ($this->isNewRecord) :  
                $this->create_date=date('Y-m-d'); 
                //$this->createusers = Yii::app()->user->id;
            else :
                $this->create_date = date('Y-m-d',strtotime($this->create_date));
                $this->update_date = date('Y-m-d',strtotime($this->update_date));
                //$this->updateusers = Yii::app()->user->id;
            endif;                
            
            return parent::afterValidate();            
        }  
        
        public function getLinkMapTitle() {
            return "Аренда коммерческой недвижимости Москвы в районе ".$this->title;
        }
        public function getLinkMapText() {
            //return "Аренда коммерческой недвижимости в районе ".$this->title;
            return "Коммерческая недвижимость в районе ".$this->title;
        }
        public function getLinkMapAlt() {
            return "Аренда коммерческой недвижимости в районе ".$this->title;
        }  
}