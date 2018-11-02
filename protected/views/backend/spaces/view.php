<?php
$this->breadcrumbs=array(
	Yii::t('all','Spaces')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('menu-adm','List Spaces'), 'url'=>array('index'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('member')),
	array('label'=>Yii::t('form','Create Spaces'), 'url'=>array('create'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')),
	array('label'=>Yii::t('menu-adm','Update Spaces'), 'url'=>array('update', 'id'=>$model->id),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')),
	array('label'=>Yii::t('menu-adm','Delete Spaces'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager')),
	array('label'=>Yii::t('menu-adm','Manage Spaces'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager')),
);
?>

<h1><?php echo Yii::t('all','View Spaces');?> №<?php echo $model->nid; ?> ID:<?php echo $model->id; ?></h1>
      
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

<?php 
      $repres = CHtml::listData(Representatives::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'name'); 
      $rcnt=count($model->spaceRepresentatives);
      $listRepresentatives='';
      foreach ($model->spaceRepresentatives as $key=>$spaceRepresentative) {           
          if ($rcnt<>($key+1)) $listRepresentatives.= CHtml::encode($repres[$spaceRepresentative->representative_id])                 
                    .(trim($spaceRepresentative->representative->telephone)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','телефон').': </span>'.$spaceRepresentative->representative->telephone
                                   : '')
                                .(trim($spaceRepresentative->representative->fio)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','ФИО').': </span>'.$spaceRepresentative->representative->fio
                                   : '')
                                .(trim($spaceRepresentative->representative->site)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Cайт').': </span>'
                                        .( strpos($spaceRepresentative->representative->site,"http://")===false ? "http://" : "").CHtml::link($spaceRepresentative->representative->site, $spaceRepresentative->representative->site, array("target"=>"_blank"))
                                   : '')
                                .'<span class="ed" >/</span>';
          else $listRepresentatives.= CHtml::encode($repres[$spaceRepresentative->representative_id])
                    .(trim($spaceRepresentative->representative->telephone)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','телефон').': </span>'.$spaceRepresentative->representative->telephone
                                   : '')
                                .(trim($spaceRepresentative->representative->fio)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','ФИО').': </span>'.$spaceRepresentative->representative->fio
                                   : '')
                                .(trim($spaceRepresentative->representative->site)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Cайт').': </span>'
                                        .CHtml::link($spaceRepresentative->representative->site, ( strpos($spaceRepresentative->representative->site,"http://")===false ? "http://" : "").$spaceRepresentative->representative->site, array("target"=>"_blank"))
                                   : '');
      } 
?>     

<?php 
     $similars =  CHtml::listData(Spaces::model()->findAll(), 'id', 'title'); 
     // Схожие предложения     
     $spaceSimilarities = SpaceSimilarities::model()->findAll("space_id=".$model->id." and space_linking_id=1", 
                                              array("select"=>"similaries_id"));
     $rcnt=count($spaceSimilarities);
     $listSimilarities='';
     foreach ( $spaceSimilarities as $key=>$spaceSimilaritie) {
         if ($rcnt<>($key+1)) $listSimilarities.= CHtml::encode($similars[$spaceSimilaritie->similaries_id])
                                                   .'<span class="ed" > , </span>';
          else $listSimilarities.= CHtml::encode($similars[$spaceSimilaritie->similaries_id]);
     }          
     
     $similars1 =  CHtml::listData(Spaces::model()->findAll(), 'id', 'title'); 
     $spaceSimilarities1 = SpaceSimilarities::model()->findAll("space_id=".$model->id." and space_linking_id=2", 
                                              array("select"=>"similaries_id"));
     $rcnt=count($spaceSimilarities1);          
     $listSimilarities1='';
     foreach ( $spaceSimilarities1 as $key=>$spaceSimilaritie1) {
         if ($rcnt<>($key+1)) $listSimilarities1.= CHtml::encode($similars1[$spaceSimilaritie1->similaries_id])
                                                   .'<span class="ed" > , </span>';
          else $listSimilarities1.= CHtml::encode($similars1[$spaceSimilaritie1->similaries_id]);
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
       
       $spaceFotos=array();
       foreach ($model->spaceFotos as $key=>$spaceFoto) $spaceFotos[] = $spaceFoto->file_id; 
         if (!empty($spaceFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$spaceFotos).')');                          
       ?>
       <div class="block-fotos" >
       <?php                         
           foreach ($fotos as $key=>$foto) {
              $picFoto = '/'.str_replace('_original'.substr($foto->original_name,-4,4),
                             '_small'.substr($foto->original_name,-4,4),
                             $foto->original_name); 
       ?>                                                
          <div id="space-fotos-<?=$spaceFoto->id;?>" class="space-fotos">
            <div class="fotos" >
            <?php
                echo CHtml::link(CHtml::image( $picFoto, '', 
                                   array('title'=>$foto->name)),                                                       
                                     '/'.$foto->original_name, 
                                     array('class'=>'fancySladeShow',
                                           'rel'=>'spaceFotos',
                                           'title'=>$foto->name));                           
            ?>                       
            </div>
          </div>
   <?php   } ?>
         </div>
 <?php } ?>
 <?php 
       $spaceFotos = ob_get_contents(); 
       ob_end_clean(); 
 ?>

 <?php ob_start(); ?>
 <?php $spacePresentations=array();
      foreach ($model->spacePresentations as $key=>$spacePresentation) $spacePresentations[] = $spacePresentation->file_id; 
        if (!empty($spacePresentations)) {
                $presentations = Files::model()->findAll('id in ('.implode(",",$spacePresentations).')');
   ?>               
        <div class="presents" >
        <?php foreach ($presentations as $key=>$presentation) { ?>

           <div id="space-presentations-<?=$spacePresentation->id;?>" class="space-presentations">
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
       $spacePresentations = ob_get_contents(); 
       ob_end_clean(); 
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(              
                'title',
                'address',
                'sid',  
                array( 'name'=>'spaceType.title',
                       'label'=>Yii::t('label','Space Type'),                    
                ),
                array( 'name'=>'fav',
                       'value'=>($model->fav ? 'да' : 'нет'),
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
                array( 'name'=>'spaceVid.title',
                       'label'=>Yii::t('label','Space Vid'),                    
                ),
                array( 'name'=>'spaceClass.abbr',
                       'label'=>Yii::t('label','Space Class'),                    

                ),
                array( 'name'=>'date_rang',
                       'label'=>Yii::t('label','Date Rang'),                                        
                       'value'=>( $model->date_rang==null ? null : date('d.m.Y', strtotime($model->date_rang))),
                ),
                array( 'name'=>'date_release',
                       'label'=>Yii::t('label','Date Release'),                                        
                       'value'=>( $model->date_release==null ? null : date('d.m.Y', strtotime($model->date_release))),
                ),            
                array( 'name'=>'act',
                       'value'=>($model->act ? 'да' : 'нет'),
                ),            
                array( 'name'=>'del',
                       'value'=>($model->act ? 'да' : 'нет'),
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
                'coefficient_corridor',
                array( 'name'=>'is_separate_entrance',
                       'value'=>($model->is_separate_entrance ? 'да' : 'нет'),
                ),
                array( 'name'=>'spaceProperties',
                       'label'=>Yii::t('label','Space Properties'),
                       'type'=>'html',
                       'value'=>$listProperties,
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
                                .(trim($model->representative->telephone)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','телефон').': </span>'.$model->representative->telephone
                                   : '')
                                .(trim($model->representative->fio)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','ФИО').': </span>'.$model->representative->fio
                                   : '')
                                .(trim($model->representative->site)<>'' 
                                   ? ' <span class="ed">'.Yii::t('all','Cайт').': </span>'
                                     .CHtml::link( $model->representative->site, ( strpos($model->representative->site,"http://")===false ? "http://" : "").$model->representative->site, 
                                                        array("target"=>"_blank"))
                                   : '')
                ),   
                array( 'name'=>'spaceRepresentatives',
                       'label'=>Yii::t('label','Space Representatives'),
                       'type'=>'html',
                       'value'=>$listRepresentatives,
                ),     
                array( 'name'=>'commission.title',
                       'label'=>Yii::t('label','Commission'),                                                               
                       'type'=>'html',
                       'value'=>$model->commission->title.( trim($model->procent_commission)<>'' 
                                    ? ' - <b>'.$model->procent_commission.'</b> <span class="ed" >%</span>' : ''),
                ),
                'tax_number',
                array( 'name'=>'spaceSimilarities',
                       'label'=>Yii::t('label','Space Similarities'),
                       'type'=>'html',
                       'value'=>$listSimilarities,
                ),  
                array( 'name'=>'spaceSimilarities1',
                       'label'=>Yii::t('label','Space Similarities1'),
                       'type'=>'html',
                       'value'=>$listSimilarities1,
                ),              
                'number_tax',                  
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
                array( 'name'=>'spaceFotos',
                       'type'=>'html',
                       'value'=>$spaceFotos 
                     ),               
                array( 'name'=>'spacePresentations',
                       'type'=>'html',
                       'value'=>$spacePresentations 
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
                array( 'name'=>'update_date',
                       'label'=>Yii::t('label','Update Date'),                                        
                       'value'=>( $model->update_date==null ? "" : date('d.m.Y', strtotime($model->update_date))),
                ),
		array( 'name'=>'update_user',
                       'label'=>Yii::t('label','Updateuser'),                                        
                       'value'=>( $model->update_user ? $model->updateUser->email : ""),
                )                
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
       $(".fancySladeShow").attr("rel","spaceFotos"); 
       $(".fancySladeShow[rel=spaceFotos]").fancybox({
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