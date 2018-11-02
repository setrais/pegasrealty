<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iblock_id')); ?>:</b>
	<?php echo CHtml::encode($data->iblock_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_iblock_id')); ?>:</b>
	<?php echo CHtml::encode($data->type_iblock_id); ?>
	<br />


</div>