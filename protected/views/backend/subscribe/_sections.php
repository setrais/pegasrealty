<?php echo CHtml::label('Фильтр','Subscribe_fid',array()); ?>          
<?php $data = empty($model) ? array() : CHtml::listData($model,'id', 'text', 'group');  ?>
<?php// print_r($data);?>
<?php $this->widget('ext.widgets.EchMultiSelect', array(
    // the data model associated with this widget:
    //'model' => $model,
    // the attribute associated with drop down list of this widget:
    //'dropDownAttribute' => 'gid',     
    // data for generating the options of the drop down list:
    'id'=> 'Subscribe_fid',
    'data' => $data,    
    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
    'name' => 'Subscribe[fid]',
    // additional HTML attributes for the drop down list:                           
    'dropDownHtmlOptions'=> array(
        'style'=>'width:auto',//'width:378px;', 
        'multiple'=>true, 
        //'onchange'=>'getAjaxObject();'
        //'prompt'=>Yii::t('application','Select Options').'...',  
    ),
    // options for the jQuery UI MultiSelect Widget
    // (see the project page for available options):
    'options' => array( 
        'selectedList'=>5,
        'header'=>true,
         // set this to true, if you want to use the Filter Plugin
        'checkAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Выбрать все'),
        'uncheckAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Отмена'),
        'selectedText' =>Yii::t('EchMultiSelect.EchMultiSelect','# выбрано'),
        'noneSelectedText'=>Yii::t('EchMultiSelectEchMultiSelect','Выбор фильтра...'),                                
         // set this to true, if you want to use the Filter Plugin
        'filter'=>true,
        'height'=>100,                               
        'multiple'=>true, 
        'ajax'=>true,
        //'ajaxRefresh'=>true,
        'autoReset'=>false,
    ),
    'filterOptions'=>array(
    'label' => Yii::t('EchMultiSelect.EchMultiSelect','Фильтр:'),
         'placeholder'=>Yii::t('EchMultiSelect.EchMultiSelect','Ввод слов'),
    )       
)); ?> 