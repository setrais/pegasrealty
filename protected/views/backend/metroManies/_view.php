<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro_id')); ?>:</b>
	<?php echo CHtml::encode($data->metro_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('many_id')); ?>:</b>
	<?php echo CHtml::encode($data->many_id); ?>
	<br />


</div>