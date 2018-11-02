<?php

/**
 * This is the model class for table "tax_reference".
 *
 * The followings are the available columns in table 'tax_reference':
 * @property integer $id
 * @property integer $num
 * @property string $abbr
 * @property string $title
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property string $desc
 * @property integer $grid
 * @property integer $district_id
 * @property string $index
 * @property string $address
 * @property string $index_fact
 * @property string $address_fact
 * @property integer $metro_id
 * @property string $proezd
 * @property string $phone
 * @property string $phone_2
 * @property string $phone_3
 * @property string $fax
 * @property string $site
 * @property string $email
 * @property string $anons
 * @property string $detile
 * @property string $description
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keywords
 *
 * The followings are the available model relations:
 * @property Districts $district
 * @property Metros $metro
 */
class TaxReference extends CActiveRecord
{
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return TaxReference the static model class
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
		return 'tax_reference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('num, sort, act, del, grid, district_id, metro_id', 'numerical', 'integerOnly'=>true),
			array('abbr, title, address, address_fact, proezd, site, email, seo_title', 'length', 'max'=>255),
			array('index, index_fact, phone, phone_2, phone_3, fax', 'length', 'max'=>75),
			array('create_date, update_date, desc, anons, detile, description, seo_desc, seo_keywords', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, num, abbr, title, sort, act, del, create_date, update_date, desc, grid, district_id, index, address, index_fact, address_fact, metro_id, proezd, phone, phone_2, phone_3, fax, site, email, anons, detile, description, seo_title, seo_desc, seo_keywords', 'safe', 'on'=>'search'),
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
			'district' => array(self::BELONGS_TO, 'Districts', 'district_id'),
			'metro' => array(self::BELONGS_TO, 'Metros', 'metro_id'),
		);
	}

        public function scopes()
        {
            return array(        
                    'sitemap' => array( 'select' => 't.id, t.title, t.grid, t.abbr', 
                                     'condition' => 'EXISTS (SELECT * FROM realestates r WHERE r.number_tax = t.id AND ( (r.ACT IS NULL OR r.ACT=1) AND (r.DEL IS NULL OR r.DEL=0) )) AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', //'(create_date <= NOW())and'.'(in_stock=1)'
                                         'order' =>'t.id ASC'),
                'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.abbr))) AS maxname'), 
                'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.abbr))) AS minname'),                                  
                     'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'),
                 'lastcreate' => array( 'order'=>'t.id DESC' ),
                'firstcreate' => array( 'order'=>'t.id ASC' ),
                  'mapfields' => array( 'select' => 't.id, t.title, t.grid, t.abbr' ),                
            );
        }        
                        
      	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'num' => 'Num',
			'abbr' => 'Abbr',
			'title' => 'Title',
			'sort' => 'Sort',
			'act' => 'Act',
			'del' => 'Del',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'desc' => 'Desc',
			'grid' => 'Grid',
			'district_id' => 'District',
			'index' => 'Index',
			'address' => 'Address',
			'index_fact' => 'Index Fact',
			'address_fact' => 'Address Fact',
			'metro_id' => 'Metro',
			'proezd' => 'Proezd',
			'phone' => 'Phone',
			'phone_2' => 'Phone 2',
			'phone_3' => 'Phone 3',
			'fax' => 'Fax',
			'site' => 'Site',
			'email' => 'Email',
			'anons' => 'Anons',
			'detile' => 'Detile',
			'description' => 'Description',
			'seo_title' => 'Seo Title',
			'seo_desc' => 'Seo Desc',
			'seo_keywords' => 'Seo Keywords',
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
		$criteria->compare('num',$this->num);
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('grid',$this->grid);
		$criteria->compare('t.district_id',$this->district_id);
		$criteria->compare('index',$this->index,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('index_fact',$this->index_fact,true);
		$criteria->compare('address_fact',$this->address_fact,true);
		$criteria->compare('metro_id',$this->metro_id);
		$criteria->compare('proezd',$this->proezd,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phone_2',$this->phone_2,true);
		$criteria->compare('phone_3',$this->phone_3,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('email',$this->email,true);
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
        
        public function getLinkMapTitle() {           
            return 'Аренда коммерческой недвижимости Москвы, '.$this->abbr;
        }
        public function getLinkMapText() {
            //return 'Аренда коммерческой недвижимости Москвы, '.$this->abbr;
            return 'Коммерческой недвижимость, '.$this->abbr;
        }
        public function getLinkMapAlt() {
            return 'Аренда коммерческой недвижимости Москвы, '.$this->abbr;
        }         
                             
        /* Links areas offer for vid 
         * @merge criteria
         */
        public function realexvid($vid) {
            $this->getDbCriteria()->mergeWith( 
               array( 'condition' => 'EXISTS (SELECT * 
                                              FROM realestates r 
                                              WHERE r.number_tax = t.id AND ((r.realestate_vid_id=:vid) AND (r.ACT IS NULL OR r.ACT=1) 
                                                                                                         AND (r.DEL IS NULL OR r.DEL=0)) )',
                         'params' => array(':vid'=>$vid) 
               )
            );
            return $this;
        }
}