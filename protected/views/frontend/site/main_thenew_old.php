<?php $this->pageTitle=Yii::t('all',Yii::app()->name); ?>
<?php 
      $this->pageTitle='Аренда офиса в Москве без комиссии по цене собственника | Пегас недвижимость успех Вашего бизнеса по аренде офиса, помещения, особняка, бизнес центра, банка, здания Москвы согласно стоимости помещений на прямую от собственника. Cнять офис, помещение или здание г.Москва без посредников'// в бизнес центре, административном здании, жилом доме, комлексе, парке, банке, особняке, сити, центре, западе, юге, востоке, севере, цао, зао, сао, вао, юао, юзао, ювао, свао, сзао Москвы'
      //$this->pageTitle='Пегас недвижимость | Аренда офиса в Москве - коммерческая недвижимость успех Вашего бизнеса, по цене стоимости предложений './*'аренды офиса в Москве '*/'от собственника помещений. Сдать, снять офис в: центре, офис сити, западе, юге, востоке, севере, цао, зао, сао, вао, юао, юзао, ювао, свао, сзао Москвы ' 
      //$this->pageTitle='Пегас недвижимость | Аренда офиса в Москве - коммерческая недвижимость успех Вашего бизнеса, по цене стоимости сдачи в аренду офиса в Москве от собственника снять офис: в центре, офис сити, западе, юге, востоке, севере, цао, зао, сао, вао, юао, юзао, ювао, свао, сзао, Москвы '
                       .($title_onreq ? ' ( '.$title_onreq.' ) ' : '');
      $this->pageDescription = $this->pageDescription.($desc_onreq ? ' ( '.$desc_onreq.' ) ' : '');
      $this->pageKeywords = //array_merge( 
                              $this->pageKeywords;                            
                            //,$akeywords_onreq)  ;
      $is_hor_street = true; 
