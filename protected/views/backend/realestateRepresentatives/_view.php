<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realestate_id')); ?>:</b>
	<?php echo CHtml::encode($data->realestate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('representative_id')); ?>:</b>
	<?php echo CHtml::encode($data->representative_id); ?>
	<br />


</div>