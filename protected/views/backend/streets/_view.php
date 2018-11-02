<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
        
	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
	<?php echo CHtml::encode($data->sid); ?>
	<br />*/?>
        
	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />*/?>  
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SOCR')); ?>:</b>
	<?php echo CHtml::encode($data->SOCR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('index')); ?>:</b>
	<?php echo CHtml::encode($data->index); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GNINMB')); ?>:</b>
	<?php echo CHtml::encode($data->GNINMB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UNO')); ?>:</b>
	<?php echo CHtml::encode($data->UNO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('OCATD')); ?>:</b>
	<?php echo CHtml::encode($data->OCATD); ?>
	<br />

	*/ ?>

</div>