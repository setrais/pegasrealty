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
                <?php $this->renderPartial('/realestates/_social');?>
            </div>
             <div class="iblock-1 justify m-t10" >
                <?php 
                        // Детально Главной
                        $main=Iblocks::model()->findByPk(30);
                        echo $main->detile;
                 ?> 
             </div>     
            <div class="search-form" >                
                 <?php $this->renderPartial('/realestates/_vertical_search_old',                         
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
            <div class="iblock-11 justify">
                 <?php 
                        // Детально Выбор инфоблока
                        $main=Iblocks::model()->findByPk(34);
                        echo $main->detile;
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
                        // Детально Выбор инфоблока
                        $main=Iblocks::model()->findByPk(33);
                        echo $main->detile;
                 ?>    
            </div>            
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
            <div class="iblock-11 justify">
                 <?php 
                        // Детально Выбор инфоблока
                        $main=Iblocks::model()->findByPk(32);
                        echo $main->detile;
                 ?>    
            </div>
        </div>
