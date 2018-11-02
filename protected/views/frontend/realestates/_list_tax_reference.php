<?php 
$short = true;
$is_list = false;

$this->pageTitle=Yii::t('all','Коммерческая недвижимость')
                .($model->taxReference 
                  ? ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->taxReference->abbr.' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' с регистрацией в '.mb_strtolower($model->taxReference->title,'UTF-8')
                      .' ('.$model->taxReference->abbr.')'.' целиком, без посредников по стоимости аренды от собственника Москвы.'
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->taxReference->abbr.' в Москве без комиссии.'
                      .' Снять в аренду '.mb_strtolower($property->title,'UTF-8').' в бизнес, торговом центре, особняке, банке, здании, жилом доме,'
                      .' комлексе, парке без посредников по стоимости от собственника с регистрацией в налоговой инспекции №'
                      .mb_strtolower($model->taxReference->num,'UTF-8').' Москвы.')
                  : ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по ИФНС в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' целиком с регистрацией в разных инспециях федеральной налоговой службы,'
                      .' без посредников по стоимости аренды от собственника Москвы.' 
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по ИФНС в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес, торговом центре, особняке, банке, адм.здании, жилом доме, комлексе, парке,'
                      .' торговом центре различных инспекций федеральной налоговой службы, без посредников по стоимости аренды от собственника Москвы.'));
                  //.($property->seo_title ? ', '.$property->seo_title : '');
                  //." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name));  

if ($model->taxReference) $this->pageDescription= trim($model->taxReference->seo_desc)<>'' 
                                        ? 'Здесь отобраны предложения аренды '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->taxReference->abbr
                                          .' в Москве без комиссии стоимость аренды от собственника. '                                          
                                          .$model->taxReference->seo_desc 
                                        : 'Здесь отобраны предложения аренды '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->taxReference->abbr
                                          .' в Москве без комиссии стоимость аренды от собственника.';                   

else $this->pageDescription= 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' по различным инспекциям федеральной налогой службы, одним словом ИФНС в Москве. ';
$this->pageDescription=$this->pageDescription.($property->seo_description ? ' '.$property->seo_description : '');
if ( !$property->seo_description && !$model->taxReference) {
    if ($model->taxReference) {
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' целиком c регистрацией в '
                                   .str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8'))
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->taxReference->abbr
                                   .' отличается размещением, адресом, классом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' c регистрацией в '
                                   .str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8'))
                                   .' бизнес центра, парка, жилого комплекса, дома, особняка, здания, медцентра, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->taxReference->abbr.' отличается '
                                   .' размещением, адресом, классом, назначением, свойствами, удаленностью от метро,'
                                   .' площадью, стоимостью, валютой платежа.');
   }else{
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' целиком по ИФНС '
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' с регистрацией в различной '
                                   .str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8'))
                                   .' отличается между собой объектом размещения, адресом, классом, назначением, свойствами, удаленностью от метро,'
                                   .' площадью, стоимостью, валютой расчетов.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' по ИФНС '
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' с регистрацией в различной '
                                   .str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8'))
                                   .' различна по размещению, адресу, назначению, свойствами, удаленности от метро, площади,'
                                   .' стоимости, валюты расчетов.');
        
    }
}

