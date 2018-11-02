<?php

/**
 * This is the model class for table "ri_files".
 *
 * The followings are the available columns in table 'ri_files':
 * @property string $id
 * @property string $uid
 * @property string $status
 * @property string $name
 * @property string $timetamp_x
 * @property string $order
 * @property string $height
 * @property string $width
 * @property string $file_size
 * @property string $ext
 * @property string $subdir
 * @property string $file_name
 * @property string $original_name
 * @property string $content_type
 * @property string $module_id
 * @property string $handler_id
 * @property string $created_user
 * @property integer $updated_user
 * @property string $created
 * @property string $updated
 * @property string $description
 */
class Files extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Files the static model class
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
		return 'files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, name, ext, original_name, created_user', 'required'), //timetamp_x,
			array('updated_user', 'numerical', 'integerOnly'=>true),
			array('uid, content_type', 'length', 'max'=>75),
			array('status', 'length', 'max'=>7),
			array('name, subdir, file_name, original_name, description, action, controller', 'length', 'max'=>255),
			array('order, created_user', 'length', 'max'=>11),
			array('height, width, file_size', 'length', 'max'=>18),
			array('ext', 'length', 'max'=>4),
			array('module_id, handler_id', 'length', 'max'=>50),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, status, name, timetamp_x, order, height, width, file_size, ext, subdir, file_name, original_name, content_type, module_id, handler_id, created_user, updated_user, created, updated, description, action, controller', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
            $attr = array( 'en' =>
                                array(  'id' => 'ID',
                                        'uid' => 'Uid',
                                        'status' => 'Status',
                                        'name' => 'Name',
                                        'timetamp_x' => 'Timetamp X',
                                        'order' => 'Order',
                                        'height' => 'Height',
                                        'width' => 'Width',
                                        'file_size' => 'File Size',
                                        'ext' => 'Ext',
                                        'subdir' => 'Subdir',
                                        'file_name' => 'File Name',
                                        'original_name' => 'Original Name',
                                        'content_type' => 'Content Type',
                                        'module_id' => 'Module',
                                        'handler_id' => 'Handler',
                                        'created_user' => 'Created User',
                                        'updated_user' => 'Updated User',
                                        'created' => 'Created',
                                        'updated' => 'Updated',
                                        'action'  => 'Action',
                                        'controller' => 'Controller',
                                        'description' => 'Description',
                                    ),
                          'ru'  =>
                                array(  'id' => 'ID файла',
                                        'uid' => 'Уникальный ID файла',
                                        'name' => 'Имя файла',
                                        'timetamp_x' => 'Временная метка',
                                        'order' => 'Сортировка',
                                        'status' => 'Статус',
                                        'height' => 'Высота',
                                        'width' => 'Ширина',
                                        'file_size' => 'Размер файла',
                                        'ext' => 'Расширение',
                                        'subdir' => 'Путь к файлу',
                                        'file_name' => 'Имя файла на диске',
                                        'original_name' => 'Оригенальное имя файла',
                                        'content_type' => 'Тип контента',
                                        'module_id' => 'ID модуля',
                                        'handler_id' => 'ID заголовка',
                                        'created_user' => 'Создал',
                                        'updated_user' => 'Изменил',
                                        'description' => 'Оисание файла',
                                        'action'  => 'Действие',
                                        'controller' => 'Контроллер',
                                     )
            );
            return $attr[$lang];
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('timetamp_x',$this->timetamp_x,true);
		$criteria->compare('order',$this->order,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('file_size',$this->file_size,true);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('subdir',$this->subdir,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('original_name',$this->original_name,true);
		$criteria->compare('content_type',$this->content_type,true);
		$criteria->compare('module_id',$this->module_id,true);
		$criteria->compare('handler_id',$this->handler_id,true);
		$criteria->compare('created_user',$this->created_user,true);
		$criteria->compare('updated_user',$this->updated_user);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('description',$this->description,true);
                $criteria->compare('action',$this->action,true);
                $criteria->compare('controller',$this->controller,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}