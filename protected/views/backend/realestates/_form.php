<?  // Подключаем скрипт посчета поля textarea
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/cnttextarea.css');      
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/cnttextarea.js');  
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/charCount.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/kwcount/kwcount.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/kwcount/kwcount.js');   
?>
<div class="wide form l150">
<?php $isId = (empty($model->id) ? (isset($copid) ? true : false) : true); ?>  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'realestates-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data','name'=>'realestates-form'), 
)); ?>

	<p class="note"><?=Yii::t('form','Fields marked <span color="red">*</span> are required for entry.');?></p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
          <?php echo $form->labelEx($model,'realestate_type_id'); ?>
          <?php echo $form->dropDownList($model,'realestate_type_id',                           
                       CHtml::listData( RealestateTypes::model()->findAll(array("select"=>"t.id,t.title",
                                                                                "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                "order"=>"t.sort")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>             
            <?php// echo $form->textField($model,'realestate_type_id'); ?>
            <?php echo $form->error($model,'realestate_type_id'); ?>
	</div>

        <div class="row">
          <?php echo $form->labelEx($model,'operation_id'); ?>
          <?php echo $form->dropDownList($model,'operation_id',   
                       CHtml::listData(Operations::model()->findAll(array("select"=>"t.id,t.title",
                                                                          "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                          "order"=>"t.sort")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>             
	  <?php// echo $form->textField($model,'realestate_type_id'); ?>
	  <?php echo $form->error($model,'operation_id'); ?>
	</div>

        <div class="row">
          <?php echo $form->labelEx($model,'district_id'); ?>
	  <?php// echo $form->textField($model,'district_id'); ?>
          <?php echo $form->dropDownList($model,'district_id',
                        CHtml::listData(Districts::model()->findAll(array("select"=>"t.id,t.title",
                                                                          "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                          "order"=>"t.sort")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>
	  <?php echo $form->error($model,'district_id'); ?>
	</div>
                
        <div class="row">
          <?php echo $form->labelEx($model,'areas_id'); ?>
	  <?php// echo $form->textField($model,'areas_id'); ?>
          <?php echo $form->dropDownList($model,'areas_id',
                        CHtml::listData(Areas::model()->findAll(array("select"=>"t.id,t.title","condition"=>"(t.ACT IS NULL OR t.ACT=1) AND (t.DEL IS NULL OR t.DEL=0)",
                                                                      "order"=>"t.title")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>
	  <?php echo $form->error($model,'areas_id'); ?>
	</div>
        
        <div class="row">
          <?php echo $form->labelEx($model,'metro_id'); ?>
          <?php $data = CHtml::listData(Metros::model()->findAll(array("select"=>"t.id,t.title")), 'id', 'title'); ?>
          <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'metro_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_metro_id',    
                          // additional HTML attributes for the drop down list:                           
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/, 
                            'prompt'=>'--'.Yii::t('all','Select')."--",  
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100,                               
                            'multiple'=>false,  
                          ),
                )); ?>             
          <?php/* echo $form->dropDownList($model,'metro_id',
                        array_merge( array('0' => 'Выберите метро'), 
                        CHtml::listData(Metros::model()->findAll(), 'id', 'title'))); */?>
          <?php echo $form->error($model,'metro_id'); ?>
	</div>
         
	<div class="row">
	  <?php echo $form->labelEx($model,'remoteness'); ?>                                
	  <?php echo $form->textField($model,'remoteness',array('size'=>10,'maxlength'=>10,
                                                                'value'=>($model->remoteness===null ? $model->remoteness : round($model->remoteness )))); ?>
	  <?php echo $form->error($model,'remoteness'); ?>                
          <?php echo $form->dropDownList($model,'unit_id',
                         CHtml::listData(Units::model()->findAll(array("select"=>"t.id,t.short_title",
                                                                       "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                       "order"=>"t.sort")), 'id', 'short_title'), array('prompt'=>Yii::t('all','Выберите ед.измерения'))); ?>    		
	  <?php echo $form->error($model,'unit_id'); ?>                
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
                  <?php $autocompleteConfig = array(
                     'model'=>$model, // модель
                     'attribute'=>'title', // атрибут модели
                     // "источник" данных для выборки
                     // может быть url, который возвращает JSON, массив
                     // или функция JS('js: alert("Hello!");')
                    'source' =>Yii::app()->createUrl('realestates/autocompletetitle'),
                     // параметры, подробнее можно посмотреть на сайте
                     // http://jqueryui.com/demos/autocomplete/
                    'options'=>array(
                         // минимальное кол-во символов, после которого начнется поиск
                        'minLength'=>'2',
                        'showAnim'=>'fold',
                        // обработчик события, выбор пункта из списка
                        'change' =>'js: function(event, ui) {
                            $(\'input#Realestates_title[type="hidden"]\').val($(\'input#Realestates_title\').val());
                        }',
                        'select' =>'js: function(event, ui) {
                        // действие по умолчанию, значение текстового поля
                        // устанавливается в значение выбранного пункта
                        this.value = ui.item.label;
                        // устанавливаем значения скрытого поля                        
                        $("#Realestates_title").val(ui.item.title);
                        return true;
                        }',
                  ),
                 'htmlOptions' => array(
                    'maxlength'=>75,
                    'size'=>60, 
                  ),
                );
                ?>
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $autocompleteConfig); ?>
                <?php echo $form->hiddenField($model,'title', array('style'=>'display: none;width:150px;')); ?>
		<?php// echo $form->textField($model,'title',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'title'); ?>
                <script>
                  $( function () {
                        $('input[type="submit"]').click(
                            function() {
                                $('input#Realestates_title[type="hidden"]').val($('input#Realestates_title').val()); 
                            }
                        );
                   });
                </script>
	</div>

        <?/*<div class="row">
          <?php echo $form->labelEx($model,'street_id'); ?>
          <?php $data = CHtml::listData(Streets::model()->findAll(array('select'=>"id,concat(socr,' ',name) as 'name'","order"=>'t.name')), 'id', 'name'); ?>  
          <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'street_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_street_id',    
                          // additional HTML attributes for the drop down list:                           
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;', 
                            'prompt'=>'--'.Yii::t('all','Select')."--",  
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>120,                               
                            'multiple'=>false,  
                          ),
                )); ?>             
          <?php/* echo $form->dropDownList($model,'street_id',
                        array_merge( array('0' => 'Выберите улицу'), 
                        CHtml::listData(Streets::model()->findAll(), 'id', 'name'))); ?>
          <?php echo $form->error($model,'street_id'); ?>
	</div>*/?>
        <div class="row">
		<?php echo $form->labelEx($model,'street_id', array('label'=>'Улица')); ?>
                <?php if ($model->street_id) $model->newstreet = $model->street->SOCR.'.'.$model->street->name; ?>
                <?php $autocompletestreetConfig = array(
                                   'model'=>$model, // модель
                                   'attribute'=>'newstreet', // атрибут модели
                                     /*'name'=>'Realestates_newstreet', 
                                     'id'=>'Realestates_newstreet',*/
                                   // "источник" данных для выборки
                                   // может быть url, который возвращает JSON, массив
                                   // или функция JS('js: alert("Hello!");')
                                  'source' =>Yii::app()->createUrl('realestates/autocompletestreet'),
                                  'value' => trim($model->street_id)<>'' ? $model->street->name : '',
                                   // параметры, подробнее можно посмотреть на сайте
                                   // http://jqueryui.com/demos/autocomplete/
                                  //'theme'=>'ui-lightness',                                      
                                  'options'=>array(
                                       // минимальное кол-во символов, после которого начнется поиск                                      
                                      'minLength'=>'1',
                                      'autoFill'=>true,
                                      'showAnim'=>'fold',                                      
                                      // обработчик события, выбор пункта из списка
                                      'select' =>'js: function(event, ui) {                                        
                                        $("#Realestates_newstreet").val(ui.item.label);
                                        $("#Realestates_street_id").val(ui.item.id);
                                          var address = $("#Realestates_address").val();
                                          if ( address.length==0 ) {
                                            $("#Realestates_address").val(ui.item.label );
                                          }
                                          return false;
                                      }',
                                      'focus' =>'js:function( event, ui ) {                                        
                                        $("#Realestates_newstreet").val(ui.item.label );                                       
                                        return false;}',
                                ),
                               'htmlOptions' => array(
                                  'maxlength'=>255,
                                  'style'=>'width:262px;', 
                                  /*'placeholder' => 'улица',*/ 
                                  'class'=>'styler',
                                ),
                              );
                              ?>
                              <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $autocompletestreetConfig); ?>     
                              <?php echo $form->hiddenField($model,'street_id', array('style'=>'display: none;width:150px;')); ?>                             
                              <?php echo $form->error($model, 'street_id');?>
                <script>
                  $( function () {
                        $('input[type="submit"]').click(
                            function() {
                                $('input#Realestates_street_id[type="hidden"]').val($('input#Realestates_street_id').val()); 
                            }
                        );
                   });
                </script>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>

                <?php $autocompleteConfig = array(
                     'model'=>$model, // модель
                     'attribute'=>'address', // атрибут модели
                     // "источник" данных для выборки
                     // может быть url, который возвращает JSON, массив
                     // или функция JS('js: alert("Hello!");')
                    'source' =>Yii::app()->createUrl('realestates/autocompleteaddress'),
                     // параметры, подробнее можно посмотреть на сайте
                     // http://jqueryui.com/demos/autocomplete/
                    'options'=>array(
                         // минимальное кол-во символов, после которого начнется поиск
                        'minLength'=>'2',
                        'showAnim'=>'fold',
                        // обработчик события, выбор пункта из списка
                        'select' =>'js: function(event, ui) {
                        // действие по умолчанию, значение текстового поля
                        // устанавливается в значение выбранного пункта
                        this.value = ui.item.label;
                        // устанавливаем значения скрытого поля
                        $("#Realestates_address").val(ui.item.address);
                        return true;
                    }',
                  ),
                 'htmlOptions' => array(
                    'maxlength'=>255,
                    'size'=>75, 
                  ),
                );
                ?>
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $autocompleteConfig); ?>
                <?php echo $form->hiddenField($model,'address', array('style'=>'display: none;width:255px;')); ?>
		<?php// echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
                <script>
                  $( function () {
                        $('input[type="submit"]').click(
                            function() {
                                $('input#Realestates_address[type="hidden"]').val($('input#Realestates_address').val()); 
                            }
                        );
                   });
                </script>
                                            
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'realestate_vid_id'); ?>
                <?php echo $form->dropDownList($model,'realestate_vid_id',   
                              CHtml::listData(RealestateVids::model()->findAll(array("select"=>"t.id,t.title",
                                                                                      "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                      "order"=>"t.sort")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--" )); ?>                                     
		<?php// echo $form->textField($model,'realestate_vid_id'); ?>
		<?php echo $form->error($model,'realestate_vid_id'); ?>
	</div>

        
	<div class="row" >
		<?php echo $form->labelEx($model,'realestate_class_id'); ?>
                <?php echo $form->dropDownList($model,'realestate_class_id',   
                              CHtml::listData(RealestateClasses::model()->findAll(array("select"=>"t.id,t.abbr",
                                                                                        "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                        "order"=>"t.sort")), 'id', 'abbr'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>                                     
		<?php// echo $form->textField($model,'realestate_class_id'); ?>
		<?php echo $form->error($model,'realestate_class_id'); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'date_rang'); ?>
            <?php $langs = array_flip(Yii::app()->params->languages); 
                  if ($model->date_rang) 
                      $model->date_rang = date('d.m.Y H:i:s',  strtotime($model->date_rang));
                  else 
                      $model->date_rang = date('d.m.Y H:i:s',  time());
            ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> $langs[Yii::app()->language],                                        
                    'model'=>$model,
                    'attribute'=>'date_rang',   
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy H:i:s',  
                        'defaultDate'=>date('d.m.Y H:i:s'),                                                
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
            <?php/* $this->widget('application.extensions.jui.EDatePicker',
                 array(
                      'name'=>'date_rang',
                      'attribute'=>'date_rang', // Model attribute filed which hold user input
                      'model'=>$model,          // Model name
                      'language'=>Yii::app()->params->languages,
                      'mode'=>'imagebutton',
                      'theme'=>'redmond',
                      'dateFormat'=>'dd.mm.yy',
                      'value'=>date('Y-m-d H:i:s A'),
                      'htmlOptions'=>array('size'=>8),
                      'fontSize'=>'0.8em'
                     )
            );*/?>
            <?php echo $form->error($model,'date_rang'); ?>
        </div>    
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'date_rang'); ?>
		<?php echo $form->textField($model,'date_rang'); ?>
		<?php echo $form->error($model,'date_rang'); ?>
	</div>*/?>

       <div class="row">
           
           <?php echo $form->labelEx($model,'date_release'); ?>
            <?php $langs = array_flip(Yii::app()->params->languages); 
                  if ($model->date_release) 
                      $model->date_release = date('d.m.Y',  strtotime($model->date_release))
            ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> $langs[Yii::app()->language],                                        
                    'model'=>$model,
                    'attribute'=>'date_release',   
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
            <?php/* $this->widget('application.extensions.jui.EDatePicker',
                 array(
                      'name'=>'date_release',
                      'attribute'=>'date_release', // Model attribute filed which hold user input
                      'model'=>$model,          // Model name
                      'language'=>Yii::app()->params->languages,
                      'mode'=>'imagebutton',
                      'theme'=>'redmond',
                      'dateFormat'=>'dd.mm.yy',
                      'value'=>date('Y-m-d H:i:s A'),
                      'htmlOptions'=>array('size'=>8),
                      'fontSize'=>'0.8em'
                     )
            );*/?>
            <?php echo $form->error($model,'date_rang'); ?>
        </div>    
        
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'date_release'); ?>
		<?php echo $form->textField($model,'date_release'); ?>
		<?php echo $form->error($model,'date_release'); ?>
	</div>*/?>
        <?php if ( Yii::app()->user->checkAccess('superadmin') /*|| Yii::app()->user->name == 'adminone'*/ ) { ?> 
        <div class="row">
		<?php echo $form->labelEx($model,'act'); ?>
		<?php echo $form->checkBox($model,'act',array('value'=>1,'uncheckValue'=>0,'checked'=>( ($model->isNewRecord /*|| Yii::app()->controller->action->id==='copy'*/ ) && $model->act==null ? "checked" : $model->act ? "checked" : "" ) )); ?>
		<?php echo $form->error($model,'act'); ?>
	</div>
        <?php } ?>
        <?php if ( Yii::app()->user->checkAccess('superadmin')) { ?> 
        <div class="row">
		<?php echo $form->labelEx($model,'del'); ?>
		<?php echo $form->checkBox($model,'del',array('value'=>1,'uncheckValue'=>0,'checked'=>( ($model->isNewRecord /*|| Yii::app()->controller->action->id==='copy'*/ ) && $model->act==null ? "" : $model->del ? "checked" : "") )); ?>
		<?php echo $form->error($model,'del'); ?>
	</div>        
        <?php } ?>
        <? /*else{ ?>
        <div class="row">
		<?php echo $form->labelEx($model,'act'); ?>
		<?php echo $form->checkBox($model,'act', ( $model->act==null ? "" : array("checked"=>"checked"))); ?>
		<?php echo $form->error($model,'act'); ?>
	</div>            
        <?  } */?> 
        
        <div class="row">
		<?php echo $form->labelEx($model,'in_stock'); ?>
		<?php echo $form->checkBox($model,'in_stock', ( $model->in_stock==null ? array("checked"=>"checked") : "" )); ?>
		<?php echo $form->error($model,'in_stock'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->textField($model,'area',array('size'=>10,'maxlength'=>10,
                                                                'value'=>($model->area===null ? $model->area : round($model->area )))); ?> м2
		<?php echo $form->error($model,'area'); ?>
	</div>

                
	<div class="row">
		<?php echo $form->labelEx($model,'planning_id'); ?>
                <?php echo $form->dropDownList($model,'planning_id',   
                                               CHtml::listData(Plannings::model()->findAll(array("select"=>"t.id,t.title",
                                                                                                 "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                                 "order"=>"t.sort")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?> 
		<?php// echo $form->textField($model,'planning_id'); ?>
		<?php echo $form->error($model,'planning_id'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'coefficient_corridor'); ?>
		<?php echo $form->dropDownList($model,'coefficient_corridor', array_combine(range(1,26,1),range(5,30,1)), array('prompt'=>"--")); ?> %
		<?php echo $form->error($model,'coefficient_corridor'); ?>
	</div> 
                
        <div class="row">
		<?php echo $form->labelEx($model,'is_separate_entrance'); ?>
		<?php echo $form->checkBox($model,'is_separate_entrance'); ?>
		<?php echo $form->error($model,'is_separate_entrance'); ?>
	</div> 
        
        <div class="row">
		<?php echo $form->labelEx($model,'Свойства недвижемости'); ?> 
                <?php $data = CHtml::listData(Properties::model()->findAll(array("select"=>"t.id,t.title",
                                                                                 "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                 "order"=>"t.sort")), 'id', 'title'); ?> 
                <?php // Свойства недвижемости
                       $selProperties = array();                      
                       if (!$model->isNewRecord) {
                           $properties = RealestateProperties::model()->findAll("realestate_id=".(isset($copid) ? $copid : $model->id), 
                                                   array("select"=>"property_id"));                                       
                           foreach ( $properties as $key=>$val) $selProperties[]=$val->property_id;
                       }
                ?>
                <?php echo "<nobr>".CHtml::checkBoxList('Realestates[realestateProperties]', $selProperties, $data, array("separator"=>"&nbsp;"))."</nobr>" ;?>
                <?php/* $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'realestateProperties',     
                          // data for generating the options of the drop down list:
                          'data' => $data,                            
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_realestateProperties',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'/,
                            'multiple'=>true,
                            'options'=>(isset($selProperties) ? $selProperties : array()),                              
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                          ),
                )); ?>            
                
                <?php/* echo $form->listBox($model,'realestateProperties',
                                               CHtml::listData(Properties::model()->findAll(), 'id', 'title'),
                                               array("multiple"=>"multiple","size"=>"2")); */?>
		<?php echo $form->error($model,'realestateProperties'); ?>
	</div>
        
        <?php $this->renderPartial( '_currency', array('model'=>$model,
                                                       'form' =>$form,
                                                       'is_curs'=>true));
        ?>

        <?/*<div id="block-currency" class="row">
            <div class="fl" >
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10,
                                                                 'value'=>($model->price===null ? $model->price : round($model->price )))); ?> кв.м.год
		<?php echo $form->error($model,'price'); ?>
            </div>    
            <div class="fl " >
		<?php echo $form->labelEx($model,'valute_id',array("style"=>"width:69px;")); ?>
                <?php $data = CHtml::listData(Valutes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr');?>
		<?php echo $form->dropDownList($model,'valute_id',
                                               $data); ?> 
		<?php echo $form->error($model,'valute_id'); ?>
            </div>
            <div class="fr">	                   
              <div class="currency curs">
                  <label for="currency">Курсы:</label>                  
                  <span style="color: #0078ae;" id="curs_valute_1" >USD</span>:&nbsp;<i id="curs_valute_value_USD" ><?php echo round(Yii::app()->currency->USD,5);?></i> &nbsp;&nbsp; 
                  <span style="color: #0078ae;" id="curs_valute_2" >EUR</span>:&nbsp;<i id="curs_valute_value_EUR" ><?php echo round(Yii::app()->currency->EUR,5);?></i>
             </div>  
            </div>              
            <div class="clear"></div>
            <div class="currency value">
                  <label for="currency">Стоимость согласно Курса&nbsp;валют:</label>                  
                  <span style="color:#169EA5;" id="curr_value_1">USD</span>:&nbsp;<i id="cost_USD"><?php echo round($model->price/Yii::app()->currency->USD);?></i> &nbsp;&nbsp; 
                  <span style="color:#169EA5;" id="curr_value_2">EUR</span>:&nbsp;<i id="cost_EUR"><?php echo round($model->price/Yii::app()->currency->EUR);?></i>
            </div>  
	</div>    
        <script>
            
            $('#Realestates_price').keyup(
                function() {
                    changeCurrency();
                }
            ); 
            
            function changeCurrency() {
                var price = parseInt($('#Realestates_price').val());
                var evt1 = $('#curs_valute_1').text();
                var evt2 = $('#curs_valute_2').text();
                var val1  = parseFloat($('#curs_valute_value_'+evt1).text());
                var val2  = parseFloat($('#curs_valute_value_'+evt2).text());
                       
                $('#cost_'+evt1).text(''+Math.round(price/val1));
                $('#cost_'+evt2).text(''+Math.round(price/val2));                         
            }

            /*
            function loadBlockCurrency(price,currency_title,currency_id) {                                    
                   var url = '/bax.php/realestates/ajaxshowcurrenty/'
                                +currency_id+'/'
                                +price+'.html';
                   $('#block-currency').load(url, function() {
                       $('#Realestates_price').attr('title',currency_title);
                   });
            }
                        
            
            $('#Realestates_valute_id').change(
                 
                 function() 
                 {                      
                   var curr_currency = $('#Realestates_price').attr('title');
                   var currency_title = $('#Realestates_valute_id').attr('title');
                   var currency_id = $('#Realestates_valute_id').val();
                   var is_curr =( curr_currency==currency);                       
                   var price;
                   
                   if ( !is_curr) 
                   {
                       price = $('#cost_'+curr_currency);
                       loadBlockCurrency(price,currency_title,currency_id);
                   }                       
                 }
            );
                
            loadBlockCurrency(<?=$model->valute_id;?>,<?=$model->price;?>);
            
        </script>*/?>
	<div class="row">
		<?php echo $form->labelEx($model,'tax_id'); ?>
		<?php echo $form->dropDownList($model,'tax_id',   
                                   CHtml::listData(Taxs::model()->findAll(array("select"=>"t.id,t.abbr",
                                                                                "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                "order"=>"t.sort")), 'id', 'abbr'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?> 
		<?php// echo $form->textField($model,'tax_id'); ?>
		<?php echo $form->error($model,'tax_id'); ?>
	</div>

        
	<div class="row">
		<?php echo $form->labelEx($model,'parking_id'); ?>
                <?php echo $form->dropDownList($model,'parking_id',   
                                   CHtml::listData(Parkings::model()->findAll(array("select"=>"t.id,t.title",
                                                                                    "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                    "order"=>"t.sort")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>             
		<?php// echo $form->textField($model,'parking_id'); ?>
		<?php echo $form->error($model,'parking_id'); ?>
	</div>

        
	<div class="row">
		<?php echo $form->labelEx($model,'cnt_parking_place'); ?>
		<?php echo $form->textField($model,'cnt_parking_place',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cnt_parking_place'); ?>
	</div>
                
	<div class="row">
		<?php echo $form->labelEx($model,'representative_id'); ?>
                <?php $data = CHtml::listData(Representatives::model()->findAll(array('select'=>"id,concat(name,' - #',id) as 'name'")), 'id', 'name'); ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'representative_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_representative_id',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,    
                            'prompt'=>'--'.Yii::t('all','Select')."--",    
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100,                               
                            'multiple'=>false, 
                          ),
                )); ?>                
                <?php/* echo $form->dropDownList($model,'representative_id',   
                                               array_merge( array('0' => 'Выбор собственника...'),  
                                               CHtml::listData(Representatives::model()->findAll(), 'id', 'name'))); */?>              
		<?php// echo $form->textField($model,'representative_id'); ?>
                <?php echo CHtml::link( CHtml::image('/images/add_item.png',Yii::t('form','Add')), '#', array("id"=>"AddRepresentative"));?>
                <?php echo CHtml::link( CHtml::image('/images/edit_item.png',Yii::t('form','Edit')), '#', array("id"=>"EditRepresentative"));?>
                <?php echo CHtml::link( CHtml::image('/images/del_item.png',Yii::t('form','Delete')), '#', array("id"=>"DeleteRepresentative"));?>  
                <?php echo CHtml::ajaxLink( CHtml::image('/images/view_item.png',Yii::t('form','Info')),
                                            Yii::app()->controller->createUrl("representatives/ajaxgetinfo"), 
                                            array( 'update'=>'#window-info',
                                                   'data'=>'js:{ "id" : $("#Realestates_representative_id").val(), "ajax" : "representatives-form" }', 
                                                   'dataType'=>'text', 
                                                   'success'=>"function(data) { 
                                                            if ( data ) {
                                                                 $('#window-info').html(data);
                                                                 $('#window-info').dialog({ closeOnEscape: true, width: 'auto', title:'Информация о собственнике',modal: true});                                                                      
                                                            }     
                                                       }"
                                                 ), array("id"=>"InfoRepresentative"));?> 
		<?php echo $form->error($model,'representative_id'); ?>
                <div id="window-info" class="window-info hidden"></div>
	</div>
                
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>*/?>
       
        <div class="row">
		<?php echo $form->labelEx( $model, 'realestateRepresentatives'); ?>    
                <?php $data = CHtml::listData(Representatives::model()->findAll(array('select'=>"id,concat(name,' - #',id) as 'name'")), 'id', 'name')  ?>
                <?php // Представители недвижемости
                    if ($isId) {
                        $representatives = RealestateRepresentatives::model()->findAll("realestate_id=".(isset($copid) ? $copid : $model->id), 
                                               array("select"=>"representative_id"));
                        $selRepresentatives = array();
                        foreach ( $representatives as $key=>$val) 
                        $selRepresentatives[$val->representative_id]=array("selected"=>true);
                    }
                ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'realestateRepresentatives',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_realestateRepresentatives',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,
                            'multiple'=>true,    
                            'options'=>(isset($selRepresentatives) ? $selRepresentatives : array()),   
                            'prompt'=>'--'.Yii::t('all','Select')."--",  
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100,                               
                            'multiple'=>true,  
                          ),
                )); ?>                      
                <?php/* echo $form->listBox( $model, 'realestateRepresentatives',   
                               array_merge( array("0"=>"Выбор представителей..."),
                                       CHtml::listData(Representatives::model()->findAll($isId ? 'not id='.$model->representative_id)
                                            , 'id', 'name') ),
                                            array("multiple"=>"multiple","size"=>"1") ); */?>              
		<?php// echo $form->textField($model,'representative_id'); ?>       
                <?php echo CHtml::link( CHtml::image('/images/add_item.png',Yii::t('form','Add')), '#', array("id"=>"AddRepresentatives"));?>
                <?php// echo CHtml::Button(Yii::t('form','Add'), array("id"=>"AddRepresentatives"));?>
		<?php echo $form->error($model,'realestateRepresentatives'); ?>                
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'procent_commission'); ?>
		<?php echo $form->textField($model,'procent_commission',array('size'=>6,'maxlength'=>6,'value'=>$model->procent_commission,'default'=>'0.00')); ?>
		<?php echo $form->error($model,'procent_commission'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'commission_id'); ?>
                <?php echo $form->dropDownList($model,'commission_id',   
                                   CHtml::listData(Commissions::model()->findAll(array("select"=>"t.id,t.title",
                                                                                      "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                      "order"=>"t.sort")), 'id', 'title'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>                          
		<?php// echo $form->textField($model,'commission_id'); ?>
		<?php echo $form->error($model,'commission_id'); ?>
	</div>
        
	<div class="row" >
		<?php echo $form->labelEx($model,'number_tax'); ?>
                <?php echo $form->dropDownList($model,'number_tax',   
                              CHtml::listData(TaxReference::model()->findAll(array("select"=>"t.id,t.abbr",
                                                                                   "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                   "order"=>"t.sort")), 'id', 'abbr'), array('prompt'=>'--'.Yii::t('all','Select')."--")); ?>                                     
		<?php// echo $form->textField($model,'realestate_class_id'); ?>
		<?php echo $form->error($model,'number_tax'); ?>
	</div>        
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'number_tax'); ?>
		<?php echo $form->textField($model,'number_tax',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'number_tax'); ?>
	</div>*/?>
        
        <?/*<div class="row">
		<?php echo $form->labelEx($model,'pic_scr_id'); ?>
                    <?/* $this->widget('ext.EAjaxUpload.EAjaxUpload',
                    array(
                            'id'=>'pic_scr_id',
                            'config'=>array(
                                   'action'=>'/bax.php/files/upload?source_action='
                                            .$this->getAction()->getId()
                                            .'&source_controller='
                                            .$this->getId()
                                            .'&status='
                                            .($this->getAction()->getId()=='create' ? 'created' : 'updated') 
                                            .'&name='.urldecode('Фото обьекта')
                                            .'&description='.urldecode('Описание фото'),
                                   'allowedExtensions'=>array("jpg"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                   'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                   //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                                   //'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName); }",
                                   //'messages'=>array(
                                   //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                   //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                   //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                   //                  'emptyError'=>"{file} is empty, please select files again without it.",
                                   //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                   //                 ),
                                   //'showMessage'=>"js:function(message){ alert(message); }"
                                  )
                    ));  ?>            
                <?php echo $form->fileField($model,'pic_scr_id'); ?>
		<?php// echo $form->textField($model,'pic_scr_id'); ?>
		<?php echo $form->error($model,'pic_scr_id'); ?>
	</div>*/?>
        
        <?/*
        <div class="row">
		<?php echo $form->labelEx($model,'unit_id'); ?>
		<?php echo $form->textField($model,'unit_id'); ?>
		<?php echo $form->error($model,'unit_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_value'); ?>
		<?php echo $form->textField($model,'unit_value',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'unit_value'); ?>
	</div>
         */?>

	<?/*
        <div class="row">
		<?php echo $form->labelEx($model,'metro_id'); ?>
		<?php echo $form->textField($model,'metro_id'); ?>
		<?php echo $form->error($model,'metro_id'); ?>
	</div>
        */?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'contract_type_id'); ?>
                <?php echo $form->dropDownList($model,'contract_type_id',   
                                               array_merge( array('0' => 'Выбор...'),  
                                               CHtml::listData(ContractTypes::model()->findAll(), 'id', 'title'))); ?>                          
		<?php// echo $form->textField($model,'contract_type_id'); ?>
		<?php echo $form->error($model,'contract_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contract_number'); ?>
		<?php echo $form->textField($model,'contract_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contract_number'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->labelEx($model,'fav'); ?>
		<?php echo $form->checkBox($model,'fav'); ?>
		<?php echo $form->error($model,'fav'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'recommend'); ?>
		<?php echo $form->checkBox($model,'recommend'); ?>
		<?php echo $form->error($model,'recommend'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'rented'); ?>
		<?php echo $form->checkBox($model,'rented'); ?>
		<?php echo $form->error($model,'rented'); ?>
	</div>        
        
        <div class="row">
		<?php echo $form->labelEx($model,'advertised'); ?>
		<?php echo $form->checkBox($model,'advertised'); ?>
		<?php echo $form->error($model,'advertised'); ?>
	</div>              
        
        <div class="row">
		<?php echo $form->labelEx($model,'realestateOthers'); ?>                	
                <?php $data =  CHtml::listData(Realestates::model()->findAll(array('select'=>'t.id,t.title',
                                                                                   'condition'=>($isId && !isset($copid)) ? 'not id='.$model->id : '')), 'id', 'title'); ?>
                <?php // Другая площадь
                      if ($isId) {    
                          
                          $others = RealestateSimilarities::model()->findAll("realestate_id=".(isset($copid) ? $copid : $model->id)." and realestate_linking_id=2", 
                                              array("select"=>"similaries_id"));                          
                          $selOthers = array();

                          foreach ( $others as $key=>$val) {
                              $selOthers[$val->similaries_id]=array("selected"=>true);                       
                          }                              

                          if ( isset($copid) && !isset($_POST["Realestates"])) {
                              $selOthers[$copid]=array("selected"=>true);                                                                 
                                                        
                              $parSimilarities= array_keys($selOthers);
                              
                              foreach ( $parSimilarities as $key=>$parid) {                                     
                                  
                                  $parOthers = getOthersRealty($parid,$selOthers);
                                  
                                  if (is_array($parOthers) && !empty($parOthers)) {  
                                    //print_r($parOthers);  
                                    $selOthers=$selOthers+$parOthers;                                    
                                  }
                              }   
                              //print_r($selOthers);
                          }    
                      }                      
                      
                      
                      function getOthersRealty($parid,$similar=array()) {
                          $parent = RealestateSimilarities::model()->findAll("realestate_id=".$parid." and realestate_linking_id=2", 
                                     array("select"=>"similaries_id")); 
                          if ($parent) {
                                foreach ( $parent as $val) {                                                    
                                    if (!array_key_exists($val->similaries_id,$similar)) {
                                        $similar[$val->similaries_id]=array("selected"=>true);                                                       
                                        return getOthersRealty($val->similaries_id,$similar);                                
                                    }    
                                }
                                return $similar;
                          }else{
                                return array();
                         }
                      }    
                ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'realestateOthers',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_realestateOthers',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',/*'width:378px;'*/
                            'multiple'=>true,
                            'options'=>(isset($selOthers) ? $selOthers : array()),
                            'prompt'=>'--'.Yii::t('all','Select')."--",  
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,                            
                            'header'=>true,  
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100, 
                            'multiple'=>true,    
                          ),
                )); ?>              
		<?php/* echo $form->listBox($model,'realestateOthers',
                                               CHtml::listData(Realestates::model()->findAll(), 'id', 'title'),
                                               array("multiple"=>"multiple","size"=>"1")); */?>
		<?php echo $form->error($model,'realestateOthers'); ?>
	</div>

                <div class="row">
		<?php echo $form->labelEx($model,'realestateSimilarities'); ?>                		
                <?php $data =  CHtml::listData(Realestates::model()->findAll(array('select'=>'t.id,t.title',
                                                                                   'condition'=>$isId ? 'not id='.(isset($copid) ? $copid : $model->id) : '')), 'id', 'title'); ?>
                <?php // Схожие предложения
                      if ($isId) {                          
                          $similarities = RealestateSimilarities::model()->findAll("realestate_id=".(isset($copid) ? $copid : $model->id)." and realestate_linking_id=1", 
                                              array("select"=>"similaries_id"));
                          
                          $selSimilarities = array();
                          foreach ( $similarities as $key=>$val) {
                            $selSimilarities[$val->similaries_id]=array("selected"=>true);
                          }
                      }                      
                ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'realestateSimilarities',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_realestateSimilarities',       
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',/*'width:378px;'*/
                            'multiple'=>true,
                            'options'=>(isset($selSimilarities) ? $selSimilarities : array()),  
                            'prompt'=>'--'.Yii::t('all','Select')."--",    
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,  
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100, 
                            'multiple'=>true,  
                          ),
                )); ?>              
		<?php/* echo $form->listBox($model,'realestateOthers',
                                               CHtml::listData(Realestates::model()->findAll(), 'id', 'title'),
                                               array("multiple"=>"multiple","size"=>"1")); */?>
		<?php echo $form->error($model,'realestateSimilarities'); ?>
	</div>

        <div class="row <?/*editor anons*/?>">
		<?php echo $form->labelEx($model,'anons'); ?>
		<?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>65,'style'=>"width:540px;", 'OnKeyUp'=>'createStat(this, 200, 450);', 'OnChange'=>'createStat(this, 200, 450);')); ?>		
                <?php/* $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'anons',
                        'config' => array(
                        'toolbar'=>array(
                            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                            array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
                        ),
                      ),                    
                     )); */?>
                <?php echo $form->error($model,'anons'); ?>
                <script>
                    createTextAreaWidget('Realestates_anons', 200, 450);
                </script>
	</div>

	<div class="row editor detile" style="padding-top:10px;">		
                <center class="plashka" ><?php echo $form->labelEx($model,'detile'); ?></center>  
                <div>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'detile',
                        'config' => array(
                            'language'=> $langs[Yii::app()->language],
                            'uiColor' => '#ebebeb',//#ededed',// '#AADC6E',
                            'toolbar'=>array(
                                array('Source','DocProps','-','NewPage','Preview','-','Templates'),
                                array('Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'),
                                array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
                                array('FitWindow','ShowBlocks','-','About'),
                                array('Image','Flash','Table','Rule','Smiley','SpecialChar','PageBreak'),
                                '/',
                                array('Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'),
                                array('OrderedList','UnorderedList','-','Outdent','Indent','Blockquote','CreateDiv'),
                                array('JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'),
                                array('Link','Unlink','Anchor'),
                                array('TextColor','BGColor'),
                                array('Style','FontFormat','FontName','FontSize'),
                                
                            ),                            
                            /*'toolbar'=>array(
                                array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                                array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
                            ),*/
                        ),
                     )); ?>
		<?php// echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detile'); ?>
                </div>    
	</div>

        <div class="row editor desc" style="padding-top:10px;" >
		<center class="plashka" ><?php echo $form->labelEx($model,'description'); ?></center>  
                <div>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'description',   
                        'config' => array(
                            'language'=> $langs[Yii::app()->language],
                            'uiColor' => '#ebebeb',//#ededed',// '#AADC6E',
                            'toolbar'=>array(
                                array('Source','DocProps','-','NewPage','Preview','-','Templates'),
                                array('Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'),
                                array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
                                array('FitWindow','ShowBlocks','-','About'),
                                array('Image','Flash','Table','Rule','Smiley','SpecialChar','PageBreak'),
                                '/',
                                array('Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'),
                                array('OrderedList','UnorderedList','-','Outdent','Indent','Blockquote','CreateDiv'),
                                array('JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'),
                                array('Link','Unlink','Anchor'),
                                array('TextColor','BGColor'),
                                array('Style','FontFormat','FontName','FontSize'),
                                
                            ),
                        ),    
                     )); ?>            
		<?php// echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
                </div>    
	</div>
	<div class="row">
            <div>
		<?php// echo $form->labelEx($model,'seo_title',array('label'=>'SEO заголовок')); ?>
                <?php $optTitle=CHtml::ajaxLink('',Yii::app()->createUrl('realestates/genTitle'), array(
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#realestates-form").serialize()',    
                                                                'beforeSend'=>'function(){                                                            
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){
                                                                     //$("#loadTitle").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Realestates_seo_title').val(data.content); 
                                                                    createTextAreaWidget('Realestates_seo_title', 175, 250, false)
                                                                 }"
                                                       ),
                                                       array('class'=>'genTitle', 'title'=>'Авто генерация seo-заголовка', 'rel'=>'nofollow')); ?>                
                <?php echo MyCHtml::activeLabelEx($model,'seo_title',array('label'=>'SEO заголовок', 'optional'=>$optTitle)); ?>
		<?php echo $form->textField($model,'seo_title',
                                array('size'=>87,'maxlength'=>255, 'style'=>'width:540px;',
                                      'onfocus'=>/*"var seo_title=$('#Realestates_seo_title').val();
                                        if (seo_title.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('Realestates/genTitle'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#realestates-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var seo_title=$("#Realestates_seo_title").val();
                                                                    if (seo_title.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadTitle").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadTitle',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Realestates_seo_title').val(data.content); 
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    ))); ?>
		<?php echo $form->error($model,'seo_title'); ?>      
                <script>
                    $("#Realestates_seo_title").charCount({
                        allowed: 80,
                        warning: 75,
                        counterText: 'Количество символов: '
                    });
                </script>    
             </div>   
	</div>    
        <? if ( Yii::app()->user->checkAccess('superadmin') || Yii::app()->user->checkAccess('editor') || Yii::app()->user->name == 'adminone' || Yii::app()->user->name == '7777998@mail.ru' ) { ?> 
        <div class="row">
                 <?php $optDesc=CHtml::ajaxLink('',Yii::app()->createUrl('realestates/genDescription'), array(
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#realestates-form").serialize()',    
                                                                'beforeSend'=>'function(){                                                            
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){
                                                                     //$("#loadDescription").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Realestates_seo_desc').val(data.content); 
                                                                    createTextAreaWidget('Realestates_seo_desc', 175, 250, false)
                                                                 }"
                                                       ),
                                                       array('class'=>'genDescription', 'title'=>'Авто генерация seo-описания', 'rel'=>'nofollow')); ?>

		<?php echo MyCHtml::activeLabelEx($model,'seo_desc',array('label'=>'SEO описание', 'optional'=>$optDesc)); ?>
		<?php echo $form->textArea($model,'seo_desc',
                                           array('rows'=>6, 'cols'=>65, /*'maxlength'=>450,*/ 'OnKeyUp'=>'createStat(this, 175, 250, false);', 'OnChange'=>'createStat(this, 175, 250, false);', 'style'=>"width:540px;", 
                                                 'onfocus'=>/*"var seo_title=$('#Realestates_seo_desc').val();
                                                 if (seo_desc.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('Realestates/genDescription'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#realestates-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var seo_desc=$("#Realestates_seo_desc").val();
                                                                    if (seo_desc.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadDescription").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadTitle',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Realestates_seo_desc').val(data.content); 
                                                                    createTextAreaWidget('Realestates_seo_desc', 175, 250, false)
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    )
                                               )); ?>		
                <?php echo $form->error($model,'seo_desc'); ?>
            <script>            
                createTextAreaWidget('Realestates_seo_desc', 200, 450, false);
                /*$('#Realestates_seo_desc').kwcount({ hide_delay: 2000,
                                                     show_max: true,
                                                     maxlength: 450, 
                                                     limit: true/*,
                                                     count_type: 'words'
                                                   });*/
            </script>
	</div>        
        <div class="row">
		<?php// echo $form->labelEx($model,'seo_keywords',array('label'=>'SEO ключевые слова')); ?>
                <?php $optKeywords = CHtml::ajaxLink('',Yii::app()->createUrl('realestates/genKeywords'), array(
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#realestates-form").serialize()',    
                                                                'beforeSend'=>'function(){                                                            
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){
                                                                     //$("#loadKeywords").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Realestates_seo_keywords').val(data.content); 
                                                                    createTextAreaWidget('Realestates_seo_keywords', 175, 300, false)
                                                                 }"
                                                       ),
                                                       array('class'=>'genKeywords', 'title'=>'Авто генерация seo-описания', 'rel'=>'nofollow')); ?>            
                <?php echo MyCHtml::activeLabelEx($model,'seo_keywords',array('label'=>'SEO ключ.слова', 'optional'=>$optKeywords)); ?>            
		<?php echo $form->textArea($model,'seo_keywords',
                           array('rows'=>6, 'cols'=>65, /*'maxlength'=>175,*/ 'OnKeyUp'=>'createStat(this, 175, 300, false);', 'OnChange'=>'createStat(this, 175, 300, false);', 'style'=>"width:540px;",
                                 'onfocus'=>/*"var title=$('#Iblocks_title').val();
                                        if (title.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('Realestates/genKeywords'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#realestates-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var seo_keywords=$("#Realestates_seo_keywords").val();
                                                                    if (seo_keywords.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadKeywords").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Realestates_seo_keywords').val(data.content); 
                                                                    createTextAreaWidget('Realestates_seo_keywords', 175, 300, false);
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    ))); ?>		
                <?php echo $form->error($model,'seo_keywords'); ?>
            <script>
                createTextAreaWidget('Realestates_seo_keywords', 175, 300, false);
                /*$('#Realestates_seo_keywords').kwcount({ hide_delay: 2000,
                                                     show_max: true,
                                                     maxlength: 250/*, 
                                                     limit: true,
                                                     count_type: 'words'
                                                   });*/
            </script>
	</div>    
        <? } ?>
        <div class="row" style="padding-top:10px;">
		<?php echo $form->labelEx($model,'is_resize'); ?>             
                <?php $htmlOpt = array( "onclick"=>" if ( $('#Realestates_is_resize').attr('checked')=='checked' ) "
                                           ."{ "                           
                                           ."  $('#pic_oreginal').show(); "
                                           ."  $('#pic_scr').hide(); $('#pic_anons').hide(); $('#pic_detile').hide();"                               
                                           ."}else{"
                                           ."  $('#pic_oreginal').hide(); "
                                           ."  $('#pic_scr').show(); $('#pic_anons').show(); $('#pic_detile').show();"                                                      
                                           ."}");
                      if ( $model->is_resize===null ) $htmlOpt = array_merge($htmlOpt,array("checked"=> "checked"));
                ?>
                <?php echo $form->checkBox($model,'is_resize', $htmlOpt); ?>                
		<?php// echo $form->textField($model,'is_resize'); ?>
		<?php echo $form->error($model,'is_resize'); ?>
	</div>        
        <div id="pic_oreginal" class="row <?=( $model->is_resize || $model->is_resize===null ? '' : 'hidden' );?>">
		<?php echo $form->labelEx($model,'picOreginal'); ?>
                <?php echo $form->fileField($model,'picOreginal'); ?>   
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_anons #ytRealestates_picOreginal').val('');$('#pic_oreginal #Realestates_picOreginal').val('');" )); ?>
                <?php // echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_anons #ytRealestates_picOreginal').val('');$('#pic_oreginal #Realestates_picOreginal').val('');$('#Realestates_pic_anons_id').val('');" )); ?>            
                <?php if ( !empty($model->pic_oreginal_id) ) : ?>                
                <?php //print_r($model->pic_oreginal_id); ?>             
                <?php $picOreginal = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                                                '_small'.substr($model->picOreginal->original_name,-4,4),
                                                $model->picOreginal->original_name); 
                ?>
                <div id="realestate-pic-oreginal" class="realestate-pic">
                    <div class="pic">
                    <?php         
                      echo CHtml::link(CHtml::image( $picOreginal,'', 
                                                     array('title'=>$model->picOreginal->name,
                                                           'style'=>"padding-left:10px;vertical-align:middle")), 
                                                           '/'.$model->picOreginal->original_name, 
                                                           array('class'=>'fancyImage'));

                    ?>
                    </div>
                    <div class="del-pic" >
                    <?php
                      echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_oreginal', "onclick"=>"$('#realestate-pic-oreginal').remove();$('#Realestates_pic_oreginal_id').remove();"));
                      /*echo Chtml::ajaxLink('x', 
                                           '/bax.php/realestates/ajaxdeletepicoreginal', 
                                           array(), // Свойства ajax
                                           array("id"=>'del_pic_oreginal'));*/
                    ?>
                    </div>
                </div>    
                <?php endif; ?>
                <?php// echo $form->checkbox($model,'del_pic_oreginal_id'); ?>
		<?php// echo $form->textField($model,'picOreginal'); ?>
		<?php echo $form->error($model,'picOreginal'); ?>
	</div>
        <div class="clear" ></div>
	<div id="pic_scr" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
		<?php echo $form->labelEx($model,'picScr'); ?>                
                <?php echo $form->fileField($model,'picScr'); ?>                
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_scr #ytRealestates_picScr').val('');$('#pic_scr #Realestates_picScr').val('');" )); ?>
                <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_scr #ytRealestates_picScr').val('');$('#pic_scr #Realestates_picScr').val('');$('#pic_scr_id').val('');" )); ?>
                <?php if ( !empty($model->pic_scr_id) ) : ?>
                <?php $picScr = '/'.str_replace('_original'.substr($model->picScr->original_name,-4,4),
                                                '_small'.substr($model->picScr->original_name,-4,4),
                                                $model->picScr->original_name); 
                ?>                           
                <div id="realestate-pic-scr" class="realestate-pic">
                    <div class="pic">
                    <?php 
                      echo CHtml::link(CHtml::image( $picScr,'', 
                                                     array('title'=>$model->picScr->name,
                                                           'style'=>"padding-left:10px;vertical-align:middle")), 
                                                           '/'.$model->picScr->original_name, 
                                                            array('class'=>'fancyImage'));
                    ?>                                   
                    </div>
                    <div class="del-pic" >
                <?php
                      echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_src', "onclick"=>"$('#realestate-pic-scr').remove();$('#Realestates_pic_scr_id').remove();"));
                ?>
                    </div>
                </div>            
                <?php endif; ?>
		<?php echo $form->error($model,'picScr'); ?>
	</div>
        <div class="clear" ></div>
	<div id="pic_anons" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
		<?php echo $form->labelEx($model,'picAnons'); ?>                
                <?php echo $form->fileField($model,'picAnons'); ?>
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_anons #ytRealestates_picAnons').val('');$('#pic_anons #Realestates_picAnons').val('');" )); ?>
                <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_anons #ytRealestates_picAnons').val('');$('#pic_anons #Realestates_picAnons').val('');$('#pic_anons_id').val('');" )); ?>
                <?php if ( !empty($model->pic_anons_id) ) : ?>
                <?php $picAnons = '/'.str_replace('_original'.substr($model->picAnons->original_name,-4,4),
                                                '_small'.substr($model->picAnons->original_name,-4,4),
                                                $model->picAnons->original_name); ?>           
                <div id="realestate-pic-anons" class="realestate-pic">
                    <div class="pic">
                    <?php 
                      echo CHtml::link(CHtml::image( $picAnons, '',
                                                     array('title'=>$model->picAnons->name,
                                                           'style'=>"padding-left:10px;vertical-align:middle")), 
                                                           '/'.$model->picAnons->original_name, 
                                                            array('class'=>'fancyImage'));
                    ?>                                
                    </div>
                    <div class="del-pic" > 
                <?php
                    echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_anons', "onclick"=>"$('#realestate-pic-anons').remove();$('#Realestates_pic_anons_id').remove();"));                    
                      /*echo Chtml::ajaxLink('x', 
                                           '/bax.php/realestates/ajaxdeletepicanons', 
                                           array(), // Свойства ajax
                                           array("id"=>'del_pic_anons'));*/
                ?>
                    </div>
                </div>            
                <?php endif; ?>
		<?php echo $form->error($model,'picAnons'); ?>
	</div>
        <div class="clear" ></div>
	<div id="pic_detile" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
		<?php echo $form->labelEx($model,'picDetile'); ?>
                <?php echo $form->fileField($model,'picDetile'); ?>
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_detile #ytRealestates_picDetile').val('');$('#pic_detile #Realestates_picDetile').val('');" )); ?>
                <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_detile #ytRealestates_picDetile').val('');$('#pic_detile #Realestates_picDetile').val('');$('#pic_detile_id').val('');" )); ?>            
                <?php $picDetile = '/'.str_replace('_original'.substr($model->picDetile->original_name,-4,4),
                                                '_small'.substr($model->picDetile->original_name,-4,4),
                                                $model->picDetile->original_name); 
                ?>
                <?php if ( !empty($model->pic_detile_id) ) : ?>
                <div id="realestate-pic-detile" class="realestate-pic">
                    <div class="pic">
                    <?php 
                        echo CHtml::link(CHtml::image( $picDetile, '', 
                                         array('title'=>$model->picDetile->name,
                                               'style'=>"padding-left:10px;vertical-align:middle")), 
                                               '/'.$model->picDetile->original_name, 
                                               array('class'=>'fancyImage'));
                    ?>                                             
                    </div>
                    <div class="del-pic" >
                <?php
                    echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_detile', "onclick"=>"$('#realestate-pic-detile').remove();$('#Realestates_pic_detile_id').remove();"));
                ?>
                    </div>
                </div>
                <?php endif; ?>
		<?php echo $form->error($model,'picDetile'); ?>
                <script>
                   $(document).ready(function() {
                   $(".fancyImage").fancybox(
                        {'overlayShow': true, 'hideOnContentClick': false});
                   }); 
                </script>  
                <script>
                   $(document).ready(function() {
                   $(".fancySladeShow[rel=RealestateFotos]").fancybox({
                        'showCloseButton': true,
                        'overlayShow' : true,
                	'transitionIn': 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                                                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                                                  }                                   
			});                        
                   }); 
                </script>  
                <script>
                    $(document).ready(function() {
                    $(".fancyFrame").fancybox(
                        {'width': 800, 'height':600, 'frameWidth' : 800, 'frameHeight': 600, 'overlayShow': true, 'hideOnContentClick': false});
                    }); 
                </script>  
	</div>
        <div class="clear" ></div>     
        <div class="row multi">
		<?php echo $form->labelEx($model,'realestateFotos'); ?>           
                <?php
                     $this->widget('CMultiFileUpload', array(
                    'model'=>$model,
                        'attribute'=>'realestateFotos',
                        'accept'=>'jpg|gif|jpeg',
                        /*'options'=>array(
                        'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
                        'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
                        'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                        'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                        'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                        'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
                    ),*/
                    ));
                ?>                
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#Realestates_realestateFotos_wrap_list').html('');",
                                                            'class'=>"float:right; margin-right: 250px;" )); ?> 
                <?php $realestateFotos=array();
                      if (!empty($model->realestateFotos)) {
                        foreach ($model->realestateFotos as $key=>$realestateFoto) $realestateFotos[] = $realestateFoto->file_id; 
                      }
                      if (!empty($realestateFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$realestateFotos).')');                          
                ?>
                <div class="block-fotos">
                <?php    
                     
                      foreach ($fotos as $key=>$foto) {
                            $picFoto = '/'.str_replace('_original'.substr($foto->original_name,-4,4),
                                                    '_small'.substr($foto->original_name,-4,4),
                                                    $foto->original_name); 
                ?>                                                
                  <div id="realestate-fotos-<?=$foto->id;?>" class="realestate-fotos">
                    <div class="fotos">
                <?php
                      echo CHtml::link(CHtml::image( $picFoto, '', 
                                                      array('title'=>$foto->name)),                                                       
                                                      '/'.$foto->original_name, 
                                                      array('class'=>'fancySladeShow',
                                                            'rel'=>"RealestateFotos",
                                                            'title'=>$foto->name));                           
                ?>                       
                    </div>
                    <div class="del-fotos" >
                <?php
                    echo Chtml::link("x", "javascript:void();", 
                               array("id"=>'delfotos-'.$foto->id, 
                                     "onclick"=>"$('#realestate-fotos-".$foto->id."').remove();$('#Realestates_realestateFotos_".$foto->id."').remove();"));
                ?>
                    </div>
                  </div>
        <?php    } ?>
               </div>
        <?php } ?>                  
        <?php// echo $form->textField($model,'pic_detile_id'); ?>
	<?php echo $form->error($model,'realestateFotos'); ?>
	</div>
        
        <?/*<div class="row multi" style="padding-bottom:10px;" >
                <?php echo $form->labelEx($model,'realestatePresentations'); ?>                      
                <?php
                     $this->widget('CMultiFileUpload', array(
                    'model'=>$model,
                        'attribute'=>'realestatePresentations',
                        'accept'=>'pdf|mov|doc|odt|rtf',                         
                        /*'options'=>array(
                        'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
                        'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
                        'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                        'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                        'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                        'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
                    ),
                    ));
                ?>
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#Realestates_realestatePresentations_wrap_list').html('');",
                                                            'style'=>"float: right; margin-right: 250px;" )); ?>            
                <?php $realestatePresentations=array();
                      if (!empty($model->realestatePresentations)) {
                      foreach ($model->realestatePresentations as $key=>$realestatePresentation) $realestatePresentations[] = $realestatePresentation->file_id; 
                      }
                          if (!empty($realestatePresentations)) {
                              $presentations = Files::model()->findAll('id in ('.implode(",",$realestatePresentations).')');
                    ?>               
                          <div style="display: inline-block;padding-left: 155px;width: 100%;">

                    <?php foreach ($presentations as $key=>$presentation) { ?>

                             <div id="realestate-presentations-<?=$realestatePresentation->id;?>" class="realestate-presentations">
                                 <div class="presentations">
                                    <?php 
                                     echo CHtml::link( $presentation->name, 
                                                       'http://'.$_SERVER["SERVER_NAME"].'/'.$presentation->original_name, 
                                                        array('title'=>$presentation->name,
                                                              'style'=>'padding-left:10px;vertical-align:middle',
                                                              'class'=>'fancyFrame iframe'));                            
                                    ?>
                                </div>
                                <div class="del-presentations" >
                                <?php
                                     /*echo Chtml::link( 'x', '/bax.php/realestates/ajaxdeletepresentations', 
                                                       array(), // Свойства ajax
                                                       array("id"=>'delpresentations-'.$presentation->id));
                                     echo Chtml::link("x", "javascript:void();", 
                                        array("id"=>'delpresentations-'.$realestatePresentation->id,
                                              "onclick"=>"$('#realestate-presentations-".$realestatePresentation->id."').remove();$('#Realestates_realestatePresentations_".$realestatePresentation->id."').remove();"));                                     
                                ?>
                                </div>  
                             </div>    
                    <?php } ?>                         
                         </div>
                <?php } ?>                    
		<?php// echo $form->textField($model,'pic_detile_id'); ?>
		<?php echo $form->error($model,'realestatePresentations'); ?>
	</div>*/?>
        
        <div class="row" style="padding-bottom:5px;" >
            <center class="plashka" ><b>Координаты недвижимости на карте:</b></center>                        
            <div class="cke_skin_kama">    
                <?php echo $map;?>     
            </div>    
            <div>
                <?php echo $form->hiddenField($model,'pic_detile_id'); ?>
                <?php echo $form->hiddenField($model,'pic_anons_id'); ?>
                <?php echo $form->hiddenField($model,'pic_oreginal_id'); ?>
                <?php echo $form->hiddenField($model,'pic_scr_id'); ?>                
                
                <?php if (!empty($model->realestateFotos)) {
                        foreach( $model->realestateFotos as $key=>$realestateFoto ) 
                           echo CHtml::hiddenField( 'Realestates[realestateFotos][]', $realestateFoto->id, 
                                                  array( 'id'=>'Realestates_realestateFotos_'.$realestateFoto->file_id,
                                                         'class'=>'Realestates_realestateFotos'));                    
                      }
                ?>
                
                <?php if (!empty($model->realestatePresentations)) {
                        foreach( $model->realestatePresentations as $key=>$realestatePresentation ) 
                         echo CHtml::hiddenField( 'Realestates[realestatePresentations][]', $realestatePresentation->id, 
                                                  array('id'=>'Realestates_realestatePresentations_'.$realestatePresentation->id,
                                                        'class'=>'Realestates_realestatePresentations'));                    
                      }  
                ?>
                <?php echo $form->hiddenField($model,'uid');?>
                <?php echo $form->hiddenField($model,'sid');?>
                <?php echo $form->hiddenField($model,'nid');?>                
                <?php if ( !Yii::app()->user->checkAccess('superadmin') /*&& !Yii::app()->user->name = 'adminone'*/ ) { ?>                
                        <?php 
                        if ( Yii::app()->controller->action->id==='copy' || $model->isNewRecord ) :                              
                        ?>
                        <?php   echo $form->hiddenField($model,'act',array('value'=>0)); ?>
                        <?php else : ?>
                        <?php   echo $form->hiddenField($model,'act'); ?>                            
                        <?php endif; ?>
                <?php } ?>
                <?php if ( !Yii::app()->user->checkAccess('superadmin')) { ?>
                        <?php if ( Yii::app()->controller->action->id==='copy' || $model->isNewRecord ) : ?>
                        <?php   echo $form->hiddenField($model,'del',array('value'=>0)); ?>
                        <?php else : ?>
                        <?php   echo $form->hiddenField($model,'del'); ?>                            
                        <?php endif; ?>
                <?php } ?>
                <?php echo $form->hiddenField($model,'map_latitude',array('default'=>55.756387)); ?>
                <?php echo $form->hiddenField($model,'map_longitude',array('default'=>37.605278)); ?>                
            </div>
        </div>    
               
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'map_latitude'); ?>
		<?php echo $form->textField($model,'map_latitude',array('size'=>20,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'map_latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map_longitude'); ?>
		<?php echo $form->textField($model,'map_longitude',array('size'=>20,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'map_longitude'); ?>
	</div>*/?>

<?php $this->endWidget(); ?>

</div><!-- form Realestates-->

<?php                
              $this->beginWidget('zii.widgets.jui.CJuiDialog', 
                                        array(
                                            'id' => 'dialogRepresentatives',
                                            'options' => 
                                                 array( 'title' => 'Редактирование представителя',
                                                        'autoOpen' => false,
                                                        'modal' => true,
                                                        'resizable'=> false,
                                                        'width'=>800,
                                                 ),                                            
                                       ));
                    
                 $model_representatives = ($model->representative ? $model->representative : Representatives::model());
                 ?>
                 <div class="wide form l150">  
                 <?php $formReps = $this->beginWidget('CActiveForm', 
                                array( 'id' => 'quick-form-Representatives',
                                        'enableClientValidation' => true,
                                        'clientOptions' => array(
                                           'validateOnSubmit' => true,
                                        ),
                                        'action' => array('representatives/create'),
                            ));
                ?>   
                
                <?php echo $formReps->errorSummary($model_representatives); ?>

                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'name'); ?>
                        <?php echo $formReps->textField($model_representatives,'name',array('size'=>60,'maxlength'=>75)); ?>
                        <?php echo $formReps->error($model_representatives,'name'); ?>
                    </div>    
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'fio'); ?>
                        <?php echo $formReps->textField($model_representatives,'fio',array('size'=>75,'maxlength'=>255)); ?>
                        <?php echo $formReps->error($model_representatives,'fio'); ?>
                    </div>                        
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'telephone'); ?>
                        <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model_representatives,
                                    'attribute' => 'telephone',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>
                        <?php// echo $formReps->textField($model_representatives,'telephone',array('size'=>30,'maxlength'=>255)); ?>
                        <?php// echo $formReps->textField($model_representatives,'telephone',array('size'=>30,'maxlength'=>255)); ?>
                        <?php echo $formReps->error($model_representatives,'telephone'); ?>
                        <?php echo $formReps->labelEx($model_representatives,'telephone_1',array('label'=>'Доп.телефоны')); ?>
                        <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model_representatives,
                                    'attribute' => 'telephone_1',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>
                        <?php echo $formReps->error($model_representatives,'telephone_1'); ?>                       
                        <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model_representatives,
                                    'attribute' => 'telephone_2',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>
                        <?php echo $formReps->error($model_representatives,'telephone_2'); ?>                       
                        <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model_representatives,
                                    'attribute' => 'telephone_3',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>
                        <?php echo $formReps->error($model_representatives,'telephone_3'); ?>                                               
                    </div>                                            
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'fax'); ?>
                        <?php
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model_representatives,
                                    'attribute' => 'fax',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>
                        <?php// echo $formReps->textField($model_representatives,'telephone',array('size'=>30,'maxlength'=>255)); ?>
                        <?php// echo $formReps->textField($model_representatives,'telephone',array('size'=>30,'maxlength'=>255)); ?>
                        <?php echo $formReps->error($model_representatives,'fax'); ?>
                    </div>                        
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'email'); ?>
                        <?php echo $formReps->textField($model_representatives,'email',array('size'=>60,'maxlength'=>255)); ?>
                        <?php echo $formReps->error($model_representatives,'email'); ?>
                    </div>   
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'site'); ?>
                        <?php echo $formReps->textField($model_representatives,'site',array('size'=>60,'maxlength'=>255)); ?>
                        <?php echo $formReps->error($model_representatives,'site'); ?>
                    </div>                                                                
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'desc'); ?>
                        <?php echo $form->textArea($model_representatives,'desc',array('rows'=>6, 'cols'=>65,'style'=>"width:540px;",'onkeypress'=>"count_desc()", 'onkeyup'=>"count_desc()")); ?>		                                                
                        <?php echo $formReps->error($model_representatives,'desc'); ?>
                    </div>                                                                
                    <div class="row hidden-row" >                                                
                        <?php echo $form->hiddenField($model_representatives,'id'); ?>
                        <?php echo CHtml::hiddenField('what',$what); ?>
                    </div>                                                                
 
                    <div class="row buttons">
                        <?php echo CHtml::ajaxSubmitButton( Yii::t('form','Save'), 
                                                            Yii::app()->controller->createUrl("representatives/ajaxsave"),
                                array ( 'type' => 'POST',                                                                                  
                                        'dataType'=>'json',
                                    	'beforeSend' =>' function(){
                                            var loading = $("<div>", {
                                                            "class" : "ds-loading"
                                            });
                                            $(loading).css("top", ($(window).height()/2)-($(loading).height()/2)).css("left", ($(document).width()/2)-($(loading).width()/2));
                                            $("body").append(loading);
                                        }',
                                        'success'   =>' function(data) {  
                                            if ( data.success ) {
                                              $(".ds-loading").detach();
                                              $("#dialogRepresentatives").dialog("close");                      
                                              
                                              var el  = $("#Realestates_representative_id").multiselect();                                              
                                              var els  = $("#Realestates_realestateRepresentatives").multiselect();                       
                                              
                                              if ( data.oper == "update" ) { 
                                                  $("#Realestates_representative_id option").filter(":selected").text(data.name+" - #"+data.id);
                                                  $("#Realestates_realestateRepresentatives option").filter(function(index) { return this.value == data.id; }).text(data.name+" - #"+data.id);
                                              }else{
                                                  if ( data.what == "owner" ) {  
                                                        var opt_el = $("<option />", {
                                                                     value: data.id, text: data.name+" - #"+data.id, selected: "selected" }
                                                        );
                                                        opt_el.appendTo( el );		
                                                        var opt_els = $("<option />", {
                                                               value: data.id, text: data.name+" - #"+data.id, selected: "selected" }
                                                        );
                                                        opt_els.appendTo( els );
                                                  }else if ( data.what == "repres" ) {  
                                                        var opt_el = $("<option />", {
                                                                     value: data.id, text: data.name+" - #"+data.id }
                                                        );
                                                        opt_el.appendTo( el );		
                                                        var opt_els = $("<option />", {
                                                               value: data.id, text: data.name+" - #"+data.id, selected: "selected" }
                                                        );
                                                        opt_els.appendTo( els );		
                                                  }else{
                                                        var opt_el = $("<option />", {
                                                                     value: data.id, text: data.name+" - #"+data.id, selected: "selected" }
                                                        );
                                                        var opt_els = $("<option />", {
                                                               value: data.id, text: data.name+" - #"+data.id, selected: "selected" }
                                                        );                                                        
                                                        opt_el.appendTo( el );		
                                                        opt_els.appendTo( els );		
                                                  }
                                                  
                                              }                                              
                                              el.multiselect("refresh");                                                                                            
                                              els.multiselect("refresh");                                              
                                              
                                            } else {
                                              alert(data.message);
                                            }
                                        }'                                        
                                )); ?>
                    </div>
                 </div>
                <?php
                $this->endWidget();
              $this->endWidget('zii.widgets.jui.CJuiDialog');
           ?>            
           <script type="text/javascript">                               
                    $(function () {
                        //onAdd representative
                        $('#AddRepresentative').live('click',function() {                            
                            $("#Representatives_name,#Representatives_fio,#Representatives_site,#Representatives_telephone,#Representatives_id").val("");            
                            $("#quick-form-Representatives").attr("action","<?=Yii::app()->controller->createUrl("representatives/ajaxcreate",array("ajax"=>"representatives-form"))?>");                            
                            $("#what").val("owners")
                            $("#dialogRepresentatives" ).dialog( "option", "title", "<?=Yii::t("form","Create Representative");?>" );
                            $("#dialogRepresentatives").dialog("open");                                             
                        });
                        
                        $('#AddRepresentatives').live('click',function () {
                            $("#Representatives_name,#Representatives_fio,#Representatives_site,#Representatives_telephone,#Representatives_id").val("");                            
                            $("#quick-form-Representatives").attr("action","<?=Yii::app()->controller->createUrl("representatives/ajaxcreate",array("ajax"=>"representatives-form"))?>");                            
                            $("#dialogRepresentatives" ).dialog( "option", "title", "<?=Yii::t("form","Create Representative");?>" );                            
                            $("#dialogRepresentatives").dialog("open");                                                          
                            $("#what").val("repres")
                        });
                        
                        //onAdd representative
                        $('#EditRepresentative').live('click',function () {                            
                            var url = '/bax.php/representatives/ajaxget?id='+$('#Realestates_representative_id').val();
                            $.ajax({
                                url: url,                                
                                dataType: 'json',
				beforeSend: function(){
					var loading = $("<div>", {
                                                            "class" : "ds-loading"
                                            });
                                            $(loading).css("top", ($(window).height()/2)-($(loading).height()/2)).css("left", ($(document).width()/2)-($(loading).width()/2));
                                            $("body").append(loading);
				},
                                success: function(data) {
                                    
                                    $("#Representatives_name").val(data.name);
                                    $("#Representatives_fio").val(data.fio);
                                    $("#Representatives_site").val(data.site);
                                    $("#Representatives_telephone").val(data.telephone);
                                    $("#Representatives_desc").val(data.desc);
                                    $("#Representatives_id").val(data.id);
                                    
                                    $(".ds-loading").detach();
                                    $("#quick-form-Representatives").attr("action","<?=Yii::app()->controller->createUrl("representatives/ajaxupdate", array("id"=>$model->representative_id))?>");                            
                                    $("#dialogRepresentatives" ).dialog( "option", "title", "<?=Yii::t("form","Edit Representative");?>" );                            
                                    $('#dialogRepresentatives').dialog("open");
                                }
                            });                                                        
                        });
                        
                        $('#DeleteRepresentative').live('click',function () {
                            var ajax = "representatives-form";
                            var url = '/bax.php/representatives/ajaxdelete?id='+$('#Realestates_representative_id').val();                            
                            $.ajax({
                                url: url,
                                data: ajax,
                                dataType: 'json',
				beforeSend: function(){
					var loading = $("<div>", {
                                                            "class" : "ds-loading"
                                            });
                                            $(loading).css("top", ($(window).height()/2)-($(loading).height()/2)).css("left", ($(document).width()/2)-($(loading).width()/2));
                                            $("body").append(loading);
				},
                                success: function(data) {
                                    $(".ds-loading").detach();
                                    if (data.success) {                                              
                                        
                                        var el  = $("#Realestates_representative_id").multiselect();                                              
                                        var els  = $("#Realestates_realestateRepresentatives").multiselect();                       
                                        $("#Realestates_representative_id option").filter(":selected").remove();
                                        $("#Realestates_realestateRepresentatives option").filter(function(index) { return this.value == data.id; }).remove();
                                        el.multiselect("refresh");                                              
                                        els.multiselect("refresh");                                

                                    } else {
                                        alert( data.message );
                                    }                                             
                                }
                            });                                                
                        });
                        
                    });
              </script>
<!-- modal form Representative -->