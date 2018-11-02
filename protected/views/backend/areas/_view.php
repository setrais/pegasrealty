<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
	<?php echo CHtml::encode($data->sid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('district_id')); ?>:</b>
	<?php echo CHtml::encode($data->district->title); ?>
        <?php// echo CHtml::encode($data->district->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abbr')); ?>:</b>
	<?php echo CHtml::encode($data->abbr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode('Расшифровка аббривиатуры'/*$data->getAttributeLabel('desc')*/); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br /> 
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('anons')); ?>:</b>
	<?php echo CHtml::encode($data->anons); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('detile')); ?>:</b>
	<?php echo CHtml::encode($data->detile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act')); ?>:</b>
	<?php echo CHtml::encode($data->act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo CHtml::encode($data->del); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_date')); ?>:</b>
	<?php echo CHtml::encode($data->update_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grid')); ?>:</b>
	<?php echo CHtml::encode($data->grid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weigth')); ?>:</b>
	<?php echo CHtml::encode($data->weigth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_title')); ?>:</b>
	<?php echo CHtml::encode($data->seo_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_desc')); ?>:</b>
	<?php echo CHtml::encode($data->seo_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->seo_keywords); ?>
	<br />

	*/ ?>

</div>