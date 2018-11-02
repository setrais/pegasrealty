<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('space_id')); ?>:</b>
	<?php echo CHtml::encode($data->space_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('space_foto_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->space_foto_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_id')); ?>:</b>
	<?php echo CHtml::encode($data->file_id); ?>
	<br />


</div>