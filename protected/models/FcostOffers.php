<?php

/**
 * This is the model class for table "fcost_offers".
 *
 * The followings are the available columns in table 'fcost_offers':
 * @property integer $id
 * @property string $uid
 * @property string $sid
 * @property integer $valute_id
 * @property integer $grid
 * @property integer $init_value
 * @property integer $final_value
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $desc
 * @property string $anons
 * @property string $detile
 * @property string $description
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keywords
 * @property string $create_date
 * @property string $update_date
 */
class FcostOffers extends CActiveRecord
{
        public $title;
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return FcostOffers the static model class
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
		return 'fcost_offers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valute_id, grid, init_value, final_value, sort, act, del', 'numerical', 'integerOnly'=>true),
			array('uid', 'length', 'max'=>75),
			array('sid', 'length', 'max'=>125),
			array('seo_title, title', 'length', 'max'=>255),
			array('desc, anons, detile, description, seo_desc, seo_keywords, create_date, update_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, sid, valute_id, grid, title, init_value, final_value, sort, act, del, desc, anons, detile, description, seo_title, seo_desc, seo_keywords, create_date, update_date', 'safe', 'on'=>'search'),
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
			'valute' => array(self::BELONGS_TO, 'Valutes', 'valute_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'sid' => 'Sid',
			'valute_id' => 'Valute',
			'grid' => 'Grid',
			'init_value' => 'Init Value',
			'final_value' => 'Final Value',
			'sort' => 'Sort',
			'act' => 'Act',
			'del' => 'Del',
			'desc' => 'Desc',
			'anons' => 'Anons',
			'detile' => 'Detile',
			'description' => 'Description',
			'seo_title' => 'Seo Title',
			'seo_desc' => 'Seo Desc',
			'seo_keywords' => 'Seo Keywords',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
		);
	}

        public function scopes()
        {
            return array(        
                'sitemap' => array( 'select' => 't.id, t.grid, t.final_value, t.init_value', 
                                 'condition' => 'EXISTS (SELECT * 
                                                         FROM realestates r 
                                                         WHERE  (r.area*r.price)/12 BETWEEN t.init_value AND  t.final_value 
                                                                AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                                         )',                                                 
                                    'order' => 't.id ASC','join'=>'LEFT JOIN valutes v on v.id=t.valute_id'),
                
      'sitemap_noexreal' => array( 'select' => 't.id, t.grid, t.final_value, t.init_value', 
                                'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                    'order' => 't.id ASC'),
             'mapfields' => array( 'select' => 't.id, t.grid, t.final_value, t.init_value' ),
           'titlelenmax' => array( 'select' => 'MAX(LENGTH(CONCAT(t.init_value,t.final_value))) AS maxname'), 
           'titlelenmin' => array( 'select' => 'MIN(LENGTH(CONCAT(t.init_value,t.final_value))) AS minname'),                
                'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),
            'lastcreate' => array( 'order'=>'t.id DESC' ),
           'firstcreate' => array( 'order'=>'t.id ASC' ),  
              'rubinval' => array( 'condition' => 't.valute_id=2')
            );
        }
        
        /* Exists vid for real in costoffers 
         * @merge criteria
         */
        public function realex() {
            return $this->realexvid();
        }

        /* Exists vid for real in costoffers 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) {
                $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          WHERE (r.realestate_vid_id=:vid) AND (r.area*r.price)/12 BETWEEN t.init_value AND  t.final_value 
                                                  AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                         )',     
                    'params'=>array(':vid'=>$vid)
                ));
            }else{
               $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          WHERE (r.area*r.price)/12 BETWEEN t.init_value AND  t.final_value 
                                                       AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                          )',  
               ));    
            }
            return $this;
        }
        
        /* Cost offers in real id
         * @merge criteria
         */
        public function realexin($in=null) {
            
            if (empty($in)) return $this;           
            
            $this->getDbCriteria()->mergeWith( 
                array(  'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          WHERE (r.id IN ('.$in.')) AND (r.area*r.price)/12 BETWEEN t.init_value AND  t.final_value  
                                                                           AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                          )',  
                     )
            );
            return $this;
        }        
        
        /* Cost offers real id
         * @merge criteria
         */
        public function realexsel($inexsel=null,$exsel=null,$exjoin=null) {
            
            if (empty($exsel)) $exsel ='(r.area*r.price)/12 BETWEEN t.init_value AND  t.final_value';                        
            
            $this->getDbCriteria()->mergeWith( 
                array(  
                        'condition'=>'EXISTS (SELECT * 
                                          FROM realestates r 
                                          '.$exjoin.'
                                          WHERE '.$exsel.'
                                                AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))
                                                '.($inexsel ? 'AND (r.id IN ('.$inexsel.'))' : '').'
                                          )' )
            );
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
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('valute_id',$this->valute_id);
		$criteria->compare('grid',$this->grid);
		$criteria->compare('init_value',$this->init_value);
		$criteria->compare('final_value',$this->final_value);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('t.act',$this->act);
		$criteria->compare('t.del',$this->del);
		$criteria->compare('t.desc',$this->desc,true);
		$criteria->compare('anons',$this->anons,true);
		$criteria->compare('detile',$this->detile,true);
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