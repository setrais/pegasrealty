<?php

/**
 * This is the model class for table "realestate_vids".
 *
 * The followings are the available columns in table 'realestate_vids':
 * @property integer $id
 * @property string $abbr
 * @property string $title
 * @property integer $sort
 * @property integer $sort_main
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property string $desc
 *
 * The followings are the available model relations:
 * @property Realestates[] $realestates
 */
class RealestateVids extends CActiveRecord
{       
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return RealestateVids the static model class
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
		return 'realestate_vids';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, sort_main, act, del, is_ceil', 'numerical', 'integerOnly'=>true),
                        array('sid, uid', 'length', 'max'=>75),                    
                        array('label', 'length', 'max'=>15),  
			array('abbr, title, nameov, namewhats, namewhat, if_label', 'length', 'max'=>255),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile,description', 'length', 'max'=>6000), // (3000) 6000                    	
			array('create_date, update_date, desc, grid, nameov, namewhats, namewhat, anons, detile, description, seo_keywords, seo_desc, seo_title, act, del, is_ceil, label', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, sid, abbr, title, label, nameov, namewhats, namewhat, sort, sort_main, act, del, is_ceil, create_date, update_date, desc, anons, detile, description, seo_keywords, seo_desc, seo_title, act, del ', 'safe', 'on'=>'search'),
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
			'realestates' => array(self::HAS_MANY, 'Realestates', 'realestate_vid_id'),
		);
	}
        
        public function scopes()
        {
            return array(        
                    'sitemap' => array(    'select' => 't.id, t.title, t.grid, t.namewhats, t.nameov', 
                                        'condition' => 'EXISTS (SELECT * FROM realestates r WHERE r.realestate_vid_id = t.id AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))) AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                            'order' => 't.id ASC' ),
           'sitemap_noexreal' => array(    'select' => 't.id, t.grid, t.namewhats', 'condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                            'order' => 't.id ASC' ),
         'sitemap_noexrealOv' => array(    'select' => 't.id, t.grid, t.namewhats, t.nameov', 
                                        'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                            'order' => 't.id ASC' ),                
                'titlelenmax' => array(    'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname' ), 
                'titlelenmin' => array(    'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname' ),                    
                     'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))' ),
                 'lastcreate' => array(     'order' => 't.id DESC' ),
                'firstcreate' => array(     'order' => 't.id ASC' ),
                  'mapfields' => array( '   select' => 't.id, t.title, t.grid, t.namewhats, t.nameov' ),  
                 'realexvids' => array( 'condition' => 'EXISTS (SELECT * FROM realestates r WHERE r.realestate_vid_id = t.id AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL)))' ) 
            );
        }
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'            => Yii::t('label','ID'),
                        'sid'           => Yii::t('label','SID'),
                        'uid'           => Yii::t('label','UID'),
			'abbr'          => Yii::t('label','Abbr'),
			'title'         => Yii::t('label','Title'),
                        'label'         => Yii::t('label','Label'),
                        'is_label'      => Yii::t('label','Is Ceil'),
                        'if_label'      => Yii::t('label','If Label'),
                        'nameov'        => Yii::t('label','Name Ov'),
                        'namewhat'      => Yii::t('label','Name What'),
                        'namewhats'     => Yii::t('label','Name What"s'),                    
			'sort'          => Yii::t('label','Sort'),
                        'sort_main'     => Yii::t('label','Sort Main'),
			'act'           => Yii::t('label','Act'),
			'del'           => Yii::t('label','Del'),
			'create_date'   => Yii::t('label','Create Date'),
			'update_date'   => Yii::t('label','Update Date'),
			'desc'          => Yii::t('label','Desc'),
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
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('title',$this->title,true);
                $criteria->compare('label',$this->label,true);
                $criteria->compare('is_ceil',$this->is_ceil);
                $criteria->compare('nameov',$this->nameov,true);
                $criteria->compare('namewhat',$this->namewhat,true);
                $criteria->compare('namewhats',$this->namewhats,true);                
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
            return 'Аренда '.mb_strtolower($this->namewhats,'UTF-8').' Москвы';
        }
        public function getLinkMapText() {
            //return 'Аренда '.mb_strtolower($this->namewhats,'UTF-8').' Москвы';
            return $this->nameov;
        }
        public function getLinkMapAlt() {
            return 'Аренда '.mb_strtolower($this->namewhats,'UTF-8').' Москвы';
        }  
}