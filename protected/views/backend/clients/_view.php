<div class="view">
        <div>
            <div class="fl">
                <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
                <?php echo CHtml::encode($data->name); ?>
            </div>        
            <div class="fr">
                <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>&nbsp;                
                <b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
                <?php echo CHtml::encode($data->sid); ?>
            </div>
            <div class="clear" ></div>
        </div>
	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_person')); ?>:</b>
	<?php echo CHtml::encode($data->contact_person); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_types_id')); ?>:</b>
	<?php echo CHtml::encode($data->phoneTypes->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('email_types_id')); ?>:</b>
	<?php echo CHtml::encode($data->emailTypes->title); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->site), $data->site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacts')); ?>:</b>
	<?php echo CHtml::encode($data->contacts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scope_id')); ?>:</b>
	<?php echo CHtml::encode($data->scope->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_vids_id')); ?>:</b>
	<?php echo CHtml::encode($data->siteVids->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->clientType->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act')); ?>:</b>
	<?php echo CHtml::encode(($data->act) ? 'да' : 'нет'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo CHtml::encode(($data->del) ? 'да' : 'нет'); ?>
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

</div>