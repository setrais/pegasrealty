<?php $form=$this->beginWidget('CActiveForm',
            array( 'action'=>Yii::app()->createUrl('realestates/index'),//Yii::app()->createUrl($this->route),
                   'method'=>'get', //post
                   'id'=>'mainSearch',
                   'htmlOptions'=>array('name'=>'mainSearch'),
                 ));
?>
   <div class="p-5" >
       <div class="panel-params fl w-248" >
          <div class="rows odd radius-5-0">               
               <div class="oper">
                   <div class="title"><?php echo $form->label($model,'operation_id'); ?></div>
                   <div class="checks">
                     <?php $data = CHtml::listData(Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                       array("order"=>"sort")), 'id', 'title'); ?>                    
                     <?php echo "<nobr>".CHtml::checkBoxList("Realestates[operation_id]", "1", $data, array("separator"=>"&nbsp;"))."</nobr>" ;?>
                   </div>
               </div>    
          </div>    
          <div class="rows oven">               
               <div class="oper">
                   <div class="title"><label for="location" ><?php echo Yii::t('all','Расположение') ?></label></div>
                   <div class="checks">
                      <?php $data = array("1"=>"метро","2"=>"карта");  ?>                                            
                      <?php echo "<nobr>".CHtml::checkBoxList("map_id", ( trim($_POST["map_id"])<>'' ? $_POST["map_id"] : "1"), $data, array("separator"=>"&nbsp;"))."</nobr>" ;?>
                   </div>
               </div>    
          </div>               
          <div class="rows odd">               
               <div class="oper">
                   <div class="title"><?php echo $form->label($model,'district_id'); ?></div>
                   <div class="checks">
                      <? $district = Districts::model()->findAll(array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                                       "order"=>"sort_main")); ?>
                      <? $data = CHtml::listData( $district, 'id', 'abbr'); ?>
                      <?// print_r($data) ?> 
                      <?php echo CHtml::checkBoxList("Realestates[district_id]", ( trim($_POST["Realestates"]["district_id"])<>'' ? $_POST["Realestates"]["district_id"] : ""/*array("7")*/ ), $data, array("separator"=>" ","class"=>"boxlist","template"=>"<nobr class=\"item\" >{input} {label}</nobr>")) ;?>
                   </div>
               </div>    
          </div>                          
          <div class="rows oven">               
               <div class="oper">
                   <div class="title"><?php echo $form->label($model,'remoteness'); ?></div>
                   <div class="checks p-l5">
                      <label>до</label>
                      <?php echo CHtml::hiddenField( 'remoteness-from',(trim($_POST['remoteness-from'])<>'' ? $_POST['remoteness-from'] : '0'));  ?>
                      <?php echo CHtml::textField( 'remoteness-to',(trim($_POST['remoteness-to'])<>'' ? $_POST['remoteness-to'] : '30'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default remoteness-to w-54 valign-m','id'=>'remoteness-to'));  ?>&nbsp;мин.                                                              
                      <?php $data = CHtml::listData( Units::model()->findAll( array( "condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)", "order"=>"sort" ) ), 'id', 'abbr'); ?>
                      <div class="box-checks valign-m">
                      <?php echo CHtml::checkBoxList( "Realestates[unit_id]", trim($_POST["Realestates"]["unit_id"])<>"" ? $_POST["Realestates"]["unit_id"] : ""/*array("2")*/, $data, array("separator"=>" ","template"=>"<nobr class=\"item\" >{input} {label}</nobr>")) ;?>
                      </div>    
                   </div>
               </div>   
          </div>              
          <div class="rows odd">               
               <div class="oper">
                   <div class="title"><?php echo $form->label($model,'realestate_vid_id'); ?></div>
                   <div class="checks">
                      <?php $data = CHtml::listData(RealestateVids::model()->findAll( array( "condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)", "order"=>"sort_main" )), 'id', 'title'); ?>
                      <?php echo CHtml::checkBoxList("Realestates[realestate_vid_id]", trim($_POST["Realestates"]["realestate_vid_id"])<>"" ? $_POST["Realestates"]["realestate_vid_id"] : ""/*array("1")*/, $data, array("separator"=>" ","template"=>"<nobr class=\"item w-112\" >{input} {label}</nobr>")) ;?>
                   </div>
               </div>   
          </div>             
          <div class="rows oven">               
               <div class="oper">
                   <div class="title"><?php echo $form->label($model,'realestate_class_id'); ?></div>
                   <div class="checks">
                      <?php $data = CHtml::listData(RealestateClasses::model()->findAll( array( "condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                        "order"=>"sort")), 'id', 'abbr'); ?>
                      <?php echo CHtml::checkBoxList("Realestates[realestate_class_id]", trim($_POST["Realestates"]["realestate_class_id"])<>"" ? $_POST["Realestates"]["realestate_class_id"] : ""/*array("1")*/, $data, array("separator"=>" ","template"=>"<nobr class=\"item-class\" >{input} {label}</nobr>")) ;?>
                   </div>
               </div>   
          </div>                               
          <div class="rows odd">               
               <div class="oper">
                   <div class="title"><label>Площадь <span class="c-fill ff-Arial">кв.м</span></label></div>
                   <div class="checks">
                       <label for="area-from" >от</label>
                       <?php echo CHtml::textField('area-from',(trim($_POST['area-from'])<>'' ? $_POST['area-from'] : '50'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default area-to item-area','id'=>'area-from'));  ?>
                       <label for="area-to" >до</label>
                       <?php echo CHtml::textField('area-to',(trim($_POST['area-to'])<>'' ? $_POST['area-to'] : '40000'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default area-to item-area','id'=>'area-to'));  ?>
                   </div>
               </div>   
          </div>            
          <div class="rows oven">               
               <div class="oper">
                   <div class="title"><label>Стоимость <span class="c-fill ff-Arial">кв.м в год</span></label></div>
                   <div class="checks">
                      <label for="price-from" >от</label>
                      <?php echo CHtml::textField( 'price-from',(trim($_POST['price-from'])<>'' ? $_POST['price-from'] : '0'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default price-to item-price','id'=>'price-from'));  ?>
                      <label for="price-to" >до</label>
                      <?php echo CHtml::textField( 'price-to',(trim($_POST['price-to'])<>'' ? $_POST['price-to'] : '240000'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default price-to item-price','id'=>'price-to'));  ?>
                      <?php $data = CHtml::listData( Valutes::model()->findAll( array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)","order"=>"sort")), 'id', 'abbr'); ?>
                      <div class="box-checks valign-m w-30">
                      <?php// echo CHtml::checkBoxList( "valute", trim($_POST["valute"])<>"" ? $_POST["valute"] : array("2"),  $data, array("separator"=>" ","template"=>"<nobr class=\"item w-54\" >{input} {label}</nobr>")) ;?>
                      <?php echo CHtml::radioButtonList( "valute", trim($_POST["valute"])<>"" ? $_POST["valute"] : "2",  $data, array("separator"=>" ","template"=>"<nobr class=\"item w-54\" >{input} {label}</nobr>")) ;?>
                      </div>    
                   </div>
               </div>   
          </div>               
          <div class="rows halign-c valign-m"> 
              <a href="#" class="search_but button-main" id="mainSearchButton">Поиск</a>  
              <?php echo CHtml::hiddenField('polygon');?>  
              <div id="metro"></div>
          </div>  
          <div class="rows oven bann valign-m halign-c hidden" id="newrealts"> 
              <?php $this->widget ('ext.EasySlider.EasySlider', array (
                    'width' => '202px',
                    'height' => '152px',
                    'data' => $newrealts )); 
              ?>
              <?/*<a class="banner">Место<br>под баннер</a>*/?>
          </div>    
       </div>
       <div class="panel-map fl <?/*w-660*/?>" >  
            <div class="contenerGoogleMap vsearch bg-blue radius-5" >
            <? /* Выберите район поиска */ ?>
                <div id="mapsearch" class="cke_skin_kama" width="660px" >
                    <?php echo $map->renderMap(array(),Yii::app()->language);?>
                </div>
            </div>
            <div class="contenerMap" style="display:block;">
                <?php $this->renderPartial( '/realestates/_vmap_metros',                                                
                        array('metros'=>$metros)
                ); 
                ?>
            </div>
      </div>            
     <div class="clear"></div> 
  </div>
<?php $this->endWidget(); ?>
<script>
    $(document).ready(function() {
              $('#newrealts').removeClass('hidden');
    });
</script>
