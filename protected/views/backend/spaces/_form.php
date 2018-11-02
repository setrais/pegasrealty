<div class="wide form l150">
<?php $isId = (empty($model->id) ? false : true); ?>  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'spaces-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'), 
)); ?>

	<p class="note"><?=Yii::t('form','Fields marked <span color="red">*</span> are required for entry.');?></p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
          <?php echo $form->labelEx($model,'space_type_id'); ?>
          <?php echo $form->dropDownList($model,'space_type_id',                           
                       CHtml::listData( SpaceTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>             
            <?php// echo $form->textField($model,'space_type_id'); ?>
            <?php echo $form->error($model,'space_type_id'); ?>
	</div>

        <div class="row">
          <?php echo $form->labelEx($model,'operation_id'); ?>
          <?php echo $form->dropDownList($model,'operation_id',   
                       CHtml::listData(Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>             
	  <?php// echo $form->textField($model,'space_type_id'); ?>
	  <?php echo $form->error($model,'operation_id'); ?>
	</div>

        <div class="row">
          <?php echo $form->labelEx($model,'district_id'); ?>
	  <?php// echo $form->textField($model,'district_id'); ?>
          <?php echo $form->dropDownList($model,'district_id',
                        CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                          array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>
	  <?php echo $form->error($model,'district_id'); ?>
	</div>
                
        <div class="row">
          <?php echo $form->labelEx($model,'metro_id'); ?>
          <?php $data = CHtml::listData(Metros::model()->findAll(), 'id', 'title'); ?>
          <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'metro_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_metro_id',    
                          // additional HTML attributes for the drop down list:                           
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/, 
                            'prompt'=>Yii::t('all','Select')."...",  
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
                         CHtml::listData(Units::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'short_title'), array('prompt'=>Yii::t('all','Выберите ед.измерения'))); ?>    		
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
                    'source' =>Yii::app()->createUrl('spaces/autocompletetitle'),
                     // параметры, подробнее можно посмотреть на сайте
                     // http://jqueryui.com/demos/autocomplete/
                    'options'=>array(
                         // минимальное кол-во символов, после которого начнется поиск
                        'minLength'=>'2',
                        'showAnim'=>'fold',
                        // обработчик события, выбор пункта из списка
                        'change' =>'js: function(event, ui) {
                            $(\'input#Spaces_title[type="hidden"]\').val($(\'input#Spaces_title\').val());
                        }',
                        'select' =>'js: function(event, ui) {
                        // действие по умолчанию, значение текстового поля
                        // устанавливается в значение выбранного пункта
                        this.value = ui.item.label;
                        // устанавливаем значения скрытого поля                        
                        $("#Spaces_title").val(ui.item.title);
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
                                $('input#Spaces_title[type="hidden"]').val($('input#Spaces_title').val()); 
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
                    'source' =>Yii::app()->createUrl('spaces/autocompleteaddress'),
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
                        $("#Spaces_address").val(ui.item.address);
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
                                $('input#Spaces_address[type="hidden"]').val($('input#Spaces_address').val()); 
                            }
                        );
                   });
                </script>
                                            
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'space_vid_id'); ?>
                <?php echo $form->dropDownList($model,'space_vid_id',   
                              CHtml::listData(SpaceVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."..." )); ?>                                     
		<?php// echo $form->textField($model,'space_vid_id'); ?>
		<?php echo $form->error($model,'space_vid_id'); ?>
	</div>

        
	<div class="row" >
		<?php echo $form->labelEx($model,'space_class_id'); ?>
                <?php echo $form->dropDownList($model,'space_class_id',   
                              CHtml::listData(SpaceClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                     
		<?php// echo $form->textField($model,'space_class_id'); ?>
		<?php echo $form->error($model,'space_class_id'); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'date_rang'); ?>
            <?php $langs = array_flip(Yii::app()->params->languages); 
                  if ($model->date_rang) 
                      $model->date_rang = date('d.m.Y',  strtotime($model->date_rang))
            ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> $langs[Yii::app()->language],                                        
                    'model'=>$model,
                    'attribute'=>'date_rang',   
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
        
        <div class="row">
		<?php echo $form->labelEx($model,'act'); ?>
		<?php echo $form->checkBox($model,'act', ( $model->act==null ? array("checked"=>"checked") : "" )); ?>
		<?php echo $form->error($model,'act'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'del'); ?>
		<?php echo $form->checkBox($model,'del', ( $model->act==null ? array("checked"=>"checked") : "" )); ?>
		<?php echo $form->error($model,'del'); ?>
	</div>
        
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
                                               CHtml::listData(Plannings::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?> 
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
                <?php $data = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); ?> 
                <?php // Свойства недвижемости
                      if ($isId) {
                          $properties = SpaceProperties::model()->findAll("space_id=".$model->id, 
                                              array("select"=>"property_id"));                
                          $selProperties = array();
                          foreach ( $properties as $key=>$val) 
                          $selProperties[$val->property_id]=array("selected"=>true);
                      }
                ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'spaceProperties',     
                          // data for generating the options of the drop down list:
                          'data' => $data,                            
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceProperties',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,
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
                
                <?php/* echo $form->listBox($model,'spaceProperties',
                                               CHtml::listData(Properties::model()->findAll(), 'id', 'title'),
                                               array("multiple"=>"multiple","size"=>"2")); */?>
		<?php echo $form->error($model,'spaceProperties'); ?>
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
            
            $('#Spaces_price').keyup(
                function() {
                    changeCurrency();
                }
            ); 
            
            function changeCurrency() {
                var price = parseInt($('#Spaces_price').val());
                var evt1 = $('#curs_valute_1').text();
                var evt2 = $('#curs_valute_2').text();
                var val1  = parseFloat($('#curs_valute_value_'+evt1).text());
                var val2  = parseFloat($('#curs_valute_value_'+evt2).text());
                       
                $('#cost_'+evt1).text(''+Math.round(price/val1));
                $('#cost_'+evt2).text(''+Math.round(price/val2));                         
            }

            /*
            function loadBlockCurrency(price,currency_title,currency_id) {                                    
                   var url = '/bax.php/spaces/ajaxshowcurrenty/'
                                +currency_id+'/'
                                +price+'.html';
                   $('#block-currency').load(url, function() {
                       $('#Spaces_price').attr('title',currency_title);
                   });
            }
                        
            
            $('#Spaces_valute_id').change(
                 
                 function() 
                 {                      
                   var curr_currency = $('#Spaces_price').attr('title');
                   var currency_title = $('#Spaces_valute_id').attr('title');
                   var currency_id = $('#Spaces_valute_id').val();
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
                                   CHtml::listData(Taxs::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'), array('prompt'=>Yii::t('all','Select')."...")); ?> 
		<?php// echo $form->textField($model,'tax_id'); ?>
		<?php echo $form->error($model,'tax_id'); ?>
	</div>

        
	<div class="row">
		<?php echo $form->labelEx($model,'parking_id'); ?>
                <?php echo $form->dropDownList($model,'parking_id',   
                                   CHtml::listData(Parkings::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>             
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
                <?php $data = CHtml::listData(Representatives::model()->findAll(), 'id', 'name'); ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'representative_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_representative_id',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,    
                            'prompt'=>Yii::t('all','Select')."...",    
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                            'multiple'=>false, 
                          ),
                )); ?>                
                <?php/* echo $form->dropDownList($model,'representative_id',   
                                               array_merge( array('0' => 'Выбор собственника...'),  
                                               CHtml::listData(Representatives::model()->findAll(), 'id', 'name'))); */?>              
		<?php// echo $form->textField($model,'representative_id'); ?>
                <?php echo CHtml::Button( Yii::t('form','Add'), array("id"=>"AddRepresentative"));?>
                <?php echo CHtml::Button(Yii::t('form','Edit'), array("id"=>"EditRepresentative"));?>
                <?php echo CHtml::Button(Yii::t('form','Delete'), array("id"=>"DeleteRepresentative"));?>  
		<?php echo $form->error($model,'representative_id'); ?>
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
		<?php echo $form->labelEx( $model, 'spaceRepresentatives'); ?>    
                <?php $data = CHtml::listData(Representatives::model()->findAll(), 'id', 'name')  ?>
                <?php // Представители недвижемости
                    if ($isId) {
                        $representatives = SpaceRepresentatives::model()->findAll("space_id=".$model->id, 
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
                          'dropDownAttribute' => 'spaceRepresentatives',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceRepresentatives',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,
                            'multiple'=>true,    
                            'options'=>(isset($selRepresentatives) ? $selRepresentatives : array()),   
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100,                               
                            'multiple'=>true,  
                          ),
                )); ?>                      
                <?php/* echo $form->listBox( $model, 'spaceRepresentatives',   
                               array_merge( array("0"=>"Выбор представителей..."),
                                       CHtml::listData(Representatives::model()->findAll($isId ? 'not id='.$model->representative_id)
                                            , 'id', 'name') ),
                                            array("multiple"=>"multiple","size"=>"1") ); */?>              
		<?php// echo $form->textField($model,'representative_id'); ?>            
                <?php echo CHtml::Button(Yii::t('form','Add'), array("id"=>"AddRepresentatives"));?>
		<?php echo $form->error($model,'spaceRepresentatives'); ?>                
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'procent_commission'); ?>
		<?php echo $form->textField($model,'procent_commission',array('size'=>6,'maxlength'=>6,'value'=>$model->procent_commission,'default'=>'0.00')); ?>
		<?php echo $form->error($model,'procent_commission'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'commission_id'); ?>
                <?php echo $form->dropDownList($model,'commission_id',   
                                   CHtml::listData(Commissions::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>                          
		<?php// echo $form->textField($model,'commission_id'); ?>
		<?php echo $form->error($model,'commission_id'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'number_tax'); ?>
		<?php echo $form->textField($model,'number_tax',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'number_tax'); ?>
	</div>
        
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

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'tax_number'); ?>
		<?php echo $form->textField($model,'tax_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tax_number'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->labelEx($model,'fav'); ?>
		<?php echo $form->checkBox($model,'fav'); ?>
		<?php echo $form->error($model,'fav'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'spaceSimilarities1'); ?>                		
                <?php $data =  CHtml::listData(Spaces::model()->findAll($isId ? 'not id='.$model->id : ''), 'id', 'title'); ?>
                <?php // Другая площадь
                      if ($isId) {
                          $similarities1 = SpaceSimilarities::model()->findAll("space_id=".$model->id." and space_linking_id=2", 
                                              array("select"=>"similaries_id"));
                          $selSimilarities1 = array();
                          foreach ( $similarities1 as $key=>$val) 
                          $selSimilarities1[$val->similaries_id]=array("selected"=>true);     
                      }
                ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'spaceSimilarities1',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceSimilarities1',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',/*'width:378px;'*/
                            'multiple'=>true,
                            'options'=>(isset($selSimilarities1) ? $selSimilarities1 : array()),
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
		<?php/* echo $form->listBox($model,'spaceSimilarities1',
                                               CHtml::listData(Spaces::model()->findAll(), 'id', 'title'),
                                               array("multiple"=>"multiple","size"=>"1")); */?>
		<?php echo $form->error($model,'spaceSimilarities1'); ?>
	</div>

                <div class="row">
		<?php echo $form->labelEx($model,'spaceSimilarities'); ?>                		
                <?php $data =  CHtml::listData(Spaces::model()->findAll($isId ? 'not id='.$model->id : ''), 'id', 'title'); ?>
                <?php // Схожие предложения
                      if ($isId) {
                          $similarities = SpaceSimilarities::model()->findAll("space_id=".$model->id." and space_linking_id=1", 
                                              array("select"=>"similaries_id"));
                          $selSimilarities = array();
                          foreach ( $similarities as $key=>$val) 
                          $selSimilarities[$val->similaries_id]=array("selected"=>true);
                      }
                ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'spaceSimilarities',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceSimilarities',       
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',/*'width:378px;'*/
                            'multiple'=>true,
                            'options'=>(isset($selSimilarities) ? $selSimilarities : array()),  
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
		<?php/* echo $form->listBox($model,'spaceSimilarities1',
                                               CHtml::listData(Spaces::model()->findAll(), 'id', 'title'),
                                               array("multiple"=>"multiple","size"=>"1")); */?>
		<?php echo $form->error($model,'spaceSimilarities'); ?>
	</div>

        <div class="row <?/*editor anons*/?>">
		<?php echo $form->labelEx($model,'anons'); ?>
		<?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>65,'style'=>"width:540px;")); ?>		
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
        
        <div class="row" style="padding-top:10px;">
		<?php echo $form->labelEx($model,'is_resize'); ?>             
                <?php $htmlOpt = array( "onclick"=>" if ( $('#Spaces_is_resize').attr('checked')=='checked' ) "
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
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_anons #ytSpaces_picOreginal').val('');$('#pic_oreginal #Spaces_picOreginal').val('');" )); ?>
                <?php // echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_anons #ytSpaces_picOreginal').val('');$('#pic_oreginal #Spaces_picOreginal').val('');$('#Spaces_pic_anons_id').val('');" )); ?>            
                <?php if ( trim($model->pic_oreginal_id)<>"" ) : ?>                
                <?php //print_r($model->pic_oreginal_id); ?>             
                <?php $picOreginal = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                                                '_small'.substr($model->picOreginal->original_name,-4,4),
                                                $model->picOreginal->original_name); 
                ?>
                <div id="space-pic-oreginal" class="space-pic">
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
                      echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_oreginal', "onclick"=>"$('#space-pic-oreginal').remove();$('#Spaces_pic_oreginal_id').remove();"));
                      /*echo Chtml::ajaxLink('x', 
                                           '/bax.php/spaces/ajaxdeletepicoreginal', 
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
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_scr #ytSpaces_picScr').val('');$('#pic_scr #Spaces_picScr').val('');" )); ?>
                <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_scr #ytSpaces_picScr').val('');$('#pic_scr #Spaces_picScr').val('');$('#pic_scr_id').val('');" )); ?>
                <?php if ( trim($model->pic_scr_id)<>"" ) : ?>
                <?php $picScr = '/'.str_replace('_original'.substr($model->picScr->original_name,-4,4),
                                                '_small'.substr($model->picScr->original_name,-4,4),
                                                $model->picScr->original_name); 
                ?>                           
                <div id="space-pic-scr" class="space-pic">
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
                      echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_src', "onclick"=>"$('#space-pic-scr').remove();$('#Spaces_pic_scr_id').remove();"));
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
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_anons #ytSpaces_picAnons').val('');$('#pic_anons #Spaces_picAnons').val('');" )); ?>
                <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_anons #ytSpaces_picAnons').val('');$('#pic_anons #Spaces_picAnons').val('');$('#pic_anons_id').val('');" )); ?>
                <?php if ( trim($model->pic_anons_id)<>"" ) : ?>
                <?php $picAnons = '/'.str_replace('_original'.substr($model->picAnons->original_name,-4,4),
                                                '_small'.substr($model->picAnons->original_name,-4,4),
                                                $model->picAnons->original_name); ?>           
                <div id="space-pic-anons" class="space-pic">
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
                    echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_anons', "onclick"=>"$('#space-pic-anons').remove();$('#Spaces_pic_anons_id').remove();"));                    
                      /*echo Chtml::ajaxLink('x', 
                                           '/bax.php/spaces/ajaxdeletepicanons', 
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
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_detile #ytSpaces_picDetile').val('');$('#pic_detile #Spaces_picDetile').val('');" )); ?>
                <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_detile #ytSpaces_picDetile').val('');$('#pic_detile #Spaces_picDetile').val('');$('#pic_detile_id').val('');" )); ?>            
                <?php $picDetile = '/'.str_replace('_original'.substr($model->picDetile->original_name,-4,4),
                                                '_small'.substr($model->picDetile->original_name,-4,4),
                                                $model->picDetile->original_name); 
                ?>
                <?php if ( trim($model->pic_detile_id)<>"" ) : ?>
                <div id="space-pic-detile" class="space-pic">
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
                    echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_detile', "onclick"=>"$('#space-pic-detile').remove();$('#Spaces_pic_detile_id').remove();"));
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
                   $(".fancySladeShow[rel=SpaceFotos]").fancybox({
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
		<?php echo $form->labelEx($model,'spaceFotos'); ?>           
                <?php
                     $this->widget('CMultiFileUpload', array(
                    'model'=>$model,
                        'attribute'=>'spaceFotos',
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
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#Spaces_spaceFotos_wrap_list').html('');",
                                                            'class'=>"float:right; margin-right: 250px;" )); ?> 
                <?php $spaceFotos=array();
                      if (!empty($model->spaceFotos)) {
                        foreach ($model->spaceFotos as $key=>$spaceFoto) $spaceFotos[] = $spaceFoto->file_id; 
                      }
                      if (!empty($spaceFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$spaceFotos).')');                          
                ?>
                <div class="block-fotos">
                <?php    
                     
                      foreach ($fotos as $key=>$foto) {
                            $picFoto = '/'.str_replace('_original'.substr($foto->original_name,-4,4),
                                                    '_small'.substr($foto->original_name,-4,4),
                                                    $foto->original_name); 
                ?>                                                
                  <div id="space-fotos-<?=$foto->id;?>" class="space-fotos">
                    <div class="fotos">
                <?php
                      echo CHtml::link(CHtml::image( $picFoto, '', 
                                                      array('title'=>$foto->name)),                                                       
                                                      '/'.$foto->original_name, 
                                                      array('class'=>'fancySladeShow',
                                                            'rel'=>"SpaceFotos",
                                                            'title'=>$foto->name));                           
                ?>                       
                    </div>
                    <div class="del-fotos" >
                <?php
                    echo Chtml::link("x", "javascript:void();", 
                               array("id"=>'delfotos-'.$foto->id, 
                                     "onclick"=>"$('#space-fotos-".$foto->id."').remove();$('#Spaces_spaceFotos_".$foto->id."').remove();"));
                ?>
                    </div>
                  </div>
        <?php    } ?>
               </div>
        <?php } ?>                  
        <?php// echo $form->textField($model,'pic_detile_id'); ?>
	<?php echo $form->error($model,'spaceFotos'); ?>
	</div>
        
        <div class="row multi" style="padding-bottom:10px;" >
                <?php echo $form->labelEx($model,'spacePresentations'); ?>                      
                <?php
                     $this->widget('CMultiFileUpload', array(
                    'model'=>$model,
                        'attribute'=>'spacePresentations',
                        'accept'=>'pdf|mov|doc|odt|rtf',                         
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
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#Spaces_spacePresentations_wrap_list').html('');",
                                                            'style'=>"float: right; margin-right: 250px;" )); ?>            
                <?php $spacePresentations=array();
                      if (!empty($model->spacePresentations)) {
                      foreach ($model->spacePresentations as $key=>$spacePresentation) $spacePresentations[] = $spacePresentation->file_id; 
                      }
                          if (!empty($spacePresentations)) {
                              $presentations = Files::model()->findAll('id in ('.implode(",",$spacePresentations).')');
                    ?>               
                          <div style="display: inline-block;padding-left: 155px;width: 100%;">

                    <?php foreach ($presentations as $key=>$presentation) { ?>

                             <div id="space-presentations-<?=$spacePresentation->id;?>" class="space-presentations">
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
                                     /*echo Chtml::link( 'x', '/bax.php/spaces/ajaxdeletepresentations', 
                                                       array(), // Свойства ajax
                                                       array("id"=>'delpresentations-'.$presentation->id));*/
                                     echo Chtml::link("x", "javascript:void();", 
                                        array("id"=>'delpresentations-'.$spacePresentation->id,
                                              "onclick"=>"$('#space-presentations-".$spacePresentation->id."').remove();$('#Spaces_spacePresentations_".$spacePresentation->id."').remove();"));                                     
                                ?>
                                </div>  
                             </div>    
                    <?php } ?>                         
                         </div>
                <?php } ?>                    
		<?php// echo $form->textField($model,'pic_detile_id'); ?>
		<?php echo $form->error($model,'spacePresentations'); ?>
	</div>
        
        <div class="row" style="padding-bottom:5px;" >
            <center class="plashka" ><b>Координаты недвижемости на карте:</b></center>                        
            <div class="cke_skin_kama">    
                <?php echo $map;?>     
            </div>    
            <div>
                <?php echo $form->hiddenField($model,'pic_detile_id'); ?>
                <?php echo $form->hiddenField($model,'pic_anons_id'); ?>
                <?php echo $form->hiddenField($model,'pic_oreginal_id'); ?>
                <?php echo $form->hiddenField($model,'pic_scr_id'); ?>                
                
                <?php if (!empty($model->spaceFotos)) {
                        foreach( $model->spaceFotos as $key=>$spaceFoto ) 
                           echo CHtml::hiddenField( 'Spaces[spaceFotos][]', $spaceFoto->id, 
                                                  array( 'id'=>'Spaces_spaceFotos_'.$spaceFoto->file_id,
                                                         'class'=>'Spaces_spaceFotos'));                    
                      }
                ?>
                
                <?php if (!empty($model->spacePresentations)) {
                        foreach( $model->spacePresentations as $key=>$spacePresentation ) 
                         echo CHtml::hiddenField( 'Spaces[spacePresentations][]', $spacePresentation->id, 
                                                  array('id'=>'Spaces_spacePresentations_'.$spacePresentation->id,
                                                        'class'=>'Spaces_spacePresentations'));                    
                      }  
                ?>
                <?php echo $form->hiddenField($model,'uid');?>
                <?php echo $form->hiddenField($model,'sid');?>
                <?php echo $form->hiddenField($model,'nid');?>
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

