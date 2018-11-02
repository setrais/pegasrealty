<?php
$this->pageTitle=Yii::t('tcontent',$item->title).' - '.Yii::t('all',Yii::app()->name);
$this->pageDescription=Yii::t('all',$item->description); 
$this->pageKeywords=explode(',',$item->keywords); 
if ($item->section) {
    $this->breadcrumbs=array(
        Yii::t('tcontent',Yii::t('all',Yii::t('menu',trim($item->section->title))))=>array('site/list','id'=>$item->section->id),
        Yii::t('tcontent',Yii::t('all',Yii::t('menu',trim($item->title)))), 
    );
} else {
    $this->breadcrumbs=array(    
    Yii::t('tcontent',Yii::t('all',Yii::t('menu',trim($item->title)))), 
    );
}
?>

<h1><?php echo Yii::t('tcontent',Yii::t('all',trim($item->title))); ?><?php echo $icons; ?></h1>
<?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>  
<p>
    <?=$item->detile;/*( trim(Yii::t('dcontent',$item->detile))<>'' ? CHtml::encode(Yii::t('dcontent',$item->detile)) : CHtml::encode($item->detile) ); */?>
</p>