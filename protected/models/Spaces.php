<?php
/**
 * This is the model class for table "spaces".
 *
 * The followings are the available columns in table 'spaces':
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
 * @property string $tax_number
 * @property integer $fav
 * @property integer $space_type_id
 * @property string $title
 * @property integer $space_class_id
 * @property integer $space_vid_id
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
 *
 * The followings are the available model relations:
 * @property ClientSpaces[] $clientSpaces
 * @property SpaceFotos[] $spaceFotos
 * @property SpacePresentations[] $spacePresentations
 * @property SpaceProperties[] $spaceProperties
 * @property SpaceSimilarities[] $spaceSimilarities
 * @property SpaceSimilarities[] $spaceSimilarities1
 * @property SpaceRepresentatives[] $spaceRepresentatives
 * @property Commissions $commission
 * @property ContractTypes $contractType
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
 * @property SpaceClasses $spaceClass
 * @property SpaceTypes $spaceType
 * @property SpaceVids $spaceVid
 * @property Taxs $tax
 * @property Units $unit
 */
class Spaces extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Spaces the static model class
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
		return 'spaces';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('area, price, address, district_id, metro_id, 
                               space_vid_id, space_class_id, planning_id, 
                               valute_id, tax_id, parking_id, representative_id, 
                               procent_commission, commission_id, uid, sid, nid', 'required')*/
                        array('address, district_id, metro_id, 
                               space_vid_id, space_class_id,  
                               representative_id, 
                               uid, sid, nid', 'required'),
			array('district_id, pic_oreginal_id, pic_scr_id, pic_anons_id, 
                               pic_detile_id, unit_id, in_stock, metro_id, planning_id, 
                               tax_id, parking_id, cnt_parking_place, representative_id, 
                               commission_id, contract_type_id, fav, space_type_id, 
                               space_class_id, space_vid_id, is_resize, operation_id, 
                               is_separate_entrance, valute_id, remoteness, 
                               coefficient_corridor, create_user, update_user', 'numerical', 'integerOnly'=>true),
                        array('coefficient_corridor', 'length', 'max'=>3),                    
                        array('procent_commission', 'length', 'max'=>6),
			array('number_tax', 'length', 'max'=>11),                        
                      /*array('picOreginal', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picScr', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picAnons', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),
			array('picDetile', 'file', 'types'=>'jpg, jpeg, gif, png', 'maxSize' => 1048576,'allowEmpty'=>true),*/
			array('area, price, remoteness, unit_value, cnt_parking_place', 'length', 'max'=>10),
			array('telephone, site, contract_number, tax_number, map_latitude, map_longitude, address', 'length', 'max'=>255),
			array('title,uid,sid,nid', 'length', 'max'=>75),
			array('date_rang, date_release, create_date, update_date, anons, detile, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, nid, district_id, number_tax, area, price, pic_oreginal_id, 
                               pic_scr_id, pic_anons_id, pic_detile_id, remoteness, 
                               unit_id, unit_value, date_rang, date_release, in_stock, metro_id, 
                               planning_id, tax_id, parking_id, cnt_parking_place, telephone, site, 
                               representative_id, commission_id, procent_commission, contract_type_id, 
                               contract_number, tax_number, fav, space_type_id, title, 
                               space_class_id, space_vid_id, anons, detile, description, 
                               map_latitude, map_longitude, is_resize, operation_id, address, 
                               is_separate_entrance, valute_id, coefficient_corridor, create_date, update_date, create_user, update_user', 'safe', 'on'=>'search'),
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
			'clientSpaces' => array(self::HAS_MANY, 'ClientSpaces', 'space_id'),
			'spaceFotos' => array(self::HAS_MANY, 'SpaceFotos', 'space_id'),                        
			'spacePresentations' => array(self::HAS_MANY, 'SpacePresentations', 'space_id'),
			'spaceProperties' => array(self::HAS_MANY, 'SpaceProperties', 'space_id'),
			'spaceSimilarities' => array(self::HAS_MANY, 'SpaceSimilarities', 'similaries_id'),
			'spaceSimilarities1' => array(self::HAS_MANY, 'SpaceSimilarities', 'space_id'),
                        'spacesSimilarities' => array(self::MANY_MANY, 'Spaces','space_similarities(space_id, similaries_id)'),                        
                        'spaceRepresentatives' => array(self::HAS_MANY, 'SpaceRepresentatives', 'space_id'),
                        'spacesRepresentatives' => array(self::MANY_MANY, 'Representatives','space_representatives(space_id, representative_id)'),                        
			'commission' => array(self::BELONGS_TO, 'Commissions', 'commission_id'),
			'contractType' => array(self::BELONGS_TO, 'ContractTypes', 'contract_type_id'),
			'district' => array(self::BELONGS_TO, 'Districts', 'district_id'),
                        'picOreginal' => array(self::BELONGS_TO, 'Files', 'pic_oreginal_id'),
			'picScr' => array(self::BELONGS_TO, 'Files', 'pic_scr_id'),
			'picAnons' => array(self::BELONGS_TO, 'Files', 'pic_anons_id'),
			'picDetile' => array(self::BELONGS_TO, 'Files', 'pic_detile_id'),
			'metro' => array(self::BELONGS_TO, 'Metros', 'metro_id'),
			'parking' => array(self::BELONGS_TO, 'Parkings', 'parking_id'),
			'planning' => array(self::BELONGS_TO, 'Plannings', 'planning_id'),
                        'operation' => array(self::BELONGS_TO, 'Operations', 'operation_id'),
                        'valute' => array(self::BELONGS_TO, 'Valutes', 'valute_id'),
			'representative' => array(self::BELONGS_TO, 'Representatives', 'representative_id'),
			'spaceClass' => array(self::BELONGS_TO, 'SpaceClasses', 'space_class_id'),
			'spaceType' => array(self::BELONGS_TO, 'SpaceTypes', 'space_type_id'),
			'spaceVid' => array(self::BELONGS_TO, 'SpaceVids', 'space_vid_id'),
			'tax' => array(self::BELONGS_TO, 'Taxs', 'tax_id'),
			'unit' => array(self::BELONGS_TO, 'Units', 'unit_id'),
                        'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user'),
                        'createUser' => array(self::BELONGS_TO, 'Users', 'create_user'),
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
                        'title'                 => Yii::t('label','Title'),
                        'act'                   => Yii::t('label','Act'),
                        'del'                   => Yii::t('label','Del'),
			'district_id'           => Yii::t('label','District'),
			'number_tax'            => Yii::t('label','Number Tax'),
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
			'tax_number'            => Yii::t('label','Tax Number'),
			'fav'                   => Yii::t('label','Fav'),
			'space_type_id'         => Yii::t('label','Space Type'),			
			'space_class_id'        => Yii::t('label','Space Class'),
			'space_vid_id'          => Yii::t('label','Space Vid'),
			'anons'                 => Yii::t('label','Anons'),
			'detile'                => Yii::t('label','Detile'),
			'description'           => Yii::t('label','Desc'),
			'map_latitude'          => Yii::t('label','Map Latitude'),
			'map_longitude'         => Yii::t('label','Map Longitude'),
                        'operation_id'          => Yii::t('label','Operation'),
                        'address'               => Yii::t('label','Address'),
                        'is_separate_entrance'  => Yii::t('label','Is Separate Entrance'),
                        'valute_id'             => Yii::t('label','Valute'),
                        'spaceFotos'            => Yii::t('label','Space Fotos'),
			'spacePresentations'    => Yii::t('label','Space Presentations'),
			'spaceProperties'       => Yii::t('label','Space Properties'),
			'spaceSimilarities'     => Yii::t('label','Space Similarities'),
			'spaceSimilarities1'    => Yii::t('label','Space Similarities1'),
                        'spaceRepresentatives'  => Yii::t('label','Space Representatives'),
                        'coefficient_corridor'  => Yii::t('label','Coefficient of corridor'),                       
                        'picOreginal'           => Yii::t('label','Pic Oreginal'),
                        'picScr'                => Yii::t('label','Pic Scr'),
                        'picAnons'              => Yii::t('label','Pic Anons'),
                        'picDetile'             => Yii::t('label','Pic Detile'),
			'create_date'           => Yii::t('label','Create Date'),
			'update_date'           => Yii::t('label','Update Date'),     
                 	'create_user'           => Yii::t('label','Create User'),
			'update_user'           => Yii::t('label','Update User'),     
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
                $criteria->compare('uid',$this->uid); 
                $criteria->compare('sid',$this->sid); 
                $criteria->compare('nid',$this->nid); 
                
		$criteria->compare('district_id',$this->district_id); 
                
		$criteria->compare('number_tax',$this->number_tax,true);
                
		$criteria->compare('area',$this->area,true);                
                                
		$criteria->compare('price',$this->price,true);
                $criteria->compare('is_resize',$this->is_resize);
                $criteria->compare('pic_oreginal_id',$this->pic_oreginal_id);                  
                $criteria->compare('picOreginal.id', $this->pic_oreginal_id);                                
		$criteria->compare('pic_scr_id',$this->pic_scr_id);    
                $criteria->compare('pic_anons_id',$this->pic_anons_id);		
		$criteria->compare('pic_detile_id',$this->pic_detile_id);
		$criteria->compare('remoteness',$this->remoteness,true);
                $criteria->compare('unit_id',$this->unit_id);

		$criteria->compare('unit_value',$this->unit_value,true);
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
                
                $criteria->compare('act', $this->act, true); 
                $criteria->compare('del', $this->del, true); 
                
		$criteria->compare('metro_id',$this->metro_id);
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
		$criteria->compare('tax_number',$this->tax_number,true);
		$criteria->compare('fav',$this->fav );
		$criteria->compare('space_type_id',$this->space_type_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('space_class_id',$this->space_class_id);

                $criteria->compare('space_vid_id',$this->space_vid_id);

		$criteria->compare('anons',$this->anons,true);
		$criteria->compare('detile',$this->detile,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('map_latitude',$this->map_latitude,true);
		$criteria->compare('map_longitude',$this->map_longitude,true);
                $criteria->compare('operation_id',$this->operation_id);
                $criteria->compare('address',$this->address);
                $criteria->compare('is_separate_entrance',$this->is_separate_entrance);                                
                $criteria->compare('valute_id',$this->valute_id); 

                $criteria->compare('coefficient_corridor',$this->coefficient_corridor,true);                                 

                //$criteria->compare('district.id',$this->district_id);                 
		//$criteria->compare('unit.id',$this->unit_id);
                //$criteria->compare('metro.id',$this->metro_id);                
                //$criteria->compare('planning.id',$this->planning_id);                
                //$criteria->compare('tax.id',$this->tax_id);                
                //$criteria->compare('parking.id',$this->parking_id);                
                //$criteria->compare('spaceClass',$this->space_class_id);                                
                //$criteria->compare('spaceVid.id',$this->space_vid_id);		                
                //$criteria->compare('valute.id',$this->valute_id); 
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
        
        public function &getCoord($polygon) {
            
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
        }
        
}