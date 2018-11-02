<div class="view">

        <div>
            <div class="fl">
                <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
                <?php echo CHtml::encode($data->title); ?>
            </div>        
            <div class="fr">
                <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>&nbsp;                
            </div>
            <div class="clear" ></div>
        </div>
        <b><?php echo CHtml::encode($data->getAttributeLabel('abbr')); ?>:</b>
        <?php echo CHtml::encode($data->abbr); ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
        <?php echo CHtml::encode($data->uid); ?>
        <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act')); ?>:</b>
	<?php echo CHtml::encode(($data->act) ? 'да' : 'нет'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo CHtml::encode(($data->del) ? 'да' : 'нет'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anons')); ?>:</b>
	<?php echo CHtml::encode($data->anons); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('infocode')); ?>:</b>	
        <div class="infocode" style="display:inline-block;vertical-align: middle;margin:5px;"><?php echo $data->getInfoCode(); ?></div>        
	<br />
        <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ddog')); ?>:</b>
	<?php echo CHtml::encode($data->ddog); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ndog')); ?>:</b>
	<?php echo CHtml::encode($data->ndog); ?>
	<br />
        */?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->site), $data->site); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact')); ?>:</b>
	<?php echo CHtml::encode($data->contact); ?>
	<br />

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />*/?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('mypage')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mypage),$data->mypage); ?>
	<br />

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user')); ?>:</b>
	<?php echo CHtml::encode($data->createUser->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_date')); ?>:</b>
	<?php echo CHtml::encode($data->update_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user')); ?>:</b>
	<?php echo CHtml::encode($data->updateUser->username); ?>
	<br />*/?>

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
        <div style="margin: 3px 0 7px 0;">
	<?php echo CHtml::encode($data->desc); ?>
        </div>*/?>    

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('logo_id')); ?>:</b>
	<?php echo CHtml::encode($data->logo_id); ?>
	<br />*/?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->clientType->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_id')); ?>:</b>
	<?php echo $data->client_id ? CHtml::encode($data->client->name.' : '.$data->client->contact.' > '.$data->client->email) : 'не указан'; ?>
	<br />
</div>
<?php
    // Прикрытие инфо кода
    include __DIR__ . '/include/_var_infocode.php';
?> 
