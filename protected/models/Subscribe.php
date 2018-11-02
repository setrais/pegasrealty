<?php

/**
 * This is the model class for table "subscribe".
 *
 * The followings are the available columns in table 'subscribe':
 * @property integer $id
 * @property string $email
 * @property integer $typesubs_id
 * @property integer $lastsubs_id
 * @property string $lastsubs_date
 * @property string $description
 * @property integer $del
 * @property integer $act
 * @property integer $fid
 *
 * The followings are the available model relations:
 * @property TypeSubscribe $typesubs
 * @property Users $email0
 */
class Subscribe extends CActiveRecord
{
        public $lastsubs_date_from;
        public $lastsubs_date_to;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subscribe the static model class
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
		return 'subscribe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, typesubs_id', 'required'),
			array('typesubs_id, lastsubs_id, del, act', 'numerical', 'integerOnly'=>true),
                        array( 'lastsubs_date', 'match', 'pattern'=>'/^(((0[1-9]|[12]\d|3[01])\.(0[13578]|1[02])\.((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\.(0[13456789]|1[012])\.((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\.02\.((19|[2-9]\d)\d{2}))|(29\.02\.((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/', 'allowEmpty'=>true, 'message'=>'Некорректно указана дата.'),                   
                        // !@ TODO В Будущем пересмотреть метод enableClientValidation=true не работает для даты
                        array( 'lastsubs_date', 'date', 'format'=>'dd.MM.yyyy', 'enableClientValidation'=>false, 'allowEmpty'=>true, 'message'=>'Некорректно указана дата.'),
                        array('email','email', 'message' => 'Указан неверный адрес электронной почты.'),
			array( 'email', 'length', 'max'=>255),
			array( 'description,fid', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'id, email, typesubs_id, lastsubs_id, lastsubs_date, 
                                lastsubs_date_from, lastsubs_date_to, description, 
                                del, act, fid', 'safe', 'on'=>'search'),
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
			'typesubs' => array(self::BELONGS_TO, 'TypeSubscribe', 'typesubs_id'),
			'email0'   => array(self::BELONGS_TO, 'Users', 'email'),                        
                        'filter'   => array(self::BELONGS_TO, 'RealestateFilters', 'fid'),                         
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'email' => Yii::t('label','Email'),
			'typesubs_id' => Yii::t('label','Тип рассылки'),
			'lastsubs_id' => Yii::t('label','Посл. Ид'),
			'lastsubs_date' => Yii::t('label','Посл. Дата'),
                        'lastsubs_date_from'=> Yii::t('label','Дата последнего везита c'),
                        'lastsubs_date_to'  => Yii::t('label','Дата последнего везита по'),
			'description' => Yii::t('label','Description'),
			'del' => Yii::t('label','Del'),
			'act' => Yii::t('label','Act'),
			'fid' => Yii::t('label','Фильтер'),
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('typesubs_id',$this->typesubs_id);
		$criteria->compare('lastsubs_id',$this->lastsubs_id);
		$criteria->compare('lastsubs_date',$this->lastsubs_date,true);
                
                if ($this->lastsubs_date_from) :
                    $criteria->addCondition("UNIX_TIMESTAMP(lastsubs_date) >= ".strtotime($this->lastsubs_date_from));
                endif;
                if ($this->lastsubs_date_to) :
                    $criteria->addCondition("UNIX_TIMESTAMP(lastsubs_date) <= ".strtotime($this->lastsubs_date_to));
                endif;                
		$criteria->compare('description',$this->description,true);                
		$criteria->compare('del',$this->del);
		$criteria->compare('act',$this->act);
		$criteria->compare('fid',$this->fid);
                $criteria->order='t.id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getSection() {
                switch ($this->typesubs_id) {
                    case 4;
                        $section = Iblocks::model()->findByPk(str_replace('iblocks','',$this->fid));    
                        break;
                    case 5;
                        $section = Iblocks::model()->findByPk(str_replace('iblocks','',$this->fid)); 
                        break;
                    case 8;
                        $section = RealestateFilters::model()->findByPk($this->fid);      
                        break;
                }
            return $section;   
        }        
        
        public function getListSection() {
               $list = array();
               switch ($this->typesubs_id) {
                   case 4;
                       $articles=  Iblocks::model()->findAll(
                                   array( 'condition'=>'(typesIblock.id=4)AND(t.grid IS NULL OR t.grid=0)AND(t.act IS NULL OR t.act=1)AND(t.del IS NULL OR t.del=0)',
                                            'order'=>'t.sort',
                                            'with'=>'typesIblock',
                                            'together'=>true,  
                                            'select'=>"t.id,name"));                        
                        foreach($articles as $article) {
                            $list[] = array('id'=>Iblocks::tableName().$article->id,'text'=>$article->name,'group'=>'Cтатьи');
                        }
                        break;
                   case 5;
                       $news= Iblocks::model()->findAll(
                                        array('condition'=>'(typesIblock.id=5)AND(t.grid IS NULL OR t.grid=0)AND(t.act IS NULL OR t.act=1)AND(t.del IS NULL OR t.del=0)',
                                              'order'=>'t.sort',
                                              'with'=>'typesIblock',
                                              'together'=>true,  
                                              'select'=>"t.id,t.name"));                        
                        foreach($news as $new) {
                            $list[] = array('id'=>Iblocks::tableName().$new->id,'text'=>$new->name,'group'=>'Новости');
                        }
                        break;
                   case 8;
                         $filters = RealestateFilters::model()->findAll(array("order"=>"name",
                                            'select'=>"id,name"));                        
                        foreach($filters as $filter) {
                            $list[] = array('id'=>  RealestateFilters::tableName().$filter->id,'text'=>$filter->name,'group'=>'Объявления');                                                        
                        }
                        break;
               }
               return $list;
        }

        /*public function getListObject() {                
            // Ид.объекта
            $tid = substr($this->gid,strlen('order'));
            $objects = Object::model()->findAll();
            foreach ($objects as $object) {  
                if ( !$object->sorder || in_array($tid,explode(',',$object->sorder))) { 
                     $group =  Order::model()->findByPk(intval($tid));
                     $list[] = array('id'=>'object'.$object->objectid, 'text'=>$object->name, 'group'=>$group->name);                                                        
                }
            }
            return $list;
        }     
                    
        public function getObject() {
                switch ($this->typesubs_id) {
                    case 4;
                        $object = null;      
                        break;
                    case 5;
                        $object = null;                        
                        break;
                    case 8;
                        $object = Object::model()->findByPk(str_replace('object','',$this->oid));                        
                        break;
                }
            return $object;   
        }*/             
 
        protected function afterFind() {              
            $this->lastsubs_date = $this->lastsubs_date ? date('d.m.Y', strtotime($this->lastsubs_date)) : null;  
            parent::afterFind();
        }
        
        public function save($runValidation=true,$attributes=null)
        {
            if(!$runValidation || $this->validate($attributes)) {                
                //$this->lastsubs_date = $this->lastsubs_date ? date('Y-m-d', strtotime($this->lastsubs_date)) : null;  
                return $this->getIsNewRecord() ? $this->insert($attributes) : $this->update($attributes);
            } else {
                return false;
            }
        }
}