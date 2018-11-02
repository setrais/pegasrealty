<?php
$this->pageTitle=Yii::t('tcontent',$group->title).' - '.Yii::t('all',Yii::app()->name);
$this->breadcrumbs=array(
    Yii::t('tcontent',$group->title),
);
?>
<? $cnt_item=count($item);   ?>
<? 
   $cnt_row =10; // Количество строк
   $cnt_col=3;   // Количество колонок
   $cnt_letter = 250;
   $gcnt_letter = 150;
   $k=0;
?>
<h1><?php echo Yii::t('tcontent',$group->title); ?> <?php echo $icons; ?></h1>
<?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>            
<div class="grid">
    <div class="gpic fl">
        <? $gpic_url = Files::model()->findByPk($item->pic_anons_id);
           if ($gpic_url) {
                 CHtml::link( CHtml::image( $gpic_url->original_name, 
                                $group->title, array("class"=>"group-image")), 
                                $group->url, array("class"=>"group-link fancy-box"));
           } else {
                                CHtml::link( CHtml::image( 'images/no-foto-group.png', 
                                             $group->title, array("class"=>"group-image")), 
                                             $group->url, array("class"=>"group-link fancy-box"));
          } 
        ?>   
    </div>
    <div class="ganons">
        <?=substr($group->anons,0/*,$gcnt_letter*/);?>
    </div>
    <div class="clear"></div>
</div>
<br/>
<div>
    <? foreach ( $items as $item ) { ?>
    <?   if ( $k==0 ) { ?>
            <div class="row" >            
    <?   }  ?>             
                 <div class="fl">
                     <div class="pic fl">
                         <? $pic_url = Files::model()->findByPk($item->pic_anons_id);
                            if ($pic_url) {
                                CHtml::link( CHtml::image( $pic_url->original_name, 
                                                           $item->title, array("class"=>"item-image")), 
                                             $item->url, array("class"=>"item-link fancy-box"));
                            } else {
                                CHtml::link( CHtml::image( 'images/no-fotos.png', 
                                                           $item->title, array("class"=>"item-image")), 
                                             $item->url, array("class"=>"item-link fancy-box"));
                            } 
                         ?>   
                     </div>
                     <div class="info">
                         <h2 class="title">
                             <?=$item->title;?>
                         </h2>
                         <div class="anons">
                             <?=Ri::cutstr(Yii::t('acontent',$item->anons),300);?> 
                             <?=CHtml::link( 'подробнее',$item->url); ?>
                         </div>
                     </div>                     
                 </div>
    <?                                                          
         $k++;              
         if ( ($k%$cnt_col)==0 ) 
         {  
            $k = 0;
            
    ?>          <div class="clear"></div>                   
            </div>     
    <?   }         
       }
       if ($k>0) { ?>
                <div class="clear"></div>                   
            </div>     
       <? }  ?>    
</div>