</div><!-- form Spaces-->

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
                    
                 $model_representatives = Representatives::model();
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
                    </div>                                            
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'site'); ?>
                        <?php echo $formReps->textField($model_representatives,'site',array('size'=>60,'maxlength'=>255)); ?>
                        <?php echo $formReps->error($model_representatives,'site'); ?>
                    </div>                                                                
                    <div class="row" >                        
                        <?php echo $formReps->labelEx($model_representatives,'desc'); ?>
                        <?php echo $form->textArea($model_representatives,'desc',array('rows'=>6, 'cols'=>65,'style'=>"width:540px;")); ?>		                                                
                        <?php echo $formReps->error($model_representatives,'desc'); ?>
                    </div>                                                                
                    <div class="row hidden-row" >                                                
                        <?php echo $form->hiddenField($model_representatives,'id'); ?>
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
                                              
                                              var el  = $("#Spaces_representative_id").multiselect();                                              
                                              var els  = $("#Spaces_spaceRepresentatives").multiselect();                       
                                              
                                              if ( data.oper == "update" ) { 
                                                  $("#Spaces_representative_id option").filter(":selected").text(data.name);
                                                  $("#Spaces_spaceRepresentatives option").filter(function(index) { return this.value == data.id; }).text(data.name);
                                              }else{
                                                  var opt_el = $("<option />", {
                                                               value: data.id, text: data.name, selected: "selected" }
                                                  );
                                                        
                                                  var opt_els = $("<option />", {
                                                               value: data.id, text: data.name, selected: "selected" }
                                                  );
                                                        
                                                  opt_el.appendTo( el );		
                                                  opt_els.appendTo( els );		
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
                            $("#dialogRepresentatives" ).dialog( "option", "title", "<?=Yii::t("form","Create Representative");?>" );
                            $("#dialogRepresentatives").dialog("open");                                             
                        });
                        
                        $('#AddRepresentatives').live('click',function () {
                            $("#Representatives_name,#Representatives_fio,#Representatives_site,#Representatives_telephone,#Representatives_id").val("");                            
                            $("#quick-form-Representatives").attr("action","<?=Yii::app()->controller->createUrl("representatives/ajaxcreate",array("ajax"=>"representatives-form"))?>");                            
                            $("#dialogRepresentatives" ).dialog( "option", "title", "<?=Yii::t("form","Create Representative");?>" );                            
                            $("#dialogRepresentatives").dialog("open");                                                          
                        });
                        
                        //onAdd representative
                        $('#EditRepresentative').live('click',function () {                            
                            var url = '/bax.php/representatives/ajaxget?id='+$('#Spaces_representative_id').val();
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
                            var url = '/bax.php/representatives/ajaxdelete?id='+$('#Spaces_representative_id').val();                            
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
                                        
                                        var el  = $("#Spaces_representative_id").multiselect();                                              
                                        var els  = $("#Spaces_spaceRepresentatives").multiselect();                       
                                        $("#Spaces_representative_id option").filter(":selected").remove();
                                        $("#Spaces_spaceRepresentatives option").filter(function(index) { return this.value == data.id; }).remove();
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