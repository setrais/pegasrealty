<?php

/**
 * This is the model class for table "ri_iblocks".
 *
 * The followings are the available columns in table 'ri_iblocks':
 * @property integer $id
 * @property string $uid
 * @property string $sid
 * @property string $nid
 * @property integer $grid
 * @property string $name
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $anons
 * @property integer $pic_oreginal_id
 * @property integer $pic_scr_id
 * @property integer $pic_anons_id
 * @property integer $pic_detile_id
 * @property integer $act
 * @property integer $del
 * @property integer $createusers
 * @property string $createdate
 * @property integer $updateusers
 * @property string $updatedate
 * @property string $detile
 * @property integer $sort
 * @property string $cid
 * @property integer $is_main
 * @property integer $is_pay
 * @property integer $is_arhiv
 * @property integer $is_use
 * @property string $maps_id
 * @property integer $types_iblocks_id
 * @property string $url
 * @property string $url_detile
 * @property string $url_list
 * @property string $action
 * @property string $visible
 * @property integer $city
 * @property Files $picOreginal
 * @property Files $picScr
 * @property Files $picAnons
 * @property Files $picDetile 
 */
class Iblocks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RiIblocks the static model class
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
		return 'iblocks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'required'),
			array('grid, act, del, createusers, updateusers, sort, 
                               is_main, is_pay, is_arhiv, is_use, is_resize,
                               types_iblocks_id, city_id, pic_oreginal_id, pic_scr_id, 
                               pic_anons_id, pic_detile_id', 'numerical', 'integerOnly'=>true),
                      /*array('picOreginal', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picScr', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picAnons', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picDetile', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),*/                    
			array('uid, nid, cid, maps_id', 'length', 'max'=>75),
                        array('name, sid','length','max'=>125),
                    	//array('name, sid', 'length', 'max'=>255),
			array('title', 'length', 'max'=>255),
			/*array('anons', 'length', 'max'=>750),*/
			array('keywords, description, pic_detile, createdate, updatedate, detile, url, 
                               url_detile, url_list, visname, grid, anons, action', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, sid, nid, grid, name, title, keywords, description, anons, 
                               pic_oreginal_id, pic_scr_id, pic_anons_id, pic_detile_id, 
                               act, del, createusers, createdate, updateusers, 
                               updatedate, detile, sort, cid, is_main, is_pay, 
                               is_arhiv, is_use, maps_id, types_iblocks_id, url, 
                               url_list, url_detile, city_id, grid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return 
                array(
                        'picOreginal' => array(self::BELONGS_TO, 'Files', 'pic_oreginal_id'),
			'picScr' => array(self::BELONGS_TO, 'Files', 'pic_scr_id'),
			'picAnons' => array(self::BELONGS_TO, 'Files', 'pic_anons_id'),
                        'city' => array(self::BELONGS_TO, 'Cities', 'city_id'),
                        'section' => array(self::BELONGS_TO, 'Iblocks', 'grid'),
			'picDetile' => array(self::BELONGS_TO, 'Files', 'pic_detile_id'),
                        'typesIblock' => array(self::BELONGS_TO, 'TypesIblocks', 'types_iblocks_id'),
                        'updateUser' => array(self::BELONGS_TO, 'Users', 'updateusers'),
                        'createUser' => array(self::BELONGS_TO, 'Users', 'createusers'),
		);
	}
        
        public function scopes()
        {
            return array(
                'sitemap'=>array('select'=>'IF(id<10, LPAD(id,2,"0"), id) as id, title,  grid', 'condition'=>/*'(createdate <= NOW())and*/'(act=1)and(del=0)', 'order'=>'id DESC'/*createdate DESC'*/),
            );
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'uid' => Yii::t('label','UID'),
                        'sid' => Yii::t('label','Symbol ID'),
                        'nid' => Yii::t('label','Internal ID'),
			'grid' => Yii::t('label','Grid'),
			'name' => Yii::t('label','Name'),
			'title' => Yii::t('label','Title page'),
			'keywords' => Yii::t('label','Keywords'),
			'description' => Yii::t('label','Description'),
			'anons' => Yii::t('label','Anons'),
                        'is_resize'             => Yii::t('label','Is Resize'),
                        'pic_oreginal_id'       => Yii::t('label','Pic Oreginal'),
			'pic_scr_id'            => Yii::t('label','Pic Scr'),
			'pic_anons_id'          => Yii::t('label','Pic Anons'),
			'pic_detile_id'         => Yii::t('label','Pic Detile'),
			'act' => Yii::t('label','Act'),
			'del' => Yii::t('label','Del'),
			'createusers' => Yii::t('label','Createusers'),
			'createdate' => Yii::t('label','Createdate'),
			'updateusers' => Yii::t('label','Updateusers'),
			'updatedate' => Yii::t('label','Updatedate'),
			'detile' => Yii::t('label','Detile'),
			'sort' => Yii::t('label','Sort'),
			'cid' => Yii::t('label','Cid'),
			'is_main' => Yii::t('label','Is Main'),
			'is_pay' => Yii::t('label','Is Pay'),
			'is_arhiv' => Yii::t('label','Is Arhiv'),
			'is_use' => Yii::t('label','Is Use'),
			'maps_id' => Yii::t('label','Maps'),
			'types_iblocks_id' => Yii::t('label','Types Iblocks'),
                        'action' => Yii::t('label','Action'),
                        'visible' => Yii::t('label','Visible'),
			'url' => Yii::t('label','Url'),
                        'url_detile' => Yii::t('label','Url Detile'),
                        'url_list' => Yii::t('label','Url List'),
			'city_id' => Yii::t('label','City'),                           
                        'picOreginal'           => Yii::t('label','Pic Oreginal'),
                        'picScr'                => Yii::t('label','Pic Scr'),
                        'picAnons'              => Yii::t('label','Pic Anons'),
                        'picDetile'             => Yii::t('label','Pic Detile'),                    
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
		$criteria->compare('uid',$this->uid,true);
                $criteria->compare('sid',$this->sid,true);
                $criteria->compare('nid',$this->nid,true);
		$criteria->compare('grid',$this->grid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('anons',$this->anons,true);
                $criteria->compare('pic_oreginal_id',$this->pic_oreginal_id);                  
                $criteria->compare('picOreginal.id', $this->pic_oreginal_id);                                
		$criteria->compare('pic_scr_id',$this->pic_scr_id);    
                $criteria->compare('pic_anons_id',$this->pic_anons_id);		
		$criteria->compare('pic_detile_id',$this->pic_detile_id);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('createusers',$this->createusers);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateusers',$this->updateusers);
		$criteria->compare('updatedate',$this->updatedate,true);
		$criteria->compare('detile',$this->detile,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('cid',$this->cid,true);
		$criteria->compare('is_main',$this->is_main);
		$criteria->compare('is_pay',$this->is_pay);
		$criteria->compare('is_arhiv',$this->is_arhiv);
		$criteria->compare('is_use',$this->is_use);
                $criteria->compare('is_resize',$this->is_use);
		$criteria->compare('maps_id',$this->maps_id,true);
		$criteria->compare('types_iblocks_id',$this->types_iblocks_id);
		$criteria->compare('url',$this->url,true);
                $criteria->compare('url_detile',$this->url,true);
                $criteria->compare('url_list',$this->url,true);
		$criteria->compare('city_id',$this->city_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
               
        public function createTitle() {
            return $this->name;
        }
        
        public function createDescription() {
            return $this->anons;
        }
        
        public function createKeywords() {            
            $meta = HRu::create_meta($this->title.' '.$this->anons.' '.$this->detile, null,$this->anons);                                       
            return $meta['keywords'];
        }
        
        public function afterValidate() {
            if ($this->isNewRecord) :  
                $this->createdate=date('Y-m-d H:i:s'); 
                $this->createusers = Yii::app()->user->id;
            else :
                $this->createdate = date('Y-m-d H:i:s',strtotime($this->createdate));
                $this->updatedate = date('Y-m-d H:i:s',strtotime($this->updatedate));
                $this->updateusers = Yii::app()->user->id;
            endif;                
            
            return parent::afterValidate();            
        }   
        
        public function afterSave() {
            if (empty($this->maps_id)) $this->maps_id = $this->id; 
            return parent::afterSave();
        }
} 