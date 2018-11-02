<?php
/* @var $this SubscribeController */
/* @var $data Subscribe */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('typesubs_id')); ?>:</b>
	<?php echo CHtml::encode($data->typesubs_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastsubs_id')); ?>:</b>
	<?php echo CHtml::encode($data->lastsubs_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastsubs_date')); ?>:</b>
	<?php echo CHtml::encode($data->lastsubs_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo CHtml::encode($data->del); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('act')); ?>:</b>
	<?php echo CHtml::encode($data->act); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('fid')); ?>:</b>
	<?php echo CHtml::encode($data->fid); ?>
	<br />

	*/ ?>

</div>