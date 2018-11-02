<?php

/**
 * This is the model class for table "parkings".
 *
 * The followings are the available columns in table 'parkings':
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
class Parkings extends CActiveRecord
{
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Parkings the static model class
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
		return 'parkings';
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
			array('abbr, title', 'length', 'max'=>255),
			array('create_date, update_date, desc, grid', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, abbr, title, sort, act, del, create_date, update_date, desc', 'safe', 'on'=>'search'),
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
			'realestates' => array(self::HAS_MANY, 'Realestates', 'parking_id'),
		);
	}
        
        public function scopes()
        {
            return array(        
                'sitemap' => array( 'select' => 't.id, title, grid, t.abbr', 
                                 'condition' => 'EXISTS (SELECT * FROM realestates r 
                                                         WHERE r.parking_id = t.id  
                                                               AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))) 
                                                               AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 
                                     'order' => 't.id ASC'),
            'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname'), 
            'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname'),                                    
                 'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),
             'lastcreate' => array(  'order' => 't.id DESC' ),
            'firstcreate' => array(  'order' => 't.id ASC' ),
              'mapfields' => array( 'select' => 't.id, title, grid, t.abbr' ),                
            );
        }        

        /* Parking exist realestate
         * @merge criteria
         */
        public function realex() {
            return $this->realexvid();
        }
        
        /* Parking exist realestate for vid 
         * @merge criteria
         */
        public function realexvid($vid=null) {
            if ($vid) {
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.parking_id = t.id AND ((r.realestate_vid_id=:vid) AND (r.ACT IS NULL OR r.ACT=1) 
                                                                                                       AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                            'params' => array(':vid'=>$vid)
                         )
                );
            }else{
                $this->getDbCriteria()->mergeWith( 
                    array( 'condition' => 'EXISTS (SELECT * 
                                             FROM realestates r 
                                             WHERE r.parking_id = t.id AND ((r.ACT IS NULL OR r.ACT=1) 
                                                                       AND (r.DEL IS NULL OR r.DEL=0))
                                             )', 
                    )
                );
            }    
            return $this;
        }
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'abbr' => 'Abbr',
			'title' => 'Title',
			'sort' => 'Sort',
			'act' => 'Act',
			'del' => 'Del',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'desc' => 'Desc',
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
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getLinkMapTitle() {           
            return 'Аренда коммерческой недвижимсти только '.mb_strtolower($this->title,'UTF-8')." (".$this->abbr.")";
        }
        public function getLinkMapText() {
            //return 'Аренда коммерческой недвижимость только '.mb_strtolower($this->title,'UTF-8')." (".$this->abbr.")";
            return 'Коммерческая недвижимость только '.mb_strtolower($this->title,'UTF-8')." (".$this->abbr.")";
        }
        public function getLinkMapAlt() {
            return 'Аренда коммерческой недвижимсти только '.mb_strtolower($this->title,'UTF-8')." (".$this->abbr.")";
        } 
}