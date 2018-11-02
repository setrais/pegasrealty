<?php 
      $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); 
      $cnt=count($model->spaceProperties);
      $listProperties='';
      foreach ($model->spaceProperties as $key=>$spacePropertie) { 
          if ($cnt<>($key+1)) $listProperties.= CHtml::encode($props[$spacePropertie->property_id])
                                                   .'<span class="ed" >/</span>';
          else $listProperties.= CHtml::encode($props[$spacePropertie->property_id]);
      } 
?>    
<?       
    $spaceFotos=array();
    foreach ($model->spaceFotos as $key=>$spaceFoto) $spaceFotos[] = $spaceFoto->file_id; 
      if (!empty($spaceFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$spaceFotos).')');                          
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
              
              if( !file_exists($picRes) ) {
                  $image = Yii::app()->image->load($src);
                 /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                  $image->resize($pic_width,$pic_height);
                  $image->save($res); // or $image->save('images/small.jpg');
              }
                                          
              $afotos[]=array('image_url'=>$picRes);              
           } 
       ?>

<?php } ?>
<?php 
     // Схожие предложения     
     //print_r($model->spacesSimilarities);
?> 
<div class="container" id="page">
    <div id="header" style="background-color: yellow;">
        <div id="logo" class="fl w-396" >
             <div class="lozung" >
               <?php echo CHtml::encode(Yii::app()->name); ?>
             </div>
        </div>
        <div id="phone" class="phone fr w-180" >
            +7(495)766-63-90    
        </div>
        <div class="clear" ></div>
    </div>
    <div id="content" class="p-b0">
        <div class="content" >    
            <div class="title" >    
                <div class="fl w-346">            
                    <h1>
                        <?php echo $model->title; ?><?php// echo Yii::t('all','View Spaces');?>
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
                                        array( 'name'=>'spaceType.title',
                                               'label'=>Yii::t('label','Space Type'),                    
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
                                        array( 'name'=>'spaceVid.title',
                                               'label'=>Yii::t('label','Space Vid'),                    
                                        ),  
                                        array( 'name'=>'spaceClass.abbr',
                                               'label'=>Yii::t('label','Space Class'),                    

                                        ),
                                        array( 'name'=>'planning.title',
                                               'label'=>Yii::t('label','Planning'),                                                               
                                        ),
                                        array( 'name'=>'coefficient_corridor',
                                               'value'=>($model->coefficient_corridor===null ? 'не указан' : $model->coefficient_corridor),
                                        ),
                                         array( 'name'=>'is_separate_entrance',
                                                'value'=>($model->is_separate_entrance ? 'да' : 'нет'),
                                        ),                                
                                        array( 'name'=>'area',
                                               'type'=>'html',
                                               'value'=>round($model->area)
                                                       .' <span class="ed">'.Yii::t('all','м2').'</span>',
                                        ),                  
                                        array( 'name'=>'price',
                                               'type'=>'html',
                                               'value'=>round($model->price).' <span class="ed">'.$model->valute->abbr.'</span>',
                                        ),                         
                                        array( 'name'=>'tax.abbr',
                                               'label'=>Yii::t('label','Tax'),                       
                                        ), 
                                        array( 'name'=>'parking.title',
                                               'label'=>Yii::t('label','Parking'),
                                               'type'=>'html',
                                               'value'=>'<span style="text-transform: lowercase;">'
                                                            .$model->parking->title.'</span> - '
                                                            .'<b>'.$model->cnt_parking_place.'</b> '
                                                            .' <span class="ed">'.Yii::t('all','м/м').' </span>',
                                        ),  
                                        /*array( 'name'=>'spaceProperties',
                                               'label'=>'Свойства',//Yii::t('label','Space Properties'),
                                               'type'=>'html',
                                               'value'=>$listProperties,
                                        ),*/                                
                                        /*array( 'name'=>'district.title',
                                               'label'=>Yii::t('label','District'),
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
                </div>    
                <div class="clear"></div>
            </div>
            <div class="detile">
                <div class="fl w-342 maxh-246 overflow" >                                           
                           <h3 class="center c-fill m-5 fs-14 ff-tahoma"><b>Описание недвижемости:</b></h3>                                                                                  
                           <? if ( trim($model->detile)<>'' ) { ?>    
                           <?php echo $model->detile; ?>  
                           <? } ?>                           
                           <h3 class="center c-fill m-5 fs-14 ff-tahoma"><b>Для заметок:</b></h3>                                                                                                             
                           <div class="notes">
                             <? for ($i=0 ; $i<16 ; $i++ ) : ?>  
                              <div class="row">&nbsp;</div>    
                             <?endfor;?> 
                           </div>                    
                 </div>       
                 <div class="fr p-l5">       
                    <div class="map p-5 m-t10 radius-5 bg-blue">
                     <img src="http://maps.google.com/maps/api/staticmap?center=<?php echo $model->map_latitude; ?>,<?php echo $model->map_longitude;?>&zoom=14&size=360x420&maptype=roadmap
                        &&markers=color:blue%7Clabel:S%7C<?php echo $model->map_latitude;?>,<?php echo $model->map_longitude;?>&sensor=false" />   
                     <?php// echo $map; ?>
                    </div> 
                 </div>    
                 <div class="clear"></div>
            </div>
            <div class="description p-5">
                 <?php echo $model->description; ?>
            </div>
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
    <div id="footer" >        
          <span class="contacts">Влад Ладожский 8(926)244-40-30</span>    
    </div>
</div>   
