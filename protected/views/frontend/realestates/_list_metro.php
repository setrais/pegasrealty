<?php 
$short = true;
$is_list = false;

$this->pageTitle=Yii::t('all','Коммерческая недвижимость')
                .($model->metro->title 
                  ? ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' рядом с станцией метро '.$model->metro->title.' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' у ст.метро '.$model->metro->title.' целиком, без посредников по стоимости аренды'
                      .' от собственника Москвы.'
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' рядом с станцией метро '.$model->metro->title.' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, административном здании, жилом доме,'
                      .' комлексе, парке, торговом центре у ст.метро '.$model->metro->title.', без посредников от собственника Москвы.')
                  : ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по станциям метро в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' у ст.метро без посредников по стоимости аренды от собственника Москвы.' 
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по станциям метро в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, административном здании, жилом доме, комлексе, парке,'
                      .' торговом центре у ст.метро, без посредников по стоимости аренды от собственника Москвы.'));
                  //.($property->seo_title ? ', '.$property->seo_title : '');
                  //." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name)); 

if ($model->metro->title) $this->pageDescription= trim($model->metro->seo_desc)<>'' 
                                        ? 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' рядом с станцией метро '.$model->metro->title
                                          .' в Москве. '                                          
                                          .$model->metro->seo_desc 
                                        : 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' рядом с станцией метро '.$model->metro->title
                                          .' в Москве.';                   
else $this->pageDescription= 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' по станциям метро в Москве. ';
$this->pageDescription=$this->pageDescription.($property->seo_description ? ' '.$property->seo_description : '');
if ( !$property->seo_description && !$model->metro->seo_desc) {
    if ($model->metro->title) {
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' у метро '.$model->metro->title
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' рядом с ст.м.'.$model->metro->title
                                   .' отличается классом, адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' у метро '.$model->metro->title
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' рядом с ст.м.'.$model->metro->title.' отличается'
                                   .' объектом размещения, адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.');
    }else{
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' рядом с станциями метро'
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по станциям метро'
                                   .' отличается адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' по станциям метро'
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' у ст.метро отличается объектом размещения, адресом,'
                                   .' назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.');
        
    }
}

