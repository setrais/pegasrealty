<?php

/**
 * This is the model class for table "realestate_types".
 *
 * The followings are the available columns in table 'realestate_types':
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
class RealestateTypes extends CActiveRecord
{
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return RealestateTypes the static model class
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
		return 'realestate_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, sort_main, act, del, is_label', 'numerical', 'integerOnly'=>true),
			array('abbr, title, sid, if_label, nameov, nameed, namewhere, namewheres', 'length', 'max'=>255),
                        array('label, name', 'length', 'max'=>15), 
                        array('uid', 'length', 'max'=>75), 
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile,description', 'length', 'max'=>6000), // (3000) 600
                    
			array('create_date, update_date, desc, grid, name, nameov, nameed, namewhere, namewheres, anons, detile, description, seo_keywords, seo_desc, seo_title', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, sid, abbr, title, name, label, if_label, is_label, nameov, nameed, namewhere, namewheres, sort, sort_main, act, del, create_date, update_date, desc, anons, detile, description, seo_keywords, seo_desc, seo_title', 'safe', 'on'=>'search'),
		);
	}

        public function scopes()
        {
            return array(        
                'sitemap' => array( 'select' => 't.id, t.title, t.grid, t.namewheres', 
                                 'condition' => 'EXISTS (SELECT * 
                                                         FROM realestates r 
                                                         WHERE r.realestate_type_id = t.id 
                                                               AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                                         ) 
                                                 AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                     'order' => 't.id ASC'),
            'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname'), 
            'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname'),                                    
                 'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),
             'lastcreate' => array(  'order' => 't.id DESC' ),
            'firstcreate' => array(  'order' => 't.id ASC' ),
              'mapfields' => array( 'select' => 't.id, t.title, t.grid, t.namewheres' ),                   
            );
        }
 
        /* Type exist realestate
         * @merge criteria
         */
        public function realex() {
            return $this->realexvid();
        }   
        
        /* Type exist realestate for vid 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) {
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                                   FROM realestates r 
                                                   WHERE r.realestate_type_id = t.id 
                                                         AND ((r.realestate_vid_id=:vid) AND (r.ACT IS NULL OR r.ACT=1) 
                                                                                         AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                            'params' => array(':vid'=>$vid)
                         )
                );
            }else{
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                                   FROM realestates r 
                                                   WHERE r.realestate_type_id = t.id 
                                                         AND ((r.ACT IS NULL OR r.ACT=1) 
                                                         AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                         )
                );                
            }
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
			'realestates' => array(self::HAS_MANY, 'Realestates', 'realestate_type_id'),
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
                        'uid'          => Yii::t('label','Uid'),
			'abbr'         => Yii::t('label','Abbr'),
			'title'        => Yii::t('label','Title'),
                        'label'        => Yii::t('label','Label'),
                        'is_label'     => Yii::t('label','Is Label'),
                        'if_label'     => Yii::t('label','If Label'),
			'sort'         => Yii::t('label','Sort'),
                        'sort_main'    => Yii::t('label','Sort Main'),
			'act'          => Yii::t('label','Act'),
			'del'          => Yii::t('label','Del'),
			'create_date'  => Yii::t('label','Create Date'),
			'update_date'  => Yii::t('label','Update Date'),
			'desc'         => Yii::t('label','Desc'),
                 	'anons'        => Yii::t('label','Anons'),
			'detile'       => Yii::t('label','Detile'),
                        'description'  => Yii::t('label','Description'),                    
                        'seo_desc'     => Yii::t('label','Seo Desc'),
                        'seo_title'    => Yii::t('label','Seo Title'),
                        'seo_keywords' => Yii::t('label','Seo Keywords'),                          			
                        'name'         => Yii::t('label','Краткое название'), 
                        'nameov'       => Yii::t('label','Чего/Кого?'), 
                        'nameed'       => Yii::t('label','Единица'), 
                        'namewhere'    => Yii::t('label','Где? в единице'), 
                        'namewheres'   => Yii::t('label','Где? в множестве'), 
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
                $criteria->compare('name',$this->name,true);
                $criteria->compare('is_label',$this->is_label);
		$criteria->compare('sort',$this->sort);
                $criteria->compare('sort_main',$this->sort_main);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('desc',$this->desc,true);
                $criteria->compare('anons',$this->anons,true);
                $criteria->compare('detile',$this->detile,true);
                $criteria->compare('description',$this->description,true);
                $criteria->compare('seo_title',$this->seo_title,true);
                $criteria->compare('seo_desc',$this->seo_desc,true);
                $criteria->compare('seo_keywords',$this->seo_keywords,true);
                $criteria->compare('nameov',$this->nameov,true);
                $criteria->compare('nameed',$this->nameed,true);
                $criteria->compare('namewhere',$this->namewhere,true);
                $criteria->compare('namewheres',$this->namewheres,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function createTitle() {
            return $this->desc; 
        }        
        
        public function createDescription() {
            return $this->anons;
        }
        
        public function createKeywords() {            
            $meta = HRu::create_meta($this->seo_title.' '.$this->anons.' '.$this->detile.' '.$this->detile, null, $this->anons);                                       
            return $meta['keywords'];
        }     
        public function getLinkMapTitle() {
            return 'Аренда в '.mb_strtolower($this->namewheres,'UTF-8').' Москвы';
        }
        public function getLinkMapText() {
            //return 'Аренда в '.mb_strtolower($this->namewheres,'UTF-8').' Москвы';
            return $this->title;
        }
        public function getLinkMapAlt() {
            return 'Аренда в '.mb_strtolower($this->namewheres,'UTF-8').' Москвы';
        }       
}