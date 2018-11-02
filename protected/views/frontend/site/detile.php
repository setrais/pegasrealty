<?php
$this->pageTitle=Yii::t('all',Yii::app()->name). ' - '.Yii::t('tcontent',$item->title);
$this->breadcrumbs=array(
    Yii::t('tcontent',$item->title),
);
?>
<h1><?php echo Yii::t('tcontent',$item->title); ?> <?php echo $icons; ?></h1>
<?//=print_r($childs)?>
<?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>  
<div>
    <div class="pic-detile fl">
       <? $dpic_url = Files::model()->findByPk($item->pic_detile_id);
           if ($dpic_url) {
                 CHtml::link( CHtml::image( $dpic_url->original_name, 
                                $item->title, array("class"=>"detile-image")), 
                                $item->url, array("class"=>"detile-link fancy-box"));
           } else {
                                CHtml::link( CHtml::image( 'images/no-foto-detile.png', 
                                             $item->title, array("class"=>"detile-image")), 
                                             $item->url, array("class"=>"detile-link fancy-box"));
          } 
       ?>   
    </div> 
    <div class="detile">
        <?=( trim(Yii::t('dcontent',$item->detile))<>'' ? CHtml::encode(Yii::t('dcontent',$item->detile)) : $item->detile ); ?>
    </div> 
    <div class="clear"></div>     
</div>