if ($model->metro->title) $this->pageKeywords= trim($model->metro->seo_keywords)<>''
                                                  ? array_merge( 
                                                          explode(',', "аренда у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                    .", аренда у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                    .", аренда ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                  
                                                                //+/.", аренда м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                    
                                                                //+/.", аренда метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                //+/.", аренда ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))  
                                                                
                                                                //+/.", аренда у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"                                                                  
                                                                //+/.", аренда метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"   
                                                                //+/.", аренда м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"    
                                                                
                                                                //+/.", аренда москва метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')) 
                                                                //+/.", аренда москва м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда москва ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')) 
                                                                //+/.", аренда москва у метро".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда москва у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                //+/.", аренда москва у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))  
                                                                //+/.", аренда москва ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))    
                                                                
                                                                //+/.", аренда в москве м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда в москве ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')) 
                                                                //+/.", аренда в москве у метро".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда в москве у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                //+/.", аренда в москве у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))  
                                                                //+/.", аренда в москве ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                    
                                                                  
                                                                //+/.", аренда м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"                                                                  
                                                                //+/.", аренда ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"                                                                  
                                                                //+/.", аренда метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве" 
                                                                //+/.", аренда у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                //+/.", аренда у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                //+/.", аренда у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                //+/.", аренда ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"                                                                                                                                
                                                                                                                                  
                                                                    
                                                                    .", аренда москва метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                    .", метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                    //.", метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." москва")
                                                                    //+/.", м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." москва")
                                                                    //+/.", ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." москва")
                                                                    //+/.", метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." в москве")
                                                                    //+/.", м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                    //+/.", ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                    //.", ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"
                                                                    //.", ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                    .", ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                    .", м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                  
                                                                    .($property->title 
                                                                        ? //-/", "."аренда офисов метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->title,'UTF-8')
                                                                         //-/.", "."аренда офисов м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->title,'UTF-8')
                                                                            
                                                                         //-/.", "."аренда офисов в москве метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." ".mb_strtolower($property->title,'UTF-8')
                                                                         //-/.", "."аренда офисов в москве м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')).mb_strtolower($property->title,'UTF-8')   
                                                                         
                                                                        //---------------------
                                                                         ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //++.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //++.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." рядом с метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))    
                                                                        //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." рядом с м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))        

                                                                        //+..", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //---------------------                                                                            
                                                                        .", аренда ".mb_strtolower($property->title,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        .", аренда ".mb_strtolower($property->title,'UTF-8')." м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))        
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." cт.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." у cт.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                            
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                                                                                                        

                                                                        .", аренда ".mb_strtolower($property->title,'UTF-8')   
                                                                        .", ".mb_strtolower($property->namewhats,'UTF-8')    
                                                                        .", ".mb_strtolower($property->namewhat,'UTF-8')        
                                                                        .", ".mb_strtolower($property->title,'UTF-8')        
                                                                        : "")          
                                                                    .($property->abbr 
                                                                        ? //-/ ", аренда ".mb_strtolower($property->abbr,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->abbr,'UTF-8')
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->abbr,'UTF-8')
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')).' '.mb_strtolower($property->abbr,'UTF-8')
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')).mb_strtolower($property->abbr,'UTF-8')   
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                                                                    
                                                                          ", ".mb_strtolower($property->abbr,'UTF-8')        
                                                                        :  "")     
                                                                    .HRu::curscob(mb_strtolower($model->metro->title,'UTF-8'))
                                                                    .", метро, каталог недвижимости, недвижимость, аренда, москва, в москве, москвы, ст.м., станция, рядом с, снять"),                   
                                                                 // Отсеиваиваем ключевые слова для короткой формы
                                                                 $short ? HRu::iskeyintxt(explode(',',$model->metro->seo_keywords),                                                   
                                                                                 HRu::cutstr($model->metro->anons,750, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->metro->detile,1500, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->metro->description,1000, false, '.','. '))
                                                                         : explode(',',$model->metro->seo_keywords) ) 
        
                                                  : explode(',', "аренда у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                    .", аренда у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                    .", аренда ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                  
                                                                //+/.", аренда м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                    
                                                                //+/.", аренда метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                //+/.", аренда ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))  
                                                                
                                                                //+/.", аренда у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"                                                                  
                                                                //+/.", аренда метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"   
                                                                //+/.", аренда м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"    
                                                                
                                                                //+/.", аренда москва метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')) 
                                                                //+/.", аренда москва м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда москва ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')) 
                                                                //+/.", аренда москва у метро".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда москва у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                //+/.", аренда москва у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))  
                                                                //+/.", аренда москва ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))    
                                                                
                                                                //+/.", аренда в москве м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда в москве ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')) 
                                                                //+/.", аренда в москве у метро".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))   
                                                                //+/.", аренда в москве у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                //+/.", аренда в москве у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))  
                                                                //+/.", аренда в москве ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                    
                                                                  
                                                                //+/.", аренда м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"                                                                  
                                                                //+/.", аренда ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"                                                                  
                                                                //+/.", аренда метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве" 
                                                                //+/.", аренда у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                //+/.", аренда у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                //+/.", аренда у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                //+/.", аренда ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"                                                                                                                                
                                                                                                                                  
                                                                    
                                                                    .", аренда москва метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                    .", метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                    //.", метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." москва")
                                                                    //+/.", м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." москва")
                                                                    //+/.", ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." москва")
                                                                    //+/.", метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')." в москве")
                                                                    //+/.", м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                    //+/.", ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                    //.", ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москва"
                                                                    //.", ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                    .", ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                    .", м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                  
                                                                    .($property->title 
                                                                        ? //-/", "."аренда офисов метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->title,'UTF-8')
                                                                         //-/.", "."аренда офисов м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->title,'UTF-8')
                                                                            
                                                                         //-/.", "."аренда офисов в москве метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." ".mb_strtolower($property->title,'UTF-8')
                                                                         //-/.", "."аренда офисов в москве м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')).mb_strtolower($property->title,'UTF-8')   
                                                                         
                                                                        //---------------------
                                                                         ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //++.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //++.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." рядом с метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))    
                                                                        //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." рядом с м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))        

                                                                        //+..", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //+/.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." у ст.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." в москве"
                                                                        //---------------------                                                                            
                                                                        .", аренда ".mb_strtolower($property->title,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        .", аренда ".mb_strtolower($property->title,'UTF-8')." м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))        
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." cт.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." у cт.м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." у м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                            
                                                                        //+/.", аренда ".mb_strtolower($property->title,'UTF-8')." у метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                                                                                                        

                                                                        .", аренда ".mb_strtolower($property->title,'UTF-8')   
                                                                        .", ".mb_strtolower($property->namewhats,'UTF-8')    
                                                                        .", ".mb_strtolower($property->namewhat,'UTF-8')        
                                                                        .", ".mb_strtolower($property->title,'UTF-8')        
                                                                        : "")          
                                                                    .($property->abbr 
                                                                        ? //-/ ", аренда ".mb_strtolower($property->abbr,'UTF-8')." метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->abbr,'UTF-8')
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))." москвы ".mb_strtolower($property->abbr,'UTF-8')
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве метро ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')).' '.mb_strtolower($property->abbr,'UTF-8')
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве м.".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8')).mb_strtolower($property->abbr,'UTF-8')   
                                                                          //-/.", аренда ".mb_strtolower($property->abbr,'UTF-8')." ".str_replace(array(')','('),array('',''),mb_strtolower($model->metro->title,'UTF-8'))                                                                                                                    
                                                                          ", ".mb_strtolower($property->abbr,'UTF-8')        
                                                                        :  "")     
                                                                    .HRu::curscob(mb_strtolower($model->metro->title,'UTF-8'))
                                                                    .", метро, каталог недвижимости, недвижимость, аренда, москва, в москве, москвы, ст.м., станция, рядом с, коммерческой, снять"/*."класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение"*/);                   
