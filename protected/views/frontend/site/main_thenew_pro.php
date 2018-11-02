<?php $this->pageTitle=Yii::t('all',Yii::app()->name); ?>
<?php 
      $this->pageTitle='Пегас недвижимость | Аренда офиса в Москве - коммерческая недвижимость успех Вашего бизнеса, по цене стоимости аренды офиса в Москве от собственника, в центре, офис сити, западе, юге, востоке, севере, цао, зао, сао, вао, юао, юзао, ювао, свао, сзао Москвы '
//$this->pageTitle='Пегас недвижимость | Аренда офиса в Москве - коммерческая недвижимость успех Вашего бизнеса, по цене стоимости сдачи в аренду офиса в Москве от собственника снять офис: в центре, офис сити, западе, юге, востоке, севере, цао, зао, сао, вао, юао, юзао, ювао, свао, сзао, Москвы '
                       .($title_onreq ? ' ( '.$title_onreq.' ) ' : '');
      $this->pageDescription = $this->pageDescription.($desc_onreq ? ' ( '.$desc_onreq.' ) ' : '');
      $this->pageKeywords = //array_merge( 
                              $this->pageKeywords;                            
                            //,$akeywords_onreq)  ;
?>

        <div class="content" >
             <div class="iblock-1 justify" >
                 <?php 
                        // Детально Главной
                        $main=Iblocks::model()->findByPk(29);
                        echo $main->detile;
                 ?>             
             </div>
            <div class="slider-wrapper">
                <div class="favs p-5" >            
                    <?php $this->renderPartial('/realestates/_horizontal_slider',                                                
                                           array('favs'=>$favs,'model'=>$model,      
                                                 'fav_cnt'=>$fav_cnt_row*$fav_cnt_col,
                                                 )
                                          ); ?>
                </div>    
                <?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>  
            </div>
             <div class="iblock-1 justify m-t10" >
                <?php 
                        // Детально Главной
                        $main=Iblocks::model()->findByPk(30);
                        echo $main->detile;
                 ?> 
             </div>     
            <div class="search-form" >                
                 <?php $this->renderPartial('/realestates/_vertical_search_new_pro',                         
                               array('metros'=>$metros, 
                                     'map'=>$map,
                                     'favs'=>$favs,
                                     'model'=>$model,
                                     'newrealts'=> $newrealts,
                                     'cascadrealts'=> $cascadrealts,  
                                    )
                              );
                ?>
            </div>
            <div class="iblock-1 justify m-t10" >
                        <?php 
                            // Детально Главной
                            $main=Iblocks::model()->findByPk(31);
                            echo $main->detile;
                        ?> 
            </div>         
            <div class="boxtags">
                <table>                   
                   <tr>
                       <td class="valign-t">  
                       <?php $destinations = Destinations::model()->sitemap()->findAll();
                             $max = Destinations::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                             $min = Destinations::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));   
                             $koef = ($min->minname/$max->maxname)*2; 
                       ?>
                       <?php foreach ($destinations as $destination) {
                             $wordList_destination[] = array('text'=>$destination->title,'weight'=>ceil(($max->maxname/(strlen($destination->title)))*$koef), 
                                                             'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>$destination->id )),
                                                             'title'=> 'Аренда офиса с назначением '.$destination->title.' в Москве');  
                             
                       }
                       $wordList = array_merge($wordList_destination);
                       ?>                                                          
                       <?php 
                        $this->widget('ext.jcloud.JCloud', array(
                        'id'=>'destination_words',
                        'htmlOptions'=>array('style'=>'width: 240px; height: 250px; border: 1px solid #ccc;/*margin-top:10px;*/margin-left:5px;margin-right:12px;padding:3px;border-radius:10px;'),
                        'wordList'=>$wordList/*array(
                            array(
                                'text'=> "Для бизнеса",
                                'weight'=> 13,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>1)),
                            ),
                            array(
                                'text'=> "Ресторан",
                                'weight'=> 10.5,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>2)),
                                'title'=> "jQuery"
                            ),
                            array(
                                'text'=> "Автосервис",
                                'weight'=> 9.4,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>3)),//"javascript:alert('JavaScript in URL is OK!');"
                            ),
                            array(
                                'text'=> "Аптека",
                                'weight'=> 8,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>4)),
                            ),
                            array(
                                'text'=> "Банк",
                                'weight'=> 6.2,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>5)),
                            ),
                            array(
                                'text'=> "Компания",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>6)),
                            ),
                            array(
                                'text'=> "Прочее",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>7)),
                            ),
                            array(
                                'text'=> "Банк",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>8)),
                            ),                                        
                        )*/
                    )); ?>      
                       </td>
                       <td class="valign-t" id="blmetro">
                         <?//=CHtml::tag('ul', array(), str_repeat(chtml::tag('li', array(), ''), 4));?>
                                <h2 class="list">Cдаем офис в аренду рядом с станцией метро, в Москве:</h2>
                                <?// $rmetros = RealestateMetros::model()->findAll(array('group'=>'metro_id')); По новому 
                                $rmetros =  Realestates::model()->findAll(array('group'=>'metro_id','condition'=>'metro_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','join'=>'LEFT JOIN metros ON metros.id = t.metro_id','order'=>'metros.title ASC'));
                                $cntcol=5;  
                                $cntrow = ceil(count($rmetros)/$cntcol);
                                foreach ($rmetros as $metro) {
                                    $li[]= Chtml::tag('li', array(), Chtml::link($metro->metro->title,Yii::app()->createUrl('realestates/metro',array('id'=>$metro->metro->id )),array('title'=>'Аренда офиса рядом с метро '.$metro->metro->title.' в Москве')));
                                }                                                                
                                $arlis=array_chunk($li, $cntrow, false);
                                ?>
                                <table>
                                <tr>
                                <?     
                                foreach ( $arlis as $lis ) {
                                ?>
                                    <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 1em 1.5em 0;padding-left: 1.5em;list-style-type: circle;"),implode('',$lis));?></td> 
                                <?    
                                }
                                ?>        
                                </tr>        
                                </table>                
                       </td>
                   </tr>
                </table>            
            </div>
            <?php // Краткая форма
                  //$short = false; 
            ?>
            <?php if ($dataRecoms) { ?>            
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-brown radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Рекомендуемая площадь</span> - Аренда офиса в Москве</h2>
                    <?php $this->renderPartial('/realestates/_list',                                                
                                           array('dataProvider'=>$dataRecoms)
                                          ); ?>
                </div>    
            </div>  
            <?php } ?>            
            <div class="iblock-11 justify p-t7">
                 <?php 
                        // Когда вы обращаитесь к проффессионалам
                        $main=Iblocks::model()->findByPk(34);                        
                        if ($short) echo $main->anons;
                        else echo $main->detile;
                 ?>    
            </div>  
            <?php if ($dataRents) { ?>
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-brown  radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Офисная площадь оформленная нами в аренду</span> - Аренда офиса г.Москва</h2>
                    <?php $this->renderPartial('/realestates/_list',                                                
                                           array('dataProvider'=>$dataRents)
                                          ); ?>
                </div>    
            </div> 
            <?php } ?>            
            
            <div class="iblock-11 justify">
                 <?php   
                        // Стоимость аренды офиса в Москве
                        $main=Iblocks::model()->findByPk(33);
                        if ($short) echo $main->anons;
                        else echo $main->detile;
                 ?>    
            </div> 
            <? if ($short) { ?>
            <div class="iblock-11 justify">
                 <?php 
                        // Какой тип офиса выбрать в аренду
                        $main=Iblocks::model()->findByPk(32);
                        //echo $main->detile;
                        echo $main->anons;
                 ?>    
            </div>
            <? } ?>
            <div class="boxtags">
                <table>
                   <tr> 
                     <td class="valign-t">
                       <?php $vids = RealestateVids::model()->sitemap()->findAll();
                             $max = RealestateVids::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                             $min = RealestateVids::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));         
                       ?>
                       <?php $districts = Districts::model()->sitemap()->findAll();
                             $maxnext = Districts::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                             $minnext = Districts::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                             $max = $maxnext->maxname < $max->maxname ? $max->maxname : $maxnext->maxname;
                             $min = $minnext->minname > $min->minname ? $min->minname : $minnext->minname;
                       ?>                         
                       <?php $class = RealestateClasses::model()->sitemap()->findAll();
                             $maxnext = RealestateClasses::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                             $minnext = RealestateClasses::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                             $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                             $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>
                       <?php $valutes = Valutes::model()->sitemap()->findAll();
                             $maxnext = Valutes::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                             $minnext = Valutes::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                             $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                             $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>
                       <?php $units = Units::model()->sitemap()->findAll();
                             $maxnext = Units::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.abbr))) AS maxname'));  
                             $minnext = Units::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.abbr))) AS minname'));  
                             $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                             $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>   
                      <?php $properties = Properties::model()->sitemap()->findAll();
                            $maxnext = Properties::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                            $minnext = Units::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>  
                      <?php $parkings = Parkings::model()->sitemap()->findAll();
                            $maxnext = Parkings::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                            $minnext = Parkings::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>                           
                     <?php  $plannings = Plannings::model()->sitemap()->findAll();
                            $maxnext = Plannings::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                            $minnext = Plannings::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>                           
                     <?php  $taxs = Taxs::model()->sitemap()->findAll();
                            $maxnext = Taxs::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                            $minnext = Taxs::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>                            
                     <?php  $operations = Operations::model()->sitemap()->findAll();
                            $maxnext = Operations::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                            $minnext = Operations::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>    
                       <?php  $types = RealestateTypes::model()->sitemap()->findAll();
                            $maxnext = RealestateTypes::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                            $minnext = RealestateTypes::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>     
                       <?php  
                            $fareas = FareaOffers::model()->sitemap()->findAll();
                            $maxnext = FareaOffers::model()->sitemap()->find(array('select'=>'MAX(LENGTH(CONCAT("Площадь от ",TRIM(init_value)," м2 до ",TRIM(final_value)," м2"))) AS maxname'));  
                            $minnext = FareaOffers::model()->sitemap()->find(array('select'=>'MIN(LENGTH(CONCAT("Площадь от ",TRIM(t.init_value)," м2 до ",TRIM(t.final_value)," м2"))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       ?>                              
                       <?php 
                            $maxnext = strlen(Yii::t('menu','корр.коэфф.'.$coefficient.'%')); 
                            $minnext = strlen(Yii::t('menu','корр.коэфф. '.$coefficient.'%')); 
                            $max = $maxnext < $max ? $max : $maxnext;
                            $min = $minnext > $min ? $min : $minnext;
                            
                            $maxnext = strlen(Yii::t('menu','без отдельного входа')); 
                            $minnext = strlen(Yii::t('menu','c отдельным входом')); 
                            $max = $maxnext < $max ? $max : $maxnext;
                            $min = $minnext > $min ? $min : $minnext;
                       ?>
                       <?                         
                         
                             $koef = ($min/$max)*13;    
                             
                       ?>                             
                       <?php foreach ($vids as $vid) {
                             //echo ceil(($max/(strlen($vid->title)))*$koef).'/';
                             $wordList_vids[] = array('text'=>$vid->title,'weight'=>ceil(($max/(strlen($vid->title)))*$koef), 
                                                      'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>$vid->id )),
                                                      'title'=> 'Аренда офиса вида '.$vid->title.', в Москве'); 
                             
                       } ?>
                       <?php foreach ($districts as $district) {
                             $wordList_districts[] = array('text'=>$district->title,'weight'=>ceil(($max/(strlen($district->title)))*$koef), 
                                                           'url'=> Yii::app()->createUrl('realestates/district',array('id'=>$district->id )),
                                                           'title'=> 'Аренда офиса в районе '.$district->title.', в Москве'); 
                             
                       } ?>   
                       <?php foreach ($class as $clase) {
                             $wordList_class[] = array('text'=>$clase->title,'weight'=>ceil(($max/(strlen($clase->title)))*$koef), 
                                                       'url'=> Yii::app()->createUrl('realestates/class',array('id'=>$clase->id )),
                                                       'title'=> 'Аренда офиса класса '.$class->title.', в Москве'); 
                             
                       } ?>                           
                       <?php foreach ($valutes as $valute) {
                             $wordList_valutes[] = array('text'=>$valute->title,'weight'=>ceil(($max/(strlen($valute->title)))*$koef), 
                                                         'url'=> Yii::app()->createUrl('realestates/valute',array('id'=>$valute->id )),
                                                         'title'=> 'Аренда офиса в валюте '.$valute->title.', в Москве'); 
                             
                       } ?>      
                       <?php foreach ($parkings as $parking) {
                             $wordList_parkings[] = array('text'=>$parking->title,'weight'=>ceil(($max/(strlen($parking->title)))*$koef), 
                                                          'url'=> Yii::app()->createUrl('realestates/parking',array('id'=>$parking->id )),
                                                          'title'=> 'Аренда офиса по парковке '.$parking->title.', в Москве'); 
                             
                       } ?>                          
                       <?php foreach ($plannings as $planning) {
                             $wordList_plannings[] = array('text'=>$planning->title,'weight'=>ceil(($max/(strlen($planning->title)))*$koef), 
                                                           'url'=> Yii::app()->createUrl('realestates/planning',array('id'=>$planning->id )),
                                                           'title'=> 'Аренда офиса c планировкой '.$planning->title.', в Москве'); 
                             
                       } ?>                             
                       <?php foreach ($units as $unit) {
                             $wordList_units[] = array('text'=>$unit->abbr,'weight'=>ceil(($max/(strlen($unit->abbr)))*$koef), 
                                                       'url'=> Yii::app()->createUrl('realestates/unit',array('id'=>$unit->id )),
                                                       'title'=> 'Добираться к аренде офиса '.$unit->title.', в Москве'); 
                             
                       } ?>    
                       <?php foreach ($taxs as $tax) {
                             $wordList_taxs[] = array('text'=>$tax->title,'weight'=>ceil(($max/(strlen($tax->title)))*$koef), 
                                                      'url'=> Yii::app()->createUrl('realestates/tax',array('id'=>$tax->id )),
                                                      'title'=> 'Аренда офиса c налогооблажением '.$tax->title.', в Москве'); 
                             
                       } ?>                          
                       <?php foreach ($operations as $operation) {
                             $wordList_operations[] = array('text'=>$operation->title,'weight'=>ceil(($max/(strlen($operation->title)))*$koef), 
                                                            'url'=> Yii::app()->createUrl('realestates/operation',array('id'=>$operation->id )),
                                                            'title'=> $operation->title.' офиса в Москве'); 
                             
                       } ?> 
                       <?php foreach ($types as $type) {
                             $wordList_types[] = array('text'=>$type->title,'weight'=>ceil(($max/(strlen($type->title)))*$koef), 
                                                       'url'=> Yii::app()->createUrl('realestates/type',array('id'=>$type->id )),
                                                       'title'=> 'Аренда '.$type->title.' в Москве'); 
                             
                       } ?>                          
                       <?php foreach ($properties as $property) {
                             $wordList_properties[] = array('text'=>$property->title,'weight'=>ceil(($max/(strlen($property->title)))*$koef), 
                                                             'url'=> Yii::app()->createUrl('realestates/property',array('id'=>$property->id )),
                                                             'title'=> 'Аренда офиса с свойством '.$property->title.' в Москве');  
                             
                       } ?>      
                       <?php 
                             $wordList_entranceon[] = array('text'=>'c отдельным входом','weight'=>ceil(($max/(strlen('c отдельным входом')))*$koef), 
                                                            'url'=> Yii::app()->createUrl('realestates/entranceon'),
                                                            'title'=> 'Аренда офиса с отдельным входом, в Москве');   
                             $wordList_entranceoff[] = array('text'=>'без отдельного входа','weight'=>ceil(($max/(strlen('без отдельного входа')))*$koef), 
                                                            'url'=> Yii::app()->createUrl('realestates/entranceoff'),
                                                            'title'=> 'Аренда офиса без отдельного входа, в Москве');
                             
                       ?>                          
                       <?php    $acoef = range(5,30,1); 
            

                             foreach ( $acoef as $key=>$coefficient ) {
                                $is_corr = Realestates::model()->exists('coefficient_corridor='.$coefficient.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                                if ($is_corr) {          
                                    $wordList_coefs[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/coefficient',array('id'=>$coefficient)),
                                        'weight'=>ceil($max/(strlen(Yii::t('menu','корр.коэфф. '.$coefficient.'%'))))*$koef,               
                                        'text'=>Yii::t('menu','корр.коэфф. '.$coefficient.'%'),
                                        'title'=> 'Аренда офиса с корредорным коэффициентом '.mb_strtolower($coefficient,'UTF-8').'%, в Москве'
                                    ); 
                                }
                            }
                      ?>     
                      <?php  
                            foreach ( $fareas as $key=>$farea ) {                                
                                $is_freals = Realestates::model()->exists('(area>='.$farea->init_value.' AND area<='.$farea->final_value.') AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                                if ($is_freals) {          
                                    $wordList_fareas[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/area',array('id'=>$farea->id)),
                                        'weight'=>ceil($max/(strlen("Площадь от ".trim($farea->init_value)." м2 до ".trim($farea->final_value)." м2")))*$koef,               
                                        'text'=>Yii::t('menu',"Площадь oт ".trim($farea->init_value)." м2 до ".trim($farea->final_value)." м2"),
                                        'title'=> 'Аренда офиса с площадью от '.trim($farea->init_value)." м2 до ".trim($farea->final_value).' м2, в Москве'
                                    ); 
                                }
                            }                         
                      ?>   
                      <?php 
                            $vwordList = array_merge($wordList_vids, $wordList_districts, $wordList_class, 
                                                     $wordList_valutes, $wordList_units, $wordList_properties, 
                                                     $wordList_coefs, $wordList_parkings, $wordList_plannings,
                                                     $wordList_taxs, $wordList_operations,$wordList_types,
                                                     $wordList_entranceoff,$wordList_entranceon,$wordList_fareas   
                                                    ); 
                      ?>  
                         
                      <?php $this->widget('ext.jcloud.JCloud', array(
                        'id'=>'vid_words',
                        'htmlOptions'=>array('style'=>'width: 240px; min-height:250px; border: 1px solid #ccc;/*margin-top:10px;*/margin-left:5px;margin-right:12px;padding:3px;border-radius:10px;'),
                        'wordList'=>$vwordList/*array(
                            array(
                                'text'=> "Бизнес центр",
                                'weight'=> 13,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>1)),
                            ),
                            array(
                                'text'=> "Жилой комплекс",
                                'weight'=> 10.5,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>2)),
                                'title'=> "jQuery"
                            ),
                            array(
                                'text'=> "Отдельно стоящее здание",
                                'weight'=> 9.4,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>3)),//"javascript:alert('JavaScript in URL is OK!');"
                            ),
                            array(
                                'text'=> "Жилой дом",
                                'weight'=> 8,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>4)),
                            ),
                            array(
                                'text'=> "Особняк",
                                'weight'=> 6.2,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>5)),
                            ),
                            array(
                                'text'=> "Бизнес парк",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>6)),
                            ),
                            array(
                                'text'=> "Административное здание",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>7)),
                            ),
                            array(
                                'text'=> "Банк",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>8)),
                            ),
                            array(
                                'text'=> "Мед центр",
                                'weight'=> 13, 
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>9)),
                            ),
                            array(
                                'text'=> "Торговое",
                                'weight'=> 8,
                                'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>10)),
                            ),  
                            array(
                                'text'=> "ЦАО",
                                'weight'=> 13,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>1)),
                                'title'=> 'Аренда офиса в центральном административном округе'
                            ),
                            array(
                                'text'=> "ВАО",
                                'weight'=> 10.5,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>2)),
                                'title'=> 'Аренда офиса в восточном административном округе'
                            ),
                            array(
                                'text'=> "ЮЗАО",
                                'weight'=> 9.4,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>3)),
                                'title'=> 'Аренда офиса в юго-западном административном округе'
                            ),
                            array(
                                'text'=> "САО",
                                'weight'=> 8,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>4)),
                                'title'=> 'Аренда офиса в северном административном округе'
                            ),
                            array(
                                'text'=> "ЮВАО",
                                'weight'=> 6.2,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>5)),
                                'title'=> 'Аренда офиса в юго-восточном административном округе'                                
                            ),
                            array(
                                'text'=> "ЗАО",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>6)),
                                'title'=> 'Аренда офиса в западном административном округе'                                
                            ),
                            array(
                                'text'=> "СВАО",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>7)),
                                'title'=> 'Аренда офиса в северо-восточном административном округе'                                
                            ),
                            array(
                                'text'=> "ЮАО",
                                'weight'=> 5,
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>8)),
                                'title'=> 'Аренда офиса в южном административном округе'  
                            ),
                            array(
                                'text'=> "СЗАО",
                                'weight'=> 13, 
                                'url'=> Yii::app()->createUrl('realestates/district',array('id'=>9)),
                                'title'=> 'Аренда офиса в северо-западном административном округе'  
                            ),
                            array(
                                'text'=> "Класс A",
                                'weight'=> 12, 
                                'url'=> Yii::app()->createUrl('realestates/class',array('id'=>1)),
                                'title'=> 'Аренда офиса класса А'  
                            ),
                            array(
                                'text'=> "Класс В",
                                'weight'=> 10.5, 
                                'url'=> Yii::app()->createUrl('realestates/class',array('id'=>2)),
                                'title'=> 'Аренда офиса класса В'  
                            ),        
                            array(
                                'text'=> "Класс В+",
                                'weight'=> 9.4, 
                                'url'=> Yii::app()->createUrl('realestates/class',array('id'=>3)),
                                'title'=> 'Аренда офиса класса В+'  
                            ),               
                            array(
                                'text'=> "Класс С",
                                'weight'=> 8, 
                                'url'=> Yii::app()->createUrl('realestates/class',array('id'=>4)),
                                'title'=> 'Аренда офиса класса С'                                  
                            ),     
                            array(
                                'text'=> "шталбасом",
                                'weight'=> 6, 
                                'url'=> Yii::app()->createUrl('realestates/unit',array('id'=>1)),
                                'title'=> 'Добираться шталбасом'  
                            ),                                
                            array(
                                'text'=> "пешком",
                                'weight'=> 1, 
                                'url'=> Yii::app()->createUrl('realestates/unit',array('id'=>2)),
                                'title'=> 'Добираться пешком'  
                            ),                                                            
                            array(
                                'text'=> "транспортом",
                                'weight'=> 5, 
                                'url'=> Yii::app()->createUrl('realestates/unit',array('id'=>3)),
                                'title'=> 'Добираться транспортом'  
                            ),                                                          
                        )*/
                    )); ?>                       
                     </td>     
                     <td class="valign-t" id="blstreet">
                         <h2 class="list">Снять офис в аренду на <?php echo Streets::model()->getListType();?>, в Москве:</h2> 
                                <? $streets = Realestates::model()->findAll(array('group'=>'street_id','condition'=>'street_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','join'=>'LEFT JOIN streets ON streets.id = t.street_id','order'=>'streets.name ASC'));
                                $cntcol=5;  
                                $cntrow = ceil(count($streets)/$cntcol);
                                foreach ($streets as $street) {
                                    $li_streets[]= Chtml::tag('li', array(),Chtml::link($street->street->getSocrName(),Yii::app()->createUrl('realestates/street',array('id'=>$street->street->id )),array('title'=>'Аренда офиса '.$street->street->getFullName('на').' в Москве')));
                                }                                                                
                                $arli_streets=array_chunk($li_streets, $cntrow, false);
                                ?>
                                <table>
                                <tr>
                                <?     
                                foreach ( $arli_streets as $streets ) {
                                ?>
                                    <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 0em 1.5em 0;padding-left: 1.5em;list-style-type: circle;"),implode('',$streets));?></td> 
                                <?    
                                }
                                ?>        
                                </tr>        
                                </table>                                                                                  
                     </td>  
                   </tr> 
                </table>    
            </div>       
            <script>
                $('#vid_words').height($('#blstreet').height()-20);
                $('#destination_words').height($('#blmetro').height()-20);
            </script>             
            <?php if ($dataPopulars) { ?>
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-brown radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Популярная площадь</span> - Аренда офиса города Москва</h2>
                    <?php $this->renderPartial('/realestates/_list',                                                
                                           array('dataProvider'=>$dataPopulars)
                                          ); ?>
                </div>    
            </div>            
            <?php } ?>
            <? if (!$short) { ?>
            <div class="iblock-11 justify">
                 <?php 
                        // Детально Выбор инфоблока
                        $main=Iblocks::model()->findByPk(32);
                        echo $main->detile;
                 ?>    
            </div>
            <? } ?>
        </div>
