<?php

/**
 * This is the model class for table "streets".
 *
 * The followings are the available columns in table 'streets':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $SOCR
 * @property string $index
 * @property string $GNINMB
 * @property string $UNO
 * @property string $OCATD
 */
class Streets extends CActiveRecord
{        
        public $title;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Streets the static model class
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
		return 'streets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code', 'length', 'max'=>17),
                        array('sid, uid', 'length', 'max'=>75),  
			array('name,title', 'length', 'max'=>40),
			array('SOCR', 'length', 'max'=>10),
			array('index', 'length', 'max'=>6),
			array('GNINMB, UNO', 'length', 'max'=>4),
			array('OCATD,grid', 'length', 'max'=>11),
                        array('seo_title', 'length', 'max'=>150),// (60-80) 80
                        array('anons, seo_desc', 'length', 'max'=>450), // (200-450) 700
                        array('seo_keywords', 'length', 'max'=>300), // (175) 250
                        array('detile,description', 'length', 'max'=>6000), // (3000) 6000                         
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, sid, code, name, SOCR, index, GNINMB, UNO, OCATD, title, grid, anons, detile, description, seo_keywords, seo_desc, seo_title', 'safe', 'on'=>'search'),
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
		);
	}

        public function scopes()
        {            
            return array(        
                'sitemap'=>array('select'=>'t.id, t.title, t.grid, t.SOCR, t.name', 'condition'=>' EXISTS (SELECT * FROM realestates r WHERE r.street_id = t.id AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL)))'/*'(create_date <= NOW())and'.'(in_stock=1)'*//*'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'*/, 'order'=>'t.id ASC'),
                //'sitemap_joinreal'=>array('select'=>'DISTINCT t.id, t.title, t.grid, t.SOCR, t.name', 'join'=>'LEFT JOIN realestates r ON r.street_id = t.id', 'condition'=>'r.street_id = t.id AND ((r.act=1)OR(r.act is NULL))AND((r.del=0)OR(r.del is NULL))', 'order'=>'t.id ASC'),
                'sitemap_noexreal'=>array('select'=>'t.id, t.title, t.grid, t.SOCR, t.name', 'order'=>'t.id ASC'),
            );
        }
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'            => Yii::t('label','ID'),
                        'sid'           => Yii::t('label','Sid'),
                        'uid'           => Yii::t('label','UID'),
			'code'          => Yii::t('label','Code'),
			'name'          => Yii::t('label','Name'),
			'SOCR'          => Yii::t('label','Socr'),
			'index'         => Yii::t('label','Index'),
			'GNINMB'        => Yii::t('label','Gninmb'),
			'UNO'           => Yii::t('label','Uno'),
			'OCATD'         => Yii::t('label','Ocatd'),
                        'title'         => Yii::t('label','Title'),
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('SOCR',$this->SOCR,true);
		$criteria->compare('index',$this->index,true);
		$criteria->compare('GNINMB',$this->GNINMB,true);
		$criteria->compare('UNO',$this->UNO,true);
		$criteria->compare('OCATD',$this->OCATD,true);
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
        
        public function getFullName($padeg=null, $isname=true, $ucfirst=false) {
            switch ($this->SOCR) {
                case 'ул':
                    if      ( $padeg=='на' ) { $fullOnName = 'улице'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'улице'; }
                    else    { $fullOnName = 'улица'; }                      
                    break;
                case 'аллея':
                    if      ( $padeg=='на' ) { $fullOnName = 'аллее'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'аллее'; }
                    else    { $fullOnName = 'аллея'; }                    
                    break;
                case 'б-р':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'бульваре'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'бульвару'; }
                    else    { $fullOnName = 'бульвар'; }                    
                    break;                
                case 'городок':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'городке'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'городку'; }
                    else    { $fullOnName = 'городок'; }                    
                    break;                     
                case 'ш':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'шоссе'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'шоссе'; }
                    else    { $fullOnName = 'шоссе'; }                    
                    break; 
                case 'кв-л':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'квартале'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'кварталу'; }
                    else    { $fullOnName = 'квартал'; }                    
                    break;                                          
                case 'наб':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'набережной'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'набережной'; }
                    else    { $fullOnName = 'набережная'; }                    
                    break;                                              
                case 'пер':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'переулке'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'переулку'; }
                    else    { $fullOnName = 'переулок'; }                    
                    break;                
                case 'пл':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'площаде'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'площади'; }
                    else    { $fullOnName = 'площадь'; }                    
                    break;                        
                case 'пр-кт':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'проспекте'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'проспекту'; }
                    else    { $fullOnName = 'проспект'; }                    
                    break;                                            
                case 'проезд':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'проезде'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'проезду'; }
                    else    { $fullOnName = 'проезд'; }                    
                    break;                                               
                case 'просек':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'просеке'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'просеке'; }
                    else    { $fullOnName = 'просека'; }                    
                    break;   
                case 'туп':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'тупике'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'тупике'; }
                    else    { $fullOnName = 'тупик'; }                    
                    break; 
                case 'д':                    
                    if      ( $padeg=='на' ) { $fullOnName = 'дворе'; }
                    else if ( $padeg=='по' ) { $fullOnName = 'двору'; }
                    else    { $fullOnName = 'двор'; }                           
                default:
                    break;
            }
            $fullOnName = ( $ucfirst ? mb_strtoupper(mb_substr($fullOnName, 0, 1, 'UTF-8'), 'UTF-8').mb_strtolower(mb_substr($fullOnName, 1, mb_strlen($fullOnName, 'UTF-8'), 'UTF-8'),'UTF-8') : $fullOnName );
            return ($padeg ? $padeg.' '.$fullOnName : $fullOnName).($isname ? ' '.$this->name : '') ;
        }
        
        /*public function mb_ucfirst($str, $enc = 'UTF-8') { 
            return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc).mbstrtolower(mb_substr($str, 1, mb_strlen($str, $enc), $enc),$enc); 
        }*/
   
        public function getSocrName() {
            return $this->SOCR.(     $this->SOCR=='проезд' || $this->SOCR=='городок' || $this->SOCR=='аллея' 
                                             ? ' ' 
                                             : '.').$this->name;
        }
        
        public function getListType() {
            return 'улице (<i>'.implode(' / ',array('аллее','бульваре','городке','шоссе','квартале','набережной','переулке','площаде','проспекте','проезде','просек','тупике'/*,'дворе'*/)).'</i>) ';            
        }
        
        public function createTitle() {
            return $this->getFullName();//.", ".$this->getSocrName(); 
        }
        
        public function createDescription() {
            return $this->anons;
        }
        
        public function createKeywords() {            
            $meta = HRu::create_meta($this->seo_title.' '.$this->anons.' '.$this->detile.' '.$this->detile, null, $this->anons);                                       
            return $meta['keywords'];
        }
        
        public function getLinkMapTitle() {
            return 'Аренда коммерческой недвижимости в Москве, '.$this->getFullName('на');
        }
        public function getLinkMapText() {
            //return 'Аренда коммерческой недвижимости, '.$this->title;//getFullName('на');
            return 'Коммерческая недвижимость, '.$this->title;//getFullName('на');
        }
        public function getLinkMapAlt() {
            return 'Аренда коммерческой недвижимости, '.$this->title;//getFullName('на');
        }  
}