<?php $form=$this->beginWidget('CActiveForm',
            array( 'action'=>Yii::app()->createUrl('realestates/index'),//Yii::app()->createUrl($this->route),
                   'method'=>'get', //post
                   'id'=>'mainSearch',
                   'htmlOptions'=>array('name'=>'mainSearch'),
                 ));

Yii::app()->clientScript->registerScript('search', "
$('form#mainSearch').submit(function(){
        var prm = Array();
        var fields = $(this).serializeArray();
        var isVid = $('#Realestates_realestate_vid_id_all').attr('checked')=='checked';
        var isType = $('#Realestates_realestate_type_id_all').attr('checked')=='checked';
        var isClass = $('#Realestates_realestate_class_id_all').attr('checked')=='checked';
        var isDist = $('#Realestates_district_id_all').attr('checked')=='checked';
        var isUnit = $('#Realestates_unit_id_all').attr('checked')=='checked';
        var isProps = $('#Realestates_realestatesProperties_all').attr('checked')=='checked';        
        
        $.each(fields, 
               function(i, field){ 
                if( field['value'].length ) 
                { 
                    
                    if ( field['name']=='Realestates[realestate_vid_id][]' ) {
                        if (!isVid) {
                          prm.push(field); 
                        } 
                    }else if ( field['name']=='Realestates[realestate_type_id][]' ) {
                        if (!isType) {
                          prm.push(field); 
                        }                        
                    }else if ( field['name']=='Realestates[realestate_class_id][]' ) {
                        if (!isClass) {
                          prm.push(field); 
                        }                                                
                    /*}else if ( field['name']=='Realestates[is_separate_entrance]' ) {
                        if (!isProps) {
                          prm.push(field); 
                        }*/                                                                        
                    }else if ( field['name']=='Realestates[district_id][]' ) {
                        if (!isDist) {
                          prm.push(field); 
                        }                        
                    }else if ( field['name']=='Realestates[realestatesProperties][]' ) {
                        if (!isProps) {
                          prm.push(field); 
                        }
                    }else if ( field['name']=='Realestates[unit_id][]' ) {
                        if (!isUnit) {
                          prm.push(field); 
                        }                        
                    }else{
                        if ( field['name']!='Realestates_realestate_vid_id_all' 
                             && field['name']!='Realestates_realestate_type_id_all' 
                             && field['name']!='Realestates_realestatesProperties_all' 
                             && field['name']!='Realestates_realestate_class_id_all' 
                             && field['name']!='Realestates_district_id_all'                              
                             && field['name']!='Realestates_unit_id_all' ) {
                            prm.push(field); 
                        }
                    }
                }
            });

        /*if ( !isProps && !$('[name=\"Realestates[realestatesProperties][]\"]:checked').length ) {            
            field = Array();
            field['name'] = 'Realestates_realestatesProperties_all';
            field['value'] = 0;
            prm.push(field);   
        }*/
        dats=$.param(prm);
        
        window.location.href='".Yii::app()->createUrl('realestates/index')."?'+dats;
            
	return false;
});     
");


?>
   <div class="p-5" >       
       <div class="panel-params new fl w-248" >
          <?/*<h2 class="ttr-upper c-white bold  bg-brown radius-5-0 p-5 m-b0 m-t0 p-l10 fs-15 ff-Arial"><center>Поиск недвижимости</center></h2>*/?>
          <div class="ttr-upper c-white bold  bg-brown radius-5-0 p-5 m-b0 m-t0 p-l10 fs-15 ff-Arial"><center>Поиск недвижимости</center></div>
          <div class="rows odd radius-5-0 hidden">               
               <div class="oper">
                   <div class="title"><?php echo $form->label($model,'operation_id'); ?></div>
                   <div class="checks">
                     <?php $data = CHtml::listData(Operations::model()->findAll(
                                                        array('condition'=>'((t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0))',
                                                              'select'=>'t.id,t.title',
                                                              'order'=>'t.sort')), 'id', 'title'); ?>                    
                     <?php echo "<nobr>".CHtml::checkBoxList("Realestates[operation_id]", "1", $data, array("separator"=>"&nbsp;"))."</nobr>" ;?>
                   </div>
               </div>    
          </div> 
          <div class="rows odd">               
               <div class="oper">
                   <?/*<div class="title">
                       <?php// echo $form->label($model,'realestate_vid_id');?>
                   </div>*/?>
                   <div class="checks">
                      <? $vid = RealestateVids::model()->findAll( array( "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)", 
                                                                         'select'=>'t.id,t.label',
                                                                         "order"=>"t.sort_main" ));?>
                      <? $data = CHtml::listData( $vid, 'id', 'label'); ?>
                      <? $dats = CHtml::listData( $vid, 'id', 'id'); ?>                        
                      
                      <?php echo CHtml::checkBoxList("Realestates[realestate_vid_id]", 
                                                     trim($_POST["Realestates"]["realestate_vid_id"])<>"" ? $_POST["Realestates"]["realestate_vid_id"] : $dats/*array("1")*/, 
                                                     $data, 
                                                     array("separator"=>" ","template"=>"<nobr class=\"item w-112\" >{input} {label}</nobr>","checkAll"=>'Cнять <span class="c-red" style="padding-left:50px;">целиком</span>')) ;?>
                      <?php Yii::app()->getClientScript()->registerScript('CheckVid'.$this->getId(), 
                                                     'if ($(\'[name="Realestates[realestate_vid_id][]"]:checked\').length=='.count($dats).') { $(\'#Realestates_realestate_vid_id_all\').attr(\'checked\',\'checked\'); }', CClientScript::POS_READY); ?>                                          
                       <script>
                           $('nobr').has('#Realestates_realestate_vid_id_all').removeClass('w-112');
                           $('nobr').has('#Realestates_realestate_vid_id_all').addClass('w-auto title p-0 m-b6');                           
                       </script>
                   </div>
               </div>   
          </div>            
          <div class="rows oven">               
               <div class="oper">
                   <?/*<div class="title">
                       <?php// echo $form->label($model,'realestate_vid_id');?>
                   </div>*/?>
                   <div class="checks">
                      <? $type = RealestateTypes::model()->findAll( array( "condition"=>"(t.is_label IS NULL OR t.is_label=1) AND (t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)", 
                                                                           'select'=>'t.id,t.label',
                                                                           "order"=>"t.sort_main" )); ?> 
                      <? $data = CHtml::listData( $type, 'id', 'label'); ?>
                      <? $dats = CHtml::listData( $type, 'id', 'id'); ?>                       
                      <?php echo CHtml::checkBoxList("Realestates[realestate_type_id]", 
                                                     trim($_POST["Realestates"]["realestate_type_id"])<>"" ? $_POST["Realestates"]["realestate_type_id"] : $dats/*array("1")*/, 
                                                     $data, 
                                                     array("separator"=>" ","template"=>"<nobr class=\"item w-112\" >{input} {label}</nobr>","checkAll"=>'Недвижимость сдается <span class="c-red">в</span>')) ;?>
                      <?php Yii::app()->getClientScript()->registerScript('CheckType'.$this->getId(), 
                                                     'if ($(\'[name="Realestates[realestate_type_id][]"]:checked\').length=='.count($dats).') { $(\'#Realestates_realestate_type_id_all\').attr(\'checked\',\'checked\'); }', CClientScript::POS_READY); ?>                                          
                       <script type="text/javascript">
                           $('nobr').has('#Realestates_realestate_type_id_all').removeClass('w-112');
                           $('nobr').has('#Realestates_realestate_type_id_all').addClass('w-auto title p-0 m-b6');                           
                       </script>
                   </div>
               </div>   
          </div>   
          <div class="rows odd">               
               <div class="oper">
                   <?/*<div class="title"><?php echo $form->label($model,'realestate_class_id'); ?></div>*/?>
                   <div class="checks">
                      <? $class = RealestateClasses::model()->findAll( array( "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                                'select'=>'t.id,t.abbr',
                                                                                                "order"=>"t.sort")); ?> 
                      <? $data = CHtml::listData( $class, 'id', 'abbr'); ?>
                      <? $dats = CHtml::listData( $class, 'id', 'id'); ?>                           

                      <?php echo CHtml::checkBoxList("Realestates[realestate_class_id]", 
                                                     isset($_POST["Realestates"]["realestate_class_id"]) ? $_POST["Realestates"]["realestate_class_id"] : $dats/*array("1")*/, 
                                                     $data, 
                                                     array("separator"=>" ","template"=>"<nobr class=\"item-class\" >{input} {label}</nobr>","checkAll"=>'Все классы недвижимости')) ;?>
                      <?php Yii::app()->getClientScript()->registerScript('CheckClass'.$this->getId(), 
                                                     'if ($(\'[name="Realestates[realestate_class_id][]"]:checked\').length=='.count($dats).') { $(\'#Realestates_realestate_class_id_all\').attr(\'checked\',\'checked\')}', CClientScript::POS_READY); ?>
                      <script>
                           $('nobr').has('#Realestates_realestate_class_id_all').removeClass('w-112');
                           $('nobr').has('#Realestates_realestate_class_id_all').addClass('w-auto title p-0 m-b6');    
                      </script>                                             
                   </div>
               </div>   
          </div>     
          <div class="rows oven">               
               <div class="oper">
                   <?/*<div class="title"><?php echo $form->label($model,'realestate_class_id'); ?></div>*/?>
                   <div class="checks">
                      <? $props = Properties::model()->findAll( array( "condition"=>"(t.is_label IS NULL OR t.is_label=1) AND (t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                                                'select'=>'t.id,t.title',
                                                                                                "order"=>"t.sort")); ?>                                         
                      <? $data = array(0=>'без свойств')+CHtml::listData( $props, 'id', 'title')+array(99=>'c отдельным входом'); ?>                            
                      <? $params = Yii::app()->getRequest()->getParam('Realestates'); 
                         $dats = isset($params["is_separate_entrance"]) 
                                    ? $params["is_separate_entrance"] 
                                      ? array(0=>0)+CHtml::listData( $props, 'id', 'id')+ array(99=>99)
                                      : array(0=>0)+CHtml::listData( $props, 'id', 'id')                                    
                                    : array(0=>0)+CHtml::listData( $props, 'id', 'id')+ array(99=>99); ?>                                                    

                      <?php echo CHtml::checkBoxList("Realestates[realestatesProperties]", 
                                                     isset($_POST["Realestates"]['realestatesProperties']) ? $_POST["Realestates"]['realestatesProperties'] : $dats/*array("1")*/, 
                                                     $data, 
                                                     array("separator"=>" ","template"=>"<nobr class=\"item-class\" >{input} {label}</nobr>","checkAll"=>'Все свойства недвижимости')) ;?>
                  
                      <?php Yii::app()->getClientScript()->registerScript('CheckProps'.$this->getId(), 
                                                     'if ($(\'[name="Realestates[realestatesProperties][]"]:checked\').length=='.(count($dats)).') { $(\'#Realestates_realestatesProperties_all\').attr(\'checked\',\'checked\')}', CClientScript::POS_READY); ?>                       
                      <script type="text/javascript">
                           $('nobr').has('#Realestates_realestatesProperties_all').removeClass('w-112');
                           $('nobr').has('#Realestates_realestatesProperties_all').addClass('w-auto title p-0 m-b6');    
                      </script>                                                                                             
                   </div>
               </div>   
          </div>              
          <div class="rows odd">               
               <div class="oper">
                   <div class="title"><label>Площадь недвижимости <span class="c-fill ff-Arial">кв.м</span></label></div>
                   <div class="checks">
                       <label for="area-from" class="p-l5" >от</label>
                       <?php echo CHtml::textField('area-from',(trim($_POST['area-from'])<>'' ? $_POST['area-from'] : ''),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default area-to item-area fs-1-1em','id'=>'area-from','placeholder'=>'50'));  ?>
                       <label for="area-to" >до</label>
                       <?php echo CHtml::textField('area-to',(trim($_POST['area-to'])<>'' ? $_POST['area-to'] : ''),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default area-to item-area fs-1-1em','id'=>'area-to','placeholder'=>'40000'));  ?>
                   </div>
               </div>   
          </div> 
          <div class="rows oven">               
               <div class="oper">
                   <div class="title p-l0">
                       <?php echo CHtml::radioButtonList('Realestates[realestate_price_vid]', ( isset($_POST['Realestates']['realestate_price_vid']) && !empty($_POST['Realestates']['realestate_price_vid']) ? $_POST['Realestates']['realestate_price_vid'] : 'year'), 
                                                   array('year'=>'Стоимость <span class="c-fill ff-Arial">кв.м в год</span>',
                                                         'mounth'=>'Цена помещения <span class="c-fill ff-Arial">в месяц</span>'), array()) ?>
                       <?/*<label>Стоимость <span class="c-fill ff-Arial">кв.м в год</span></label>*/?>
                   </div>                                      
                   <div class="checks">                      
                      <label for="price-from" class="p-l5">от</label>
                      <?php echo CHtml::textField( 'price-from',(trim($_POST['price-from'])<>'' ? $_POST['price-from'] : ''),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default price-to item-price fs-1-1em','id'=>'price-from','placeholder'=>'0'));  ?>
                      <label for="price-to" >до</label>
                      <?php echo CHtml::textField( 'price-to',(trim($_POST['price-to'])<>'' ? $_POST['price-to'] : ''),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default price-to item-price fs-1-1em m-r0','id'=>'price-to','placeholder'=>'240000'));  ?>
                      <?php $data = CHtml::listData( Valutes::model()->findAll( array('condition'=>'((t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0))',
                                                                                      'select'=>'t.id,t.abbr',
                                                                                      'order'=>'t.sort')), 'id', 'abbr'); ?>
                      <?php $data[2] = CHtml::image('/images/icons/rub_7x15_grey.png', 'руб.', array('title'=>'рублей','style'=>'vertical-align:middle')); ?>
                      <div class="box-checks valign-m w-26">
                      <?php// echo CHtml::checkBoxList( "valute", trim($_POST["valute"])<>"" ? $_POST["valute"] : array("2"),  $data, array("separator"=>" ","template"=>"<nobr class=\"item w-54\" >{input} {label}</nobr>")) ;?>
                      <?php echo CHtml::radioButtonList( "valute", trim($_POST["valute"])<>"" ? $_POST["valute"] : "2",  $data, array("separator"=>" ","template"=>"<nobr class=\"item w-30\" >{input} {label}</nobr>")) ;?>
                      </div>    
                   </div>
                   <script>
                        $('[name *= "realestate_price_vid"]').live('click', 
                                function() {                          
                                    if ( $('#Realestates_realestate_price_vid_0').attr('checked') == 'checked' ) {    
                                         $('#price-to').attr('placeholder','240000');     
                                    } else { 
                                         $('#price-to').attr('placeholder','100000000');
                                    }         
                                }
                        );
                   </script>
               </div>   
          </div>            
          <div class="rows odd">               
               <div class="oper">
                   <div class="title"><label for="location" ><?php echo Yii::t('all','Расположение недвижимости') ?></label></div>
                   <div class="checks">
                      <?php $data = array("1"=>" метро ".CHtml::image('/images/icons/metro_16x16.png', '', array('title'=>'Выбор станции метро', 'style'=>'vertical-align:middle;')),"2"=>" карта ".CHtml::image('/images/icons/map_16x16.png', '', array('title'=>'Выбор региона по карте гугле', 'style'=>'vertical-align:middle;')));  ?>                                            
                      <?php// echo "<nobr>".CHtml::checkBoxList("map_id", ( trim($_POST["map_id"])<>'' ? $_POST["map_id"] : "1"), $data, array("separator"=>"&nbsp;"))."</nobr>" ;?>
                      <?php echo "<nobr>".CHtml::checkBoxList("map_id", ( trim($_POST["map_id"])<>'' ? $_POST["map_id"] : ""), $data, array("separator"=>"&nbsp;&nbsp;&nbsp;"))."</nobr>" ;?> 
                   </div>
               </div>    
          </div>               
          <div class="rows oven">               
               <div class="oper">
                   <?/*<div class="title"><?php echo $form->label($model,'district_id'); ?></div>*/?>
                   <div class="checks">
                      <? $district = Districts::model()->findAll(array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                                       "select"=>'t.id,t.abbr', 
                                                                       "order"=>"t.sort_main")); ?>
                      <? $data = CHtml::listData( $district, 'id', 'abbr'); ?>
                      <? $dats = CHtml::listData( $district, 'id', 'id'); ?>
                      <?// print_r($data) ?> 
                      <?php echo CHtml::checkBoxList("Realestates[district_id]", ( trim($_POST["Realestates"]["district_id"])<>'' ? $_POST["Realestates"]["district_id"] : $dats/*array("7")*/ ), $data, array("separator"=>" ","class"=>"boxlist","template"=>"<nobr class=\"item\" >{input} {label}</nobr>","checkAll"=>'Все округа в Москве')) ;?>
                       <?php Yii::app()->getClientScript()->registerScript('CheckDistrict'.$this->getId(), 'if ($(\'[name="Realestates[district_id][]"]:checked\').length=='.count($dats).') {$(\'#Realestates_district_id_all\').attr(\'checked\',\'checked\')}', CClientScript::POS_READY); ?>
                      <script>
                           $('nobr').has('#Realestates_district_id_all').removeClass('w-112');
                           $('nobr').has('#Realestates_district_id_all').addClass('w-auto title p-0 m-b6');
                      </script>   
                   </div>
               </div>    
          </div>                          
          <div class="rows odd">               
               <div class="oper">
                   <div class="title"><?php echo $form->label($model,'remoteness',array('label'=>'Удаленность от метро')); ?></div>
                   <div class="checks p-l5">
                      <label>до</label>
                      <?php echo CHtml::hiddenField( 'remoteness-from',(trim($_POST['remoteness-from'])<>'' ? $_POST['remoteness-from'] : '0'));  ?>
                      <?php echo CHtml::textField( 'remoteness-to',(trim($_POST['remoteness-to'])<>'' ? $_POST['remoteness-to'] : ''),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default remoteness-to w-54 valign-m fs-1-1em','id'=>'remoteness-to','placeholder'=>'20'));  ?>&nbsp;мин.                                                              
                      
                      <? $unit = Units::model()->findAll(array( "condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)", 
                                                                                     "select"=>"t.id,t.abbr", 
                                                                                     "order"=>"t.sort" )); ?> 
                      <? $data = CHtml::listData( $unit, 'id', 'abbr'); ?>
                      <? $dats = CHtml::listData( $unit, 'id', 'id'); ?>   
                      
                      <div class="box-checks valign-m">
                      <?php echo CHtml::checkBoxList( "Realestates[unit_id]", trim($_POST["Realestates"]["unit_id"])<>"" ? $_POST["Realestates"]["unit_id"] : $dats/*array("2")*/, $data, array("separator"=>" ","template"=>"<nobr class=\"item\" >{input} {label}</nobr>","checkAll"=>'все')) ;?>
                      <?php Yii::app()->getClientScript()->registerScript('CheckUnit'.$this->getId(), 'if ($(\'[name="Realestates[unit_id][]"]:checked\').length=='.count($dats).') { $(\'#Realestates_unit_id_all\').attr(\'checked\',\'checked\')}', CClientScript::POS_READY); ?>                          
                      </div>    
                   </div>
               </div>   
          </div>                                                                            
          <div class="rows halign-c valign-m"> 
              <a href="#" class="search_but button-main" id="mainSearchButton">Найти</a>  
              <?php echo CHtml::hiddenField('polygon');?>  
              <div id="metro"></div>
          </div>  
          <div class="rows oven bannc valign-m halign-c hidden pos-r" id="newrealts"> 
              <?php $this->widget ('ext.EasySlider.EasySlider', array (
                    'width' => '202px',
                    'height' => '152px',
                    'data' => $newrealts )); 
              ?>
              <?/*<a class="banner">Место<br>под баннер</a>*/?>
              <a class="reklama pos-a c-orang" >РЕКЛАМА</a>
          </div>    
       </div>
       <div class="panel-map fl <?/*w-660*/?>" >  
            <div class="contenerGoogleMap vsearch bg-blue radius-5 p-t0 p-0 m-0">
                <h2 class="ttr-upper c-white bold  bg-brown radius-5-0 m-b3 m-t0 p-5 p-l10 fs-15 ff-Arial halign-c">Карта Google</h2>
            <? /* Выберите район поиска */ ?>
                <div id="mapsearch" class="cke_skin_kama p-5 p-t3" width="660px" >
                    <?php echo $map->renderMap(array(),Yii::app()->language);?>
                </div>
            </div>
            <div class="contenerMap" style="display:none;">
                <h2 class="ttr-upper c-white bold  bg-brown radius-5-0 m-8 m-b5 m-t0 p-5 p-l10 fs-15 ff-Arial halign-c">Карта метро</h2>                
                <?php $this->renderPartial( '/realestates/_vmap_metros',                                                
                        array('metros'=>$metros)
                ); 
                ?>
            </div>
            <div class="contenerRealtyNews">
                <?/*<h2 class="ttr-upper c-white bold  bg-brown radius-5-0 m-8 m-b0 m-t0 p-5 p-l10 fs-15 ff-Arial halign-c">Cвежие предложения по аренде офиса в Москве</h2>*/?>                
                <div class="ttr-upper c-white bold  bg-brown radius-5-0 m-8 m-b0 m-t0 p-5 p-l10 fs-15 ff-Arial halign-c">Cвежие предложения по аренде офиса</div>
                <?php $this->renderPartial('/realestates/_cascad',array('favs'=>$cascadrealts));?>
            </div> 
            <?php// Если инфоблок под каскадом ?>
            <div class="iblock-1 justify m-t10" style="padding-left: 8px; width: 630px;" >
                        <?php 
                            // Детально Главной
                            $main=Iblocks::model()->findByPk(31);
                            //if ($short) echo $main->anons;
                            //else 
                            echo $main->short_detile; //echo $main->detile
                        ?> 
            </div> 
      </div>            
     <div class="clear"></div> 
  </div>
<?php $this->endWidget(); ?>
<script>
    $(document).ready(function() {
              $('#newrealts').removeClass('hidden');
              $('.contenerMap').attr('style','display:none');              
    });
</script>