if ($model->taxReference->title) $this->pageKeywords= trim($model->taxReference->seo_keywords)<>'' 
                                        ? array_merge( explode(',',  ' аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' по '.mb_strtolower($model->taxReference->abbr,'UTF-8')                                                                   
                                                                   .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' налоговая '.$model->taxReference->num
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' налоговая '.$model->taxReference->num
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва по ифнс'
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва по ифнс'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва по налоговым'
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва по налоговым'
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                
                                                                   .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')                                                
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')                                                
                                                
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                 //+ .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы' 
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'  
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', '.mb_strtolower($property->namewhats,'UTF-8')
                                                                   .', '.mb_strtolower($property->namewhat,'UTF-8')
                                                                   .', '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                   .', '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 .($property->title 
                                                                      ? //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'
                                                                         ", аренда ".mb_strtolower($property->title,'UTF-8') 
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' москва ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' москва по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' в москве ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' в москве по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' ифнс москва'  
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' по ифнс москва' 
                                                                        .", ".mb_strtolower($property->title,'UTF-8') 
                                                                        : "")          
                                                                 .($property->abbr 
                                                                      ?  //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'
                                                                         ", аренда ".mb_strtolower($property->abbr,'UTF-8') 
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' москва ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' москва по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' в москве ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' в москве по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' ифнс москва'  
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' по ифнс москва'    
                                                                        .", ".mb_strtolower($property->abbr,'UTF-8')
                                                                        : "")                                                                                                                                                                       
                                                                 .', снять, каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, москва, в москве, москвы, инспекция, налоговым, налоговой, ифнс, по ифнс, класса, коммерческой недвижимости, округ, район, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость'),
                                                               
                                                                 // Отсеиваиваем ключевые слова для короткой формы
                                                                 $short ? HRu::iskeyintxt(explode(',',$model->areas->seo_keywords),                                                   
                                                                                 HRu::cutstr($model->areas->anons,750, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->areas->detile,1500, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->areas->description,1000, false, '.','. '))
                                                                       : explode(',',$model->taxReference->seo_keywords))
        
                                        : explode(',', ' аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' по '.mb_strtolower($model->taxReference->abbr,'UTF-8')                                                                   
                                                                   .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' налоговая '.$model->taxReference->num
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' налоговая '.$model->taxReference->num
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва по ифнс'
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва по ифнс'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва по налоговым'
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва по налоговым'
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                
                                                                   .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')                                                
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')                                                
                                                
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                 //+ .', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                 //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы' 
                                                                 //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'  
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                   .', '.mb_strtolower($property->namewhats,'UTF-8')
                                                                   .', '.mb_strtolower($property->namewhat,'UTF-8')
                                                                   .', '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                   .', '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 .($property->title 
                                                                      ? //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                        //.', аренда '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'
                                                                         ", аренда ".mb_strtolower($property->title,'UTF-8') 
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' москва ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' москва по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' в москве ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' в москве по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' ифнс москва'  
                                                                        //+.", аренда ".mb_strtolower($property->title,'UTF-8').' по ифнс москва' 
                                                                        .", ".mb_strtolower($property->title,'UTF-8') 
                                                                        : "")          
                                                                 .($property->abbr 
                                                                      ?  //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'
                                                                         ", аренда ".mb_strtolower($property->abbr,'UTF-8') 
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' москва ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' москва по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' в москве ифнс'  
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' в москве по ифнс' 
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' ифнс москва'  
                                                                        //+.", аренда ".mb_strtolower($property->abbr,'UTF-8').' по ифнс москва'    
                                                                        .", ".mb_strtolower($property->abbr,'UTF-8')
                                                                        : "")                                                                                                                                                                       
                                                                 .', снять, каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, москва, в москве, москвы, инспекция, налоговым, налоговой, ифнс, по ифнс, класса, коммерческой недвижимости, округ, район, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость');

else $this->pageKeywords=explode(',', 'снять, аренда в москве, федеральной налоговой службы, каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, москва, в москве, москвы, инспекция, налоговым, налоговой, ифнс, по ифнс, класса, коммерческой недвижимости, округ, район, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость');    

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

if ($model->taxReference&&$property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по ИФНС'=>array('realestates/taxReference'),
             $model->taxReference->abbr=>Yii::app()->createUrl('realestates/taxReference', array('id'=>$model->taxReference->id)),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." Москвы с регистрацией в налоговой инспеции ".$model->taxReference->num
        );

} else if (!$model->taxReference && $property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по ИФНС'=>array('realestates/taxReference'),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." в Москве по ИФНС"
        );
} else if ($model->taxReference && !$property->namewhats) {

        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по ИФНС'=>array('realestates/taxReference'),
             $model->taxReference->abbr=>Yii::app()->createUrl('realestates/taxReference', array('id'=>$model->taxReference->id)),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве, '.$model->taxReference->abbr
        );    
} else {
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             //'по ИФНС'=>array('realestates/taxReference'),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве по ИФНС'
        );
}
        //.($property->breadcrumbs ? ', '.$property->breadcrumbs : ''));
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
                ($model->taxReference 
                  ? ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->taxReference->abbr.' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' с регистрацией в '.mb_strtolower($model->taxReference->title,'UTF-8')
                      .' ('.$model->taxReference->abbr.')'.' целиком, без посредников по стоимости аренды от собственника Москвы.'
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->taxReference->abbr.' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес или торговом центре, особняке, банке, адм.здании, жилом доме,'
                      .' комлексе, парке с регистрацией в '.str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8')).' ('.$model->taxReference->abbr.')'
                      .', без посредников по стоимости аренды от собственника Москвы.')
                  : ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по ИФНС в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' целиком с регистрацией в разных инспециях федеральной налоговой службы,'
                      .' без посредников по стоимости аренды от собственника Москвы.' 
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по ИФНС в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес или торговом центре, особняке, банке, адм.здании, жилом доме, комлексе, парке,'
                      .' торговом центре различных инспекций федеральной налоговой службы, без посредников по стоимости аренды от собственника Москвы.'));
   ?>       
