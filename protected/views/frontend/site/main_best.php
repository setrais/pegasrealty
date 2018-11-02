<?php $this->pageTitle=Yii::t('all',Yii::app()->name); ?>
<?php $this->pageTitle='Пегас недвижимость | Аренда офиса в Москве - коммерческая недвижимость успех Вашего бизнеса, по цене аренды офиса в Москве от собственника, в центре, офис сити, на западе, юге, востоке, севере, воюао, юаo, зао, юзао, ювао, цао, свао, сзао, сао Москвы ';?>

        <div class="content" >
             <div class="iblock-1 justify" >
                 <?php 
                        // Детально Главной
                        $main=Iblocks::model()->findByPk(1);
                        echo $main->detile;
                 ?>             
             </div>
            <div class="slider-wrapper">
                <div class="favs p-5" >            
                    <h1 class="bg-blue radius-5-0 p-5 m-b0 p-l10 c-orang"><span class="ttr-upper c-black">Лучшие предложения</span> - Недвижимость / Аренда / Офиса / Москва</h1>
                    <?php $this->renderPartial('/realestates/_horizontal_slider',                                                
                                           array('favs'=>$favs,'model'=>$model,      
                                                 'fav_cnt'=>$fav_cnt_row*$fav_cnt_col,
                                                 )
                                          ); ?>
                </div>    
            </div>
            <div class="search-form" >
                 <?php $this->renderPartial('/realestates/_vertical_search',                         
                               array('metros'=>$metros, 
                                     'map'=>$map,
                                     'favs'=>$favs,
                                     'model'=>$model,
                                     'newrealts'=> $newrealts,
                                    )
                              );
                ?>
            </div>
            <div class="iblock-11 justify">
                 <?php 
                        // Детально Выбор инфоблока
                        $main=Iblocks::model()->findByPk(11);
                        echo $main->detile;
                 ?>    
            </div>
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-blue radius-5-0 p-5 m-b0 p-l10 c-orang"><span class="ttr-upper c-black ">Рекомендуемая площадь</span> - Аренда офиса в Москве</h2>
                    <?php $this->renderPartial('/realestates/_list',                                                
                                           array('dataProvider'=>$dataRecoms)
                                          ); ?>
                </div>    
            </div>
            <?php if ($dataPopulars) { ?>
            <div class="recommend-wrapper">
                <div class="recommend p-5" >            
                    <h2 class="bg-blue radius-5-0 p-5 m-b0 p-l10 c-orang"><span class="ttr-upper c-black ">Популярная площадь</span> - Аренда офиса города Москва</h2>
                    <?php $this->renderPartial('/realestates/_list',                                                
                                           array('dataProvider'=>$dataPopulars)
                                          ); ?>
                </div>    
            </div>            
            <?php } ?>
        </div>
