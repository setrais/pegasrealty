<?php
$this->breadcrumbs=array(
	Yii::t('all','Realestates')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('menu-adm','List Realestates'), 'url'=>array('index'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('member')
                         || Yii::app()->user->checkAccess('editor')
        ),
	array('label'=>Yii::t('form','Create Realestates'), 'url'=>array('create'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
        ),
	array('label'=>Yii::t('menu-adm','Copy Realestates'), 'url'=>array('copy', 'id'=>$model->id),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')                         
        ),    
	array('label'=>Yii::t('menu-adm','Update Realestates'), 'url'=>array('update', 'id'=>$model->id),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('editor')
        ),
	array('label'=>Yii::t('menu-adm','Delete Realestates'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager')
        ),
	array('label'=>Yii::t('menu-adm','Manage Realestates'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager')
                         || Yii::app()->user->checkAccess('editor')
        ),
);
?>

<h1><?php echo Yii::t('all','View Realestates');?> №<?php echo $model->nid; ?> ID:<?php echo $model->id; ?></h1>
      
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

<?php 
      $repres = CHtml::listData(Representatives::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'name'); 
      $rcnt=count($model->realestateRepresentatives);
      $listRepresentatives='';
      foreach ($model->realestateRepresentatives as $key=>$realestateRepresentative) {           
          if ($rcnt<>($key+1)) $listRepresentatives.= CHtml::encode($repres[$realestateRepresentative->representative_id])                               
                                .( (trim($realestateRepresentative->representative->telephone)<>'' || trim($realestateRepresentative->representative->telephone1)<>'' 
                                    || trim($realestateRepresentative->representative->telephone2)<>'' || trim($realestateRepresentative->representative->telephone3)<>'')
                                   ? ' <span class="ed">'.Yii::t('all','телефон').': </span>'
                                        .(trim($realestateRepresentative->representative->telephone)<>'' ? $realestateRepresentative->representative->telephone : '')
                                        .(trim($realestateRepresentative->representative->telephone_1)<>'' ? (trim($realestateRepresentative->representative->telephone)<>'' ? ' / ' : '').$realestateRepresentative->representative->telephone_1 : '')
                                        .(trim($realestateRepresentative->representative->telephone_2)<>'' ? (trim($realestateRepresentative->representative->telephone)<>'' || trim($realestateRepresentative->representative->telephone_1)<>'' ? ' / ' : '').$realestateRepresentative->representative->telephone_2 : '')
                                        .(trim($realestateRepresentative->representative->telephone_3)<>'' ? (trim($realestateRepresentative->representative->telephone)<>'' || trim($realestateRepresentative->representative->telephone_1)<>'' || trim($realestateRepresentative->representative->telephone_2)<>'' ? ' / ' : '').$realestateRepresentative->representative->telephone_3 : '')
                                   : '')
                                .(trim($realestateRepresentative->representative->fax)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Факс').': </span>'.$realestateRepresentative->representative->fax
                                   : '')  
                                .(trim($realestateRepresentative->representative->email)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Email').': </span>'.$realestateRepresentative->representative->email
                                   : '')                                     
                                .(trim($realestateRepresentative->representative->fio)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','ФИО').': </span>'.$realestateRepresentative->representative->fio
                                   : '')
                                .(trim($realestateRepresentativel->representative->site)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Cайт').': </span>'
                                     .CHtml::link( $realestateRepresentative->representative->site, ( strpos($realestateRepresentative->representative->site,"http://")===false ? "http://" : "").$realestateRepresentative->representative->site, 
                                                        array("target"=>"_blank"))
                                   : '')   
                                .'<span class="ed" >;</span><br/>';
          else $listRepresentatives.= CHtml::encode($repres[$realestateRepresentative->representative_id])
                    .( (trim($realestateRepresentative->representative->telephone)<>'' || trim($realestateRepresentative->representative->telephone1)<>'' 
                                    || trim($realestateRepresentative->representative->telephone2)<>'' || trim($realestateRepresentative->representative->telephone3)<>'')
                                   ? ' <span class="ed">'.Yii::t('all','телефон').': </span>'
                                        .(trim($realestateRepresentative->representative->telephone)<>'' ? $realestateRepresentative->representative->telephone : '')
                                        .(trim($realestateRepresentative->representative->telephone_1)<>'' ? (trim($realestateRepresentative->representative->telephone)<>'' ? ' / ' : '').$realestateRepresentative->representative->telephone_1 : '')
                                        .(trim($realestateRepresentative->representative->telephone_2)<>'' ? (trim($realestateRepresentative->representative->telephone)<>'' || trim($realestateRepresentative->representative->telephone_1)<>'' ? ' / ' : '').$realestateRepresentative->representative->telephone_2 : '')
                                        .(trim($realestateRepresentative->representative->telephone_3)<>'' ? (trim($realestateRepresentative->representative->telephone)<>'' || trim($realestateRepresentative->representative->telephone_1)<>'' || trim($realestateRepresentative->representative->telephone_2)<>'' ? ' / ' : '').$realestateRepresentative->representative->telephone_3 : '')
                                   : '')
                                .(trim($realestateRepresentative->representative->fax)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Факс').': </span>'.$realestateRepresentative->representative->fax
                                   : '')  
                                .(trim($realestateRepresentative->representative->email)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Email').': </span>'.$realestateRepresentative->representative->email
                                   : '')                                     
                                .(trim($realestateRepresentative->representative->fio)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','ФИО').': </span>'.$realestateRepresentative->representative->fio
                                   : '')
                                .(trim($realestateRepresentativel->representative->site)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Cайт').': </span>'
                                     .CHtml::link( $realestateRepresentative->representative->site, ( strpos($realestateRepresentative->representative->site,"http://")===false ? "http://" : "").$realestateRepresentative->representative->site, 
                                                        array("target"=>"_blank"))
                                   : '');
      } 
?>     

<?php 
     $similars =  CHtml::listData(Realestates::model()->findAll(), 'id', 'title'); 
     // Схожие предложения     
     $realestateSimilarities = RealestateSimilarities::model()->findAll("realestate_id=".$model->id." and realestate_linking_id=1", 
                                              array("select"=>"similaries_id"));
     $rcnt=count($realestateSimilarities);
     $listSimilarities='';
     foreach ( $realestateSimilarities as $key=>$realestateSimilaritie) {
         if ($rcnt<>($key+1)) $listSimilarities.= CHtml::encode($similars[$realestateSimilaritie->similaries_id])
                                                   .'<span class="ed" > , </span>';
          else $listSimilarities.= CHtml::encode($similars[$realestateSimilaritie->similaries_id]);
     }          
     
     $similars1 =  CHtml::listData(Realestates::model()->findAll(), 'id', 'title'); 
     $realestateOthers = RealestateSimilarities::model()->findAll("realestate_id=".$model->id." and realestate_linking_id=2", 
                                              array("select"=>"similaries_id"));
     $rcnt=count($realestateOthers);          
     $listOthers='';
     foreach ( $realestateOthers as $key=>$realestateSimilaritie1) {
         if ($rcnt<>($key+1)) $listOthers.= CHtml::encode($similars1[$realestateSimilaritie1->similaries_id])
                                                   .'<span class="ed" > , </span>';
          else $listOthers.= CHtml::encode($similars1[$realestateSimilaritie1->similaries_id]);
     }          
?> 

<?php 
      if ( trim($model->pic_oreginal_id)<>"" && $model->is_resize ) 
      {       
         $picScr = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                     '_src'.substr($model->picOreginal->original_name,-4,4), $model->picOreginal->original_name); 
                
         $HpicScr = CHtml::link(CHtml::image( $picScr,'', array('title'=>$model->picOreginal->name )), 
                    '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));

      } else if( trim($model->pic_scr_id)<>"" && !$model->is_resize )
      {           
         $picScr = '/'.str_replace('_original'.substr($model->picScr->original_name,-4,4),
                     '_src'.substr($model->picScr->original_name,-4,4), $model->picScr->original_name); 
                
         $HpicScr = CHtml::link(CHtml::image( $picScr,'', array('title'=>$model->picScr->name )), 
                    '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));
                
      } else 
      {          
         $HpicScr = CHtml::link(CHtml::image( '/images/no_foto.png','', array('title'=>Yii::t('all','Без фото'),
                                        'style'=>"height:40px;") ));          
      }
?>  

<?php 
      if ( trim($model->pic_oreginal_id)<>"" && $model->is_resize ) 
      {       
         $picAnons = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                     '_small'.substr($model->picOreginal->original_name,-4,4), $model->picOreginal->original_name); 
                
         $HpicAnons = CHtml::link(CHtml::image( $picAnons,'', array('title'=>$model->picOreginal->name )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));

      } else if( trim($model->pic_anons_id)<>"" && !$model->is_resize )
      {           
         $picAnons = '/'.str_replace('_original'.substr($model->picAnons->original_name,-4,4),
                     '_small'.substr($model->picAnons->original_name,-4,4), $model->picAnons->original_name); 
                
         $HpicAnons = CHtml::link(CHtml::image( $picAnons,'', array('title'=>$model->picAnons->name )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));
                
      } else 
      {          
         $HpicAnons = CHtml::link(CHtml::image( '/images/no_foto.png','', array('title'=>Yii::t('all','Без фото'),
                                        'style'=>"height:80px;") ));          
      }
?>  

<?php 
      if ( trim($model->pic_oreginal_id)<>"" && $model->is_resize ) 
      {       
         $picDetile = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                     '_big'.substr($model->picOreginal->original_name,-4,4), $model->picOreginal->original_name); 
                
         $HpicDetile = CHtml::link(CHtml::image( $picDetile,'', array('title'=>$model->picOreginal->name,
                                                                      'style'=>'width:680px;' )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));

      } else if( trim($model->pic_detile_id)<>"" && !$model->is_resize )
      {           
         $picDetile = '/'.str_replace('_original'.substr($model->picDetile->original_name,-4,4),
                     '_big'.substr($model->picDetile->original_name,-4,4), $model->picDetile->original_name); 
                
         $HpicDetile = CHtml::link(CHtml::image( $picDetile,'', array('title'=>$model->picDetile->name,
                                                                      'style'=>'width:680px;' )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));
                
      } else 
      {          
         $HpicDetile = CHtml::link(CHtml::image( '/images/no_foto.png','', array('title'=>Yii::t('all','Без фото'),
                                        'style'=>"width:680px;") ));          
      }
  ?>  

  <?php
       ob_start();
       
       $realestateFotos=array();
       foreach ($model->realestateFotos as $key=>$realestateFoto) $realestateFotos[] = $realestateFoto->file_id; 
         if (!empty($realestateFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$realestateFotos).')');                          
       ?>
       <div class="block-fotos" >
       <?php                         
           foreach ($fotos as $key=>$foto) {
              $picFoto = '/'.str_replace('_original'.substr($foto->original_name,-4,4),
                             '_small'.substr($foto->original_name,-4,4),
                             $foto->original_name); 
       ?>                                                
          <div id="realestate-fotos-<?=$realestateFoto->id;?>" class="realestate-fotos">
            <div class="fotos" >
            <?php
                echo CHtml::link(CHtml::image( $picFoto, '', 
                                   array('title'=>$foto->name)),                                                       
                                     '/'.$foto->original_name, 
                                     array('class'=>'fancySladeShow',
                                           'rel'=>'realestateFotos',
                                           'title'=>$foto->name));                           
            ?>                       
            </div>
          </div>
   <?php   } ?>
         </div>
 <?php } ?>
 <?php 
       $realestateFotos = ob_get_contents(); 
       ob_end_clean(); 
 ?>

 <?php ob_start(); ?>
 <?php $realestatePresentations=array();
      foreach ($model->realestatePresentations as $key=>$realestatePresentation) $realestatePresentations[] = $realestatePresentation->file_id; 
        if (!empty($realestatePresentations)) {
                $presentations = Files::model()->findAll('id in ('.implode(",",$realestatePresentations).')');
   ?>               
        <div class="presents" >
        <?php foreach ($presentations as $key=>$presentation) { ?>

           <div id="realestate-presentations-<?=$realestatePresentation->id;?>" class="realestate-presentations">
               <div class="presentations">
               <?php
                   echo CHtml::link( $presentation->name, 
                    'http://'.$_SERVER["SERVER_NAME"].'/'.$presentation->original_name, 
                    array('title'=>$presentation->name,
                        'style'=>'padding-right:10px;vertical-align:middle;'
                                .'color:#0078ae;font-family:Tahoma;font-size:12px;font-weight:normal;text-align:left;',
                        'class'=>'fancyFrame iframe'));                            
                ?>
               </div> 
            </div>    
        <?php } ?>                         
        </div>
<?php } ?>           
<?php 
       $realestatePresentations = ob_get_contents(); 
       ob_end_clean(); 
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(              
                'title',
                array(  'name'=>'street_id',                  
                        'value'=>($model->street ? $model->street->SOCR.".".$model->street->name : $model->newstreet),                     
                ),                          
                array(  'name'=>'street_id',                
                        'value'=>$model->street->SOCR.'.'.$model->street->name,                     
                        'visible'=>false,
                ),              
                array(  'name'=>'newstreet', 
                        'type'=>'rawtext',                  
                        'value'=>$model->newstreet,                     
                        'visible'=>false,
                ),                        
                'address',
                'sid',  
                array( 'name'=>'realestateType.title',
                       'label'=>Yii::t('label','Realestate Type'),                    
                ),
                array( 'name'=>'fav',
                       'value'=>($model->fav ? 'да' : 'нет'),
                ),              
                array( 'name'=>'recommend',
                       'value'=>($model->recommend ? 'да' : 'нет'),
                ),                 
                array( 'name'=>'rented',
                       'value'=>($model->rented ? 'да' : 'нет'),
                ),                             
                array( 'name'=>'advertised',
                       'value'=>($model->advertised ? 'да' : 'нет'),
                ),                                         
                array( 'name'=>'operation.title',
                       'label'=>Yii::t('label','Operation'),                    
                ),
                array( 'name'=>'district.title',
                       'label'=>Yii::t('label','District'),
                ),
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
                array( 'name'=>'date_rang',
                       'label'=>Yii::t('label','Date Rang'),                                        
                       'value'=>( $model->date_rang==null ? null : date('d.m.Y', strtotime($model->date_rang))),
                ),
                array( 'name'=>'update_date',
                       'label'=>Yii::t('label','Update Date'),                                        
                       'value'=>( $model->update_date==null ? "" : date('d.m.Y', strtotime($model->update_date))),
                ),
		array( 'name'=>'update_user',
                       'label'=>Yii::t('label','Updateuser'),                                        
                       'value'=>( $model->update_user ? $model->updateUser->email : ""),
                ),                            
                array( 'name'=>'date_release',
                       'label'=>Yii::t('label','Date Release'),                                        
                       'value'=>( $model->date_release==null ? null : date('d.m.Y', strtotime($model->date_release))),
                ),                 
                array( 'name'=>'act',
                       'value'=>($model->act ? 'да' : 'нет'),
                ),            
                array( 'name'=>'del',
                       'value'=>($model->del ? 'да' : 'нет'),
                ),                        
                array( 'name'=>'in_stock',
                       'value'=>($model->in_stock ? 'да' : 'нет'),
                ),
                array( 'name'=>'area',
                       'type'=>'html',
                       'value'=>round($model->area)
                               .' <span class="ed">'.Yii::t('all','м2').'</span>',
                ),
                array( 'name'=>'planning.title',
                       'label'=>Yii::t('label','Planning'),                                                               
                ),
                array( 'name'=>'coefficient_corridor',
                       'value'=>$model->getCoefficientCorridor()
                ),
                array( 'name'=>'is_separate_entrance',
                       'value'=>($model->is_separate_entrance ? 'да' : 'нет'),
                ),
                array( 'name'=>'realestateProperties',
                       'label'=>Yii::t('label','Свойства недвижимости'),//Realestate Properties
                       'type'=>'html',
                       'value'=>$listProperties,
                ),                
                array( 'name'=>'realestateDestinations',
                       'label'=>Yii::t('label','Назначение недвижимости'),//Realestate Properties
                       'type'=>'html',
                       'value'=>$model->getDestination(),
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
                array( 'name'=>'representative.name',
                       'label'=>Yii::t('label','Representative'),
                       'type'=>'html',
                       'value'=>$model->representative->name
                                .( (trim($model->representative->telephone)<>'' || trim($model->representative->telephone1)<>'' || trim($model->representative->telephone2)<>'' || trim($model->representative->telephone3)<>'')
                                   ? ' <span class="ed">'.Yii::t('all','телефон').': </span>'
                                        .(trim($model->representative->telephone)<>'' ? $model->representative->telephone : '')
                                        .(trim($model->representative->telephone_1)<>'' ? (trim($model->representative->telephone)<>'' ? ' / ' : '').$model->representative->telephone_1 : '')
                                        .(trim($model->representative->telephone_2)<>'' ? (trim($model->representative->telephone)<>'' || trim($model->representative->telephone_1)<>'' ? ' / ' : '').$model->representative->telephone_2 : '')
                                        .(trim($model->representative->telephone_3)<>'' ? (trim($model->representative->telephone)<>'' || trim($model->representative->telephone_1)<>'' || trim($model->representative->telephone_2)<>'' ? ' / ' : '').$model->representative->telephone_3 : '')
                                   : '')
                                .(trim($model->representative->fax)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Факс').': </span>'.$model->representative->fax
                                   : '')  
                                .(trim($model->representative->email)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Email').': </span>'.$model->representative->email
                                   : '')                                     
                                .(trim($model->representative->fio)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','ФИО').': </span>'.$model->representative->fio
                                   : '')
                                .(trim($model->representative->site)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Cайт').': </span>'
                                     .CHtml::link( $model->representative->site, ( strpos($model->representative->site,"http://")===false ? "http://" : "").$model->representative->site, 
                                                        array("target"=>"_blank"))
                                   : '')
                                .(trim($model->representative->desc)<>'' 
                                   ? ' <div>'./*Yii::t('all','Описание').':'.*/$model->representative->desc.'</div>'
                                   : '')
                ),   
                array( 'name'=>'realestateRepresentatives',
                       'label'=>Yii::t('label','Realestate Representatives'),
                       'type'=>'html',
                       'value'=>$listRepresentatives,
                ),     
                array( 'name'=>'commission.title',
                       'label'=>Yii::t('label','Commission'),                                                               
                       'type'=>'html',
                       'value'=>$model->commission->title.( trim($model->procent_commission)<>'' 
                                    ? ' - <b>'.$model->procent_commission.'</b> <span class="ed" >%</span>' : ''),
                ),
                array( 'name'=>'realestateSimilarities',
                       'label'=>Yii::t('label','Realestate Similarities'),
                       'type'=>'html',
                       'value'=>$listSimilarities,
                ),  
                array( 'name'=>'realestateOthers',
                       'label'=>Yii::t('label','Realestate Similarities1'),
                       'type'=>'html',
                       'value'=>$listOthers,
                ),          
                array( 'name'=>'taxReference.title', //'number_tax',                  
                       'label'=>Yii::t('label','№ tax'),
                ),
                array( 'name'=>'picScr',
                       'type'=>'html',
                       'value'=>$HpicScr 
                ),
                'anons', 
                array( 'name'=>'picAnons',
                       'type'=>'html',
                       'value'=>$HpicAnons 
                ),
                array( 'name'=>'detile',
                       'label'=>Yii::t('label','Detile'),
                       'type'=>'html',
                       'template'=>"<tr class=\"{class}\">
                                          <td colspan=\"2\">
                                            <div class=\"label-center\"><b>{label}</b></div>
                                            <div class=\"value-center\">{value}</div>
                                          </td>
                                        </tr>\n",
                ),
                array( 'name'=>'picDetile',
                       'type'=>'html',
                       'value'=>$HpicDetile,
                       'template'=>"<tr class=\"{class}\">
                                          <td colspan=\"2\">
                                            <div class=\"label-center\"><b>{label}</b></div>
                                            <div class=\"value-center\">{value}</div>
                                          </td>
                                        </tr>\n",
                ),            
                array( 'name'=>'description',
                       'label'=>Yii::t('label','Desc'),
                       'type'=>'html',
                       'template'=>"<tr class=\"{class}\">
                                          <td colspan=\"2\">
                                            <div class=\"label-center\"><b>{label}</b></div>
                                            <div class=\"value-center\">{value}</div>
                                          </td>
                                        </tr>\n",
                ),
                array( 'name'=>'realestateFotos',
                       'type'=>'html',
                       'value'=>$realestateFotos 
                     ),               
                array( 'name'=>'realestatePresentations',
                       'type'=>'html',
                       'value'=>$realestatePresentations 
                     ),                           
                array( 'label'=>Yii::t('all','Расположение на карте'),
                       'type'=>'raw',
                       'value'=>$map,
                       'template'=>"<tr class=\"{class}\" >
                                          <td colspan=\"2\" style=\"padding-top: 10px;\">                                            
                                            <div class=\"plashka label-center\"><b>{label}</b></div>
                                            <div class=\"value-center\">{value}</div>
                                          </td>
                                    </tr>\n",
                ),  
		array( 'name'=>'create_date',
                       'label'=>Yii::t('label','Create Date'),                                        
                       'value'=>( $model->create_date==null ? null : date('d.m.Y', strtotime($model->create_date))),
                ),
		array( 'name'=>'create_user',
                       'label'=>Yii::t('label','Createuser'),                                        
                       'value'=>( $model->create_user ? $model->createUser->email : ""),
                ),            
		/*		
		'map_latitude',
		'map_longitude'*/            
	),
)); ?>

<script>
    $(document).ready(function() {
    $(".fancyImage").fancybox(
       {'overlayShow': true, 'hideOnContentClick': false});
    }); 
</script>  
<script>
    $(document).ready(function() {
       $(".fancySladeShow").attr("rel","realestateFotos"); 
       $(".fancySladeShow[rel=realestateFotos]").fancybox({
                        'showCloseButton': true,
                        'overlayShow' : true,
                	'transitionIn': 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                                                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                                                  }                                   
       });                        
    }); 
</script>  
<script>
    $(document).ready(function() {
          $(".fancyFrame").fancybox(
                        {'width': 800, 'height':600, 'frameWidth' : 800, 'frameHeight': 600, 'overlayShow': true, 'hideOnContentClick': false});
    }); 
</script>  