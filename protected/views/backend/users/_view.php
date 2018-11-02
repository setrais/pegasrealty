<div class="view">
        <div >            
            <div class="fl">
                <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
                <?php echo CHtml::encode($data->title); ?>                
            </div>
            <div class="fr">	
                <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>&nbsp;
                <b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
                <?php echo CHtml::encode($data->uid); ?>
            </div>
            <div class="clear"></div>
        </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

       	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act')); ?>:</b>
	<?php echo ( $data->act ? 'да' : 'нет'); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('usersRoles')); ?>:</b>
        <? foreach ($data->usersRoles as $key=>$roles) {
             if ($key>0) {
                 echo " / ".CHtml::encode($roles->name); 
             } else {
                 echo CHtml::encode($roles->name); 
             }
           } ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo ( $data->del ? 'да' : 'нет'); ?>
	<br />
        
	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />*/?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('send_email')); ?>:</b>
	<?php echo CHtml::encode($data->send_email); ?>
	<br />
	
        <b><?php echo CHtml::encode($data->getAttributeLabel('register_date')); ?>:</b>
	<?php echo CHtml::encode($data->register_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastvisit_date')); ?>:</b>
	<?php echo CHtml::encode($data->lastvisit_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_date')); ?>:</b>
	<?php echo CHtml::encode($data->update_date); ?>
	<br />

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('param_id')); ?>:</b>
	<?php echo CHtml::encode($data->param_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_uid')); ?>:</b>
	<?php echo CHtml::encode($data->param_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phpBBLogin')); ?>:</b>
	<?php echo CHtml::encode($data->phpBBLogin); ?>
	<br />*/?>

</div>