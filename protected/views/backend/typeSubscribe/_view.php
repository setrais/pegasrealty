<?php
/* @var $this TypeSubscribeController */
/* @var $data TypeSubscribe */
?>

<div class="view">

    <div>
        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>	
        <span style="padding-left: 3px; padding-right: 3px;"><?php echo CHtml::image( ( trim($data->icon)<>"" && file_exists($_SERVER[DOCUMENT_ROOT].trim($data->icon)) 
                            ? trim($data->icon) : "/images/no_foto_scr.png" ), $data->title, array( 'title'=> $data->title, 'style'=>'vertical-align:middle;' )); ?></span>        
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?> 
    </div>

     <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('icon')); ?>:</b>
	<?php echo CHtml::image( ( trim($data->icon)<>"" && file_exists($_SERVER[DOCUMENT_ROOT].trim($data->icon)) 
                            ? trim($data->icon) : "/images/no_foto_scr.png" )); ?>
	<br />*/?>
        
    <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('grid')); ?>:</b>
	<?php echo CHtml::encode($data->grid); ?>
	<br />*/?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
    <?php echo CHtml::encode($data->sort); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('template')); ?>:</b>
    <?php echo CHtml::encode($data->template); ?>
    <br />
        
    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br />

    <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />*/?>
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo CHtml::encode($data->del==0 || $data->del===null ? 'нет' : 'да'); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('act')); ?>:</b>
	<?php echo CHtml::encode($data->act==1 || $data->act===null ? 'да' : 'нет'); ?>
    <br />

</div>