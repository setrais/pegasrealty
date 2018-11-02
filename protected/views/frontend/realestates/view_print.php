<?php 
      $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); 
      $cnt=count($model->realestateProperties);
      $listProperties='';
      foreach ($model->realestateProperties as $key=>$realestatePropertie) { 
          if ($cnt<>($key+1)) $listProperties.= CHtml::encode($props[$realestatePropertie->property_id])
                                                   .'<span class="ed" >/</span>';
          else $listProperties.= CHtml::encode($props[$realestatePropertie->property_id]);
      } 
?>    
<?       
    $realestateFotos=array();
    foreach ($model->realestateFotos as $key=>$realestateFoto) $realestateFotos[] = $realestateFoto->file_id; 
      if (!empty($realestateFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$realestateFotos).')');                          
       ?>
       <?php                         
           foreach ($fotos as $key=>$foto) {
              
              $pic_width  =null;
              $pic_height ="214";              

              $src = str_replace('_original'.substr($foto->original_name,-4,4),
                             '_big'.substr($foto->original_name,-4,4),
                             $foto->original_name);               
              
                                                      
              $res = str_replace('_original'.substr($foto->original_name,-4,4),
                                 '_'.$pic_width.'x'.$pic_height.substr($foto->original_name,-4,4),
                                                                       $foto->original_name);     
                                        
              $picRes = '/'.$res; 
              
              if( file_exists($src) ) {                  
                  if( !file_exists($res) ) {
                      $image = Yii::app()->image->load($src);
                     /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                      $image->resize($pic_width,$pic_height);
                      $image->save($res); // or $image->save('images/small.jpg');
                  }

                  $afotos[]=array('image_url'=>$picRes);                                
              }    
              /*if( !file_exists($picRes) ) {
                  $image = Yii::app()->image->load($src);
                 //$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);
                  $image->resize($pic_width,$pic_height);
                  $image->save($res); // or $image->save('images/small.jpg');
              }*/ 
                                          
              
           } 
       ?>

<?php } ?>
<?php 
     // Схожие предложения     
     //print_r($model->realestatesSimilarities);
