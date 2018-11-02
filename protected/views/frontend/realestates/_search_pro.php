             <?php
             $form=$this->beginWidget('CActiveForm',
                        array(  'action'=>Yii::app()->createUrl('realestates/newindex'),//Yii::app()->createUrl($this->route),
                            	'method'=>'post', //get
                                'id'=>'mainSearch',
                                'htmlOptions'=>array('name'=>'mainSearch'),
                             ));
             ?>
             <?/*<form action="/" method="post" name="mainSearch">*/?>
                <input type="hidden" name="action" value="search" />
                <div class="param_popup" style="display:block">
                  <div class="param_search">
                    <div class="param_search_top">
                       <div class="param_search_bottom" style="position:relative;">
                          <table class="param_table1">
                            <tr>
                              <th><b>Операция</b></th>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='district') { ?>
                              <th><b>Район</b></th>
                              <? } ?>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='metro') { ?>
                              <th><b>Карта</b></th>
                              <? } ?>
                              <th><b>К обьекту</b></th>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='vid') { ?>
                              <th><b>Обьект</b></th>
                              <? } ?>    
                              <? if (Yii::app()->getController()->getAction()->getId()!=='class') { ?>
                              <th><b>Класс</b></th>
                              <? } ?>
                              <th><b>Площадь <span class="c-fill ff-Arial">м2</span></b></th>
                              <th class="halign-l"><b>Оплата <div style="display:inline-block;">                                  
                                    <?php echo CHtml::dropDownList('Realestates[realestate_price_vid]', ( isset($_POST['Realestates']['realestate_price_vid']) && !empty($_POST['Realestates']['realestate_price_vid']) ? $_POST['Realestates']['realestate_price_vid'] : 'year'), 
                                                   array('year'=>'м2/год',
                                                         'mounth'=>'месяц'), array('style'=>'font-size:0.9em;width:54px;color:red;')) ?>
                                      </div>   
                                  </b>                                  
                                  <script>
                                    $('#Realestates_realestate_price_vid').live('change', 
                                            function() {                          
                                                if ( $('#Realestates_realestate_price_vid').val() == 'year' ) {    
                                                     //$('#price-to').attr('placeholder','240000');     
                                                     $('#price-to').val('240000');     
                                                } else { 
                                                     //$('#price-to').attr('placeholder','100000000');
                                                     $('#price-to').val('10000000');     
                                                }         
                                            }
                                    );
                                  </script>
                              </th>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='valute') { ?>
                              <th></th>
                              <? } ?>
                              <?/*<td><b>Удаленность</b></td>*/?>
                            </tr>
                            <tr>
                              <td>                                  
                                <?php $data = CHtml::listData(Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                             array("order"=>"sort")), 'id', 'title'); ?>
                                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                                              // the data model associated with this widget:
                                              'model' => $model,
                                              // the attribute associated with drop down list of this widget:
                                              'dropDownAttribute' => 'operation_id',
                                              // data for generating the options of the drop down list:
                                              'data' => $data,
                                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                                              'name' => 'Realestates[operation_id]',
                                              'value' => ( !empty($model->operation_id) ? $model->operation_id : 1) ,
                                              // additional HTML attributes for the drop down list:
                                              'dropDownHtmlOptions'=> array(
                                                'style'=>'width:auto'/*'width:378px;'*/,
                                                'multiple'=>false,
                                                'prompt'=>'Любая...',
                                                //'name'=>'Realestates[operation_id]',
                                              ),
                                              // options for the jQuery UI MultiSelect Widget
                                              // (see the project page for available options):
                                              'options' => array(
                                                'selectedList'=>5,
                                                'header'=>false,
                                                // set this to true, if you want to use the Filter Plugin
                                                'filter'=>false,
                                                'height'=>84,
                                                //'noneSelectedText'=>'Любая...',
                                                'minWidth'=>90,
                                                'multiple'=>false,
                                              ),
                                              /*'foptions' => array(
                                                  'autoReset'=>false,
                                              )*/
                                 )); ?>
                                 <?/*<div style="position: relative;">
                                     <? $operations = Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                             array("order"=>"sort"));

                                     ?>
                                     <a href="#" class="vip3 Selecter" rel="type"><?=$operations[0]->title;?></a>
                                     <div class="vipad3 Select" rel="type" >
                                        <a href="#" class="selsve"></a>
                                        <ul>
                                            <li><a href="#" val="0"><div class="link_a">Любая...</div></a></li>
                                            <? foreach ($operations as $key=>$operation) { ?>
                                                  <? if ( $key==0 ) { ?>
                                                  <li class="acti" ><a href="#" val="<?=$operation->id;?>"><div class="link_a"><?=$operation->title;?></div></a></li>
                                                  <? } else { ?>
                                                  <li><a href="#" val="<?=$operation->id;?>"><div class="link_a"><?=$operation->title;?></div></a></li>
                                                  <? } ?>
                                            <? } ?>
                                            <?/*<li class="acti" ><a href="#" val="1"><div class="link_a">Аренда</div></a></li>
                                            <li><a href="#" val="3"><div class="link_a">Продажа</div></a></li>*/?>
                                        <?/*</ul>
                                        <div class="vipad3_bottom"></div>
                                    </div>
                                 </div>
                                 <input type="hidden" name="Realestates[operation_id]" value="0" />*/?>
                              </td>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='district') { ?>
                              <td>
                                <?php $data = CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                             array("order"=>"sort")), 'id', 'abbr'); ?>
                                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                                              // the data model associated with this widget:
                                              'model' => $model,
                                              // the attribute associated with drop down list of this widget:
                                              'dropDownAttribute' => 'district_id',
                                              // data for generating the options of the drop down list:
                                              'data' => $data,
                                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                                              'name' => 'Realestates[district_id]',
                                              // additional HTML attributes for the drop down list:
                                              'dropDownHtmlOptions'=> array(
                                                'style'=>'width:auto'/*'width:378px;'*/,
                                                'multiple'=>true,
                                                /*'prompt'=>'Любой',*/
                                              ),
                                              // options for the jQuery UI MultiSelect Widget
                                              // (see the project page for available options):
                                              'options' => array(
                                                'selectedList'=>5,
                                                'header'=>false,
                                                // set this to true, if you want to use the Filter Plugin
                                                'filter'=>false,
                                                'height'=>210,
                                                'noneSelectedText'=>'Любой...',
                                                'minWidth'=>88,
                                                'multiple'=>true,
                                              ),
                                              /*'foptions' => array(
                                                  'autoReset'=>false,
                                              )*/
                                 )); ?>
                                 <?/* <div style="position: relative;">
                                     <? $districts = Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                     array("order"=>"sort"));
                                     ?>
                                     <a href="#" class="vip1 Selecter" rel="object">Любой</a>
                                     <div class="vipad1 Select" rel="object" >
                                        <a href="#" class="selsve"></a>
                                        <ul>
                                            <li class="acti"><a href="#" val="0"><div class="link_a">Любой</div></a></li>
                                            <? foreach ($districts as $key=>$district) { ?>
                                                  <li><a href="#" val="<?=$district->id;?>"><div class="link_a"><?=$district->title;?></div></a></li>
                                            <? } ?>
                                            <?/*<li><a href="#" val="1"><div class="link_a">Офис</div></a></li>
                                            <li><a href="#" val="3"><div class="link_a">ПСН</div></a></li>
                                            <li><a href="#" val="5"><div class="link_a">Магазин</div></a></li>
                                            <li><a href="#" val="6"><div class="link_a">Услуги</div></a></li>*/?>
                                  <?/*      </ul>
                                        <div class="vipad1_bottom"></div>
                                    </div>
                                 </div>
                                 <input type="hidden" name="Realestates[district_id]" value="0" />*/?>
                              </td>
                              <? } ?>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='metro') { ?>
                              <td>
                                <?php/* $data = CHtml::listData(Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                             array("order"=>"sort")), 'id', 'title'); */?>
                                <?php $data = array("1"=>"метро","2"=>"google");  ?>
                                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                                              // the data model associated with this widget:
                                              //'model' => $model,
                                              // the attribute associated with drop down list of this widget:
                                              //'dropDownAttribute' => 'map_id',
                                              // data for generating the options of the drop down list:
                                              'data' => $data,
                                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                                              'name' => 'map_id',
                                              'value' =>  ((isset($_POST["map_id"]) && !empty($_POST["map_id"])) ? $_POST["map_id"] : "") ,
                                              // additional HTML attributes for the drop down list:
                                              'dropDownHtmlOptions'=> array(
                                                'style'=>'width:auto'/*'width:378px;'*/,
                                                'multiple'=>false,
                                                'prompt'=>'Все...',
                                                'name'=>'map_id',
                                              ),
                                              // options for the jQuery UI MultiSelect Widget
                                              // (see the project page for available options):
                                              'options' => array(
                                                'selectedList'=>5,
                                                'header'=>false,
                                                // set this to true, if you want to use the Filter Plugin
                                                'filter'=>false,
                                                'height'=>80,
                                                'noneSelectedText'=>'Любая',
                                                'minWidth'=>75,
                                                'multiple'=>false,
                                              ),  /*'foptions' => array(
                                                  'autoReset'=>false,
                                              )*/
                                 )); ?>
                                 <?/*<div style="position: relative;"><a href="#" class="vip4 Selecter" rel="map">...</a>
                                    <div class="vipad4 Select" rel="map">
                                      <a href="#" class="selsve"></a>
                                      <ul>
                                         <li class="acti"><a href="#" val="1" class="toggleSelMap"><div class="link_c">...</div></a></li>
                                         <li><a href="#" val="2" class="toggleMap" ><div class="link_c">метро</div></a></li>
                                         <li><a href="#" val="3" class="toggleGoogleMap" ><div class="link_c">google</div></a></li>
                                      </ul>
                                      <div class="vipad4_bottom"></div>
                                    </div>
                                 </div>
                                 <input type="hidden" name="value" value="1" />*/?>
                              </td>
                              <? } ?>
                              <td>
                                 <table>
                                  <tr>
                                    <td class="tdp" ><b>до</b></td>
                                    <td>                                        
                                       <?php echo CHtml::hiddenField('remoteness-from',(trim($_POST['remoteness-from'])<>'' ? $_POST['remoteness-from'] : '0'));  ?>
                                       <?php echo CHtml::textField('remoteness-to',(trim($_POST['remoteness-to'])<>'' ? $_POST['remoteness-to'] : '200'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default remoteness-to','id'=>'remoteness-to'));  ?>                                        
                                    </td>
                                    <td>
                              <?php $data = CHtml::listData(Units::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                             array("order"=>"sort")), 'id', 'short_title'); ?>
                              <?php $this->widget('ext.widgets.EchMultiSelect', array(
                                              // the data model associated with this widget:
                                              'model' => $model,
                                              // the attribute associated with drop down list of this widget:
                                              'dropDownAttribute' => 'unit_id',
                                              // data for generating the options of the drop down list:
                                              'data' => $data,
                                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                                              'name' => 'Realestates[unit_id]',
                                              'value'=>( !empty($model->unit_id) ? $model->unit_id : 2),
                                              // additional HTML attributes for the drop down list:
                                              'dropDownHtmlOptions'=> array(
                                                'style'=>'width:auto'/*'width:378px;'*/,
                                                'multiple'=>false,
                                                'prompt'=>'...',
                                                //'name'=>'Realestates[unit_id]',
                                              ),
                                              // options for the jQuery UI MultiSelect Widget
                                              // (see the project page for available options):
                                              'options' => array(
                                                'selectedList'=>5,
                                                'header'=>false,
                                                // set this to true, if you want to use the Filter Plugin
                                                'filter'=>false,
                                                'height'=>106,
                                                //'noneSelectedText'=>'...',
                                                'minWidth'=>54,
                                                'multiple'=>false,
                                              ),
                                              /*'foptions' => array(
                                                  'autoReset'=>false,
                                              )*/
                                 )); ?>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='vid') { ?>
                              <td>
                                  <?php $data = CHtml::listData(RealestateVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                array("order"=>"sort")), 'id', 'title'); ?>
                                  <?php $this->widget('ext.widgets.EchMultiSelect', array(
                                                // the data model associated with this widget:
                                                'model' => $model,
                                                // the attribute associated with drop down list of this widget:
                                                'dropDownAttribute' => 'realestate_vid_id',
                                                // data for generating the options of the drop down list:
                                                'data' => $data,
                                                // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                                                'name' => 'Realestates_realestate_vid_id',
                                                // additional HTML attributes for the drop down list:
                                                'dropDownHtmlOptions'=> array(
                                                  'style'=>'width:auto'/*'width:378px;'*/,
                                                  'multiple'=>true,
                                                  /*'prompt'=>'Выбор...',*/
                                                ),
                                                // options for the jQuery UI MultiSelect Widget
                                                // (see the project page for available options):
                                                'options' => array(
                                                  'selectedList'=>5,
                                                  'header'=>false,
                                                  // set this to true, if you want to use the Filter Plugin
                                                  'filter'=>false,
                                                  'height'=>214,
                                                  'noneSelectedText'=>'Любой...',
                                                  'minWidth'=>148,
                                                  'multiple'=>true, 
                                                ),
                                                /*'foptions' => array(
                                                    'autoReset'=>false,
                                                )*/
                                      )); ?>
                              </td>
                              <? } ?>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='class') { ?>
                              <td>
                                  <?php $data = CHtml::listData(RealestateClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                        array("order"=>"sort")), 'id', 'abbr'); ?>
                                  <?php $this->widget('ext.widgets.EchMultiSelect', array(
                                                // the data model associated with this widget:
                                                'model' => $model,
                                                // the attribute associated with drop down list of this widget:
                                                'dropDownAttribute' => 'realestate_class_id',
                                                // data for generating the options of the drop down list:
                                                'data' => $data,
                                                // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                                                'name' => 'Realestates_realestate_class_id',
                                                // additional HTML attributes for the drop down list:
                                                'dropDownHtmlOptions'=> array(
                                                  'style'=>'width:auto'/*'width:378px;'*/,
                                                  'multiple'=>true,
                                                  /*'prompt'=>'Выбор...',*/
                                                ),
                                                // options for the jQuery UI MultiSelect Widget
                                                // (see the project page for available options):
                                                'options' => array(
                                                  'selectedList'=>5,
                                                  'header'=>false,
                                                  // set this to true, if you want to use the Filter Plugin
                                                  'filter'=>false,
                                                  'height'=>120,
                                                  'noneSelectedText'=>'...',
                                                  'minWidth'=>68,
                                                  'multiple'=>true,
                                                ),
                                                /*'foptions' => array(
                                                    'autoReset'=>false,
                                                )*/
                                      )); ?>
                              </td>
                              <? } ?>
                              <td>
                                <table>
                                  <tr>
                                    <td class="tdp">&nbsp;<b>от</b></td>
                                    <td>
                                       <?php echo CHtml::textField('area-from',(trim($_POST['area-from'])<>'' ? $_POST['area-from'] : '10'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default area-to','id'=>'area-from'));  ?>
                                    </td>
                                    <td class="tdp"><b>до</b></td>
                                    <td>
                                       <?php echo CHtml::textField('area-to',(trim($_POST['area-to'])<>'' ? $_POST['area-to'] : '40000'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default area-to','id'=>'area-to'));  ?>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td>
                                <table>
                                  <tr>
                                    <td class="tdp">&nbsp;<b>от</b></td>
                                    <td>
                                        <?php echo CHtml::textField('price-from',(trim($_POST['price-from'])<>'' ? $_POST['price-from'] : '0'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default price-to','id'=>'price-from'));  ?>
                                    </td>
                                    <td class="tdp"><b>до</b></td>
                                    <td>
                                        <?php echo CHtml::textField('price-to',(trim($_POST['price-to'])<>'' ? $_POST['price-to'] : '240000'),array('size'=>10,'maxlength'=>10,'class'=>'ui-widget ui-corner-all ui-state-default price-to','id'=>'price-to', 'style'=>'width:57px;'));  ?>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <? if (Yii::app()->getController()->getAction()->getId()!=='valute') { ?>
                              <td>                                                                
                              <?php $data = CHtml::listData(Valutes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                             array("order"=>"sort")), 'id', 'abbr'); ?>
                             <?php $this->widget('ext.widgets.EchMultiSelect', array(
                                              // the data model associated with this widget:
                                              'model' => $model,
                                              // the attribute associated with drop down list of this widget:
                                              'dropDownAttribute' => 'valute',
                                              // data for generating the options of the drop down list:
                                              'data' => $data,
                                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                                              'name' => 'valute',
                                              'value' => ( !empty($model->valute_id) ? $model->valute_id : 2),
                                              // additional HTML attributes for the drop down list:
                                              'dropDownHtmlOptions'=> array(
                                                'style'=>'width:auto'/*'width:378px;'*/,
                                                'multiple'=>false,
                                                'prompt'=>'...',
                                                'name' => 'valute',
                                              ),
                                              // options for the jQuery UI MultiSelect Widget
                                              // (see the project page for available options):
                                              'options' => array(
                                                'selectedList'=>5,
                                                'header'=>false,
                                                // set this to true, if you want to use the Filter Plugin
                                                'filter'=>false,
                                                'height'=>106,
                                                //'noneSelectedText'=>'...',
                                                'minWidth'=>58,
                                                'multiple'=>false,
                                              ),
                                              /*'foptions' => array(
                                                  'autoReset'=>false,
                                              )*/
                                 )); ?>
                              </td>
                              <? } ?>
                            </tr>
                          </table>
                          <div style="position:absolute; right: 9px; bottom:-12px;">
                             <a href="#" class="search_but" id="mainSearchButton"></a>
                             <? if (Yii::app()->getController()->getAction()->getId()=='vid') { ?>
                                    <?php echo CHtml::hiddenField('Realestates[realestate_vid_id]',$model->realestate_vid_id);?>  
                             <? } ?>
                             <?php echo CHtml::hiddenField('polygon');?>  
                             <div id="metro">
                             </div>
                          </div> 
                          <?/*<a href="#" id="link_extend_search" class="but1 param_svern_extend"><div><span>Расширенный поиск</span></div></a>
                          <a href="#" id="link_short_search" class="but1 param_svern_extend hidden"><div><span>Краткий поиск</span></div></a>
                          <script>
                              $("#link_extend_search").click( function() {
                                   $("#link_short_search").removeClass("hidden");
                                   $("#link_extend_search").addClass("hidden");
                                   $("table.param_table2").removeClass("hidden");
                              });
                              $("#link_short_search").click( function() {
                                   $("#link_extend_search").removeClass("hidden");
                                   $("#link_short_search").addClass("hidden");
                                   $("table.param_table2").addClass("hidden");
                               });
                          </script>
                          <table class="param_table2 hidden">
                          </table>*/?>
                          <div class="contenerGoogleMap" style="position: absolute;top: -948px;display:block; margin-top: 10px">
                               <? /* Выберите район поиска */ ?>
                               <div id="mapsearch" class="cke_skin_kama" width="942" >
                                    <?php echo $map->renderMap(array(),Yii::app()->language);?>
                               </div>
                          </div>
                          <div class="contenerMap" style="display:none; margin-top: 10px">
                               <?php $this->renderPartial( '/realestates/_map_metros',                                                
                                                           array('metros'=>$metros, 'mets'=>$mets)
                                                         ); 
                               ?>
                           </div>
                           <a href="#" class="but1 param_svern"><div><span>Свернуть</span></div></a>
                         </div>
                       </div>
                    </div>
                 </div>
            <?php $this->endWidget(); ?>
            <div class="formNav">
                <a href="#" class="but1" style="display:none"><div><span>Поиск по сайту</span></div></a>
            </div>

