      <div class="shogpred" > 
      <?php $this->beginWidget('ext.widgets.carousel.ECarouselWidget'); ?>
            <? foreach ( $favs as $fav ) { ?>
            <li>
               <div id="item-shogpred-<?=$fav->id;?>" class="item-shogpred" >
                   <div class="pic radius-3 center" >
      <?php 
      $thumb_picsim_width = 120;
      $thumb_picsim_height = 80;
      
      if ( trim($fav->pic_oreginal_id)<>"") 
      {       
         $pic = $fav->picOreginal->original_name; 
         $thumb = str_replace('_original'.substr($fav->picOreginal->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($fav->picOreginal->original_name,-4,4), $fav->picOreginal->original_name);          
      } else if( trim($fav->pic_detile_id)<>"" )
      {  
         $pic = $fav->picDetile->original_name; 
         $thumb = str_replace('_big'.substr($fav->picDetile->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($fav->picDetile->original_name,-4,4), $fav->picDetile->original_name); 
      } else if( trim($fav->pic_anons_id)<>"" )
      {  
         $pic = $fav->picAnons->original_name;  
         $thumb = str_replace('_original'.substr($fav->picAnons->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($fav->picAnons->original_name,-4,4), $fav->picAnons->original_name);                                 
      } else 
      {                  
         $thumb = '/images/no_foto.png';          
      }
            
      $picSrc = '/'.$pic;      
      $picThumb = '/'.$thumb;      
      
      if( !file_exists($picSrc) ) {
          $image = Yii::app()->image->load($pic);
          $image->resize($thumb_picsim_width,$thumb_picsim_height);
          $image->save($thumb); 
      }      
?>           
<?php 
      echo CHtml::link(CHtml::image( $picThumb,'', array('title'=>'Cкриншот '.$fav->title )), 
                       array('spaces/view','id'=>$fav->id),  
                        /*'/'.$fav->picOreginal->original_name*/ array('class'=>'fancyImage')); 
?>                       
                   </div>   
                   <div class="desc">
                       <div class="title">
                        <? echo CHtml::link('<b>'.$fav->title.'</b>',
                                  array('spaces/view','id'=>$fav->id)
                                ); ?>
                        <? /*<a href="#" ><b><?=$fav->title;?></b></a>*/?>   
                       </div>
                       <div class="area c-333 p-2"><b><?=ceil($fav->area);?>&nbsp;м2</b></div>
                       <div class="price p-2"><b><?=round($fav->price,2);?>&nbsp;<?=$fav->valute->abbr;?></b></div>
                   </div>                   
               </div>  
            </li> 
            <? } ?>
      <?php $this->endWidget(); ?>
      </div>