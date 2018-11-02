<?php
/**
 * This is the model class for table "realestates".
 *
 * The followings are the available columns in table 'realestates':
 * @property integer $id
 * @property integer $district_id
 * @property string $number_tax
 * @property string $area
 * @property string $price
 * @property integer $pic_oreginal_id
 * @property integer $pic_scr_id
 * @property integer $pic_anons_id
 * @property integer $pic_detile_id
 * @property string $remoteness
 * @property integer $unit_id
 * @property string $unit_value
 * @property string $date_rang
 * @property string $date_release
 * @property integer $in_stock
 * @property integer $metro_id
 * @property integer $planning_id
 * @property integer $tax_id
 * @property integer $parking_id
 * @property integer $cnt_parking_place
 * @property string $telephone
 * @property string $site
 * @property integer $representative_id
 * @property integer $commission_id
 * @property integer $procent_commission
 * @property integer $contract_type_id
 * @property string $contract_number
 * @property integer $fav
 * @property integer $recommend
 * @property integer $realestate_type_id
 * @property string $title
 * @property integer $realestate_class_id
 * @property integer $realestate_vid_id
 * @property string $anons
 * @property string $detile
 * @property string $desc
 * @property integer $is_resize
 * @property string $map_latitude
 * @property string $map_longitude
 * @property integer $operation_id
 * @property string $address
 * @property integer $is_separate_entrance
 * @property integer $valute_id
 * @property integer $areas_id
 * @property string $seo_desc
 * @property string $seo_title
 * @property string $seo_keywords
 *
 * The followings are the available model relations:
 * @property ClientRealestates[] $clientRealestates
 * @property RealestateFotos[] $realestateFotos
 * @property RealestatePresentations[] $realestatePresentations
 * @property RealestateProperties[] $realestateProperties
 * @property RealestateSimilarities[] $realestateSimilarities
 * @property RealestateSimilarities[] $realestateOthers
 * @property RealestateRepresentatives[] $realestateRepresentatives
 * @property Commissions $commission
 * @property ContractTypes $contractType
 * @property Types $contractType
 * @property Districts $district
 * @property Files $picOreginal
 * @property Files $picScr
 * @property Files $picAnons
 * @property Files $picDetile
 * @property Metros $metro
 * @property Users $update_user
 * @property Users $update_user
 * @property Parkings $parking
 * @property Plannings $planning
 * @property Representatives $representative
 * @property RealestateClasses $realestateClass
 * @property RealestateTypes $realestateType
 * @property RealestateVids $realestateVid
 * @property Taxs $tax
 * @property Units $unit
 * @property Units $grid
 */