?> 
<div class="container" id="page">
    <div id="header" style="background-color: yellow;">
        <div id="logo" class="fl w-496" style="width:526px;">
             <div class="lozung fs-18 valign-m">
               <?php echo CHtml::encode(Yii::t('all',Yii::app()->name));?>
             </div>
        </div>
        <div id="phone" class="phone fr w-180" >
            +<?php echo Yii::app()->params["contact"]["code_country"];?> (<?php echo Yii::app()->params["contact"]["code_oper"];?>) <?php echo Yii::app()->params["contact"]["code_phone"];?>
        </div>
        <div class="clear" ></div>
    </div>
    <div id="content" class="p-b0">
        <div class="content" >    
            <div class="title" >    
                <div class="fl w-346">            
                    <h1>
                        <?php echo $model->title; ?><?php// echo Yii::t('all','View Realestates');?>
                    </h1>
                </div>    
                <div class="fr fs-18 c-333 w-129">            
                    <span>Лот: №<?php echo $model->nid; ?></span>
                </div>
                <div class="clear"></div>
            </div>         
            <div class="item" >
                <div class="props w-346 fl mh-438 radius-5 bg-blue" style="margin-top:7px;" >
                     <div class="bg-blue radius-5-0 p-5 m-l1-r1" ></div>                                        
                     <div>
                     <?php $this->widget('zii.widgets.CDetailView', array(
                                'data'=>$model,
                                'attributes'=>array(              
                                        /*'address',*/
                                        array( 'name'=>'operation.title',
                                               'label'=>Yii::t('label','Operation'),                    
                                        ),
                                        array( 'name'=>'realestateType.title',
                                               'label'=>Yii::t('label','Realestate Type'),                    
                                        ),
                                        /*array( 'name'=>'fav',
                                               'value'=>($model->fav ? 'да' : 'нет'),
                                        ),*/
                                        array( 'name'=>'metro.title',
                                               'label'=>Yii::t('label','Metro'),
                                        ),
                                        array( 'name'=>'remoteness',
                                               'label'=>Yii::t('label','Remoteness'),
                                               'type'=>'html',
                                               'value'=>round($model->remoteness)
                                                        .' <span class="ed">'.$model->unit->short_title.'</span>',
                                        ),
                                        array( 'name'=>'realestateVid.title',
                                               'label'=>Yii::t('label','Realestate Vid'),                    
                                        ),  
                                        array( 'name'=>'realestateClass.abbr',
                                               'label'=>Yii::t('label','Realestate Class'),                    

                                        ),
                                        array( 'name'=>'planning.title',
                                               'label'=>Yii::t('label','Planning'),                                                               
                                        ),
                                        array( 'name'=>'coefficient_corridor',
                                               'value'=>($model->coefficient_corridor===null ? 'не указан' : $model->getCoefficientCorridor()),
                                        ),
                                         array( 'name'=>'is_separate_entrance',
                                                'value'=>($model->is_separate_entrance ? 'да' : 'нет'),
                                        ),                                
                                        array( 'name'=>'area',
                                               'type'=>'html',
                                               'value'=>round($model->area)
                                                       .' <span class="ed">'.Yii::t('all','м2').'</span>',
                                        ),                  
                                        array( 'name'=>'stavka',
                                               'type'=>'html',
                                               'label'=>Yii::t('label','Арендная ставка'), 
                                               'value'=>round($model->price).' <span class="ed">'.$model->valute->abbr.'</span>',
                                        ),    
                                        array( 'name'=>'price',
                                               'type'=>'html',
                                               'label'=>Yii::t('label','Стоимость в месяц'),
                                               'value'=>round(($model->price*$model->area)/12).' <span class="ed">'.$model->valute->abbr.'</span>',
                                        ),  
                                        array( 'name'=>'tax.abbr',
                                               'label'=>Yii::t('label','Tax'),  
                                               'value'=>$model->tax->abbr<>'НДС' ? $model->tax->abbr." | ".$model->taxReference->abbr : "вкл.".$model->tax->abbr." | ".$model->taxReference->abbr,                                                                      
                                        ),  
                                        array( 'name'=>'parking.title',
                                               'label'=>Yii::t('label','Parking'),
                                               'type'=>'html',
                                               'value'=>'<span style="text-transform: lowercase;">'
                                                            .$model->parking->title.'</span> - '
                                                            .'<b>'.$model->cnt_parking_place.'</b> '
                                                            .' <span class="ed">'.Yii::t('all','м/м').' </span>',
                                        ),  
                                        /*array( 'name'=>'realestateProperties',
                                               'label'=>'Свойства',//Yii::t('label','Realestate Properties'),
                                               'type'=>'html',
                                               'value'=>$listProperties,
                                        ),*/                                
                                        /*array( 'name'=>'district.title',
                                               'label'=>Yii::t('label','District'),
                                        ),*/
                                        /*array( 'name'=>'areas.title',
                                               'label'=>Yii::t('label','Areas'),
                                        ),*/                            
                                        /*array( 'name'=>'taxReference.title',
                                               'label'=>Yii::t('label','№ Tax'),
                                        ),*/                                    
                                        /*array( 'name'=>'in_stock',
                                               'value'=>($model->in_stock ? 'да' : 'нет'),
                                        ),*/                                    
                                ),
                        )); ?>
                      </div> 
                      <div class="bg-blue radius-0-5 m-l1-r1 p-5 p-t16 justify">                    
                            <p><?php echo $model->anons; ?></p>
                     </div>
                </div>         
                <div class="pic-detile fr">
                    <?php 

                       $pic_width  ="460";
                       $pic_height ="";

                       if ( trim($model->pic_oreginal_id)<>"" ) 
                       {   
                           $pathfrompic = str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                                                        '_big'.substr($model->picOreginal->original_name,-4,4),
                                                        $model->picOreginal->original_name); 

                           $pathtopic = str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                                                       '_'.$pic_width.'x'.$pic_height.substr($model->picOreginal->original_name,-4,4),
                                                       $model->picOreginal->original_name); 

                           $picOreginal = '/'.$pathtopic; 

                           if( !file_exists($picOreginal) ) {
                                $image = Yii::app()->image->load($pathfrompic);
                                /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                                $image->resize($pic_width,null);
                                $image->save($pathtopic); // or $image->save('images/small.jpg');
                           }
                            echo CHtml::image( $picOreginal, '', array('title'=>$model->picOreginal->name, 'width'=>$pic_width."px" ));
                        } else { 
                            echo CHtml::image( '/images/no_foto.png','', 
                                               array('title'=>Yii::t('all','Без фото'),
                                               'style'=>"width:".$pic_width."px;height:".$pic_height."px;")                                                          
                                              );
                        }
                     ?>  
                   <div>
                    <div class="map p-5 m-t10 radius-5 bg-blue">
                     <img src="http://maps.google.com/maps/api/staticmap?center=<?php echo $model->map_latitude; ?>,<?php echo $model->map_longitude;?>&zoom=14&size=360x160<?/*360x420*/?>&maptype=roadmap
                        &&markers=color:blue%7Clabel:S%7C<?php echo $model->map_latitude;?>,<?php echo $model->map_longitude;?>&sensor=false" />   
                     <?php// echo $map; ?>
                    </div> 
                   </div>
                </div>  
                <div class="clear"></div>
            </div>
            <div class="detile">                        
                <div class="<?/*fl w-342*/?> maxh-246 overflow" >                                           
                           <? if ( trim($model->detile)<>'' ) { ?>                     
                           <h3 class="center c-fill m-5 fs-14 ff-tahoma"><b>Описание недвижимости:</b></h3>                                                                                     
                           <?php echo $model->detile; ?>  
                           <? } ?>                           
                           <?/*<h3 class="center c-fill m-5 fs-14 ff-tahoma"><b>Для заметок:</b></h3>                                                                                                             
                           <div class="notes">
                             <? for ($i=0 ; $i<16 ; $i++ ) : ?>  
                              <div class="row">&nbsp;</div>    
                             <?endfor;?> 
                           </div>*/?>                    
                 </div>
                 <?/*<div class="fr p-l5"> 
                    <div class="map p-5 m-t10 radius-5 bg-blue">
                     <img src="http://maps.google.com/maps/api/staticmap?center=<?php echo $model->map_latitude; ?>,<?php echo $model->map_longitude;?>&zoom=14&size=360x420&maptype=roadmap
                        &&markers=color:blue%7Clabel:S%7C<?php echo $model->map_latitude;?>,<?php echo $model->map_longitude;?>&sensor=false" />   
                     <?php// echo $map; ?>
                    </div> 
                 </div>    
                 <div class="clear"></div>*/?>
            </div>
           <div class="description p-5">
             <?php echo $model->description; ?>
           </div>    
           <br/> 
       <?php 
            $cnt=count($afotos); 
            if ($cnt>0) {
       ?>
           <div style="width:100%" >
           <?php                        
                   foreach ($afotos as $key=>$foto) {
                       $picFoto = $foto["image_url"]; 
           ?>  
                   <?  if ($key%2==0) { ?> 
                           <div style="height:200px;width:100%;">
                   <?  } ?>   
                              <div class="halign-c valign-m p-5" style="<?=( $key%2==0  ? "margin:6px 30px 6px 0px;" : "margin:6px 0px 6px 30px;"); ?>float:left;width:320px;border-radius:10px; border-style: solid; border-width:5px; border-color: #E5F1F4"  >
                   <?            echo CHtml::image( $picFoto, '',array('style'=>"border-radius:5px"));    ?>                       
                              </div>
                   <?  if (($key+1)%2==0 || $cnt==($key+1)) { ?>  
                               <div class="clear"></div> 
                           </div>         
                   <?  } ?> 
           <?php } ?>
           </div>     
       <?php } ?>                     
       </div>     
    </div>
    <?/*<div id="footer" >        
          <span class="contacts">Влад Ладожский 8(926)244-40-30</span>    
    </div>*/?>
</div>   
