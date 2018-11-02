<?php

/**
 * This is the model class for table "representatives".
 *
 * The followings are the available columns in table 'representatives':
 * @property integer $id
 * @property string $name
 * @property string $fio
 * @property string $site
 * @property string $telephone
 * @property string $fax
 * @property string $email
 * @property string $telephone_1
 * @property string $telephone_2
 * @property string $telephone_3
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property string $desc
 *
 * The followings are the available model relations:
 * @property realestateRepresentatives[] $realestateRepresentatives
 */
class Representatives extends CActiveRecord
{
        public $isowner;
        public $realestates;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Representatives the static model class
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
		return 'representatives';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(                    
                        array('name, telephone', 'required'),                        
			array('sort, act, del', 'numerical', 'integerOnly'=>true),
			array('name, fio, site, telephone,email', 'length', 'max'=>255),
                        array('email','email'),
                        array('site','url'),
                        array('telephone_1,telephone_2,telephone_3,fax', 'length', 'max'=>75),
			array('create_date, update_date, desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, fio, site, telephone, telephone_1, telephone_2, telephone_3, fax, email, sort, act, del, create_date, update_date, desc, isowner, realestates', 'safe', 'on'=>'search'),
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
                    'realestateRepresentatives' => array(self::HAS_MANY, 'RealestateRepresentatives', 'representative_id'),     
                    'realestateOwners' => array(self::HAS_MANY, 'Realestates', 'representative_id'),   
                    'representativesCnt' => array(self::STAT, 'RealestateRepresentatives', 'representative_id'),
                    'ownersCnt' => array(self::STAT, 'Realestates', 'representative_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'name' => Yii::t('label','Name'),
			'fio' => Yii::t('label','Full Name'),
			'site' => Yii::t('label','Site'),
			'telephone' => Yii::t('label','Telephone'),
                        'telephone_1' => Yii::t('label','Other Telephone 1'),
                        'telephone_2' => Yii::t('label','Other Telephone 2'),
                        'telephone_3' => Yii::t('label','Other Telephone 3'),
                        'fax' => Yii::t('label','Fax'),
                        'email'=> Yii::t('label','Email'),
			'sort' => Yii::t('label','Sort'),
			'act' => Yii::t('label','Act'),
			'del' => Yii::t('label','Del'),
			'create_date' => Yii::t('label','Create Date'),
			'update_date' => Yii::t('label','Update Date'),
			'desc' => Yii::t('label','Desc'),
                        'isowner'=>Yii::t('label','Собственник'),
                        'realestates'=>Yii::t('label','Недвижимость'),
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
                $sort = new CSort;
                $sort->attributes = array(
                            'isowner'=>array(
                                'asc'=>'EXISTS (SELECT * FROM realestates owner WHERE owner.representative_id=t.id)',
                                'desc'=>'EXISTS (SELECT * FROM realestates owner WHERE owner.representative_id=t.id) desc',
                            ),
                            '*'                                
                );
                
                
                /* Default Sort Order*/
                /*$sort->defaultOrder= array(
                    'isowner'=>CSort::SORT_ASC,
                );*/
                
		$criteria->compare('id',$this->id);		
		$criteria->compare('name',$this->name,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('telephone',$this->telephone,true);
                $criteria->compare('telephone_1',$this->telephone_1,true);
                $criteria->compare('telephone_2',$this->telephone_2,true);
                $criteria->compare('telephone_3',$this->telephone_3,true);
                $criteria->compare('fax',$this->fax,true);
                $criteria->compare('email',$this->email,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);             
                if ($this->create_date) {
                    $criteria->compare('create_date',  date('Y-m-d',  strtotime($this->create_date)),true);
                }
                if ($this->update_date) {
                    $criteria->compare('update_date',date('Y-m-d',  strtotime($this->update_date)),true);
                }
		//$criteria->compare('create_date',$this->create_date,true);
		//$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('desc',$this->desc,true);
                $criteria->compare('EXISTS (SELECT * FROM realestates owner WHERE owner.representative_id=t.id)',$this->isowner);
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort
		));

       }
       
       public function getInfo() {
           return $this->getShortInfo()                   
                             .($this->site ? ' Cайт: '.$this->site.' ' : '')
                             .($this->email ? ' E-mail: '.$this->email.' ' : '')
                             .($this->telephone_1 || $this->telephone_2 || $this->telephone_3 ? ' Доп.тел.: '
                                    .( $this->telephone_1 ? $this->telephone_1.'; ' : '')
                                    .( $this->telephone_2 ? $this->telephone_2.'; ' : '')
                                    .( $this->telephone_3 ? $this->telephone_3.'; ' : '') : '')
                             .($this->desc ? ' Инфо: '.$this->desc.' ' : '');
       }
       
       public function getShortInfo() {
           return $this->name.' - #'.$this->id.'  | '
                             .($this->fio ? ' ФИО: '.$this->fio.' ' : '')
                             .($this->telephone ? ' Тел.: '.$this->telephone.' ' : '')
                             .($this->fax ? ' Факс: '.$this->fax.' ' : '');                             
       }       
       
       public function beforeSave() {
           
           if ($this->create_date) $this->create_date=date('Y-m-d',strtotime($this->create_date));
           else $this->create_date = date('Y-m-d');
           
           if ($this->update_date) $this->update_date=date('Y-m-d',strtotime($this->update_date));
           else $this->update_date = date('Y-m-d');
           
           return parent::beforeSave();
       }       
          
       public function getRealestates() {
           if ($this->realestateOwners) {
               //return implode('/',CHtml::listData($this->realestateOwners, 'id', 'id'));
               foreach ($this->realestateOwners as $real) {
                   $list[] = CHtml::link( ($real->in_stock ? '<span class="c-red">'.$real->id.'</span>' : $real->id), '/'.$real->picOreginal->original_name /*Yii::app()->createUrl('/realestates/view', array('id'=>$real->id))*/,
                                                array('title'=>$real->title
                                                              .($real->date_rang || $real->date_release ? ' - ' : '')
                                                              .($real->date_rang ? 'Дата прозвона: '.date('m.d.Y',strtotime($real->date_rang)) : '')
                                                              .($real->date_release ? ' Дата освобождения: '.date('m.d.Y',strtotime($real->date_release)) : '')
                                                    , 'class'=>'fancyImage'));
               }
               return implode('&nbsp;/&nbsp;',$list);
           }
       }
       
     
}