</h1>    
    
<?php if ( $model->taxReference->anons || $property->anons) {  ?>    
<div class="desc anons m-b18 fs-11 ff-Arial justify">    
    <?php if ( $model->taxReference->anons ) {  ?>      
    <div>
    <?php if ($short) { ?>    
    <?php echo str_replace(",","",HRu::cutstr($model->taxReference->anons,750, false, '.','. ')); ?>    
    <?php } else { ?>    
    <?php echo $model->taxReference->anons; ?>
    <?php } ?>    
    </div>    
    <?php } ?>
    <?php if ( $property->anons ) {  ?>    
    <div <?php echo ($model->taxReference->anons ? 'class="m-t10"' : '') ?>>
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

    //$model->search()->pagination->route = Yii::app()->createUrl('/realestates/taxReference', array('id'=>$model->taxReference->id)); 
    $model->search()->pagination->route = Yii::app()->createUrl('/ru/realestates/taxReference/'.$model->taxReference->id.'/vid/'.$model->realestateVid->id);
    
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
                        'metro'=>array(                                
                                'asc'=>'metro.title ASC',
                                'desc'=>'metro.title DESC',
                                'default'=>'desc',
                        ),                          
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
            'metro'=>'Метро',
            /*'realestateVid'=>'Вид',*/
            'realestateType'=>'В/цел',
            'realestateClass'=>'Класс', 
            'street'=>'Улица',
        ),
        'sorterHeader'=>'Сортировать по:',
        'template'=>"<hr class='m-t5 m-b5' />{sizer}{sorter}\n<div style='float:left;display:inline-block;'>{pager}</div>{summary}\n<br/>{items}\n<div style='clear:both'></div><div style='float:left;display:inline-block;'>{pager}</div>{summary}",        
        'sizerVariants'=>  HRu::cutarray(array(6, 8, 10, 12, 16, 20, 24, 30),$model->search()->getTotalItemCount()),
        'sizerAttribute'=>'size',
        'sizerHeader'=>'Выводить по: ',
        'short'=>$short,
        'beforeAjaxUpdate'=>$beforeAjaxUpdate,
        'afterAjaxUpdate'=>$afterAjaxUpdate,    
        //'ajaxUrl'=>Yii::app()->createUrl('/ru/realestates/taxReference/'.$model->taxReference->id.'/vid/'.$model->realestateVid->id),
)); ?>    

   <?php   $this->renderPartial('_send',array('model'=>$model_claim));?>

    </div>
    <hr class="m-t10 m-b8" />
    
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>  
    <?php } ?>
    
    <?php if ( $model->taxReference->detile || $property->detile ) {  ?>    
    <div class="desc detile m-t8 m-b14 fs-10 ff-tahoma">    
        <?php if ( $model->taxReference->detile ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($model->taxReference->detile,1500, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $model->taxReference->detile; ?>
            <?php } ?>                             
            </div>    
        <?php } ?>
        <?php if ( $property->detile ) {  ?>    
            <div <?php echo ($model->taxReference->detile ? 'class="m-t10"' : '') ?>>
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
    
    <?php if ( $model->taxReference->description || $property->description ) {  ?>    
    <div class="desc detile m-b18 fs-10 ff-tahoma">    
        <?php if ( $model->taxReference->description ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($model->taxReference->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $model->taxReference->description; ?>
            <?php } ?>                 
            </div>    
        <?php } ?>
        <?php if ( $property->description ) {  ?>    
            <div <?php echo ($model->taxReference->description ? 'class="m-t10"' : '') ?>>
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