?>

        <div class="content" >
            <div class="div-p center m-b0">
                <h1 class="fs-12i m-0 p-0 inline-valn c-333"><span class="c-orang bold" >АРЕНДА</span> коммерческой недвижимости по выгодной цене</h1> повод начать свой бизнес <b class="c-orang bold">В МОСКВЕ!</b>
                <?php 
                        $this->widget('ext.WebTicker.WebTicker', 
                           array(      'id' => 'webticker',
                                  'cssFile' => 'mywebticker',
                                  'options' => array( 'duplicate' => false, 
                                                         'rssurl' => 'http://pegasrealty.loc/site/rss/', 
                                                   'rssfrequency' => 1, 
                                                          'speed' => 60, //pixels per second
                                                      'direction' => 'left', //if to move left or right
                                                         'moving' => true, //weather to start the ticker in a moving or static position
                                                     'startEmpty' => false, 
                                                     'hoverpause' => true,
                                                     'updatetype' => 'reset'
                                  ),
                               'contOptions' => array( 'width' => 'auto',
                                                       'height' => 'auto',
                                                       'class' => 'inline-valn'),
                               'data'=>null// Список 
                        )); ?>    
            </div>
            <div class="iblock-1 justify" > 
                 <?php 
                        // Аренда офиса в Москве без комиссии по цене собственника задача
                        $main=Iblocks::model()->findByPk(29);
                        echo $main->short_detile; //echo $main->detile;
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
                <p class="iblock-1 justify arial" >
                 <?php 
                        $info = str_replace('pegasrealty.ru - Портал недвижимости агентства "Пегас недвижимость", профессионала рынка коммерческой недвижимости.','', Yii::t('all',$this->pageDescription));
                        $info = str_replace('Аренда офисов в бизнес центрах, особняках, административных зданиях, жилых домах и комплексах, бизнес парках Москвы','<b>Аренда офисов в бизнес центрах, особняках, административных зданиях, жилых домах и комплексах, бизнес парках Москвы</b>',$info);
                        $info = str_replace('8 (495) 222-95-20 либо через форму в меню контакты','<b class="upper c-red">8 (495) 222-95-20</b>  либо через форму в меню <a href="http://pegasrealty.ru/ru/site/contact.html">"Контакт"</a>',$info);
                        $info = str_replace('Аренда офисов в бизнес центрах, особняках, административных зданиях, жилых домах и комплексах, бизнес парках Москвы','<a href="/ru/realestates/vid/12.html" alt="Аренда офисов в бизнес центрах, особняках, административных зданиях, жилых домах и комплексах, бизнес парках Москвы">Аренда офисов в бизнес центрах, особняках, административных зданиях, жилых домах и комплексах, бизнес парках Москвы</a>',$info);
                        $info = str_replace('аренде офиса в москве от собственников в центре, на западе, юге, востоке, севере, вао, юаo, зао, юзао, ювао, цао, свао, сзао, сао','<a href="/ru/realestates/vid/12.html" alt="Аренда офисов в Москве от собственников в центре, на западе, юге, востоке, севере, вао, юаo, зао, юзао, ювао, цао, свао, сзао, сао">аренде офисов в москве от собственников в центре, на западе, юге, востоке, севере, вао, юаo, зао, юзао, ювао, цао, свао, сзао, сао</a>',$info);
                        $info = str_replace('Связаться с нами и уточнить детали аренды возможно по телефону 8 (495) 222-95-20 либо через форму в меню контакты. Всегда рады Вам и Вашим бизнес решениям!','',$info);
                        echo $info;                   
                 ?>
                </p>                    
                <?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>  
            </div>            
            <div class="iblock-1 justify m-t10 " >
                <?php                 
                        // Выбором аренды офисов в Москве
                        $main=Iblocks::model()->findByPk(30);
                        echo $main->short_detile; //echo $main->detile;
                 ?>   
            </div>     
            <div class="search-form" >                
                 <?php $this->renderPartial('/realestates/_vertical_search_new',                         
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
            <div class="iblock-1 justify m-t14 <?php//m-t10?>" >
                <?php/* 
                            // Ухало в search Расположение офиса влияет на его стоимость аренды в Москве. 
                            $main=Iblocks::model()->findByPk(31);
                            //if ($short) echo $main->anons;
                            //else 
                            echo $main->short_detile; //echo $main->detile
                 */?> 
            </div>
            <div class="boxtags">
                <table>                   
                   <tr>
                       <td class="valign-t">  
                       <?php $destinations = Destinations::model()->sitemap()->findAll();
                             $max = Destinations::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                             $min = Destinations::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));   
                             $koef = ($min->minname/$max->maxname)*20; 
                       ?>
                       <?php foreach ($destinations as $destination) {
                                $wordList_destination[] = array('text'=>$destination->title,'weight'=>ceil(($max->maxname/(strlen($destination->title)))*$koef), 
                                                                'url'=> Yii::app()->createUrl('realestates/destination',array('id'=>$destination->id )),
                                                                'title'=> 'Аренда коммерческой недвижимости с назначением '.$destination->title.' в Москве');  
                             
                            }
                            $wordList = array_merge($wordList_destination);
                       ?>                                                          
                       <?php 
                        $this->widget('ext.jcloud.JCloud', array(
                        'id'=>'destination_words',
                        'htmlOptions'=>array('style'=>(!$short ? 'width:auto; height:180px;' : 'width:240px; height:250px;').' border: 1px solid #c9e0ed;'./*#ccc;/*margin-top:10px;*/'margin-left:5px;margin-right:12px;padding:3px;border-radius:10px;'),
                        'wordList'=>$wordList
                    )); ?>      
                       </td>
                   <?php if ($short) { ?>    
                       <td class="valign-t " id="blmetro" style="<?php//Если инфоблок под каскадом?>padding-left: 28px;">
                         <?php $this->renderPartial('/site/_list_metros', array('model'=>false)); ?>              
                       </td>
                   <?php } ?>    
                   </tr>
                </table>            
            </div>
            <?php // Краткая форма
                  //$short = false; 
            ?>
            <?php if ($dataRecoms) { ?>        
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-brown radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Рекомендуемая площадь</span> - Коммерческая недвижимость, <?php echo CHtml::link(CHtml::encode('аренда малых и большых офисов в г. Москве'), array('realestates/index'), array('alt'=>'Коммерческая недвижимость - Аренда офисов в городе Москве', 'class'=>"c-orang"));?></h2>
                    <?/*<div class="bg-brown radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Рекомендуемая площадь</span></div>*/?>
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
            <div class="boxtags">
                <table>     
                   <tr>     
                       <td class="valign-t" id="blareas" >
                         <?php $this->renderPartial('/site/_list_areas', array('model'=>false)); ?>                                         
                       </td>
                   </tr>                    
                   <tr>
                       <td class="valign-t <?/*w-252*/?>">  
                       <?php $taxreferences = TaxReference::model()->sitemap()->findAll();
                             $max = TaxReference::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.abbr))) AS maxname'));  
                             $min = TaxReference::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.abbr))) AS minname'));  
                      ?>       
                      <?php  
                            $fareas = FareaOffers::model()->sitemap()->findAll();
                            //$maxnext = FareaOffers::model()->sitemap()->find(array('select'=>'MAX(LENGTH(CONCAT("Площадь от ",TRIM(init_value)," м2 до ",TRIM(final_value)," м2"))) AS maxname'));  
                            //$minnext = FareaOffers::model()->sitemap()->find(array('select'=>'MIN(LENGTH(CONCAT("Площадь от ",TRIM(t.init_value)," м2 до ",TRIM(t.final_value)," м2"))) AS minname'));  
                            $maxnext = FareaOffers::model()->find(array('select'=>'MAX(LENGTH(CONCAT(t.init_value,t.final_value))) AS maxname'));  
                            $minnext = FareaOffers::model()->find(array('select'=>'MIN(LENGTH(CONCAT(t.init_value,t.final_value))) AS minname'));  
                            $max = $maxnext->maxname+mb_strlen(' - '.' м2','utf-8') < $max->maxname ? $max->maxname : $maxnext->maxname+mb_strlen(' - '.' м2','utf-8');
                            $min = $minnext->minname+mb_strlen(' - '.' м2','utf-8') > $min->minname ? $min->minname : $minnext->minname+mb_strlen(' - '.' м2','utf-8');                            
                       ?>       
                       <?    
                             $koef = ceil(($min/$max)*100); 
                       ?>
                      <?php  
                            foreach ( $fareas as $key=>$farea ) {                                
                                $is_freals = Realestates::model()->exists('(area>='.$farea->init_value.' AND area<='.$farea->final_value.') AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                                if ($is_freals) {          
                                    $wordList_fareas[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/area',array('id'=>$farea->id)),
                                        //'weight'=>ceil($max/(strlen("Площадь от ".trim($farea->init_value)." м2 до ".trim($farea->final_value)." м2")))*$koef,               
                                        //'text'=>Yii::t('menu',"Площадь oт ".trim($farea->init_value)." м2 до ".trim($farea->final_value)." м2"),
                                        'weight'=>ceil($max/(strlen(trim($farea->init_value)."-".trim($farea->final_value)." м2"))*$koef),               
                                        'text'=>Yii::t('menu',trim($farea->init_value)."-".trim($farea->final_value)." м2"),
                                        'title'=> 'Аренда коммерческой недвижимости с площадью от '.trim($farea->init_value)." м2 до ".trim($farea->final_value).' м2, в Москве'
                                    ); 
                                }
                            }                         
                      ?>   
                       <?php 
                            foreach ($taxreferences as $taxreference) {
                                $wordList_taxRef[] = array('text'=>$taxreference->abbr,
                                                           'weight'=>ceil(($max/(strlen($taxreference->abbr)))*$koef), 
                                                           'url'=> Yii::app()->createUrl('realestates/taxReference',array('id'=>$taxreference->id )),
                                                           'title'=> 'Аренда коммерческой недвижимости '.$taxreference->title.' ( '.$taxreference->abbr." ) в Москве");  
                             
                            }
    
                            $wordList = array_merge($wordList_taxRef,$wordList_fareas);
                       ?>                                                          
                       <?php 
                        $this->widget('ext.jcloud.JCloud', array(
                        'id'=>'taxreferences',
                        'htmlOptions'=>array('style'=>'width: auto; height: 240px; border: 1px solid #c9e0ed; './*#ccc;*//*margin-top:10px;*/'margin-left:5px;margin-right:5px;margin-bottom:5px;padding:3px;border-radius:10px;'),
                        'wordList'=>$wordList
                        )); ?>      
                       </td>
                  </tr>     
                </table>            
            </div>
            <br/>         
            <div class="iblock-11 justify">
                 <?php   
                        // Стоимость аренды офиса в Москве
                        $main=Iblocks::model()->findByPk(33);
                        if (!$short) echo $main->short_detile; //echo $main->anons;
                        else echo $main->detile;
                 ?>    
            </div> 
            <?php if ($dataRents) { ?>
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-brown  radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Офисная площадь оформленная нами в аренду</span> - <?php echo CHtml::link(CHtml::encode('Аренда офисных помещений и зданий Москвы'), array('realestates/index'), array('alt'=>'Коммерческая недвижимость - аренда офисных помещений и зданий Москвы', 'class'=>"c-orang"));?></h2>
                    <?/*<div class="bg-brown  radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Офисная площадь оформленная нами в аренду</span></div>*/?>
                    <?php $this->renderPartial('/realestates/_list',                                                
                                           array('dataProvider'=>$dataRents)
                                          ); ?>
                </div>    
            </div> 
            <br>
            <?php } ?>    
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
                             //$dlenspace = strlen('Недвижимость: ');
                             $max = $maxnext->maxname+18 < $max->maxname+$dlenspace ? $max->maxname+$dlenspace : $maxnext->maxname+18;
                             $min = $minnext->minname+18 > $min->minname+$dlenspace ? $min->minname+$dlenspace : $minnext->minname+18;
                       ?>                         
                       <?php $class = RealestateClasses::model()->sitemap()->findAll();
                             $maxnext = RealestateClasses::model()->sitemap()->find(array('select'=>'MAX(LENGTH(TRIM(t.title))) AS maxname'));  
                             $minnext = RealestateClasses::model()->sitemap()->find(array('select'=>'MIN(LENGTH(TRIM(t.title))) AS minname'));  
                             $max = $maxnext->maxname+$dlenspace < $max ? $max : $maxnext->maxname+$dlenspace;
                             $min = $minnext->minname+$dlenspace > $min ? $min : $minnext->minname+$dlenspace;
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
                       <?php/*  
                            $fareas = FareaOffers::model()->sitemap()->findAll();
                            //$maxnext = FareaOffers::model()->sitemap()->find(array('select'=>'MAX(LENGTH(CONCAT("Площадь от ",TRIM(init_value)," м2 до ",TRIM(final_value)," м2"))) AS maxname'));  
                            //$minnext = FareaOffers::model()->sitemap()->find(array('select'=>'MIN(LENGTH(CONCAT("Площадь от ",TRIM(t.init_value)," м2 до ",TRIM(t.final_value)," м2"))) AS minname'));  
                            $maxnext = FareaOffers::model()->sitemap()->find(array('select'=>'MAX(LENGTH(CONCAT(TRIM(init_value)," - ",TRIM(final_value)," м2"))) AS maxname'));  
                            $minnext = FareaOffers::model()->sitemap()->find(array('select'=>'MIN(LENGTH(CONCAT(TRIM(t.init_value)," - ",TRIM(t.final_value)," м2"))) AS minname'));  
                            $max = $maxnext->maxname < $max ? $max : $maxnext->maxname;
                            $min = $minnext->minname > $min ? $min : $minnext->minname;
                       */?>       
                       <?php
                            $remoteness = Realestates::model()->findAll(array('condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND (t.unit_id IS NOT NULL)', 
                                                                              'select'=>'t.act,t.del,t.unit_id,t.remoteness',
                                                                              'group'=>'t.remoteness,t.unit_id','order'=>'t.remoteness,t.unit_id','join'=>'LEFT JOIN units unit on unit.id=t.unit_id'));
                            //$maxnext = Realestates::model()->find(array('select'=>'MAX(LENGTH(CONCAT(TRIM(remoteness)," ",TRIM(unit.short_title)))) AS maxname','condition'=>'t.unit_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'remoteness,unit_id','order'=>'t.unit_id asc,t.remoteness asc','join'=>'LEFT JOIN units unit on unit.id=t.unit_id'));
                            //$minnext = Realestates::model()->find(array('select'=>'MIN(LENGTH(CONCAT(TRIM(remoteness)," ",TRIM(unit.short_title)))) AS minname','condition'=>'t.unit_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'remoteness,unit_id','order'=>'t.unit_id asc,t.remoteness asc','join'=>'LEFT JOIN units unit on unit.id=t.unit_id'));
                            $maxnext = Realestates::model()->find(array('select'=>'MAX(LENGTH(CONCAT(remoteness,TRIM(unit.short_title)))) AS maxname','condition'=>'t.unit_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'remoteness,unit_id','order'=>'t.unit_id asc,t.remoteness asc','join'=>'LEFT JOIN units unit on unit.id=t.unit_id'));
                            $minnext = Realestates::model()->find(array('select'=>'MIN(LENGTH(CONCAT(remoteness,TRIM(unit.short_title)))) AS minname','condition'=>'t.unit_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'remoteness,unit_id','order'=>'t.unit_id asc,t.remoteness asc','join'=>'LEFT JOIN units unit on unit.id=t.unit_id'));
                            $max = $maxnext->maxname+mb_strlen(' ','utf-8') < $max ? $max : $maxnext->maxname+mb_strlen(' ','utf-8');
                            $min = $minnext->minname+mb_strlen(' ','utf-8') > $min ? $min : $minnext->minname+mb_strlen(' ','utf-8');
                       ?>                                  
                       <?php  
                            $remotenessAll = Realestates::model()->findAll(array('condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))',
                                                                                 'group'=>'t.remoteness',
                                                                                 'select'=>'t.remoteness,t.act,t.del',
                                                                                 'order'=>'t.remoteness asc'));
                            $maxnext = Realestates::model()->find(array('select'=>'MAX(LENGTH(remoteness)) AS maxname','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'remoteness','order'=>'t.remoteness asc'));  
                            $minnext = Realestates::model()->find(array('select'=>'MIN(LENGTH(remoteness)) AS minname','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'remoteness','order'=>'t.remoteness asc'));  
                            $max = $maxnext->maxname+mb_strlen(" мин.",'utf-8') < $max ? $max : $maxnext->maxname+mb_strlen(" мин.",'utf-8');
                            $min = $minnext->minname+mb_strlen(" мин.",'utf-8') > $min ? $min : $minnext->minname+mb_strlen(" мин.",'utf-8');
                       ?>                           
                       <?php 
                            $maxnext = strlen(Yii::t('menu','корр.коэфф.'.$coefficient.'%')); //@TODO Пересмотреть
                            $minnext = strlen(Yii::t('menu','корр.коэфф. '.$coefficient.'%')); 
                            $max = $maxnext < $max ? $max : $maxnext;
                            $min = $minnext > $min ? $min : $minnext;
                            
                            $maxnext = strlen(Yii::t('menu','без отдельного входа')); 
                            $minnext = strlen(Yii::t('menu','c отдельным входом')); 
                            $max = $maxnext < $max ? $max : $maxnext;
                            $min = $minnext > $min ? $min : $minnext;
                       ?>
                       <?                         
                         
                             $koef = ($min/$max)*20;    
                             
                       ?>                             
                       <?php foreach ($vids as $vid) {
                             //echo ceil(($max/(strlen($vid->title)))*$koef).'/';
                             $wordList_vids[] = array('text'=>/*'Недвижимость: '.*/$vid->title,'weight'=>ceil(($max/(strlen($vid->title)))*$koef), 
                                                      'url'=> Yii::app()->createUrl('realestates/vid',array('id'=>$vid->id )),
                                                      'title'=> 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве'); 
                             
                       } ?>
                       <?php foreach ($districts as $district) {
                             $wordList_districts[] = array('text'=>'Аренда '.(mb_strtolower($district->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на").' '.mb_strtolower($district->title,'UTF-8').'е '.'('.$district->abbr.')','weight'=>ceil(($max/(strlen('Аренда '.(mb_strtolower($district->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на").' '.mb_strtolower($district->title,'UTF-8').'е '.'('.mb_strtolower($district->abbr,'UTF-8').')')))*$koef), 
                                                           'url'=> Yii::app()->createUrl('realestates/district',array('id'=>$district->id )),
                                                           'title'=> "Аренда коммерческой недвижимости ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".$district->abbr.") Москвы"); 
                             
                       } ?>   
                       <?php foreach ($class as $class) {
                             $wordList_class[] = array('text'=>/*'Недвижимость: '.*/$class->title,'weight'=>ceil(($max/(strlen($class->title)))*$koef), 
                                                       'url'=> Yii::app()->createUrl('realestates/class',array('id'=>$class->id )),
                                                       'title'=> 'Аренда коммерческой недвижимости класса '.$class->abbr." в Москве"); 
                             
                       } ?>                           
                       <?php foreach ($valutes as $valute) {
                             $wordList_valutes[] = array('text'=>$valute->title,'weight'=>ceil(($max/(strlen($valute->title)))*$koef), 
                                                         'url'=> Yii::app()->createUrl('realestates/valute',array('id'=>$valute->id )),
                                                         'title'=> 'Аренда коммерческой недвижимости '.mb_strtolower($valute->desc,'UTF-8').' ('.$valute->title.'), в Москве'); 
                             
                       } ?>      
                       <?php foreach ($parkings as $parking) {
                             $wordList_parkings[] = array('text'=>$parking->title,'weight'=>ceil(($max/(strlen($parking->title)))*$koef), 
                                                          'url'=> Yii::app()->createUrl('realestates/parking',array('id'=>$parking->id )),
                                                          'title'=>'Аренда коммерческой недвижимсти только '.mb_strtolower($parking->title,'UTF-8')." (".$parking->abbr."), в Москве"); 
                             
                       } ?>                          
                       <?php foreach ($plannings as $planning) {
                             $wordList_plannings[] = array('text'=>$planning->title,'weight'=>ceil(($max/(strlen($planning->title)))*$koef), 
                                                           'url'=> Yii::app()->createUrl('realestates/planning',array('id'=>$planning->id )),
                                                           'title'=> 'Аренда коммерческой недвижимости в Москве, '.(strpos('планировка',mb_strtolower($planning->title,'UTF-8'))===false ? 'планировка '.mb_strtolower($planning->title,'UTF-8') : mb_strtolower($planning->title,'UTF-8'))); 
                             
                       } ?>                             
                       <?php foreach ($units as $unit) {
                             $wordList_units[] = array('text'=>$unit->abbr,'weight'=>ceil(($max/(strlen($unit->abbr)))*$koef), 
                                                       'url'=> Yii::app()->createUrl('realestates/unit',array('id'=>$unit->id )),                                 
                                                       'title'=> 'Аренда коммерческой недвижимости в Москве, с возможность добираться от метро '.$unit->abbr." (".$unit->short_title.")"); 
                             
                       } ?>    
                       <?php foreach ($taxs as $tax) {
                             $wordList_taxs[] = array('text'=>$tax->title,'weight'=>ceil(($max/(strlen($tax->title)))*$koef), 
                                                      'url'=> Yii::app()->createUrl('realestates/tax',array('id'=>$tax->id )),
                                                      'title'=> 'Аренда коммерческой недвижимости c налогооблажением '.$tax->title.', в Москве'); 
                             
                       } ?>                          
                       <?php/* foreach ($operations as $operation) {
                             $wordList_operations[] = array('text'=>$operation->title,'weight'=>ceil(($max/(strlen($operation->title)))*$koef), 
                                                            'url'=> Yii::app()->createUrl('realestates/operation',array('id'=>$operation->id )),
                                                            'title'=> $operation->title.' офиса в Москве'); 
                             
                       } */?> 
                       <?php foreach ($types as $type) {
                             $wordList_types[] = array('text'=>$type->title,'weight'=>ceil(($max/(strlen($type->title)))*$koef), 
                                                       'url'=> Yii::app()->createUrl('realestates/type',array('id'=>$type->id )),
                                                       'title'=>' Аренда коммерческой недвижимости в '.mb_strtolower($type->namewheres,"UTF-8")." Москвы "); 
                             
                       } ?>                          
                       <?php foreach ($properties as $property) {
                             $wordList_properties[] = array('text'=>$property->title,'weight'=>ceil(($max/(strlen($property->title)))*$koef), 
                                                             'url'=> Yii::app()->createUrl('realestates/property',array('id'=>$property->id )),
                                                             'title'=> 'Аренда коммерческо недвижимости Москвы с свойством '.$property->title);  
                             
                       } ?>      
                       <?php 
                             $wordList_entranceon[] = array('text'=>'c отдельным входом','weight'=>ceil(($max/(strlen('c отдельным входом')))*$koef), 
                                                            'url'=> Yii::app()->createUrl('realestates/entranceon'),
                                                            'title'=> 'Аренда коммерческой недвижимости в Москве с отдельным входом');   
                             $wordList_entranceoff[] = array('text'=>'без отдельного входа','weight'=>ceil(($max/(strlen('без отдельного входа')))*$koef), 
                                                            'url'=> Yii::app()->createUrl('realestates/entranceoff'),
                                                            'title'=> 'Аренда коммерческой недвижимости в Москве без отдельного входа');
                             
                       ?>                          
                       <?php    $acoef = range(5,30,1); 
            

                             foreach ( $acoef as $key=>$coefficient ) {
                                $is_corr = Realestates::model()->exists('coefficient_corridor='.$coefficient.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                                if ($is_corr) {          
                                    $wordList_coefs[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/coefficient',array('id'=>$coefficient)),
                                        'weight'=>ceil($max/(strlen(Yii::t('menu','корр.коэфф. '.$coefficient.'%'))))*$koef,               
                                        'text'=>Yii::t('menu','корр.коэфф. '.$coefficient.'%'),
                                        'title'=> 'Аренда коммерческой недвижимости с коридорным коэффициентом '.mb_strtolower($coefficient,'UTF-8').'%, в Москве'
                                    ); 
                                }
                            }
                      ?>      
                      <?php/*  
                            foreach ( $fareas as $key=>$farea ) {                                
                                $is_freals = Realestates::model()->exists('(area>='.$farea->init_value.' AND area<='.$farea->final_value.') AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                                if ($is_freals) {          
                                    $wordList_fareas[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/area',array('id'=>$farea->id)),
                                        //'weight'=>ceil($max/(strlen("Площадь от ".trim($farea->init_value)." м2 до ".trim($farea->final_value)." м2")))*$koef,               
                                        //'text'=>Yii::t('menu',"Площадь oт ".trim($farea->init_value)." м2 до ".trim($farea->final_value)." м2"),
                                        'weight'=>ceil($max/(strlen(trim($farea->init_value)." - ".trim($farea->final_value)." м2")))*$koef,               
                                        'text'=>Yii::t('menu',trim($farea->init_value)." - ".trim($farea->final_value)." м2"),
                                        'title'=> 'Аренда офиса с площадью от '.trim($farea->init_value)." м2 до ".trim($farea->final_value).' м2, в Москве'
                                    ); 
                                }
                            }                         
                      */?>   
                      <?php
                            $wordList_remoteness[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/unit'),
                                        'weight'=>ceil($max/(strlen('все удаленности')))*$koef,               
                                        'text'=>Yii::t('menu','все удаленности'),
                                        'title'=> 'все типы удаленности'
                            ); 
                      ?>      
                      <?php
                          foreach ( $remoteness as $key=>$remotenes ) {                                
                            $wordList_remoteness[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/unit/',($remotenes->unit->id ? array('remotenes'=>round($remotenes->remoteness),'id'=>$remotenes->unit->id) : array('remotenes'=>round($remotenes->remoteness)))),
                                        'weight'=>ceil($max/(strlen(trim(round($remoteness->remoteness))." ".trim($remoteness->unit->short_title))))*$koef,                                                                                       
                                        'text'=>round($remotenes->remoteness).' '.$remotenes->unit->short_title,
                                        'title'=> 'Аренда коммерческой недвижимости с удаленностью '.round($remotenes->remoteness).' '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")"
                            ); 
                          }  
                     ?>       
                     <?php
                         foreach ( $remotenessAll as $key=>$remotenes ) {                                
                           $wordListAll_remoteness[] = array(
                                        'url'=> Yii::app()->createAbsoluteUrl('/realestates/unit/', array('remotenes'=>round($remotenes->remoteness))),
                                        'weight'=>ceil($max/(strlen(round($remotenes->remoteness).' мин.')))*$koef,    
                                        'text'=>round($remotenes->remoteness).' мин.',
                                        'title'=>'Аренда коммерческой недвижимости с удаленностью '.round($remotenes->remoteness).' мин.'
                           ); 
                         }                         
                    ?>     
                    <?php 
                            $vwordList = array_merge($wordList_vids, $wordList_districts, $wordList_class, 
                                                     $wordList_valutes, $wordList_units, $wordList_properties, 
                                                     $wordList_coefs, $wordList_parkings, $wordList_plannings,
                                                     $wordList_taxs, /*$wordList_operations,*/$wordList_types,
                                                     $wordList_entranceoff,$wordList_entranceon,/*$wordList_fareas,*/
                                                     $wordList_remoteness, $wordListAll_remoteness
                                                    ); 
                      ?>  
                         
                      <?php $this->widget('ext.jcloud.JCloud', array(
                        'id'=>'vid_words',
                        'htmlOptions'=>array('style'=>'width: '.($is_hor_street ? 'auto;height:360px;margin-right:5px;' : '240px; min-height:250px;margin-right:12px;').' border: 1px solid #c9e0ed;'./*#ccc;/*margin-top:10px;*/'margin-left:5px;padding:3px;border-radius:10px;'),
                        'wordList'=>$vwordList
                    )); ?>                       
                     </td>     
                  <?php if($is_hor_street) { ?>
                   <tr>   
               </table>  
               <?php } ?> 
                <? if (!$short) { ?>
                <div class="iblock-11 justify">
                     <?php 
                            // Какой тип офиса выбрать в аренду
                            $main=Iblocks::model()->findByPk(32);
                            echo $main->detile;
                            //echo $main->anons;
                            //echo $main->short_detile;
                     ?>    
                </div>
                <? } ?>                
               <?php if(!$short) { ?>
               <?php if($is_hor_street) { ?> 
               <br/> 
               <table>
                   <tr>
                  <?php } ?>
                     <td class="valign-t" id="blstreet">
                        <?php $this->renderPartial('/site/_list_streets', array('model'=>false)); ?>                                                                                 
                     </td>
                   </tr> 
                </table> 
               <?php } ?>
            </div>       
            <script>
                <?php if (!$is_hor_street) { ?>
                    $('#vid_words').height($('#blstreet').height()-20);
                <?php } ?>
                <?php if ($short) { ?>                    
                $('#destination_words').height($('#blmetro').height()-20);
                <?php } ?>
                //$('#texreferences').height($('#blareas').height()-20);
            </script>             
            <?php if ($dataPopulars) { ?>
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-brown radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Популярная площадь</span> - <?php echo CHtml::link(CHtml::encode('Коммерческая недвижимость, Аренда офисных блоков и домов города Москва'), array('realestates/index'), array('title'=>'Коммерческая недвижимость, Аренда офиса города Москва', 'class'=>"c-orang"));?></h2>
                    <?/*<div class="bg-brown radius-5-0 p-5 m-b0 p-l10 c-orang normal fs-15"><span class="ttr-upper c-white bold">Популярная площадь</span></div>*/?>
                    <?php $this->renderPartial('/realestates/_list',                                                
                                           array('dataProvider'=>$dataPopulars)
                                          ); ?>
                </div>    
            </div>            
            <?php } ?>
            <? if ($short) { ?>
            <div class="iblock-11 justify">
                 <?php 
                        // Детально Выбор инфоблока
                        $main=Iblocks::model()->findByPk(32);
                        echo $main->detile;
                 ?>    
            </div>
            <? } ?>
        </div>