else $this->pageKeywords=explode(',', 'аренда в москве, каталог недвижимости, коммерческая недвижимость, недвижимость, аренда, офис, москва, в москве, москвы, станция метро, ст.м., рядом с, класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение, снять');    
$this->pageKeywords=$property->seo_keywords 
                        ? array_merge($this->pageKeywords,
                                      // Отсеиваиваем ключевые слова для короткой формы
                                      $short ? HRu::iskeyintxt( explode(',',$property->seo_keywords),                                                   
                                                        HRu::cutstr($property->anons,750, false, '.','. ')
                                                   .' '.HRu::cutstr($property->detile,1500, false, '.','. ')
                                                   .' '.HRu::cutstr($property->description,1000, false, '.','. '))
                                             : explode(',',$property->seo_keywords)) 
                        : $this->pageKeywords;

$this->pageKeywords= array_unique($this->pageKeywords);
natsort($this->pageKeywords);


if ($model->metro->title&&$property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по станциям метро'=>array('realestates/metro'),
             'у метро '.$model->metro->title=>Yii::app()->createUrl('realestates/metro',array('id'=>$model->metro->id)),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." в Москве рядом с ст.м.".$model->metro->title 
        );

} else if (!$model->metro->title && $property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по станциям метро'=>array('realestates/metro'),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." в Москве рядом со станциями метро"
        );
} else if ($model->metro->title && !$property->namewhats) {

        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по станциям метро '=>array('realestates/metro'),
             'у метро '.$model->metro->title=>Yii::app()->createUrl('realestates/metro',array('id'=>$model->metro->id)),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве рядом с ст.м.'.$model->metro->title
        );    
} else {
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по станциям метро '=>array('realestates/metro'),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве рядом со станциями метро'
        );
}
?>

<?php  
    // Подключение скрипта обработки url для нормализации передачи параметров
    $this->renderPartial('/realestates/include/_script_geturl');
?>

<?php
    // Переменная $extraRowExpression    
    include __DIR__ . '/include/_var_fav.php';
?>

