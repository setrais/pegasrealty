<?php
/**
 * This is the model class for table "units".
 *
 * The followings are the available columns in table 'units':
 * @property integer $id
 * @property string $title
 * @property string $short_title
 * @property string $abbr
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $desc
 *
 * The followings are the available model relations:
 * @property Realestates[] $realestates
 */
class Units extends CActiveRecord
{
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Units the static model class
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
		return 'units';
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
			array('title, short_title, abbr', 'length', 'max'=>255),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, short_title, sort, abbr, act, del, desc', 'safe', 'on'=>'search'),
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
			'realestates' => array(self::HAS_MANY, 'Realestates', 'unit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'short_title' => 'Short Title',
			'sort' => 'Sort',
			'act' => 'Act',
			'del' => 'Del',
			'desc' => 'Desc',
                        'abbr' => 'Abbriviatura',
		);
	}
        
        public function scopes()
        {
            return array(        
                'sitemap' => array( 'select' => 't.id, t.title, t.abbr, t.grid, t.short_title', 
                                 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                     'order' => 't.id ASC'),
            'abbrlenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.abbr))) AS maxname'), 
            'abbrlenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.abbr))) AS minname'),                                    
            'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname'), 
            'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname'),                                                    
                 'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),
             'lastcreate' => array(  'order' => 't.id DESC' ),
            'firstcreate' => array(  'order' => 't.id ASC' ),
              'mapfields' => array( 'select' => 't.id, t.title, t.abbr, t.grid, t.short_title' ),                
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
		$criteria->compare('title',$this->title,true);
                $criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('short_title',$this->short_title,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /* Unit exist realestate 
         * @merge criteria
         */
        public function realex() {
            return $this->realexvid();
        }
        /* Unit exist realestate for vid 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) {
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.unit_id = t.id AND ((r.realestate_vid_id=:vid) AND (r.ACT IS NULL OR r.ACT=1) 
                                                                                                       AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                            'params' => array(':vid'=>$vid)
                         )
                );
            }else{
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.unit_id = t.id AND ((r.ACT IS NULL OR r.ACT=1) 
                                                                    AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                         )
                );                
            }    
            return $this;
        }
        
        public function getLinkMapTitle() {           
            return 'Аренда коммерческой недвижимости в Москве с расcтоянием от метро в минутах '.$this->abbr." (".$this->short_title.")";
        }
        public function getLinkMapText() {
            //return 'Аренда коммерческой недвижимости в минутах '.$this->abbr." (".$this->short_title.") от метро";
            return 'Коммерческая недвижимость в минутах '.$this->abbr." (".$this->short_title.") от метро";
        }
        public function getLinkMapAlt() {
            return 'Аренда коммерческой недвижимости в минутах '.$this->abbr." (".$this->short_title.") от метро";
        } 
}