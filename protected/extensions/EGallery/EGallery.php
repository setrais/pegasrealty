<?php

class EGallery extends CWidget
{
    public $model;
    public $pictures;
    public $pictures_controller;
    public $ajax_upload_config;

	#true allows to upload for non existing record
	public $force = false;
	public $title = true;
	public $show_grid = true;

    public function run()
    {
        echo '<div class="row">';
		if ($this->title)
			echo CHtml::label('Фотогалерея', false);

        if (!$this->model->isNewRecord || $this->force) {
            $baseUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets', false, -1, true);
            Yii::app()->clientScript->registerCssFile($baseUrl . '/gallery.css');

            $this->widget('application.extensions.EAjaxUpload.EAjaxUpload', $this->ajax_upload_config);

			if ($this->show_grid)
			{
				echo '<div class="row-without-label">';

				$pictures_provider = new CArrayDataProvider($this->pictures, array('pagination' => false));
				$this->widget('application.extensions.EGallery.EGalleryGridView', array(
					'id' => 'gallery-grid',
					'dataProvider' => $pictures_provider,
					'columns' => array(
						'picture',
						array(
							'class' => 'CButtonColumn',
							'template' => '{view} {delete}',
							'deleteButtonUrl' =>
								'Yii::app()->controller->createUrl("'.$this->pictures_controller.'/delete", array("id" => $data->primaryKey))',
							'viewButtonUrl' => '$data->uploadTo(\'picture\')',
							'viewButtonOptions' => array('class' => 'view', 'rel' => 'gallery-grid-images'),
						),
					),
				));

				$this->widget('application.extensions.EFancyBox.EFancyBox', array(
					'target' => '#gallery-grid a.view',
					'config' => array(),
				));

				echo '</div>';
			}
        } else {
            echo 'Возможность будет доступна после создания записи';
        }

        echo '</div>';
    }
}