<div id="content"  >
<div class="content fs-13 ff-tahoma" > 
<h1>
        <?php  echo //Yii::t('all','Коммерческая недвижимость')
                ($model->metro->title 
                  ? ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' рядом с станцией метро '.$model->metro->title.' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' у ст.метро '.$model->metro->title.' целиком, без посредников по стоимости аренды'
                      .' от собственника Москвы.'
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' рядом с станцией метро '.$model->metro->title.' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в здании, доме,'
                      .' комлексе, парке у ст.метро '.$model->metro->title.', без посредников по стоимости аренды от собственника Москвы.')
                  : ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по станциям метро в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' рядом с станцией метро, без посредников по стоимости аренды от собственника Москвы.' 
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по станциям метро в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, адм.здании, жилом доме, комлексе, парке'
                      .' рядом с станцией метро, без посредников по стоимости аренды от собственника Москвы.'));
                /*.($property->title ? ', '.$property->title : '')*/
        ?>    
</h1>

<?php if ( $model->metro->anons || $property->anons) {  ?>    
<div class="desc anons m-b18 fs-11 ff-Arial justify">    
    <?php if ( $model->metro->anons ) {  ?>      
    <div>
    <?php if ($short) { ?>    
    <?php echo str_replace(",","",HRu::cutstr($model->metro->anons,750, false, '.','. ')); ?>    
    <?php } else { ?>    
    <?php echo $model->metro->anons; ?>
    <?php } ?>          
    </div>    
    <?php } ?>
    <?php if ( $property->anons ) {  ?>    
    <div <?php echo ($model->metro->anons ? 'class="m-t10"' : '') ?>>
    <?php if ($short) { ?>    
    <?php echo str_replace(",","",HRu::cutstr($property->anons,750, false, '.','. ')); ?>    
    <?php } else { ?>    
    <?php echo $property->anons; ?>
    <?php } ?>                  
    </div>    
    <?php } ?>
</div>
<? } ?>  
    
<?php 
    //$model->search()->pagination->route = Yii::app()->createUrl('/realestates/metro', array('id'=>$model->metro->id)); 
    $model->search()->pagination->route = Yii::app()->createUrl('/ru/realestates/metro/'.$model->metro->id.'/vid/'.$model->realestateVid->id); 
    //$model->search()->pagination->setPageSize(20);  не срабатывает  
    //$model->search()->sort = 'unit.title';
?>
    
<?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>
    
<?php
    // Переменная $beforeAjaxUpdate       
    include __DIR__ . '/include/_var_aftajaxupdate_list.php';
?> 

<?php
    // Переменная $beforeAjaxUpdate       
    include __DIR__ . '/include/_var_befajaxupdate_list.php';
?> 
    
