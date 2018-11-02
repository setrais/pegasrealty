<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'id'=>'iblockSearch',
        'htmlOptions'=>array('name'=>'iblockSearch'),
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>75)); ?>
	</div>*/?>
    
        <div class="row">
		<?php echo $form->label($model,'nid'); ?>
		<?php echo $form->textField($model,'nid',array('size'=>60,'maxlength'=>75)); ?>
	</div>
        
        <div class="row">
		<?php echo $form->label($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>60,'maxlength'=>75)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>75)); ?>
	</div>
    
	<div class="row">
            <?php// echo $form->label($model,'grid'); ?>          
            <?php echo CHtml::label(Yii::t('label','Section'),'grid'); ?>
            <?php $data = CHtml::listData(Iblocks::model()->findAll("(TYPES_IBLOCKS_ID<>1)AND(GRID IS NULL OR GRID=0)AND (ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'name'); 
                  $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'grid',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Iblocks_grid',
                          // additional HTML attributes for the drop down list:                           
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',//'width:378px;', 
                            'multiple'=>true,  
                            //'prompt'=>Yii::t('application','Select Options').'...',
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                            'multiple'=>true, 
                          ),
                          /*'foptions' => array(
                              'autoReset'=>false,
                          )*/
                )); ?>   		
		<?php/* echo $form->textField($model,'grid'); */?>
	</div>
        
	<div class="row">
		<?php// echo $form->label($model,'types_iblocks_id'); ?>
                <?php echo CHtml::label(Yii::t('label','Type of the infoblock'),'types_iblocks_id'); ?>            
                <?php $data = CHtml::listData(TypesIblocks::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'desc'); 
                      $this->widget('ext.widgets.EchMultiSelect', array(
                                    // the data model associated with this widget:
                                    'model' => $model,
                                    // the attribute associated with drop down list of this widget:
                                    'dropDownAttribute' => 'types_iblocks_id',     
                                    // data for generating the options of the drop down list:
                                    'data' => $data,    
                                    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' 
                                    // are not set):
                                    'name' => 'Iblocks_types_iblocks_id',
                                    // additional HTML attributes for the drop down list:                           
                                    'dropDownHtmlOptions'=> array(
                                        'style'=>'width:auto',//'width:378px;', 
                                        'multiple'=>true,  
                                        //'prompt'=>Yii::t('application','Select Options').'...',
                                    ),
                                    // options for the jQuery UI MultiSelect Widget
                                    // (see the project page for available options):
                                    'options' => array( 
                                        'selectedList'=>5,
                                        'header'=>true,
                                        // set this to true, if you want to use the Filter Plugin
                                        'filter'=>false,
                                        'height'=>100,                               
                                        'multiple'=>true, 
                                    ),
                                    //'foptions' => array(
                                    //    'autoReset'=>false,
                                    //)
                        )); ?>   		            
		<?php// echo $form->textField($model,'types_iblocks_id'); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'cid'); ?>
		<?php echo $form->textField($model,'cid',array('size'=>60,'maxlength'=>75)); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->label($model,'act'); ?>
                <?php// echo $form->checkBox($model,'act',array('value'=>null)); ?>
                <?php echo $form->dropDownList($model,'act',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
		<?php// echo $form->textField($model,'act'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'del'); ?>
                <?php// echo $form->checkBox($model,'del',array('value'=>null)); ?>
                <?php echo $form->dropDownList($model,'del',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
		<?php// echo $form->textField($model,'del'); ?>
	</div>

    	<div class="row">
		<?php echo $form->label($model,'anons'); ?>
                <?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>50)); ?>
		<?php// echo $form->textField($model,'anons',array('size'=>60,'maxlength'=>257)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keywords'); ?>
		<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'pic_anons_id'); ?>
		<?php echo $form->textField($model,'pic_anons_id',array('size'=>60,'maxlength'=>255)); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->label($model,'pic_detile_id'); ?>
		<?php echo $form->textArea($model,'pic_detile_id',array('rows'=>6, 'cols'=>50)); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->label($model,'createusers'); ?>         
                <?php $data = CHtml::listData(Users::model()->findAll("",
                                array("order"=>"sort")), 'id', 'username'); 
                      $this->widget('ext.widgets.EchMultiSelect', array(
                                    // the data model associated with this widget:
                                    'model' => $model,
                                    // the attribute associated with drop down list of this widget:
                                    'dropDownAttribute' => 'createusers',     
                                    // data for generating the options of the drop down list:
                                    'data' => $data,    
                                    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' 
                                    // are not set):
                                    'name' => 'Iblocks_createusers',
                                    // additional HTML attributes for the drop down list:                           
                                    'dropDownHtmlOptions'=> array(
                                        'style'=>'width:auto',//'width:378px;', 
                                        'multiple'=>true,  
                                        //'prompt'=>Yii::t('application','Select Options').'...',
                                    ),
                                    // options for the jQuery UI MultiSelect Widget
                                    // (see the project page for available options):
                                    'options' => array( 
                                        'selectedList'=>5,
                                        'header'=>true,
                                        // set this to true, if you want to use the Filter Plugin
                                        'filter'=>false,
                                        'height'=>100,                               
                                        'multiple'=>true, 
                                    ),
                                    //'foptions' => array(
                                    //'autoReset'=>false,
                                    //)
                        )); ?>   		                        
		<?php// echo $form->textField($model,'createusers'); ?>
	</div>

	<div class="row">
	    <?php// echo $form->label($model,'createdate'); ?>
            <label for="createdate-from"><?=Yii::t('all','Дата создания от');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'createdate-from',
                    //'model'=>$model,
                    //'attribute'=>'createdate',
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>                
            <?php// echo CHtml::textField('createdate-from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('createdate-to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'createdate-to',
                    //'model'=>$model,
                    //'attribute'=>'date_rang',
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>            
		<?php// echo $form->textField($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateusers'); ?>
                <?php $data = CHtml::listData(Users::model()->findAll("",
                                array("order"=>"sort")), 'id', 'username'); 
                      $this->widget('ext.widgets.EchMultiSelect', array(
                                    // the data model associated with this widget:
                                    'model' => $model,
                                    // the attribute associated with drop down list of this widget:
                                    'dropDownAttribute' => 'updateusers',     
                                    // data for generating the options of the drop down list:
                                    'data' => $data,    
                                    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' 
                                    // are not set):
                                    'name' => 'Iblocks_updateusers',
                                    // additional HTML attributes for the drop down list:                           
                                    'dropDownHtmlOptions'=> array(
                                        'style'=>'width:auto',//'width:378px;', 
                                        'multiple'=>true,  
                                        //'prompt'=>Yii::t('application','Select Options').'...',
                                    ),
                                    // options for the jQuery UI MultiSelect Widget
                                    // (see the project page for available options):
                                    'options' => array( 
                                        'selectedList'=>5,
                                        'header'=>true,
                                        // set this to true, if you want to use the Filter Plugin
                                        'filter'=>false,
                                        'height'=>100,                               
                                        'multiple'=>true, 
                                    ),
                                    //'foptions' => array(
                                    //   'autoReset'=>false,
                                    //)
                        ));?>   		                              
		<?php// echo $form->textField($model,'updateusers'); ?>
	</div>

	<div class="row">
            <?php// echo $form->label($model,'updatedate'); ?>
            <label for="updatedate-from"><?=Yii::t('all','Дата обновления от');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'updatedate-from',
                    //'model'=>$model,
                    //'attribute'=>'updatedate',
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>                
            <?php// echo CHtml::textField('updatedate-from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('updatedate-to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'updatedate-to',
                    //'model'=>$model,
                    //'attribute'=>'date_rang',
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>                        
		<?php// echo $form->textField($model,'updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detile'); ?>
		<?php echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
	</div>*/?>
	<div class="row">
            <?php echo $form->label($model,'is_main'); ?>
            <?php// echo $form->checkBox($model,'is_main',array('value'=>null)); ?>
            <?php echo $form->dropDownList($model,'is_main',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
            <?php// echo $form->textField($model,'is_main'); ?>            
	</div>
	<div class="row">
            <?php echo $form->label($model,'is_pay'); ?>
            <?php// echo $form->checkBox($model,'is_pay',array('value'=>null)); ?>
            <?php echo $form->dropDownList($model,'is_pay',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
            <?php// echo $form->textField($model,'is_pay'); ?>            
	</div>    

	<div class="row">
            <?php echo $form->label($model,'is_arhiv'); ?>
            <?php// echo $form->checkBox($model,'is_arhiv',array('value'=>null)); ?>
            <?php echo $form->dropDownList($model,'is_arhiv',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
            <?php// echo $form->textField($model,'is_arhiv'); ?>            
	</div>    

	<div class="row">
            <?php echo $form->label($model,'is_use'); ?>
            <?php// echo $form->checkBox($model,'is_use',array('value'=>null)); ?>
            <?php echo $form->dropDownList($model,'is_use',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
            <?php// echo $form->textField($model,'is_use'); ?>            
	</div>    

	<?/*<div class="row">
		<?php echo $form->label($model,'maps_id'); ?>
		<?php echo $form->textField($model,'maps_id',array('size'=>60,'maxlength'=>75)); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'url_detile'); ?>
		<?php echo $form->textField($model,'url_detile',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url_list'); ?>
		<?php echo $form->textField($model,'url_list',array('size'=>60,'maxlength'=>255)); ?>
	</div>*/?>    

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>                
                <?php $data = CHtml::listData(Cities::model()->findAll(array("condition"=>"country_id=1",
                                "order"=>"region_id")), 'id', 'name'); 
                      $this->widget('ext.widgets.EchMultiSelect', array(
                                    // the data model associated with this widget:
                                    'model' => $model,
                                    // the attribute associated with drop down list of this widget:
                                    'dropDownAttribute' => 'city_id',     
                                    // data for generating the options of the drop down list:
                                    'data' => $data,    
                                    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' 
                                    // are not set):
                                    'name' => 'Iblocks_city_id',
                                    // additional HTML attributes for the drop down list:                           
                                    'dropDownHtmlOptions'=> array(
                                        'style'=>'width:auto',//*'width:378px;', 
                                        'multiple'=>true,  
                                        //'prompt'=>Yii::t('application','Select Options').'...',
                                    ),
                                    // options for the jQuery UI MultiSelect Widget
                                    // (see the project page for available options):
                                    'options' => array( 
                                        'selectedList'=>5,
                                        'header'=>true,
                                        // set this to true, if you want to use the Filter Plugin
                                        'filter'=>false,
                                        'height'=>100,                               
                                        'multiple'=>true, 
                                    ),
                                    //'foptions' => array(
                                    //    'autoReset'=>false,
                                    //)
                        )); ?>   		                        
                        <?php// echo $form->textField($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visible'); ?>
		<?php echo $form->textField($model,'visible',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->