<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('space_id')); ?>:</b>
	<?php echo CHtml::encode($data->space_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_id')); ?>:</b>
	<?php echo CHtml::encode($data->property_id); ?>
	<br />


</div>