class Realestates extends CActiveRecord
{         
        public $maxname;
        public $minname;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Realestates the static model class
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
		return 'realestates';
	}
                                      
        public function scopes()
        {
            return array(        
                        'sitemap' => array( 'select' => 'id, title, grid, area', 
                                         'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))',/*'(create_date <= NOW())and'.'(in_stock=1)'*/
                                             'order' => 'create_date DESC' ),
                    'titlelenmax' => array( 'select' => 'MAX(CHAR_LENGTH(TRIM(t.title))) AS maxname' ), 
                    'titlelenmin' => array( 'select' => 'MIN(CHAR_LENGTH(TRIM(t.title))) AS minname' ),                                    
                         'active' => array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))' ),
                     'lastcreate' => array(  'order' => 't.id DESC' ),
                    'firstcreate' => array(  'order' => 't.id ASC' ),
                      'mapfields' => array( 'select' => 'id, title, grid, area' ),    
                         'unitis' => array( 'condition' => '(t.unit_id IS NOT NULL)' ),
           'actdelunitremmfields' => array( 'select' => 't.act,t.del,t.unit_id,t.remoteness' ),
                  'remmunitgroup' => array(  'group' => 't.remoteness,t.unit_id' ),
                  'remmunitorder' => array(  'order' => 't.remoteness,t.unit_id' ),     
                       'unitjoin' => array(   'join' => 'LEFT JOIN units unit on unit.id=t.unit_id' ),                 
            );
        }
        
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
                $ext_rules = (Yii::app()->user->checkAccess('superadmin') || Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('expert')) ? array(array('seo_keywords, seo_desc','required')) : array();
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge( array(
			/*array('area, price, address, district_id, metro_id, 
                               realestate_vid_id, realestate_class_id, planning_id, 
                               valute_id, tax_id, parking_id, representative_id, 
                               procent_commission, commission_id, uid, sid, nid', 'required')*/
                        array('address, district_id, areas_id,  metro_id, './*street_id,*/'
                               realestate_vid_id, realestate_class_id,  
                               representative_id, 
                               uid, sid, nid, remoteness, unit_id, planning_id, tax_id, price, area, title, anons, seo_title, realestate_type_id, operation_id, number_tax', 'required'),                        
			array('areas_id,district_id, pic_oreginal_id, pic_scr_id, pic_anons_id, 
                               pic_detile_id, unit_id, in_stock, metro_id, planning_id, street_id,
                               tax_id, parking_id, cnt_parking_place, representative_id, 
                               commission_id, contract_type_id, fav, recommend, rented, advertised, realestate_type_id, 
                               realestate_class_id, realestate_vid_id, is_resize, operation_id, 
                               is_separate_entrance, valute_id, remoteness, 
                               coefficient_corridor, create_user, update_user, grid, oid', 'numerical', 'integerOnly'=>true),
                        array('coefficient_corridor', 'length', 'max'=>3),                    
                        array('procent_commission', 'length', 'max'=>6),
			array('number_tax', 'length', 'max'=>11),                        
                      /*array('picOreginal', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picScr', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picAnons', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picDetile', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),*/
			array('area, price, remoteness, unit_value, cnt_parking_place', 'length', 'max'=>10),
			array('telephone, site, contract_number, number_tax, map_latitude, map_longitude, address, newstreet', 'length', 'max'=>255),
			array('title,uid,sid,nid,grid', 'length', 'max'=>75),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile', 'length', 'max'=>6000), // (3000) 6000
			array('date_rang, date_release, create_date, update_date, anons, detile, description, seo_title, seo_desc, seo_keywords, act, del, 
                               realestateDestinations, realestatesProperties', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, nid, oid, district_id, areas_id, number_tax, area, price, pic_oreginal_id, 
                               pic_scr_id, pic_anons_id, pic_detile_id, remoteness, 
                               unit_id, unit_value, date_rang, date_release, in_stock, metro_id, 
                               planning_id, tax_id, parking_id, cnt_parking_place, telephone, site, 
                               representative_id, commission_id, procent_commission, contract_type_id, 
                               contract_number, number_tax, fav, recommend, rented, advertised, realestate_type_id, title,
                               realestate_class_id, realestate_vid_id, anons, detile, description, 
                               map_latitude, map_longitude, is_resize, operation_id, address, street_id, newstreet
                               is_separate_entrance, valute_id, coefficient_corridor, create_date, update_date, create_user, update_user, grid, seo_desc, seo_title, seo_keywords', 'safe', 'on'=>'search'),
		), 
                $ext_rules );
	}
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'realestateClients' => array(self::HAS_MANY, 'ClientRealestates', 'realestate_id'),
			'realestateFotos' => array(self::HAS_MANY, 'RealestateFotos', 'realestate_id'),                        
			'realestatePresentations' => array(self::HAS_MANY, 'RealestatePresentations', 'realestate_id'),
			'realestateProperties' => array(self::HAS_MANY, 'RealestateProperties', 'realestate_id'),
                        //'realestateDestinations' => array(self::HAS_MANY, 'RealestateDestinations', 'realestate_id'),
                        'realestateDestinations' => array(self::MANY_MANY, 'Destinations','realestate_destinations(realestate_id, destination_id)'),
			//'realestateSimilarities' => array(self::HAS_MANY, 'RealestateSimilarities', 'similaries_id'),
                        //'realestateSimilarities' => array(self::HAS_MANY, 'RealestateSimilarities', 'realestate_id','condition'=>'realestate_linking_id=1'),
                        'realestateSimilarities' => array(self::MANY_MANY, 'Realestates','realestate_similarities(realestate_id, similaries_id)','condition'=>'realestate_linking_id=1'),                        
                        'realestateOthers' => array(self::MANY_MANY, 'Realestates','realestate_similarities(realestate_id, similaries_id)','condition'=>'realestate_linking_id=2'),                    
			//'realestateOthers' => array(self::HAS_MANY, 'RealestateSimilarities', 'realestate_id','condition'=>'realestate_linking_id=2'),
                        //'realestateSimilarities' => array(self::MANY_MANY, 'Realestates','realestate_similarities(realestate_id, similaries_id)','condition'=>'realestate_linking_id=1'),
			'realestatesOthers' => array(self::MANY_MANY, 'Realestates','realestate_similarities(realestate_id, similaries_id)','condition'=>'(realestate_linking_id=2)AND((act IS NULL)OR(act=1))'),                    
                        'realestatesSimilarities' => array(self::MANY_MANY, 'Realestates','realestate_similarities(realestate_id, similaries_id)','condition'=>'(realestate_linking_id=1)AND((act IS NULL)OR(act=1))'),                        
                        'realestateRepresentatives' => array(self::HAS_MANY, 'RealestateRepresentatives', 'realestate_id'),
                        'realestatesRepresentatives' => array(self::MANY_MANY, 'Representatives','realestate_representatives(realestate_id, representative_id)'),                        
			'commission' => array(self::BELONGS_TO, 'Commissions', 'commission_id'),
			'contractType' => array(self::BELONGS_TO, 'ContractTypes', 'contract_type_id'),
			'district' => array(self::BELONGS_TO, 'Districts', 'district_id'),
                        'object' => array(self::BELONGS_TO, 'Objects', 'oid'),
                        'taxReference'=> array(self::BELONGS_TO, 'TaxReference', 'number_tax'),
                        'areas'=> array(self::BELONGS_TO, 'Areas', 'areas_id'),
                        'picOreginal' => array(self::BELONGS_TO, 'Files', 'pic_oreginal_id'),
			'picScr' => array(self::BELONGS_TO, 'Files', 'pic_scr_id'),
			'picAnons' => array(self::BELONGS_TO, 'Files', 'pic_anons_id'),
			'picDetile' => array(self::BELONGS_TO, 'Files', 'pic_detile_id'),
			'metro' => array(self::BELONGS_TO, 'Metros', 'metro_id'),
                        'street' => array(self::BELONGS_TO, 'Streets', 'street_id'),
			'parking' => array(self::BELONGS_TO, 'Parkings', 'parking_id'),
			'planning' => array(self::BELONGS_TO, 'Plannings', 'planning_id'),                        
                        'operation' => array(self::BELONGS_TO, 'Operations', 'operation_id'),
                        'valute' => array(self::BELONGS_TO, 'Valutes', 'valute_id'/*,'select'=>'valutes.abbr,valutes.title,valutes.desc'*/),
			'representative' => array(self::BELONGS_TO, 'Representatives', 'representative_id'),
			'realestateClass' => array(self::BELONGS_TO, 'RealestateClasses', 'realestate_class_id'),
			'realestateType' => array(self::BELONGS_TO, 'RealestateTypes', 'realestate_type_id'),
			'realestateVid' => array(self::BELONGS_TO, 'RealestateVids', 'realestate_vid_id'),
                        'metros'=>array(self::HAS_MANY, 'RealestateMetros', 'realestate_id'),
                        'realestateMetros'=>array(self::MANY_MANY, 'Representatives','realestate_metros(realestate_id, metro_id)'),  
                        'realestatesProperties'=>array(self::MANY_MANY, 'Properties','realestate_properties(realestate_id, property_id)'),  
			'tax' => array(self::BELONGS_TO, 'Taxs', 'tax_id'),
			'unit' => array(self::BELONGS_TO, 'Units', 'unit_id'/*, 'select'=>'units.abbr,units.title,units.short_title'*/),
                        'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user'),
                        'createUser' => array(self::BELONGS_TO, 'Users', 'create_user'),
                        'section' => array(self::BELONGS_TO, 'Iblocks', 'grid'),
                 );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                    => Yii::t('label','ID'),
                        'uid'                   => Yii::t('label','Unique ID'),
                        'sid'                   => Yii::t('label','Symbol ID'),
                        'nid'                   => Yii::t('label','Internal ID'),
                        'oid'                   => Yii::t('label','Object ID'),
                        'grid'                  => Yii::t('label','Grid'),                    
                        'title'                 => Yii::t('label','Title'),                
                        'act'                   => Yii::t('label','Act'),
                        'del'                   => Yii::t('label','Del'),
			'district_id'           => Yii::t('label','District'),
			'number_tax'            => Yii::t('label','Number Tax'),
                        'areas_id'              => Yii::t('label','Areas'),
			'area'                  => Yii::t('label','Area'),
			'price'                 => Yii::t('label','Price'),
                        'is_resize'             => Yii::t('label','Is Resize'),
                        'pic_oreginal_id'       => Yii::t('label','Pic Oreginal'),
			'pic_scr_id'            => Yii::t('label','Pic Scr'),
			'pic_anons_id'          => Yii::t('label','Pic Anons'),
			'pic_detile_id'         => Yii::t('label','Pic Detile'),
			'remoteness'            => Yii::t('label','Remoteness'),
			'unit_id'               => Yii::t('label','Unit'),
			'unit_value'            => Yii::t('label','Unit Value'),
			'date_rang'             => Yii::t('label','Date Rang'),
			'date_release'          => Yii::t('label','Date Release'),
			'in_stock'              => Yii::t('label','In Stock'),
			'metro_id'              => Yii::t('label','Metro'),
			'planning_id'           => Yii::t('label','Planning'),
			'tax_id'                => Yii::t('label','Tax'),
			'parking_id'            => Yii::t('label','Parking'),
			'cnt_parking_place'     => Yii::t('label','Cnt Parking Place'),
			'telephone'             => Yii::t('label','Telephone'),
			'site'                  => Yii::t('label','Site'),
			'representative_id'     => Yii::t('label','Representative'),
			'commission_id'         => Yii::t('label','Commission'),
			'procent_commission'    => Yii::t('label','Procent Commission'),
			'contract_type_id'      => Yii::t('label','Contract Type'),
			'contract_number'       => Yii::t('label','Contract Number'),
			'fav'                   => Yii::t('label','Fav'),
                        'rented'                => Yii::t('label','Rented'),
                        'advertised'            => Yii::t('label','Advertised'),
                        'recommend'             => Yii::t('label','Recommend'),
			'realestate_type_id'         => Yii::t('label','Realestate Type'),			
			'realestate_class_id'        => Yii::t('label','Realestate Class'),
			'realestate_vid_id'          => Yii::t('label','Realestate Vid'),
			'anons'                 => Yii::t('label','Anons'),
			'detile'                => Yii::t('label','Detile'),
			'description'           => Yii::t('label','Desc'),
			'map_latitude'          => Yii::t('label','Map Latitude'),
			'map_longitude'         => Yii::t('label','Map Longitude'),
                        'operation_id'          => Yii::t('label','Operation'),
                        'street_id'               => Yii::t('label','Street'),
                        'newstreet'               => Yii::t('label','New Street'),
                        'address'               => Yii::t('label','Address'),
                        'is_separate_entrance'  => Yii::t('label','Is Separate Entrance'),
                        'valute_id'             => Yii::t('label','Valute'),
                        'realestateFotos'            => Yii::t('label','Realestate Fotos'),
			'realestatePresentations'    => Yii::t('label','Realestate Presentations'),
			'realestateProperties'       => Yii::t('label','Realestate Properties'),
                        'realestateDestinations'       => Yii::t('label','Destinations of realestates'),
			'realestateSimilarities'     => Yii::t('label','Realestate Similarities'),
			'realestateOthers'    => Yii::t('label','Realestate Similarities1'),
                        'realestateRepresentatives'  => Yii::t('label','Realestate Representatives'),
                        'coefficient_corridor'  => Yii::t('label','Coefficient of corridor'),                       
                        'picOreginal'           => Yii::t('label','Pic Oreginal'),
                        'picScr'                => Yii::t('label','Pic Scr'),
                        'picAnons'              => Yii::t('label','Pic Anons'),
                        'picDetile'             => Yii::t('label','Pic Detile'),
			'create_date'           => Yii::t('label','Create Date'),
			'update_date'           => Yii::t('label','Update Date'),     
                 	'create_user'           => Yii::t('label','Create User'),			
                        'seo_desc'              => Yii::t('label','Seo Desc'),
                        'seo_title'             => Yii::t('label','Seo Title'),
                        'seo_keywords'          => Yii::t('label','Seo Keywords'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($pageSize=10,$sorts=null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.                         
                $criteria=$this->criteria();
                if ($sorts) {
                    $criteria->with=array_keys($sorts);         
                    $sort = new CSort();
                    $sort->multiSort = true;
                    // здесь описываем аттрибуты, по которым будет сортировка
                    // ключ может быть произвольный, это будет $_GET параметр                    
                    $sort->attributes = $sorts;
                }                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array('pageSize'=>Yii::app()->request->getQuery('size'/*, 10*/) ? Yii::app()->request->getQuery('size', 10) : $pageSize),
                        'sort'=>$sort,
		));
	}
        
        /* District exist realestate for vid 
         * @merge criteria
         */
        public function realexvid($vid) {
            $this->getDbCriteria()->mergeWith( 
                array( 'condition' => ' t.realestate_vid_id=:vid', 
                          'params' => array(':vid'=>$vid)
                     )
            );
            return $this;
        }
        
        public function getSqlText() {
              //$criteria = $this->getCommandBuilder()->createCriteria($this->dbCriteria->condition, $this->dbCriteria->params);   
              $command = $this->getCommandBuilder()->createFindCommand($this->getTableSchema(),
                                                   $this->dbCriteria);
              //$this->getCommandBuilder()->bindValues($command,$this->dbCriteria->params);                              
              return str_replace(array_keys($this->dbCriteria->params),  array_values($this->dbCriteria->params),$command->getText());  
        }
        /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function criteria()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
            
		$criteria=new CDbCriteria;      
		$criteria->compare('id',$this->id);   
                $criteria->compare('oid',$this->id);   
                $criteria->compare('uid',$this->uid); 
                $criteria->compare('sid',$this->sid); 
                $criteria->compare('nid',$this->nid,true); 
                
		$criteria->compare('t.district_id',$this->district_id); 
                $criteria->compare('t.areas_id',$this->areas_id);       

                if ($this->metro_id || $this->remoteness || $this->unit_id) {
                    $criteria->with = array('metros');
                    $criteria->compare('metros.metro_id',$this->metro_id);    
                    $criteria->compare('metros.remoteness',$this->remoteness); // Открыт по требованию страниц unit Возможно было прикрыто для админки
                    $criteria->compare('metros.unit_id',$this->unit_id);                
                } else {
                    $criteria->compare('t.metro_id',$this->metro_id);  
                    $criteria->compare('t.remoteness',$this->remoteness); // Открыт по требованию страниц unit Возможно было прикрыто для админки
                    $criteria->compare('unit_id',$this->unit_id);                                
                }               
                $criteria->compare('unit_value',$this->unit_value,true);
		$criteria->compare('number_tax',$this->number_tax);
                
		$criteria->compare('area',$this->area,true);                
                                
		$criteria->compare('price',$this->price,true);
                $criteria->compare('is_resize',$this->is_resize);
                $criteria->compare('pic_oreginal_id',$this->pic_oreginal_id);                  
                $criteria->compare('picOreginal.id', $this->pic_oreginal_id);                   
                
		$criteria->compare('pic_scr_id',$this->pic_scr_id);    
                $criteria->compare('pic_anons_id',$this->pic_anons_id);		
		$criteria->compare('pic_detile_id',$this->pic_detile_id);		
                
                if ($this->date_rang) {
                    $criteria->compare('date_rang',  $this->date_rang,true);
                }
                if ($this->date_release) {
                    $criteria->compare('date_release',date('Y-m-d',  strtotime($this->date_release)),true);
                }
                
                if ($this->create_date) {
                    $criteria->compare('create_date',  date('Y-m-d',  strtotime($this->create_date)),true);
                }
                if ($this->update_date) {
                    $criteria->compare('update_date',date('Y-m-d',  strtotime($this->update_date)),true);
                }
                
                $criteria->compare('in_stock', $this->in_stock, true);                
                
                $criteria->compare('t.act', $this->act, true); 
                $criteria->compare('t.del', $this->del, true); 
                
		//$criteria->compare('metro_id',$this->metro_id);
                
                $criteria->compare('street_id',$this->street_id);
                if ( !$this->street_id ) {
                    $criteria->compare('newstreet',$this->newstreet);
                }
                $criteria->compare('create_user',$this->create_user);
                $criteria->compare('update_user',$this->update_user);

                $criteria->compare('planning_id',$this->planning_id);

		$criteria->compare('tax_id',$this->tax_id);

		$criteria->compare('parking_id',$this->parking_id);

		$criteria->compare('cnt_parking_place',$this->cnt_parking_place);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('site',$this->site,true);
                
		$criteria->compare('t.representative_id',$this->representative_id);
                
		$criteria->compare('commission_id',$this->commission_id);
		$criteria->compare('procent_commission',$this->procent_commission);
		$criteria->compare('contract_type_id',$this->contract_type_id);
		$criteria->compare('contract_number',$this->contract_number,true);
		$criteria->compare('fav',$this->fav );
                $criteria->compare('recommend',$this->recommend );
                $criteria->compare('rented',$this->rented );
                $criteria->compare('advertised',$this->advertised );
		$criteria->compare('realestate_type_id',$this->realestate_type_id);
                                      
		$criteria->compare('title',$this->title,true);

		$criteria->compare('realestate_class_id',$this->realestate_class_id);

                $criteria->compare('t.realestate_vid_id',$this->realestate_vid_id);

		$criteria->compare('anons',$this->anons,true);
		$criteria->compare('detile',$this->detile,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('map_latitude',$this->map_latitude,true);
		$criteria->compare('map_longitude',$this->map_longitude,true);
                $criteria->compare('t.operation_id',$this->operation_id);
                $criteria->compare('address',$this->address,true);
                $criteria->compare('is_separate_entrance',$this->is_separate_entrance);                                
                $criteria->compare('valute_id',$this->valute_id); 

                $criteria->compare('coefficient_corridor',$this->coefficient_corridor);                                 

                $criteria->compare('seo_title',$this->seo_title,true);
                $criteria->compare('seo_desc',$this->seo_desc,true);
                $criteria->compare('seo_keywords',$this->seo_keywords,true);                                    
                
                //$criteria->compare('district.id',$this->district_id);                 
		//$criteria->compare('unit.id',$this->unit_id);
                //$criteria->compare('metro.id',$this->metro_id);                
                //$criteria->compare('planning.id',$this->planning_id);                
                //$criteria->compare('tax.id',$this->tax_id);                
                //$criteria->compare('parking.id',$this->parking_id);                
                //$criteria->compare('realestateClass',$this->realestate_class_id);                                
                //$criteria->compare('realestateVid.id',$this->realestate_vid_id);		                
                //$criteria->compare('valute.id',$this->valute_id);                                 
                
		return $criteria;
	}
        
        public function getMaxLongCoord($polygon) {
            return $this->getLongCoord( $polygon, 'max');
        }
        
        public function getMinLongCoord($polygon) {
            return $this->getLongCoord( $polygon, 'min');
        }
        
        public function getMaxLatCoord($polygon) {
            return $this->getLatCoord( $polygon, 'max');
        }
        
        public function getMinLatCoord($polygon) {
            return $this->getLatCoord( $polygon, 'min');
        }
        
        public function getLatCoord($polygon,$type='min') {   
            $coord = $this->getCoord($polygon)->lat[$type];            
            return $coord;
        }
        
        public function getLongCoord($polygon,$type='max') {          
            $coord = $this->getCoord($polygon)->long[$type];            
            return $coord;
        }
        public function getCoefficientCorridor() {
            $acoef = array_combine(range(1,26,1),range(5,30,1));
            return $acoef[$this->coefficient_corridor];
        }
        
        public function &getCoord($polygon='') {
            
            $matches=array();
            
            if ( is_string($polygon) && trim($polygon)<>'') {
                
           
              preg_match_all('/([0-9\.\,\s])+/', $polygon, $matches,PREG_SET_ORDER);            
            
              foreach ($matches as $key=>$val) {
                list($map_lat,$map_long)= explode(',',$val[0]);                
                $map_lats[]=$map_lat;
                $map_longs[]=$map_long;
              }
            
              $max_lat  = max($map_lats); $min_lat  = min($map_lats);
              $max_long = max($map_longs); $min_long = min($map_longs);

              return (object) array( "lat"=>array("max"=>floatval($max_lat),"min"=>floatval($min_lat)),
                           "long"=>array("max"=>floatval($max_long),"min"=>floatval($min_long)) );
           } else {
              return false;
           }
        }
        
        public function createTitle() {
            return "Аренда офиса ".( $this->area ? $this->area." м2 " : "")
                 .( $this->title ? "в ".trim($this->title)." " : "")
                 .( $this->district 
                    ? (mb_strtolower($this->district->title,'UTF-8')=='центр' ? 'в' : 'на').' '.mb_strtolower(trim($this->district->title), 'UTF-8').'е Москвы' 
                    : 'в Москве')
                 .( $this->metro->title ? ', рядом с метро '.trim($this->metro->title) : ''); 
        }
        
        public function createDescription() {
            return $this->anons;
        }
        
        public function createKeywords() {            
            $meta = HRu::create_meta($this->seo_title.' '.$this->anons.' '.$this->detile, null, $this->anons);                                       
            return $meta['keywords'];
        }
        
        public function beforeSave() {
           if ($this->street_id) $this->newstreet = null;  
           return parent::beforeSave();
        }            
        
        public function getStatusForClient($client_id) {  
           $clientRealestate=$this->realestateClients(array('condition'=>'client_id='.$client_id));
           return $clientRealestate[0]->status->title;           
        }
        
        public function getProperty($label=false,$main=null,$rasdel='&nbsp/ ',$iscur=false) {
            $list = "";
            if ($main) {
                $list = $main;
            }else{
                $props = CHtml::listData(Properties::model()->findAll( 
                                    array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                          "select"=>"t.id,t.title",
                                          "order"=>"t.sort")
                                          ), "id", "title");
                if ($props) {            
                    $cnt=count($this->realestateProperties);
                    foreach ($this->realestateProperties as $key=>$realestatePropertie) { 
                        if ($cnt<>($key+1)) $list.=CHtml::encode($props[$realestatePropertie->property_id]).$rasdel;
                        else $list.=CHtml::encode($props[$realestatePropertie->property_id]);
                    }
                    //if ($cnt>1) {
                        //$list = substr(trim($list),0,-1);// В случае cnt == null
                        //$list = substr($list,0,-mb_strlen($rasdel,'UTF-8'));
                    //}
                    $list = $iscur ? HRu::cutstr($list,$iscur,false,'...',',') : $list;
                }
            }    
            if (!empty($list)) {
                return ($label ? "<b>".Yii::t("all","Свойства").":</b> " : "").$list;                
            } else {
                return "";
            }   
        }  
        
        public function getDestination($label=false,$main=null,$rasdel='&nbsp/ ',$iscur=false) {
            $list = "";
            if ($main) {
                $list = $main;
            }else{    
                if ( $this->realestateDestinations ) {
                    $cnt=count($this->realestateDestinations);
                    foreach ($this->realestateDestinations as $key=>$realestateDestination) {                    
                          if ($cnt<>($key+1)) $list.=CHtml::encode($realestateDestination->title).$rasdel;
                          else $list.=CHtml::encode($realestateDestination->title);
                    }  
                    //if ($cnt>1) {
                        //$list = substr(trim($list),0,-1);
                        //$list = substr($list,0,-mb_strlen($rasdel,'UTF-8')); // В случае cnt !== null                        
                    //}
                    $list = $iscur ? HRu::cutstr($list,$iscur,false,'...',',') : $list; 
                }
            }
            if (!empty($list)) {
                 return ($label ? "<b>".CHtml::encode(Yii::t("all","Назначение")).":</b> " : "").$list;
            } else {
                 return "";
            }   
        }                  
        
        public function getRemoteness($islab=true,$abbr='м.') {            
            $list = '';
            $cnt = count($this->metros);
            foreach ($this->metros as $key=>$metro) {                   
                  if ($cnt<>($key+1)) $list.="<i>".$abbr.$metro->metro->title."</i>&nbsp;-&nbsp;".$metro->remoteness."&nbsp;<i>".$metro->unit->short_title."</i>, ";
                  else $list.="<i>".$abbr.$metro->metro->title."</i>&nbsp;-&nbsp;".$metro->remoteness."&nbsp;<i>".$metro->unit->short_title."</i>";
            }
            if (!empty($list)) {
                if ($islab) {
                    return "<b>".CHtml::encode(Yii::t("all","Удаленность от метро")).":</b> ".$list;
                }else{
                    return $list;
                }
            }else{
                return "";
            }    
        }  
        
        public function getMetros($islab=true,$abbr='ст.м.') {            
            
            $list = '';
            $cnt = count($this->metros);
            $abbr = $islab ? "" : $abbr;
            
            foreach ($this->metros as $key=>$metro) {                   
                  if ($cnt<>($key+1)) $list.=$this->getHtmlInfos($abbr.$metro->metro->title,false,$islab);
                  else $list.=$this->getHtmlInfos($abbr.$metro->metro->title,true,$islab);
            }
            
            if (!empty($list)) {
                if ($islab) {
                    return "<b>".CHtml::encode(Yii::t("all","Ст.метро")).":</b> ".$list;
                }else{
                    return $list;
                }
            }else{
                return "";
            }    
        }  
        
        public function getRemots($islab=true) {            
            
            $list = '';
            $cnt = count($this->metros);
            
            foreach ($this->metros as $key=>$metro) {     
                  if ($cnt<>($key+1)) $list.=$this->getHtmlInfos($metro->remoteness,false,$islab);
                  else $list.=$this->getHtmlInfos($metro->remoteness,true,$islab);
            }
            
            if (!empty($list)) {
                if ($islab) {
                    return "<b>".CHtml::encode(Yii::t("all","Удаленность от ст.метро")).":</b> ".$list;
                }else{
                    return $list;
                }
            }else{
                return "";
            }    
        }  
        
        private function getHtmlInfos($body=null,$isend=false,$islab=false) {
            if (!$islab) return "<div class='fs-9 lh-10'>"."<i>".str_replace(' ','&nbsp;',$body)."</i>"."</div>";
            else return "<i>".$body."</i>".($isend ? ", " : "");
        }
        
        public function getUnits($islab=true) {            
            
            $list = '';
            $cnt = count($this->metros);
            $abbr = $islab ? "" : $abbr;
            
            foreach ($this->metros as $key=>$metro) {                   
                  if ($cnt<>($key+1)) $list.=$this->getHtmlInfos($metro->unit->short_title,false,$islab);
                  else $list.=$this->getHtmlInfos($metro->unit->short_title,true,$islab);
            }
            
            if (!empty($list)) {
                if ($islab) {
                    return "<b>".CHtml::encode(Yii::t("all","Способы")).":</b> ".$list;
                }else{
                    return $list;
                }
            }else{
                return "";
            }    
        }  
        
        public function getName($is_seo=false) {
            if ($is_seo) {
                 return $this->seo_title;
            } else {
                 return ($this->district ? $this->title.' Аренда '.mb_strtolower($this->realestateVid->namewhat,'UTF-8').' '.round($this->area).' '.Yii::t('all','м2')
                                        .( mb_strtolower(trim($this->realestateVid->namewhat),'UTF-8')!==mb_strtolower(trim($this->realestateType->nameed),'UTF-8') ? ' в '.mb_strtolower(trim($this->realestateType->namewhere),'UTF-8') : '')
                                            .' '.(mb_strtolower($this->district->title,'UTF-8')=='центр' ? 'в' : 'на').' '.mb_strtolower($this->district->title, 'UTF-8').'е Москвы'                    
                          : $this->title.' Аренда '.mb_strtolower($this->realestateVid->nameov,'UTF-8').' '.round($this->area).' '.Yii::t('all','м2')
                                    .( mb_strtolower(trim($this->realestateVid->title),'UTF-8')!==mb_strtolower(trim($this->realestateType->nameed),'UTF-8') ? ' в '.mb_strtolower(trim($this->realestateType->namewhere),'UTF-8') : '')
                                    .' '.'Москвы'); 
            } 
        }
        
        public function getCoefficient($is_label=false,$is_short=false) {
             
            $label = ($is_short ? 'корид.коэфф.' : 'коридорный коэффициент');            
            if (!$this->coefficient_corridor) return;
            
            if ($is_label) {
                 return $label.' '.$this->getCoefficientCorridor().'%';
            } else {
                 return $this->getCoefficientCorridor().'%';
            } 
        }
}