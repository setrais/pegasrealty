<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aid')); ?>:</b>
	<?php echo CHtml::encode($data->aid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_title')); ?>:</b>
	<?php echo CHtml::encode($data->name_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_many')); ?>:</b>
	<?php echo CHtml::encode($data->name_many); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_that')); ?>:</b>
	<?php echo CHtml::encode($data->name_that); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fomula')); ?>:</b>
	<?php echo CHtml::encode($data->fomula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	*/ ?>

</div>