<?php $this->widget('application.components.widgets.DSizerListView', array(
        'dataProvider'=>$model->search($short ? 10 : 16,
                array(
                        'unit'=>array(                                
                                'asc'=>'unit.title ASC',
                                'desc'=>'unit.title DESC',
                                'default'=>'desc',
                        ),
                        'areas'=>array(                                
                                'asc'=>'areas.title ASC',
                                'desc'=>'areas.title DESC',
                                'default'=>'desc',
                        ),
                        'district'=>array(                                
                                'asc'=>'district.title ASC',
                                'desc'=>'district.title DESC',
                                'default'=>'desc',
                        ),
                        /*'realestateVid'=>array(                                
                                'asc'=>'realestateVid.title ASC',
                                'desc'=>'realestateVid.title DESC',
                                'default'=>'desc',
                        ),*/
                        'realestateType'=>array(                                
                                'asc'=>'realestateType.title ASC',
                                'desc'=>'realestateType.title DESC',
                                'default'=>'desc',
                        ),                    
                        'realestateClass'=>array(                                
                                'asc'=>'realestateClass.title ASC',
                                'desc'=>'realestateClass.title DESC',
                                'default'=>'desc',
                        ),   
                        'valute'=>array(                                
                                'asc'=>'valute.title ASC',
                                'desc'=>'valute.title DESC',
                                'default'=>'desc',
                        ), 
                        'street'=>array(                                
                                'asc'=>'street.title ASC',
                                'desc'=>'street.title DESC',
                                'default'=>'desc',
                        ),                                              
                        /*'metro'=>array(                                
                                'asc'=>'metro.title ASC',
                                'desc'=>'metro.title DESC',
                                'default'=>'desc',
                        ),*/                          
                        'title',
                        'area',
                        'remoteness',
                        'price',                        
                        //'create_date'
                    )),                
	'itemView'=>'_view_column',
        'summaryText'=>Yii::t('core',                 
                                'Displaying Items {start} - {end} of {count} results', 
                                 $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),
        'pager'=>array(
                'header' => Yii::t('grid','Перейти к странице:'),
                //'firstPageLabel' => '&lt;&lt;',
                'prevPageLabel'  => Yii::t('grid','< Вперед'),//'<img src="images/pagination/left.png">',
                'nextPageLabel'  => Yii::t('grid','Назад >'),//'<img src="images/pagination/left.png">',
                //'nextPageLabel'  => '<img src="images/pagination/right.png">',
                //'lastPageLabel'  => '&gt;&gt;'
                //'pageSize'=>20, не сработает
        ),         
        'sortableAttributes'=>array(
            'title',
            //'create_date',
            'area',
            'remoteness',
            'price',
            'valute'=>'Валюта',
            'unit'=>'Способ',
            'district'=>'Округ',
            'areas'=>'Район',
            //'metro'=>'Метро',
            //'realestateVid'=>'Вид',
            'realestateType'=>'В/цел',
            'realestateClass'=>'Класс', 
            'street'=>'Улица',
        ),
        'sorterHeader'=>'Сортировать по:',
        'template'=>"<hr class='m-t5 m-b5' />{sizer}{sorter}\n<div style='float:left;display:inline-block;'>{pager}</div>{summary}\n<br/>{items}\n<div style='clear:both'></div><div style='float:left;display:inline-block;'>{pager}</div>{summary}",        
        'sizerVariants'=> HRu::cutarray(array(8, 10, 12, 16, 20, 24, 30),$model->search()->getTotalItemCount()),
        'sizerAttribute'=>'size',
        'sizerHeader'=>'Выводить по: ',
        'beforeAjaxUpdate'=>$beforeAjaxUpdate,
        'afterAjaxUpdate'=>$afterAjaxUpdate,    
        //'ajaxUrl'=>Yii::app()->createUrl('/ru/realestates/metro/'.$model->metro->id.'/vid/'.$model->realestateVid->id)
        
)); ?>    

   <?php   $this->renderPartial('_send',array('model'=>$model_claim));?>

    </div>
    <hr class="m-t10 m-b8" />
    
    <?php   //$this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>  

    
    <?php if ( $model->metro->detile || $property->detile ) {  ?>    
    <div class="desc detile m-t8 m-b14 fs-10 ff-tahoma justify">    
        <?php if ( $model->metro->detile ) {  ?>      
            <div>
                <?php if ($short) { ?>    
                <?php echo str_replace(",","",HRu::cutstr($model->metro->detile,1500, false, '.','. ')); ?>    
                <?php } else { ?>    
                <?php echo $model->metro->detile; ?>
                <?php } ?>                   
            </div>    
        <?php } ?>
        <?php if ( $property->detile ) {  ?>    
            <div <?php echo ($model->metro->detile ? 'class="m-t10"' : '') ?>>
                <?php if ($short) { ?>    
                <?php echo str_replace(",","",HRu::cutstr($property->detile,1500, false, '.','. ')); ?>    
                <?php } else { ?>    
                <?php echo $property->detile; ?>
                <?php } ?>                                
            </div>    
        <?php } ?>        
    </div>
    <? } ?>  
    
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_streets', array('model'=>$model)); ?>  
    <?php } ?> 
    
    <?php if ( $model->metro->description || $property->description ) {  ?>    
    <div class="desc detile m-b18 fs-10 ff-tahoma justify">    
        <?php if ( $model->metro->description ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($model->metro->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $model->metro->description; ?>
            <?php } ?>                            
            </div>    
        <?php } ?>
        <?php if ( $property->description ) {  ?>    
            <div <?php echo ($model->metro->description ? 'class="m-t10"' : '') ?>>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($property->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $property->description; ?>
            <?php } ?>                 
            </div>    
        <?php } ?>                
    </div>
    <? } ?>  
    
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_areas', array('model'=>$model)); ?>              
    <?php } ?>
</div>
<? $this->renderPartial('/realestates/include/_script_vimg_i_sec_list'); ?>  